@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" action="{{ route('equipment.store') }}"
                      id="form">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">Добавления оборудования</div>
                        <div class="panel-body">
                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Название:</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('volume_name') ? ' has-error' : '' }}">
                                <label for="volume_name" class="col-md-3 control-label">Ед. изм:</label>
                                <div class="col-md-9">
                                    <input id="volume_name" type="text" class="form-control" name="volume_name"
                                           value="{{ old('volume_name') }}" required autofocus>
                                    @if ($errors->has('volume_name'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('volume_name') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <input type="submit" class="btn btn-primary" value="Добавить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection