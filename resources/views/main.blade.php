@extends('layouts.main')

@section('style')
    <style>
        .jumbotron {
            min-height: 600px;
            background: #17234E url("http://www.beyondpesticides.org/dailynewsblog/wp-content/uploads/2013/07/hives.jpg") no-repeat top;
            -webkit-background-size: cover;
            background-size: cover;
            border-radius: 0;
        }

        #steps {
            min-height: 400px;
            background: #17234E url("https://www.muralswallpaper.com/app/uploads/honeycomb-texture-wallpaper-mural-plain.jpg") no-repeat top;
            -webkit-background-size: cover;
            background-size: cover;
            border-radius: 0;
        }

    </style>
@endsection

@section('content')
    <div class="jumbotron bg-warning">
    </div>

    <div id="register">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-user_1-tab" data-toggle="tab" href="#user_1" role="tab" aria-controls="user_1" aria-selected="true">Корхона/ЯТТ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-user_2-tab" data-toggle="tab" href="#user_2" role="tab" aria-controls="user_2" aria-selected="true">Кўп тармоқли фермер хўжаликлари</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#user_3">Деҳқон (шахсий ёрдамчи) хўжаликлари</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#user_4">Жисмоний шахс</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content" id="nav-tabContent">
                    <form class="container tab-pane fade show active" role="tabpanel" aria-labelledby="nav-user_1-tab" id="user_1">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_1" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_1" name="region">
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_1" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_1" name="city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_1" class="col-form-label col-form-label-sm">Маҳалла (МФЙ) номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_1" name="mahalla">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_1" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ) номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_1" name="subject">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_1" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_1" name="date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_1" class="col-form-label col-form-label-sm">ИНН</label>
                                <input type="number" class="form-control form-control-sm" id="inn_1" name="inn">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bank_1" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_1" name="bank">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mfo_1" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="number" class="form-control form-control-sm" id="mfo_1" name="mfo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_1" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_1" name="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_1" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm" id="phone_1" name="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_1" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_1" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_1" class="col-form-label col-form-label-sm">Корхона директори исми шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_1" name="fullName">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="labors_1" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                <input type="number" class="form-control form-control-sm" id="labors_1" name="labors">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_1" class="col-form-label col-form-label-sm">Фаолият тури (бир нечтасини танласа бўлади)</label>
                                <select class="form-control form-control-sm" id="activity_1" name="activity" multiple>
                                    @foreach($activities as $activity)
                                        <option value="{{$activity->id}}">{{$activity->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    <form class="container tab-pane fade show" role="tabpanel" aria-labelledby="nav-user_2-tab" id="user_2">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_1" class="col-form-label col-form-label-sm">Viloyatni Tanlang</label>
                                <select class="form-control form-control-sm" id="region_1" name="region">
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_1" class="col-form-label col-form-label-sm">Shahar/Tumanni Tanlang</label>
                                <select class="form-control form-control-sm" id="city_1" name="city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_1" class="col-form-label col-form-label-sm">Mahalla nomi</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_1" name="mahalla">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_1" class="col-form-label col-form-label-sm">Subyekt nomi</label>
                                <input type="text" class="form-control form-control-sm" id="subject_1" name="subject">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_1" class="col-form-label col-form-label-sm">Subyekt Ro'yhatdan O'tkazilgan
                                    Sana</label>
                                <input type="date" class="form-control form-control-sm" id="date_1" name="date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_1" class="col-form-label col-form-label-sm">INN</label>
                                <input type="number" class="form-control form-control-sm" id="inn_1" name="inn">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mfo_1" class="col-form-label col-form-label-sm">Bank MFO</label>
                                <input type="number" class="form-control form-control-sm" id="mfo_1" name="mfo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address_1" class="col-form-label col-form-label-sm">Manzil</label>
                                <input type="text" class="form-control form-control-sm" id="address_1" name="address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="phone_1" class="col-form-label col-form-label-sm">Telefon Raqam</label>
                                <input type="text" class="form-control form-control-sm" id="phone_1" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email_1" class="col-form-label col-form-label-sm">Elektron Po'chta Manzil</label>
                                <input type="email" class="form-control form-control-sm" id="email_1" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fullName_1" class="col-form-label col-form-label-sm">Direktor FIO</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_1" name="fullName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="labors_1" class="col-form-label col-form-label-sm">Ishchilar Soni</label>
                                <input type="number" class="form-control form-control-sm" id="labors_1" name="labors">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="activity_1" class="col-form-label col-form-label-sm">Faoliyat Turlari</label>
                                <select class="form-control form-control-sm" id="activity_1" name="activity" multiple>
                                    @foreach($activities as $activity)
                                        <option value="{{$activity->id}}">{{$activity->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>

    <div id="steps">

    </div>
@endsection