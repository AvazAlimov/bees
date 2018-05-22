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
                                <form action="{{ route('user.update', 'main')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="surname">Логин</label>
                                        <input type="text" class="form-control" value="{{$user->username}}" id="surname" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Субъект (корхона, ЯТТ)</label>
                                        <input type="text" class="form-control" name="subject" id="subject"
                                               value="{{$user->subject}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="neighborhood">Маҳалла (МФЙ) номи</label>
                                        <input type="text" class="form-control " value="{{$user->neighborhood}}" name="neighborhood"
                                               id="neighborhood"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="region_id">Вилоят номи</label>
                                        <select class="form-control" id="region_id" name="region_id"
                                                onchange="regionChanged()">
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}"
                                                        {{$user->region->id == $region->id ? "selected" : ''}}>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">Туман/шаҳар номи</label>
                                        <select class="form-control" id="city_id" name="city_id">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Манзил</label>
                                        <input type="text" class="form-control address" name="address" value="{{$user->address}}"
                                               id="address"/>
                                    </div>
                                        <button type="submit" class="btn btn-default pull-right bg-warning">Сохранить
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="additional" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="{{ route('user.update', 'additional')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="fullName">Хўжалик раҳбари исми шарифи</label>
                                        <input type="text" class="form-control fullName" value="{{$user->fullName}}" name="fullName" id="fullName"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_date">Корхона давлат рўйҳатидан ўтган сана</label>
                                        <input type="date" class="form-control" name="reg_date" value="{{$user->reg_date}}" id="reg_date"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="inn">СТИР (ИНН)</label>
                                        <input type="text" class="form-control inn" value="{{$user->inn}}" id="inn"
                                               minlength="9"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="mfo">Банк МФО</label>
                                        <input type="text" class="form-control mfo" name="mfo" value="{{$user->mfo}}" id="mfo" list="mfos"
                                               minlength="5" onchange="bankChanged()"/>
                                        <datalist id="mfos">
                                            @foreach($banks as $bank)
                                                <option>{{ $bank->mfo }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Хизмат кўрсатиладиган банк номи</label>
                                        <input type="text" class="form-control bank_name" value="{{$user->bank_name}}"
                                               id="bank_name" name="bank_name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="labors">Ишчилар сони</label>
                                        <input type="number" class="form-control labors" id="labors" name="labors"
                                               value="{{$user->labors}}" min="0"
                                               required>

                                    </div>
                                    <div class="form-group">
                                        <label for="bees_count">Боқлаётган асалари оилалари сони</label>
                                        <input type="number" class="form-control bees_count" id="bees_count"
                                               name="bees_count"
                                               value="{{$user->bees_count}}" min="0"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default pull-right bg-warning">Сохранить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="activities" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="{{ route('user.update', 'activities')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="family">Боқилаётган асалари зотлари</label>
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
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="password" class="tab-pane fade">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="{{ route('user.update', 'password')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="{{$user->email}}" class="form-control "
                                               id="email" name="email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Телефон рақами</label>
                                        <input type="text" class="form-control phone" id="phone" name="phone"
                                               value="{{$user->phone}}"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">Новый пароль</label>
                                        <input type="password" name="new_password" value="{{$user->new_password}}" class="form-control " id="new-password"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="news-password-confirm">Новый пароль еще раз</label>
                                        <input type="password" name="new_password_confirm" value="{{$user->new_password_confirm}}" class="form-control " id="news-password-confirm"/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default  pull-right bg-warning">Сохранить
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
    </script>
    <script src="{{ asset('dist/js/jquery.mask.min.js') }}"></script>
    <script>
        function regionChanged() {
            var selected = document.getElementById('region_id').value;

            document.getElementById('city_id').innerHTML = "";

            var city_id = '{{$user->city->id}}';

            for (var i = 0; i < arrays[1].length; i++) {
                if (selected == arrays[1][i]["region_id"]) {
                    var opt = document.createElement('option');
                    opt.value = arrays[1][i]['id'];
                    if (city_id == arrays[1][i]['id'])
                        opt.selected = 'selected';
                    opt.innerHTML = arrays[1][i]['name'];
                    document.getElementById('city_id').appendChild(opt);
                }
            }
        }
        function bankChanged() {
            var selected = document.getElementById('mfo').value;
            document.getElementById('bank_name').innerHTML = "";
            for (var i = 0; i < arrays[2].length; i++) {
                if (selected == arrays[2][i]["mfo"]) {
                    document.getElementById('bank_name').value = arrays[2][i]["name"];
                }
            }
        }
        $(document).ready(function () {
            regionChanged();
            $('.inn').mask('000000000', {
                'translation': {
                    0: {pattern: /[0-9*]/}
                }
            });
            $('.mfo').mask('00000');
            $('.phone').mask('+AAB (00) 000-00-00', {
                'translation': {
                    A: {pattern: /[9]/},
                    B: {pattern: /[8]/}
                }
            });
        });
    </script>
    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lodash.min.js') }}" type="text/javascript"></script>



    <!--suppress JSUnresolvedVariable, JSUnresolvedFunction, JSUnusedLocalSymbols -->
@endsection