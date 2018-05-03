@extends('layouts.app-admin')

@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
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

@endsection
@section('content')
    <!-- Content -->
    <div id="wrapper">
        <div class="container-fluid">
            <div class="col-sm-3">
                <!-- Profile -->
                @include('user.profile',['user'=>\Illuminate\Support\Facades\Auth::user()])
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
                                <li class="list-active">
                                    <p> Асал етиштириш ва реализиция</p>
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
                <div class="row background-white panel" id="services-list">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">O'zbekiston asalarichilari uyushmasiga a'zo subyektlar to'g'risida
                            ma'lumot</h2>
                        <div>
                            <a id="swot-export" href="{{route('export.nomma')}}" class="btn btn-success pull-left" tabindex="0"
                               aria-controls="example">Excel
                            </a>
                            <a  onclick="" class="btn btn-warning pull-right"
                                tabindex="0"
                                aria-controls="example">Қўшиш
                            </a>
                        </div>
                    </div>
                    <table id="example2" class="table table-bordered realization-theader " cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th rowspan="2">Т/Р</th>
                            <th rowspan="2">Боқилаётган асалари оиласи</th>
                            <th rowspan="2">Асал тури</th>
                            <th rowspan="2">Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</th>
                            <th rowspan="2">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</th>
                            <th rowspan="2">Ҳисобот даври бошига асал заҳираси кг</th>
                            <th colspan="2">Реализация қилган асал миқдори</th>
                            <th colspan="2">Асал захираси</th>
                        </tr>
                        <tr>
                            <th>кг</th>
                            <th>сўм</th>
                            <th>кг</th>
                            <th>сўм</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>230</td>
                            <td>Майс</td>
                            <td>1000</td>
                            <td>900</td>
                            <td>100</td>
                            <td>200</td>
                            <td>1000000</td>
                            <td>800</td>
                            <td>3000000</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>230</td>
                            <td>Майс</td>
                            <td>1000</td>
                            <td>900</td>
                            <td>100</td>
                            <td>200</td>
                            <td>1000000</td>
                            <td>800</td>
                            <td>3000000</td>
                        </tr>
                        </tbody>
                    </table>

                    {{--<div class="col-sm-4">
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
                    </div>--}}
                </div>
                {{--<div class="row">
                    <div class="col-sm-12 border-gray background-white" id="orders">
                        <h5 class="text-success">Мои заказы</h5>
                        <h6 class="color-gray">У вас пока нет ни одного заказа.</h6>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.rowGroup.min.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#example2').DataTable({
                scrollX:true
            });

        });
    </script>
@endsection
