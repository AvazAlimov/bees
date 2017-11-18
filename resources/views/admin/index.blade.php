@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-default" id="navigation"
         style="border-radius: 0; border-width: 0 0 thin 0;">
        <ul class="nav navbar-nav">
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section1')"><i class="fa fa-car"></i>
                    Viloyatlar</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section2')"><i class="fa fa-users"></i>
                    Rahbarlar</a>
            </li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section3')"><i class="fa fa-money"></i>
                    Shaharlar</a>
            </li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section4')"><i class="fa fa-building"></i>
                    Faoliyatlar</a></li>
            {{--

                <li data-toggle="tab" class="navs"><a onclick="switchSection('section4')"><i class="fa fa-file-excel-o"></i>
                        Экспорт в
                        Excel</a></li>--}}
        </ul>
    </nav>
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section1" class="section" style="display: block;">
                    <div class="page-header">
                        <h2>Viloyatlar</h2>
                    </div>
                    @foreach ($regions as $region)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $region->name }} :  <i>{{$region->leader->firstName}} {{$region->leader->lastName}}</i></strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('region.edit', $region->id) }}" method="GET">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('region.delete', $region->id) }}" method="get" onclick="return confirm('Хотите удалить')">
                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form method="GET" action="{{ route('region.create')}}" >
                        <button type="submit" class="btn btn-primary pull-right">
                            Region Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section2" class="section">
                    <div class="page-header">
                        <h2>Rahbarlar</h2>
                    </div>
                    @foreach ($leaders as $leader)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $leader->username }}</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading">
                                                Ismi: {{ $leader->firstName }} {{ $leader->lastName }}</h3>
                                            <br>
                                            <p><strong>Elektron Pochtasi:</strong> {{ $leader->email }}</p>
                                            <p><strong>Telefon raqami:</strong> {{ $leader->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('leader.show', $leader->id) }}" method="get">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('leader.delete', $leader->id) }}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        <form action="{{ route('leader.create') }}" method="GET">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary pull-right">
                                Добавить оператор
                            </button>
                        </form>
                    </div>
                </div>
                <div id="section3" class="section">
                    <div class="page-header">
                        <h2>Shaharlar</h2>
                    </div>
                    @foreach ($cities as $city)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $city->region->name }}</strong>
                                </div>
                                <div class="panel-body">
                                    <strong>{{ $city->name }}</strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('city.show', $city->id) }}"
                                                      method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('city.delete', $city->id) }}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('city.create') }}" method="GET">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary pull-right">
                            Shaharni Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section4" class="section">
                    <div class="page-header">
                        <h2>Faoliyatlar</h2>
                    </div>
                    @foreach ($activities as $activity)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $activity->name }}</strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('activity.show', $city->id) }}"
                                                      method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('activity.delete', $city->id) }}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('activity.create') }}" method="GET">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary pull-right">
                            Faoliyatni Qo'shish
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function switchSection(id) {
            document.cookie = "admin=" + id + ";";
            var section = document.getElementsByClassName('section');
            for (var i = 0; i < section.length; i++)
                section[i].style.display = "none";
            document.getElementById(id).style.display = "block";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "section1";
        }

        window.onload = function () {
            switchSection(getCookie("admin"));
            var navs = document.getElementsByClassName("navs");
            navs[getCookie("admin").replace("section", "") - 1].className = "navs active";
        }
    </script>
@endsection