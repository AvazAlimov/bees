@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" action="{{ route('city.update', $city->id) }}"
                      id="form">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">Добавить Город/Район</div>
                        <div class="panel-body">
                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Имя:</label>
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $city->name}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 form-group{{ $errors->has('region_id') ? ' has-error' : '' }}">
                                <label for="region_id" class="col-md-3 control-label">Регион:</label>
                                <div class="col-md-9">
                                    <select id="region_id" name="region_id" class="col-md-6">
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}" {{$city->region->id == $region->id ? 'selected' : ''}}>{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('region_id'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('region_id') }}</strong>
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