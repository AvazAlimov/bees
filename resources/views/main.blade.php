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
                    <label for="region">Viloyatni Tanlang</label>
                    <select class="form-control form-control-sm" id="region" name="region">
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">Shahar/Tumanni Tanlang</label>
                    <select class="form-control form-control-sm" id="city" name="city">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="mahalla">Mahalla nomi</label>
                    <input type="text" class="form-control form-control-sm" id="mahalla" name="mahalla">
                </div>
                <div class="form-group col-md-6">
                    <label for="subject">Subyekt nomi</label>
                    <input type="text" class="form-control form-control-sm" id="subject" name="subject">
                </div>
            </div>

        </form>
    </div>
@endsection