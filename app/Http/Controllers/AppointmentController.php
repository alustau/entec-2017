<?php

namespace App\Http\Controllers;


use App\Contracts\Appointment\Listable as AppointmentListable;
use App\Contracts\Appointment\Creatable as AppointmentCreatable;
use App\Contracts\Doctor\Listable as DoctorListable;
use App\Models\Appointment;
use App\Http\Requests\AppointmentStoreRequest;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function index(AppointmentListable $lister)
    {
        $appointments = $lister->all();

        return view('appointment.index', compact('appointments'));
    }

    public function create(DoctorListable $lister)
    {
        $doctors = $lister->all();

        return view('appointment.create', compact('doctors'));
    }

    public function store(AppointmentStoreRequest $request, AppointmentCreatable $creator)
    {
        $creator->create($request->all());

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
