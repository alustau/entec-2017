@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                     Appointment list - {{ $doctor->name }}

                    <div class="row pull-right">
                        <a href="{{ route('doctors.index') }}" class="col-md-6">
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
                                    <th>Patient Name</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($doctor->appointments->count())
                                    @foreach ($doctor->appointments as $appointment)
                                        <tr>
                                            <td>
                                                {{ $appointment->id }}
                                            </td>
                                            <td>
                                                {{ $appointment->patient_name }}
                                            </td>
                                            <td>
                                                {{ $appointment->created_at->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-xs" href="{{ route('appointment.delete', ['appointment' => $appointment->id]) }}">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">There are no appointments</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
