@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('doctors.index') }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                                Doctors
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('appointments.index') }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                                Appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
