<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
            #card{
                padding-top: 20px;
                margin-top: 20px;
                box-shadow: 0 0 4px 1px #888888;
            }
        </style>
    </head>
    <body>
        <form action="{{route('web.submit.form')}}" method="post">
            {{csrf_field()}}
            <div class="container" id="card">
                <div class="col-md-12 form-group">
                    <label for="region" class="col-md-2">Viloyat:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="region_id" id="region">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="city" class="col-md-2">Tuman:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="city_id" id="region">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="neighborhood" class="col-md-2">Mahalla:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="neighborhood" id="neighborhood">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="subject" class="col-md-2">Subyekt nomi:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="subject" id="subject">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="reg_date" class="col-md-2">Sana:</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="reg_date" id="reg_date">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="inn" class="col-md-2">INN:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="inn" id="inn">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="mfo" class="col-md-2">Bank MFO:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="mfo" id="mfo">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="address" class="col-md-2">Manzil:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="phone" class="col-md-2">Telefon:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="email" class="col-md-2">Email:</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="fullName" class="col-md-2">Direktor:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="fullName" id="fullName">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="activity" class="col-md-2">Faoliyat:</label>
                    <div class="col-md-10">
                            @foreach($activities as $activity)
                                <input type="checkbox" name="activity" value="{{$activity->id}}" id="activity"> {{$activity->name}}<br>
                            @endforeach
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="labors" class="col-md-2">Ishchilar soni:</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" name="labors" id="labors">
                    </div>
                </div>

                <div class="col-md-12 form-group text-center">
                    <input type="submit" class="btn btn-success">
                </div>
            </div>
        </form>
    </body>
</html>
