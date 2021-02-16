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
}
