@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" action="{{ route('leader.store') }}">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">Добавить Лидера</div>
                        <div class="panel-body">
                            <div class="col-md-12 form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                                <label for="firstName" class="col-md-3 control-label">Имя:</label>
                                <div class="col-md-9">
                                    <input id="firstName" type="text" class="form-control" name="firstName"
                                           value="{{ old('firstName') }}" required autofocus>
                                    @if ($errors->has('firstName'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('firstName') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                                <label for="lastName" class="col-md-3 control-label">Фамилия:</label>
                                <div class="col-md-9">
                                    <input id="lastName" type="text" class="form-control" name="lastName"
                                           value="{{ old('lastName') }}" required autofocus>
                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('lastName') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">Почта:</label>
                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3 control-label">Телефон:</label>
                                <div class="col-md-9">
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
	                                        <strong>{{ $errors->first('phone') }}</strong>
	                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Имя пользователя:</label>
                                <div class="col-md-8  col-lg-push-0">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Пароль:</label>

                                <div class="col-md-8 col-lg-pull-0">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Подтвердите Пароль:</label>
                                <div class="col-md-8 col-lg-pull-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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