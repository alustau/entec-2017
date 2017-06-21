<?php

namespace App\Http\Controllers;


use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return view('doctor.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'specialty' => 'required',
            'registry'  => 'required|unique:doctor',
        ]);

        if ($validator->fails()) {
            return redirect()->route('doctor.create')
                ->withErrors($validator)
                ->withInput();
        }

        Doctor::create($request->all());

        return redirect()->route('doctors.index');
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
