@extends('layouts.app-admin')
@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        table.dataTable tr.group td {
            font-weight: bold;
            background-color: #e0e0e0
        }
    </style>
@endsection
@section('nav')
    <nav class="navbar navbar-default" id="navigation">
        <ul class="nav navbar-nav" style="display:block; width: 100%">
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Asosiy sozlamalar </a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section1')"><i
                                    class="fa fa-users"></i>
                            Viloyatlar</a>
                    </li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section2')"><i
                                    class="fa fa-users"></i>
                            Rahbarlar</a>
                    </li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section3')"><i
                                    class="fa fa-money"></i>
                            Shaharlar</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Turlar</a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section4')"><i
                                    class="fa fa-building"></i>
                            Faoliyatlar</a></li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section5')"><i
                                    class="fa fa-building"></i>
                            Asalari Zotlari</a></li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section6')"><i
                                    class="fa fa-building"></i>
                            Jihoz Turlari</a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Заказы</a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section7')"><i
                                    class="fa fa-building"></i>
                            Заказы</a></li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section8')"><i
                                    class="fa fa-building"></i>
                            Принятые заказы</a></li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section9')"><i
                                    class="fa fa-building"></i>
                            Непринятые заказы</a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Hisobot</a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section10')"><i
                                    class="fa fa-building"></i>
                            Ишлаб чиқариш</a></li>
                    <li class="navs2"><a href="{{route('admin.index')}}" onclick="switchSection('section11')"><i
                                    class="fa fa-building"></i>
                            Йетказиб бериш</a></li>
                </ul>
            </li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section10" class="section">
                    <div class="page-header clearfix">
                        <div class="col-md-4">
                            <h2 class="pull-left">Ишлаб чиқариш   </h2>
                            <div >
                                <a href="{{route('ishlabchiqarish.export')}}" class="btn btn-success" tabindex="0" aria-controls="example"
                                        style="margin-top: 20px; margin-left: 20px;" >Excel
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="#" class="btn btn-success btn-add-new pull-right" style="margin-top: 22px;">
                                <i class="fa fa-plus"></i> <span>Добавить</span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <table id="example" class="table table-striped table-bordered cell-border" cellspacing="0">
                            <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Ишлаб чиқарувчи номи</th>
                                <th rowspan="2">Ҳудуд номи</th>
                                <th rowspan="2">Вилоят номи</th>
                                @for($i=0; $i<$maxNumber; $i++)
                                    <th colspan="2">Ишлаб чиқариладиган жиҳоз</th>
                                @endfor
                                <th rowspan="2">Созлаш</th>
                            </tr>
                            @if($maxNumber != 0)
                                <tr>
                                    @for($i=0; $i<$maxNumber; $i++)
                                        <th>Тури</th>
                                        <th>Ҳажми</th>
                                    @endfor
                                </tr>
                            @endif
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.rowGroup.min.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

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
            var navs = document.getElementsByClassName("navs2");
            navs[getCookie("admin").replace("section", "") - 1].className = "navs2 active";
            $(navs[getCookie("admin").replace("section", "") - 1]).filter(function () {
                return $(this).parent().parent().is('li')
            }).parent().parent().addClass('active');
            var maxNumber = '{!! $maxNumber !!}';
            $('#example').DataTable({

                rowGroup: {
                    dataSrc: 'user.region.name'
                },
                processing: true,
                serverSide: true,
                ajax: '{!! route('ishlabchiqarish.data') !!}',
                columns: [
                    {data: 'id'},
                    {data: 'user.subject'},
                    {data: 'user.city.name'},
                    {data: 'user.region.name'},
                        @for($i =0; $i<$maxNumber; $i++)
                    {
                        data: 'equipments.{{$i}}.name'
                    },
                    {data: 'equipments.{{$i}}.volume'},
                        @endfor
                    {
                        data: null, render: function (data, type, full, meta) {
                        return '<a href="' + data.id + '">Here</a>';
                    }
                    }
                ],
                "dom": "frtip",
                "columnDefs": [
                    {"width": "10px", "targets": "_all"}
                ],
                "language": {
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi"
                    },
                    "lengthMenu": "Хар бир сахифа учун _MENU_ йозувларни кўрсатиш",
                    "zeroRecords": "Хеч нарса топилмади",
                    "search": "Қидириш:",
                    "info": "_PAGES_ дан _PAGE_ таси сахифа кўрсатилган",
                    "infoEmpty": "Йозувлар мавжуд эмас",
                    "infoFiltered": "(жами _MAX_ йозувлар филти килинган)"
                },
                "scrollX": true
            });
        }
    </script>
@endsection