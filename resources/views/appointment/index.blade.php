@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Appointments list

                    <div class="row pull-right">
                        <a href="{{ route('home') }}" class="col-md-6">
                            <span class="glyphicon glyphicon-arrow-left">
                            </span>
                        </a>

                        <a href="{{ route('appointment.create') }}" class="col-md-6">
                            <span class="glyphicon glyphicon-plus">
                            </span>
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Doctor</th>
                                    <th>Specialty</th>
                                    <th>Patient Name</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>
                                            {{ $appointment->id }}
                                        </td>
                                        <td>
                                            {{ $appointment->doctor->name ?? $appointment->doctor_name }}
                                        </td>
                                        <td>
                                            {{ $appointment->doctor->specialty ?? $appointment->doctor_specialty }}
                                        </td>
                                        <td>
                                            {{ $appointment->patient_name }}
                                        </td>
                                        <td>
                                            {{ is_object($appointment->created_at) ? $appointment->created_at->format('d/m/Y H:i:s') : \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->created_at)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" href="{{ route('appointment.delete', ['doctor' => $appointment->id]) }}">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
