<?php

namespace App\Http\Controllers;


use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Comment\Doc;

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

    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    public function update(Doctor $doctor, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'      => 'required',
            'specialty' => 'required',
            'registry'  => [
                'required',
                Rule::unique('doctor')->ignore($doctor->id)
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->route('doctor.edit', ['doctor' => $doctor->id])
                ->withErrors($validator)
                ->withInput();
        }

        $doctor->update($data);

        return redirect()->route('doctor.edit', ['doctor' => $doctor->id]);
    }

    public function delete()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }
}
