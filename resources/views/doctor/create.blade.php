@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Doctor Form

                    <div class="row pull-right">
                        <a href="{{ route('doctors.index') }}" class="col-md-6">
                            <span class="glyphicon glyphicon-arrow-left">
                            </span>
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="{{ route('doctor.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            @if (isset($errors) && $errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="specialty">Specialty</label>
                            <input type="text" class="form-control" name="specialty" id="specialty" placeholder="Specialty">
                            @if (isset($errors) && $errors->has('specialty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="specialty">Registry</label>
                            <input type="text" class="form-control" name="registry" id="registry" placeholder="Registry">
                            @if (isset($errors) && $errors->has('registry'))
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
