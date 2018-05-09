<nav class="navbar navbar-default" id="navigation">
    <ul class="nav navbar-nav" style="display:block; width: 100%">
        <li class="dropdown navs">
            <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                Асосий бўлим  </a>
            <ul class="dropdown-menu">
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section2')">Раҳбарият</a>
                </li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section1')">Вилоятлар</a>
                </li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section3')">Туманлар</a>
                </li>
            </ul>
        </li>
        <li class="dropdown navs">
            <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-compass"></i>Йўналишлар<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section4')">Фаолият тури</a></li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section5')">Боқилаётган асалари турлари</a></li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section6')">Жиҳозлар</a></li>
            </ul>
        </li>
        <li class="dropdown navs">
            <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-id-card"></i>
                Аъзолик <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section7')">Аризалар</a></li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section8')">Қабул қилинган</a></li>
                <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section9')">Қабул қилинмаган</a></li>
            </ul>
        </li>
        <li class="dropdown navs active">
            <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-line-chart"></i>
                Электрон ҳисобот <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="navs2 {{$section==1 ? "active" : ""}}"><a {{$section==1 ? "" : "href=".route('swot')}}>Ҳисобот</a></li>
                <li class="navs2 {{$section==2 ? "active" : ""}}"><a {{$section==2 ? "" : "href=".route('nomma')}}>Таҳлилий ҳисобот</a></li>
                <li class="navs2 {{$section==3 ? "active" : ""}}"><a {{$section==3 ? "" : "href=".route('ishlabchiqarish')}}>Ишлаб чиқариш қувватлари</a></li>
            </ul>
        </li>
    </ul>
</nav>