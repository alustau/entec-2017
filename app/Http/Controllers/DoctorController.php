<?php

namespace App\Http\Controllers;


use App\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return view('doctor.index', compact('doctors'));
    }

    public function store()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function edit()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function delete()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }
}
