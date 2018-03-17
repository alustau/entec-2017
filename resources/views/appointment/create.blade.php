@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Appointment Form

                    <div class="row pull-right">
                        <a href="{{ route('appointments.index') }}" class="col-md-6">
                            <span class="glyphicon glyphicon-arrow-left">
                            </span>
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="{{ route('appointment.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Doctor</label>

                            <select name="doctor_id" id="doctor_id" class="form-control">
                                <option value>Select a doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>

                            @if (isset($errors) && $errors->has('doctor_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('doctor_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="specialty">Patient Name</label>
                            <input type="text" class="form-control"
                                   name="patient_name" id="patient_name"
                                   placeholder="Patient Name">

                            @if (isset($errors) && $errors->has('patient_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('patient_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
