<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use Storage;
use File;
use Mail;
use App\Mail\TrainingCreatedMail;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->keyword != null) {
            //query based on keyword
            $trainings = Training::where('title', 'LIKE', '%'.$request->keyword.'%')->paginate(2);
        } else {
            // query all trainings from DB using Model
            $trainings = Training::paginate(2); // per page 2
        }

        // return to view with all trainings
        // resources/views/trainings/index.blade.php
        return view('trainings.index', compact('trainings'));
    }

    public function create()
    {
        // return create form to user
        return view('trainings.create');
    }

    public function store(Request $request)
    {
        // store the data into db
        //Method 1 - POPO | Plain Old PHP Object
        // $training = new Training();
        // $training->title = $request->title;
        // $training->description = $request->description;
        // $training->user_id = auth()->user()->id;
        // $training->save();

        // Method 2 - Mass Assignment + Relationship
        $user = auth()->user();
        $training = $user->trainings()->create($request->only('title', 'description'));

        //check if has attachment
        if ($request->hasFile('attachment')) {
            // rename 200-2021-03-09.png
            $filename = $training->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            // save to table
            $training->update(['attachment' => $filename]); // mass assignment + fillable properties

            //store file
            Storage::disk('public')->put($filename, File::get($request->attachment));
        }

        // send email - training has been created
        // resources/views/emails/training-created.blade.php
        // Mail::send('emails.training-created', [
        //     'title' => $training->title,
        //     'description' => $training->description
        // ], function ($message) {
        //     $message->to('tarmizi@mizi.my');
        //     $message->subject('Training Created: Using Inline Mail Facade');
        // });

        // Method 2: Send Email using Mailable Class
        // Mail::to('tarmizi@mizi.my')->send(new TrainingCreatedMail($training));

        // Method 3: Send Email with Job
        dispatch(new \App\Jobs\SendEmailJob($training));

        // return to /trainings
        return redirect('/trainings')
                    ->with([
                        'alert-type' => 'alert-primary',
                        'alert' => 'Your training has been saved.'
                    ]);
    }

    public function show(Training $training)
    {
        $this->authorize('view', $training);
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        $this->authorize('update', $training);
        return view('trainings.edit', compact('training'));
    }

    public function update(Training $training, Request $request)
    {
        $this->authorize('update', $training);
        // update data from form to db
        // Method 1 - POPO
        // $training->title = $request->title;
        // $training->description = $request->description;
        // $training->save();

        // Method 2 - Mass Assignment
        $training->update($request->only('title', 'description'));

        // return to /trainings
        return redirect()->route('training:index')
            ->with([
                'alert-type' => 'alert-success',
                'alert' => 'Your training has been updated.'
            ]);
    }

    public function delete(Training $training)
    {
        $this->authorize('delete', $training);

        if ($training->attachment != null) {
            Storage::disk('public')->delete($training->attachment);
        }
        
        $training->delete();

        return redirect()->route('training:index')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Your training has been deleted.'
            ]);
    }
}
