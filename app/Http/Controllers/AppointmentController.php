<?php

namespace App\Http\Controllers;


use App\Appointment;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

        Session::flash('flash_messenger', [
            'type'    => 'success',
            'message' => 'Appointement has been created'
        ]);

        return redirect()->route('appointments.index');
    }

    public function delete($appointment)
    {
        $appointment = Appointment::find($appointment);

        $appointment->delete();

        Session::flash('flash_messenger', [
            'type'    => 'success',
            'message' => 'Appointment has been removed'
        ]);

        return back();
    }
}
