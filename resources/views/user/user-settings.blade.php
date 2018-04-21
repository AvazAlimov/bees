@extends('layouts.app-admin')
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
            <div class="col-sm-9 panel background-white">
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
                                        <label for="surname">Логин</label>
                                        <input type="text" class="form-control" value="U1510352" id="surname" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Субъект (корхона, ЯТТ)</label>
                                        <input type="text" class="form-control" name="subject" id="subject" value="Ярашов Найим боги"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="neighborhood">Маҳалла (МФЙ) номи</label>
                                        <input type="text" class="form-control " value="Кизилтепа" name="neighborhood" id="neighborhood"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="region_id">Вилоят номи</label>
                                        <select class="form-control" id="region_id" name="region_id">
                                            <option selected>Андижон вилояти</option>
                                            <option>Бухоро вилояти</option>
                                            <option>Жиззах вилояти</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">Туман/шаҳар номи</label>
                                        <select class="form-control" id="city_id" name="city_id">
                                            <option selected>ЧИРЧИК ШАХРИ</option>
                                            <option>ОККУРГОН ТУМАНИ</option>
                                            <option>ОХАНГАРОН ТУМАНИ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_date">Корхона давлат рўйҳатидан ўтган сана</label>
                                        <input type="date" class="form-control " value="2018-01-01" id="reg_date"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="inn">СТИР (ИНН)</label>
                                        <input type="text" class="form-control inn" value="492792097" id="inn" minlength="9"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="inn">Банк МФО</label>
                                        <input type="text" class="form-control mfo" value="01111" id="mfo" minlength="5"/>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-default pull-right bg-warning">Сохранить</button>
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
                                        <button type="button" class="btn btn-default  pull-right bg-warning">Сохранить</button>
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
@section('scripts')
    <script>
        var arrays = [{!! $regions !!}];
        arrays.push({!! $cities !!});
        arrays.push({!! $banks !!});
        var mfos = [];
    </script>
    <script src="{{ asset('dist/js/jquery.mask.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('.inn').mask('000000000', {
                'translation': {
                    0: {pattern: /[0-9*]/}
                }
            });
            $('.mfo').mask('00000');
        });
    </script>
    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lodash.min.js') }}" type="text/javascript"></script>



    <!--suppress JSUnresolvedVariable, JSUnresolvedFunction, JSUnusedLocalSymbols -->
@endsection
