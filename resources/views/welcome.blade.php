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

            }
        </style>
    </head>
    <body>
        <form action="">
            <div class="container" id="card">
                <div class="col-md-12">
                    <label for="region">Viloyat:</label>
                    <select name="region" id="region">
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
                <div class="col-md-12">
                    <label for="city">Tuman:</label>
                    <select name="city" id="region">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="mahalla">Mahalla:</label>
                    <input type="text" name="mahalla" id="mahalla">
                </div>
                <div class="col-md-12">
                    <label for="subject">Subyekt nomi:</label>
                    <input type="text" name="subject" id="subject">
                </div>
                <div class="col-md-12">
                    <label for="date">Sana:</label>
                    <input type="date" name="date" id="date">
                </div>
                <div class="col-md-12">
                    <label for="inn">INN:</label>
                    <input type="text" name="inn" id="inn">
                </div>
                <div class="col-md-12">
                    <label for="mfo">Bank MFO:</label>
                    <input type="text" name="mfo" id="mfo">
                </div>
                <div class="col-md-12">
                    <label for="address">Manzil:</label>
                    <input type="text" name="address" id="address">
                </div>
                <div class="col-md-12">
                    <label for="phone">Telefon:</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="col-md-12">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="col-md-12">
                    <label for="director">Direktor:</label>
                    <input type="text" name="director" id="director">
                </div>
                <div class="col-md-12">
                    <label for="activity">Faoliyat:</label>
                    <select name="activity" id="activity" multiple>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="1">3</option>
                        <option value="2">4</option>
                        <option value="1">5</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="labors">Ishchilar soni:</label>
                    <input type="number" name="labors" id="labors">
                </div>
                <input type="submit">
            </div>
        </form>
    </body>
</html>
