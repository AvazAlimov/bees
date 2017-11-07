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
        <form action="">
            <div class="container" id="card">
                <div class="col-md-12 form-group">
                    <label for="region" class="col-md-2">Viloyat:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="region" id="region">
                            <option value="0">Tashkent City</option>
                            <option value="1">Tashkent</option>
                            <option value="2">Andijan</option>
                            <option value="3">Fergana</option>
                            <option value="4">Namangan</option>
                            <option value="5">Jizzakh</option>
                            <option value="6">Samarkand</option>
                            <option value="7">Kashkadarya</option>
                            <option value="8">Bukhara</option>
                            <option value="9">Nukus</option>
                            <option value="10">Khorezm</option>
                            <option value="11">Termiz</option>
                            <option value="12">Karakalpak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="city" class="col-md-2">Tuman:</label>
                    <div class="col-md-10">
                        <select class="form-control" name="city" id="region">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="mahalla" class="col-md-2">Mahalla:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="mahalla" id="mahalla">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="subject" class="col-md-2">Subyekt nomi:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="subject" id="subject">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="date" class="col-md-2">Sana:</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="date" id="date">
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
                    <label for="director" class="col-md-2">Direktor:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="director" id="director">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label for="activity" class="col-md-2">Faoliyat:</label>
                    <div class="col-md-10">
                        <select name="activity" class="form-control" id="activity" multiple>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="1">3</option>
                            <option value="2">4</option>
                            <option value="1">5</option>
                        </select>
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
