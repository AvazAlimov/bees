@extends('layouts.app-user')
@section('styles')
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
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Content -->
    <div id="wrapper">
        <div class="container">
            <div class="col-sm-3">
                @include('user.profile',['user'=>\Illuminate\Support\Facades\Auth::user()])

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
                <h5 class="text-success"><i class="fa fa-pencil"></i>Менинг созламаларим</h5>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#main">Асосий</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#additional">Реквизитлар</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#activities">Асалари зотлари ва фаолият тури</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#password">Парол</a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div id="main" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-sm-8">
                                {!! Form::model($user, ['route' => ['user.update', 'main'], 'method'=>'PUT', 'files' =>true, 'data-parsley-validate'=>'']) !!}
                                    <div class="form-group">
                                        {{ Form::label('username', 'Логин')}}
                                        {{ Form::text('username', null, ['class'=>'form-control'])}}
                                    </div>  
                                    <div class="form-group">
                                        {{ Form::label('subject', 'Субъект (корхона, ЯТТ)')}}
                                        {{ Form::text('subject', null, ['class'=>'form-control',])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('neighborhood', 'Маҳалла (МФЙ) номи')}}
                                        {{ Form::text('neighborhood', null, ['class'=>'form-control',])}}
                                    </div>
                                    <div class="form-group">
                                        <label for="region_4" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                        <select class="form-control form-control-sm" id="region_4" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_4" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                        <select class="form-control form-control-sm" id="city_4" name="city_id" required>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('address', 'Манзил')}}
                                        {{ Form::text('address', null, ['class'=>'form-control'])}}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default pull-right bg-warning">Сохранить
                                        </button>
                                    </div>
                                {!! Form::close()!!}
                            </div>
                        </div>
                    </div>
                    <div id="additional" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                {!! Form::model($user, ['route' => ['user.update', 'additional'], 'method'=>'PUT', 'files' =>true, 'data-parsley-validate'=>'']) !!}
                                    <div class="form-group">
                                        {{ Form::label('fullName', 'Хўжалик раҳбари исми шарифи')}}
                                        {{ Form::text('fullName', null, ['class'=>'form-control'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('reg_date', 'Корхона давлат рўйҳатидан ўтган сана')}}
                                        {{ Form::date('reg_date', null, ['class'=>'form-control'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('inn', 'СТИР (ИНН)')}}
                                        {{ Form::text('inn', null, ['class'=>'form-control', 'minlength' => '9'])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('mfo', 'Банк МФО')}}
                                        <input type="text" class="form-control form-control-sm bankmfo" id="mfo_2" name="mfo"
                                       value="{{$user->mfo}}" list="mfos" minlength="5" required>
                                        <datalist id="mfos">
                                            @foreach($banks as $bank)
                                                <option>{{ $bank->mfo }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('bank_name', 'Хизмат кўрсатиладиган банк номи')}}
                                        <input type="text" class="form-control form-control-sm" id="bank_3" name="bank_name"
                                       value="{{$user->bank_name}}">
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('labors', 'Ишчилар сони')}}
                                        {{ Form::number('labors', null, ['class'=>'form-control', 'minlength' => '0', 'required' => ''])}}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('bees_count', 'Боқлаётган асалари оилалари сони')}}
                                        {{ Form::number('bees_count', null, ['class'=>'form-control', 'minlength' => '0', 'required' => ''])}}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default pull-right bg-warning">Сохранить
                                        </button>
                                    </div>
                                {!! Form::close()!!}
                            </div>
                        </div>
                    </div>
                    <div id="activities" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                {!! Form::model($user, ['route' => ['user.update', 'activities'], 'method'=>'PUT', 'files' =>true, 'data-parsley-validate'=>'']) !!}
                                    <div class="form-group">
                                        {{ Form::label('families', 'Боқилаётган асалари зотлари')}}
                                        
                                        <div class="">
                                            @foreach($families as $family)
                                                <input type="checkbox" name="families[]" value="{{$family->id}}"
                                                       > {{$family->name}}<br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="activity">Фаолият тури
                                            (бир
                                            нечтасини танласа бўлади)</label>
                                        <div class="">
                                            @foreach($activities as $activity)
                                                <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                                > {{$activity->name}}<br>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default pull-right bg-warning">Сохранить
                                        </button>
                                    </div>
                                {!! Form::close()!!}
                            </div>
                        </div>
                    </div>
                    <div id="password" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="shohrux.shomaxmudvo@gmail.com" class="form-control "
                                               id="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Телефон рақами</label>
                                        <input type="text" class="form-control phone" id="phone" name="phone"
                                               value="998908082443"
                                               required>
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
                                        <button type="button" class="btn btn-default  pull-right bg-warning">Сохранить
                                        </button>
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

        function regionChanged(id) {
            var selected = document.getElementById(id).value;
            var select = "city_" + id.substring(7, 8);
            document.getElementById(select).innerHTML = "";

            for (var i = 0; i < arrays[1].length; i++) {
                if (selected == arrays[1][i]["region_id"]) {
                    var opt = document.createElement('option');
                    opt.value = arrays[1][i]['id'];
                    opt.innerHTML = arrays[1][i]['name'];
                    document.getElementById(select).appendChild(opt);
                }
            }
        }

        function changeType(id) {
            var selected = document.getElementById(id).selectedIndex + 2;
            for (var i = 2; i < 5; i++)
                document.getElementById("user_" + i).classList.remove("active");
            document.getElementById("user_" + selected).classList.add("active");
        }
    </script>
    <script src="{{ asset('dist/js/jquery.mask.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('.phone').mask('+AAB (00) 000-00-00', {
                'translation': {
                    A: {pattern: /[9]/},
                    B: {pattern: /[8]/}
                }
            });

            $('.bankmfo').mask('00000');
            $('.inn').mask('000000000', {
                'translation': {
                    0: {pattern: /[0-9*]/}
                }
            });

            for (var i = 0; i < arrays[2].length; i++)
                mfos.push(arrays[2][i]['mfo']);
        });
    </script>
    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lodash.min.js') }}" type="text/javascript"></script>

    <!--suppress JSUnusedLocalSymbols -->
    <script>
        var app = new Vue({
            el: '#wrapper',
            data: {
                mfo: '',
                bank: '',
                address: '',
                refresh: false
            },
            watch: {
                mfo: function () {
                    this.address = '';
                    if (this.mfo.length > 0) {
                        this.lookupAddress();
                    }
                }
            },
            methods: {
                lookupAddress: _.debounce(function () {
                    var app = this;
                    app.bank = "Searching...";
                    var found = false;
                    for (var i = 0; i < mfos.length; i++)
                        if (mfos[i] === app.mfo) {
                            found = true;
                            app.bank = arrays[2][i]['name'];
                            break;
                        }
                    if (!found)
                        app.bank = '';
                }, 500)
            }
        });
    </script>

    <!--suppress JSUnresolvedVariable, JSUnresolvedFunction, JSUnusedLocalSymbols -->
@endsection
