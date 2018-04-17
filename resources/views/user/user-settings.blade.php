@extends('layouts.app')
@section('styles')
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Content -->
    <div id="wrapper">
        <div class="container">
            <div class="col-sm-3">
                <!-- Profile -->
                <div class="panel panel-default panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#profile">
                                Мой профиль <b class="caret"></b></a>
                        </h4>
                    </div>
                    <div id="profile" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>
                                    <h3>U0001262</h3>
                                    <h4><b>Ярашов Н.</b></h4>
                                    <a href="{{route('settings')}}">Редактировать</a>
                                </li>
                                <li>
                                    <h4 class="color-gray">Ярашов Найим боги</h4>
                                    <a>info@aloqabank.uz</a>
                                    <h6>998937415527</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Profile -->

                <!-- Site services -->
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#services">
                                Мой профиль <b class="caret"></b></a>
                        </h4>
                    </div>
                    <div id="services" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#"> </a>
                                </li>
                                <li>
                                    <a href="#">Консультации по телефону</a>
                                </li>
                                <li>
                                    <a href="#">Документы</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Site services -->
            </div>
            <div class="col-sm-9 border-gray background-white">
                <h5 class="text-success"><i class="fa fa-pencil"></i> Редактирование профиля</h5>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#main">Основное</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#password">Почта и пароль</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="main" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="">
                                    <div class="form-group">
                                        <label for="surname">Фамилия</label>
                                        <input type="text" class="form-control " id="surname"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input type="text" class="form-control " id="name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="patronymic">Отчество</label>
                                        <input type="text" class="form-control " id="patronymic"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Город</label>
                                        <input type="text" class="form-control " id="city" list="cities"/>
                                        <datalist id="cities">
                                            <option>Москва</option>
                                            <option>Ташкент</option>
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday">Дата рождение</label>
                                        <input type="date" class="form-control " id="birthday"/>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label>Пол </label>
                                        <input type="radio" name="gender" checked /> Мужской
                                        <input type="radio" name="gender"/> Женский
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn-primary pull-right">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="password" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control " id="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">Новый пароль</label>
                                        <input type="password" class="form-control " id="new-password"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="news-password-confirm">Новый пароль еще раз</label>
                                        <input type="password" class="form-control " id="news-password-confirm"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="current-password">Текущий пароль</label>
                                        <input type="password" class="form-control " id="current-password"/>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn-primary pull-right">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
