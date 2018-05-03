@extends('layouts.app')
@section('styles')
    <style>
        .background-white {
            background-color: #fff;
        }
        .bg-warning{
            background-color: #ffc107 !important;
        }
        .panel{
            border-color: #ffc107 !important;
        }
    </style>
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Content -->
    <div id="wrapper">
        <div class="container">
            <div class="col-sm-3">
                <!-- Profile -->
                <div class="panel panel-default">
                    <div class="panel-heading bg-warning">
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
                <div class="panel panel-default">
                    <div class="panel-heading bg-warning">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#services">
                                Мой профиль <b class="caret"></b></a>
                        </h4>
                    </div>
                    <div id="services" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{route('user.realizations')}}"> Асал етиштириш ва реализиция</a>
                                </li>
                                <li>
                                    <a href="{{route('user.exports')}}"> Асални қадоқлаш ва реализация</a>
                                </li>
                                <li>
                                    <a href="{{route('user.productions')}}"> Ишлаб чиқарилган жиҳоз</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Site services -->
            </div>
            <div class="col-sm-9">
                <div class="row text-center background-white panel" id="services-list">
                    <div class="col-sm-4">
                        <h4 class="text-success">Вопрос</h4>
                        <p>Задайте любой вопрос, и в течение 15 минут вы получите ответы наших юристов.</p>
                        <button type="button" class="btn btn-default btn-success">Задать вопрос</button>
                    </div>
                    <div class="col-sm-4">
                        <h4 class="text-primary">Звонок</h4>
                        <p>Оставьте номер телефона, и наш юрист свяжется с вами, чтобы проконсультировать вас по любому вопросу.</p>
                        <button type="button" class="btn btn-default btn-primary">Заказать звонок</button>
                    </div>
                    <div class="col-sm-4">
                        <h4 class="text-warning">Документ</h4>
                        <p>Закажите документ, после чего наш юрист свяжется с вами, уточнит детали и подготовит его.</p>
                        <button type="button" class="btn btn-default btn-warning">Заказать документ</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 panel background-white" id="orders">
                        <h5 class="text-success">Мои заказы</h5>
                        <h6 class="color-gray">У вас пока нет ни одного заказа.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
