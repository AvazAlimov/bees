@extends('layouts.main')

@section('style')
    <style>
        .jumbotron {
            min-height: 600px;
            background: #17234E url("http://www.beyondpesticides.org/dailynewsblog/wp-content/uploads/2013/07/hives.jpg") no-repeat left;
            -webkit-background-size: cover;
            background-size: cover;
            border-radius: 0;
        }
    </style>
@endsection

@section('content')
    <div class="jumbotron">
    </div>

    <div id="register">
        <form class="container">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="region" class="col-form-label col-form-label-sm">Viloyatni Tanlang</label>
                    <select class="form-control form-control-sm" id="region" name="region">
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="city" class="col-form-label col-form-label-sm">Shahar/Tumanni Tanlang</label>
                    <select class="form-control form-control-sm" id="city" name="city">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="mahalla" class="col-form-label col-form-label-sm">Mahalla nomi</label>
                    <input type="text" class="form-control form-control-sm" id="mahalla" name="mahalla">
                </div>
                <div class="form-group col-md-6">
                    <label for="subject" class="col-form-label col-form-label-sm">Subyekt nomi</label>
                    <input type="text" class="form-control form-control-sm" id="subject" name="subject">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="date" class="col-form-label col-form-label-sm">Subyekt Ro'yhatdan O'tkazilgan
                        Sana</label>
                    <input type="date" class="form-control form-control-sm" id="date" name="date">
                </div>
                <div class="form-group col-md-6">
                    <label for="inn" class="col-form-label col-form-label-sm">INN</label>
                    <input type="number" class="form-control form-control-sm" id="inn" name="inn">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="mfo" class="col-form-label col-form-label-sm">Bank MFO</label>
                    <input type="number" class="form-control form-control-sm" id="mfo" name="mfo">
                </div>
                <div class="form-group col-md-6">
                    <label for="address" class="col-form-label col-form-label-sm">Manzil</label>
                    <input type="text" class="form-control form-control-sm" id="address" name="address">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone" class="col-form-label col-form-label-sm">Telefon Raqam</label>
                    <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="col-form-label col-form-label-sm">Elektron Po'chta Manzil</label>
                    <input type="email" class="form-control form-control-sm" id="email" name="email">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fullName" class="col-form-label col-form-label-sm">Direktor FIO</label>
                    <input type="text" class="form-control form-control-sm" id="fullName" name="fullName">
                </div>
                <div class="form-group col-md-6">
                    <label for="labors" class="col-form-label col-form-label-sm">Ishchilar Soni</label>
                    <input type="number" class="form-control form-control-sm" id="labors" name="labors">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="activity" class="col-form-label col-form-label-sm">Faoliyat Turlari</label>
                    <select class="form-control form-control-sm" id="activity" name="activity" multiple>
                        @foreach($activities as $activity)
                            <option value="{{$activity->id}}">{{$activity->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>
    </div>
@endsection