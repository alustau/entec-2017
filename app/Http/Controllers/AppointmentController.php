<?php

namespace App\Http\Controllers;


use App\Appointment;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointment.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::all();

        return view('appointment.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id'    => 'required',
            'patient_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('appointment.create')
                ->withErrors($validator)
                ->withInput();
        }

        Appointment::create($request->all());

        return redirect()->route('appointments.index');
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

    public function delete(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index');
    }
}
