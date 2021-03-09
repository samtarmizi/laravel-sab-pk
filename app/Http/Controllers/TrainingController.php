<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // query all trainings from DB using Model
        $trainings = Training::paginate(2); // per page 2

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
        $user->trainings()->create($request->only('title', 'description'));

        // return to /trainings
        return redirect('/trainings')
                    ->with([
                        'alert-type' => 'alert-primary',
                        'alert' => 'Your training has been saved.'
                    ]);
    }

    public function show(Training $training)
    {
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        return view('trainings.edit', compact('training'));
    }

    public function update(Training $training, Request $request)
    {
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
        $training->delete();

        return redirect()->route('training:index')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Your training has been deleted.'
            ]);
    }
}
