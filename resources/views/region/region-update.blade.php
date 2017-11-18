@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" enctype="multipart/form-data"
                      action="{{ route('region.update', $region->id) }}">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">Обновить автомобиль</div>
                        <div class="panel-body">

                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Полное имя:</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $region->name }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('leader_id') ? ' has-error' : '' }}">
                                <label for="leader_id" class="col-md-3 control-label">Лидер:</label>
                                <div class="col-md-9">
                                    <select id="leader_id" name="leader_id" class="col-md-6" >
                                        @foreach($leaders as $leader)
                                            <option value="{{$leader->id}}" {{$region->leader->id == $leader->id ? "selected" : ""}}>{{$leader->firstName}} {{$leader->lastName}}</option>
                                        @endforeach
                                    </select >
                                    @if ($errors->has('leader_id'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('leader_id') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <input type="submit" class="btn btn-primary" value="Обновить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection