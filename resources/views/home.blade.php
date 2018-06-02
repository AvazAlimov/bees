@extends('layouts.app-user')
@section('styles')
    <style>
        .background-white {
            background-color: #fff;
        }
        .bg-warning{
            background-color: #ffc107 !important;
        }
        .panel{
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
                <!-- Profile -->
            @include('user.profile',['user'=>\Illuminate\Support\Facades\Auth::user()])
            <!-- /Profile -->

                <!-- Site services -->
                <div class="panel panel-default">
                    <div class="panel-heading bg-warning">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#services">
                                Мой профиль <b class="caret"></b></a>
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
            <div class="col-sm-9">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-12 border-gray background-white">
                        <h5 class="text-success"> Бош сахифа</h5>
                        <h6 class="color-gray">Ойлик ҳисобот тўлдириш</h6>
                    </div>
                </div>
                <div class="row text-center background-white border-gray" id="services-list">
                    <div>
                        <p class="text-justify">
                            "Ўзбекистон асаларичилари" уюшмаси Ўзбекистон Республикаси Президентининг 2017 йил 16 октябрдаги
                            ПҚ-3327 сонли қарорига асосан асаларичилик тармоғини бошқариш, тизимини тубдан такомиллаштириш,
                            тармоқда наслчилик ишларини илмий асосда ташкил этиш, асаларичилик хўжаликлари фаолияти
                            самарадорлигини ошириш, асал маҳсулотлари ишлаб чиқариш ҳажми ва турларини янада кўпайтириш,
                            асални қайта ишлаш бўйича замонавий технологияларни жорий этиш, соҳанинг экспорт салоҳиятини
                            ошириш, шунингдек, асаларичилик соҳасидаги илғор тажрибаларни республикамизнинг барча
                            ҳудудларида татбиқ этиш мақсадида ташкил этилган.
                            <br>
                            <strong>Уюшманинг асосий вазифалари:</strong>
                            <br>
                            • асаларичилик тармоғини ривожлантиришга қаратилган норматив-хуқуқий базани ишлаб чиқишда
                            иштирок этиш;
                            <br>
                            • асаларичилик тармоғини ривожлантириш дастурларини амалга оширишни мувофиқлаштириш, ягона
                            илмий-техника, технологик, инвестиция ва экспорт сиёсатини амалга оширишни мувофиқлаштириш;
                            <br>
                            • олий ва ўрта махсус, касб-ҳунар таълими, шу жумладан, хорижий муассасаларда асаларичилик
                            тармоғига кадрлар тайёрлаш, қайта тайёрлаш ва уларнинг малакасини ошириш ишларини самарали
                            ташкил этиш ва мувофиқлаштиришда иштирок этиш.
                            <br>
                            <strong>Уюшманинг асосий фаолият йўналишлари:</strong>
                            <br>
                            • маҳаллий ижро этувчи ҳокимият органлари ва манфаатдор ташкилотлар билан ҳамкорликда
                            асаларичилик хўжаликларини ўрмон фонди ерларига, тоғ ва тоғолди ҳудудларига, табиий пичанзор ва
                            яйловларга ҳамда қишлоқ хўжалиги ерларига жойлаштиришни амалга ошириш;
                            <br>
                            • асаларилар учун сунъий озуқалар ишлаб чиқаришни марказлашган ҳолда ташкил этишга кўмаклашиш ва
                            ушбу тажрибани кенг қўллаш ҳисобига асаларичилик хўжаликларининг озуқа базасини мустаҳкамлаш;
                            <br>
                            • асалари касалликларининг олдини олиш, даволаш ва ташхис қўйиш бўйича замонавий ва илғор
                            усулларни жорий этиш ишларига кўмаклашиш;
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
