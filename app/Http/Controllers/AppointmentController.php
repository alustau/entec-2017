<?php

namespace App\Http\Controllers;


use App\Models\Appointment;
use App\Models\Doctor;
use App\Http\Requests\AppointmentStoreRequest;
use Illuminate\Support\Facades\Session;

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

    public function store(AppointmentStoreRequest $request)
    {
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
