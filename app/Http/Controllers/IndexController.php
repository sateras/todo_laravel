<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('home', compact('tasks'));
    }

    public function new()
    {
        return view('new');
    }
}