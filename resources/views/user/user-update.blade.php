@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" action="{{ route('leader.user.update', $user->id) }}">
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">Изменить Пользователя</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="region_1" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                    <select class="form-control form-control-sm" id="region_id" name="region_id"
                                            onchange="regionChanged(this.id)" required>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}" {{$user->region->id == $region->id ? "selected" : ""}}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city_1" class="col-form-label col-form-label-sm">Туман/шаҳар
                                        номи</label>
                                    <select class="form-control form-control-sm" id="city_id" name="city_id" required>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{$user->city->id == $city->id ? "selected" : ""}}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="type" class="col-form-label col-form-label-sm">Асалари тури</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="2" {{$user->type <= 2 ? "selected" : ""}}>Юридик корхоналар (МЧЖ, ХК, ҚК)</option>
                                        <option value="3" {{$user->type == 3 ? "selected" : ""}}>ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари
                                        </option>
                                        <option value="4" {{$user->type == 4 ? "selected" : ""}}>Шахсий ёрдамчи хўжалик (Жисмоний шахслар)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mahalla_1" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                        номи</label>
                                    <input type="text" class="form-control form-control-sm" id="mahalla_1"
                                           name="neighborhood" value="{{$user->neighborhood}}"
                                           required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="subject_1" class="col-form-label col-form-label-sm">Субъект (корхона,
                                        ЯТТ)
                                        номи</label>
                                    <input type="text" class="form-control form-control-sm" id="subject_1"
                                           name="subject"
                                           value="{{$user->subject}}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="date_1" class="col-form-label col-form-label-sm">Корхона давлат
                                        рўйҳатидан
                                        ўтган сана</label>
                                    <input type="date" class="form-control form-control-sm" id="date_1" name="reg_date"
                                           value="{{$user->reg_date}}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inn_1" class="col-form-label col-form-label-sm">ИНН</label>
                                    <input type="number" class="form-control form-control-sm inn" id="inn_1" name="inn"
                                           value="{{$user->inn}}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mfo_1" class="col-form-label col-form-label-sm">Банк МФО</label>
                                    <input type="number" class="form-control form-control-sm mfo" id="mfo" name="mfo" onchange="bankChanged()"
                                           value="{{$user->mfo}}" list="mfos"
                                           required>
                                    <datalist id="mfos">
                                        @foreach($banks as $bank)
                                            <option>{{ $bank->mfo }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bank_1" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган
                                        банк
                                        номи</label>
                                    <input type="text" class="form-control form-control-sm" id="bank_name" name="bank_name"
                                           value="{{$user->bank_name}}"
                                           required>

                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="address_1" class="col-form-label col-form-label-sm">Манзил</label>
                                    <input type="text" class="form-control form-control-sm" id="address_1"
                                           name="address"
                                           value="{{$user->address}}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone_1" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                    <input type="text" class="form-control form-control-sm phone" id="phone_1" name="phone"
                                           value="{{$user->phone}}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email_1" class="col-form-label col-form-label-sm">Электрон почта</label>
                                    <input type="email" class="form-control form-control-sm" id="email_1" name="email"
                                           value="{{$user->email}}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fullName_1" class="col-form-label col-form-label-sm">Корхона директори
                                        исми
                                        шарифи</label>
                                    <input type="text" class="form-control form-control-sm" id="fullName_1"
                                           name="fullName"
                                           value="{{$user->fullName}}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="labors_1" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                    <input type="number" class="form-control form-control-sm" id="labors_1"
                                           name="labors"
                                           value="{{$user->labors}}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="activity_1" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                        нечтасини танласа бўлади)</label>
                                    <div class="col-md-12">
                                        @foreach($activities as $activity)
                                            <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                                   id="activity_1" {{$user->activities->contains('id', $activity->id) ? "checked" : ""}}> {{$activity->name}}
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="activity_1" class="col-form-label col-form-label-sm">Боқилаётган асалари
                                        зотлари</label>
                                    <div class="col-md-12">
                                        @foreach($families as $activity)
                                            <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                                   id="activity_1" {{$user->families->contains('id', $activity->id) ? "checked" : ""}}> {{$activity->name}}
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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