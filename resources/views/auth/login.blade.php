@extends('layouts.auth')

@section('style')
    <style>
        .card {
            border-color: #f0ad4e;
            box-shadow: 0 0 2px #888;
        }

        .card-heading {
            padding: 16px;
        }

        .card-body {
            padding: 16px;
        }
    </style>
@endsection

@section('content')
    <div class="container text-center">
        <div class="container col-md-6">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-heading bg-warning">
                        <img src="{{ asset('Resources/logo1.png') }}" alt="logo" style="width: 96px;">
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-12 control-label">Фойдаланувчи номи</label>
                                <div class="col-md-12 input-group">
                                    <span class="input-group-addon bg-warning"><i class="fa fa-user"
                                                                                  aria-hidden="true"></i></span>
                                    <input id="username" type="text" class="form-control" name="username"
                                           value="{{ old('username') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">Парол</label>

                                <div class="col-md-12 input-group">
                                    <span class="input-group-addon bg-warning"><i class="fa fa-lock"
                                                                                  aria-hidden="true"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Эслаб қолиш
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning">
                                        Кириш
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection