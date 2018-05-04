@extends('layouts.app-user')

@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
    <style>
        .background-white {
            background-color: #fff;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .panel {
            border-color: #ffc107 !important;
        }
    </style>
    <!-- Styles -->
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
                                Профил <b class="caret"></b></a>
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
                <h5>Асал етиштириш ва реализиция</h5>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#add">Қўшиш</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#services-list">Маълумот </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="add">
                        <form>
                            <label for="realized_quantity" class="col-md-12">Ойма ой киритиладиган сана</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="year">Йил</label>
                                    <select class="form-control" id="year">
                                        @for($i = date('Y'); $i>1999; $i--)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="month">Ой</label>
                                    <select class="form-control" id="year">
                                        <option value="1">Январь</option>
                                        <option value="2">Февраль</option>
                                        <option value="3">Март</option>
                                        <option value="4">Апрель</option>
                                        <option value="5">Май</option>
                                        <option value="6">Июнь</option>
                                        <option value="7">Июль</option>
                                        <option value="8">Август</option>
                                        <option value="9">Сентябрь</option>
                                        <option value="10">Октябрь</option>
                                        <option value="11">Ноябрь</option>
                                        <option value="12">Декабрь</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="honey_type">Асал тури</label>
                                    <input type="text" class="form-control" id="honey_type"
                                           name="honey_type" min="0">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</label>
                                    <input type="number" name="annual_prog" class="form-control" id="annual_prog" min="0">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="produced_honey">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</label>
                                    <input type="number" name="produced_honey" class="form-control" id="produced_honey">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="reserve">Ҳисобот даври бошига асал заҳираси кг</label>
                                    <input type="number" name="reserve" class="form-control" id="reserve">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="family_count">Боқилаётган асалари оиласи</label>
                                    <input type="number" class="form-control" id="family_count"
                                           name="family_count" min="0">
                                </div>
                            </div>

                            <label for="realized_quantity" class="col-md-12">Реализация қилган асал миқдори</label>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                       <input type="number" name="realized_quantity" class="form-control"
                                           id="realized_quantity">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="realized_price" class="form-control" id="realized_price">
                                    </div>
                                </div>

                            </div>
                            <label for="realized_quantity" class="col-md-12">Асал захираси </label>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="stock_quantity" class="form-control" id="stock_quantity">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="stock_price" class="form-control" id="stock_price">                                    </div>
                                </div>

                            </div>

                            {{-- <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="gridCheck">
                                     <label class="form-check-label" for="gridCheck">
                                         Check me out
                                     </label>
                                 </div>
                             </div>--}}
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="services-list">

                        <div class="page-header clearfix ">
                            <h2 class="pull-left">O'zbekiston asalarichilari uyushmasiga a'zo subyektlar to'g'risida
                                ma'lumot</h2>

                        </div>
                        <table id="example2" class="table table-bordered realization-theader " cellspacing="0"
                               width="100%">
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

                    </div>
                </div>

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
                scrollX: true
            });

        });
    </script>
@endsection
