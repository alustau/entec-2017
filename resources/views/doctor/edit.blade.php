@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Doctor Form</div>

                <div class="panel-body">
                    <form action="{{ route('doctor.update', ['doctor' => $doctor->id]) }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $doctor->id }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $doctor->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="specialty">Specialty</label>
                            <input type="text" class="form-control" name="specialty" value="{{ $doctor->specialty }}" id="specialty" placeholder="Specialty">
                            @if ($errors->has('specialty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="specialty">Registry</label>
                            <input type="text" class="form-control" name="registry" value="{{ $doctor->registry }}" id="registry" placeholder="Registry">
                            @if ($errors->has('registry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('registry') }}</strong>
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
