@extends('layouts.main')

@section('style')
    <style>
        .jumbotron {
            margin: 0;
            min-height: 400px;
            background: #17234E url({{ asset('Resources/background.jpg') }}) no-repeat center;
            -webkit-background-size: cover;
            background-size: cover;
            border-radius: 0;
        }

        #register {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/halftone-yellow.png') }}) repeat scroll 0 0;
        }

        #about {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/sayagata.png') }}) repeat scroll 0 0;
        }

        #contacts {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/halftone-yellow.png') }}) repeat scroll 0 0;
        }

        /*.nav-link {*/
        /*color: #555;*/
        /*}*/

        /*.nav-link:hover {*/
        /*color: #333;*/
        /*}*/

        .display-5 {
            color: #582E2A;
            font-weight: Bold;
        }

    </style>
@endsection

@section('content')
    <div class="jumbotron bg-warning text-center">
        <img src="{{ asset('Resources/logo.png') }}" alt="logo" style="width: 128px;">
        <h1 class="display-5"><br>ЎЗБЕКИСТОН РЕСПУБЛИКАСИ АСАЛАРИЧИЛАРИ<br>УЮШМАСИ</h1>
    </div>

    <div id="register">
        <br>
        <div class="container">
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    <!--ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-user_1-tab" data-toggle="tab" href="#user_1" role="tab"
                               aria-controls="user_1" aria-selected="true">Корхона/ЯТТ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-user_2-tab" data-toggle="tab" href="#user_2" role="tab"
                               aria-controls="user_2" aria-selected="true">Кўп тармоқли фермер хўжаликлари</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-user_3-tab" data-toggle="tab" href="#user_3" role="tab"
                               aria-controls="user_3" aria-selected="true">Деҳқон (шахсий ёрдамчи) хўжаликлари</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-user_4-tab" data-toggle="tab" href="#user_4" role="tab"
                               aria-controls="user_4" aria-selected="true">Жисмоний шахс</a>
                        </li>
                    </ul-->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="type" class="col-form-label col-form-label-sm">Фойдаланувчи тури</label>
                            <select id="type" class="form-control form-control-sm" onchange="changeType(this.id)">
                                <option value="0" selected>Юридик корхоналар</option>
                                <option value="1">Кўп тармоқли фермер хўжаликлари</option>
                                <option value="2">Якка тартибдаги тадбиркор</option>
                                <option value="3">Чаҳсий ёрдамчи хўжалик</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body tab-content" id="nav-tabContent">
                    <form action="{{route('submit.form',1)}}" method="post" class="container tab-pane fade show active"
                          aria-labelledby="nav-user_1-tab" id="user_1">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_1" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_1" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_1" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_1" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_1" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_1"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_1" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_1" name="subject"
                                       value="{{old('subject')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_1" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                    ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_1" name="reg_date"
                                       value="{{old('reg_date')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_1" class="col-form-label col-form-label-sm">ИНН</label>
                                <input type="number" class="form-control form-control-sm" id="inn_1" name="inn"
                                       value="{{old('inn')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mfo_1" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="text" class="form-control form-control-sm bankmfo" id="mfo_1" name="mfo"
                                       value="{{old('mfo')}}" required minlength="5" v-model="mfo" list="mfos"/>
                                <datalist id="mfos">
                                    @foreach($banks as $bank)
                                        <option>{{ $bank->mfo }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_1" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_1" name="bank_name"
                                       value="{{old('bank_name')}}"
                                       required v-model="bank" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_1" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_1" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_1" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_1" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_1" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_1" class="col-form-label col-form-label-sm">Корхона директори исми
                                    шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_1" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="labors_1" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                <input type="number" class="form-control form-control-sm" id="labors_1" name="labors"
                                       value="{{old('labors')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_1" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_1"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>

                    <form action="{{route('submit.form', 2)}}" method="post" class="container tab-pane fade show"
                          aria-labelledby="nav-user_2-tab" id="user_2">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_2" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_2" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_2" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_2" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_2" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_2"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_2" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_2" name="subject"
                                       value="{{old('subject')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_2" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                    ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_2" name="reg_date"
                                       value="{{old('reg_date')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_2" class="col-form-label col-form-label-sm">ИНН</label>
                                <input type="number" class="form-control form-control-sm" id="inn_2" name="inn"
                                       value="{{old('inn')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bank_2" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_2" name="bank_name"
                                       value="{{old('bank_name')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mfo_2" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="number" class="form-control form-control-sm" id="mfo_2" name="mfo"
                                       value="{{old('mfo')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_2" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_2" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_2" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_2" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_2" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_2" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_2" class="col-form-label col-form-label-sm">Хўжалик раҳбари исми
                                    шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_2" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="labors_2" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                <input type="number" class="form-control form-control-sm" id="labors_2" name="labors"
                                       value="{{old('labors')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_2" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_2"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>

                    <form action="{{route('submit.form', 3)}}" method="post" class="container tab-pane fade show"
                          aria-labelledby="nav-user_3-tab" id="user_3">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_3" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_3"
                                        onchange="regionChanged(this.id)" name="region_id" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_3" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_3" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_3" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_3"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_3" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_3" name="subject"
                                       value="{{old('subject')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_3" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                    ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_3" name="reg_date"
                                       value="{{old('reg_date')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_3" class="col-form-label col-form-label-sm">ИНН</label>
                                <input type="number" class="form-control form-control-sm" id="inn_3" name="inn"
                                       value="{{old('inn')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bank_3" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_3" name="bank_name"
                                       value="{{old('bank_name')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mfo_3" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="number" class="form-control form-control-sm" id="mfo_3" name="mfo"
                                       value="{{old('mfo')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_3" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_3" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_3" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_3" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_3" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_3" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_3" class="col-form-label col-form-label-sm">Хўжалик раҳбари исми
                                    шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_3" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="activity_3" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_3"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>

                    </form>

                    <form action="{{route('submit.form', 4)}}" method="post" class="container tab-pane fade show"
                          aria-labelledby="nav-user_4-tab" id="user_4">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_4" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_4" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_4" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_4" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_4" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_4"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_4" class="col-form-label col-form-label-sm">ФИШ</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_4" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_4" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_4" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_4" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_4" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_4" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_4" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_4" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_4"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div id="about">
            <br>
            <div class="container text-center">
                <h2 class="display-5">Биз ҳақимизда</h2>
                <hr>
                <img src="https://aloqabank.uz/gallery/aloqa1-2-1-bannery-na-vnutrennyuyu39.jpg"
                     alt="Generic placeholder image">
                <div>
                    <br>
                    <p class="text-justify">
                        <strong>Bankning yuksak vazifasi</strong> - o'z mijozlariga ularning bizneslari talablariga
                        javob beruvchi keng
                        qamrovli bank xizmatlarini professional darajada taqdim etib, respublikada tadbirkorlikning
                        mustahkamlanishiga ko'maklashish.
                        <br>
                        Ushbu vazifani amalga oshirishda AT «Aloqabank» doimiy ravishda o'zining korporativ
                        qadriyatlariga asoslanib faoliyat yuritadi.
                        <br>
                        AT "Aloqabank" yirik tarkibiy bo'linmalariga Toshkent shaxridagi Amaliyot Boshqarmasi hamda
                        Respublika hududlaridagi filiallar tarmog'i kiradi.
                        <br>
                        Xususiy va kichik biznes vakillari, dehqon va fermer xo’jaliklari, shuningdek aholining keng
                        qatlamiga bank xizmatlari ko’rsatishni geografik kengaytirish maqsadida bank filiallari qoshida
                        mini-banklar ochilgan.
                        <br>
                        Toshkent shahri hamda hududiy filiallar qoshida aloqa xizmatlari, kommunal va boshqa to’lovlar
                        qabul qilish uchun bankning jamg’arma kassalari faoliyat yuritib bormoqda.
                        <br>
                        AT “Aloqabank” tomonidan valyuta ayirboshlash shoxobchalari ochilgan. Bankning butun dunyo
                        bo’yicha Western Union, Zolotaya korona va Leader kabi tizimlari orqali pul o’tkazmalarini
                        amalga oshirish uchun xalqaro pul o’tkazish shoxobchalari xizmat ko’rsatib kelmoqda.
                    </p>
                </div>
            </div>
            <br>
        </div>

        <div id="contacts">
            <br>
            <div class="container text-center">
                <h2 class="display-5">Боғланиш</h2>
                <hr>
                <br>
            </div>
            <div id="map" style="width:100%;height:500px"></div>
        </div>
    </div>
@endsection

@section('script')
    <!--suppress EqualityComparisonWithCoercionJS -->
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
            var selected = document.getElementById(id).selectedIndex + 1;
            for (var i = 1; i < 5; i++)
                document.getElementById("user_" + i).classList.remove("active");
            document.getElementById("user_" + selected).classList.add("active");
        }


        $(document).ready(function () {
            regionChanged('region_1');
            regionChanged('region_2');
            regionChanged('region_3');
            regionChanged('region_4');
            $('.phone').mask('+AAB (00) 000-00-00', {
                'translation': {
                    A: {pattern: /[9]/},
                    B: {pattern: /[8]/}
                }
            });

            $('.bankmfo').mask('00000');

            @if($type != null)
                document.getElementById('type').selectedIndex = {!! $type !!} - 1;
            @endif

            for (var i = 0; i < arrays[2].length; i++)
                mfos.push(arrays[2][i]['mfo']);
        });
    </script>

    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lodash.min.js') }}" type="text/javascript"></script>

    <!--suppress JSUnusedLocalSymbols -->
    <script>
        var app = new Vue({
            el: '#register',
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
    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(41.310441, 69.278460);
            var mapCanvas = document.getElementById("map");
            var mapOptions = {center: myCenter, zoom: 16};
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({position: myCenter});
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
@endsection