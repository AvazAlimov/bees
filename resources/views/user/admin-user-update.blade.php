@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="for-horizontal" method="POST" action="{{ route('admin.user.update', $user->id) }}">
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
                                    <select class="form-control form-control-sm" id="region_1" name="region_id"
                                            onchange="regionChanged(this.id)" required>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}" {{$user->region->id == $region->id ? "selected" : ""}}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city_1" class="col-form-label col-form-label-sm">Туман/шаҳар
                                        номи</label>
                                    <select class="form-control form-control-sm" id="city_1" name="city_id" required>
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
                                        <option value="1" {{$user->type < 3 ? "selected" : ''}}>Юридик корхоналар (МЧЖ, ХК, ҚК)</option>
                                        <option value="3" {{$user->type == 3 ? "selected" : ''}}>ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари</option>
                                        <option value="4" {{$user->type == 4? "selected" : ''}}>Шахсий ёрдамчи хўжалик (Жисмоний шахслар)</option>
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
                                    <input type="number" class="form-control form-control-sm" id="inn_1" name="inn"
                                           value="{{$user->inn}}"
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="bank_1" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган
                                        банк
                                        номи</label>
                                    <input type="text" class="form-control form-control-sm" id="bank_1" name="bank_name"
                                           value="{{$user->bank_name}}"
                                           required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mfo_1" class="col-form-label col-form-label-sm">Банк МФО</label>
                                    <input type="number" class="form-control form-control-sm" id="mfo_1" name="mfo"
                                           value="{{$user->mfo}}"
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
                                    <input type="text" class="form-control form-control-sm" id="phone_1" name="phone"
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
                                    <label for="labors_1" class="col-form-label col-form-label-sm">Боқлаётган асалари оилалари сони</label>
                                    <input type="number" class="form-control form-control-sm" id="labors_1"
                                           name="bees_count"
                                           value="{{$user->bees_count}}"
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
                                            <input type="checkbox" name="families[]" value="{{$activity->id}}"
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