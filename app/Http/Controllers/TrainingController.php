<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    public function index()
    {
        // query all trainings from DB using Model
        $trainings = Training::all();

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
        $training = new Training();
        $training->title = $request->title;
        $training->description = $request->description;
        $training->user_id = auth()->user()->id;
        $training->save();

        // return to /trainings
        return redirect('/trainings');

    }
}
