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
                        <div class="col-md-6">
                            <h2 class="">Ишлаб чиқариш</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-success btn-add-new pull-right" style="margin-top: 22px;">
                                <i class="fa fa-plus"></i> <span>Добавить</span>
                            </a>
                        </div>
                    </div>{{--
                    <div class="row">
                        <table id="example" class="table table-striped table-bordered cell-border" cellspacing="0">
                            <thead>
                            <tr>
                                <th >#</th>
                                <th >Ишлаб чиқарувчи номи</th>
                                <th >Ҳудуд номи</th>
                                <th >Вилоят номи</th>
                                @for($i=0; $i<$maxNumber; $i++)
                                    <th colspan="2">Ишлаб чиқариладиган жиҳоз</th>
                                @endfor
                                <th rowspan="2">Созлаш</th>
                            </tr>
                            @if($maxNumber != 0)
                                <tr>
                                    @for($i=0; $i<$maxNumber; $i++)
                                        <th>Тури</th>
                                        <th>Ҳажми </th>
                                    @endfor
                                </tr>
                            @endif
                            </thead>

                            <tbody>
                            @foreach($productions as $par => $production)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$production->user->subject}}</td>
                                    <td>{{$production->user->city->name}}</td>
                                    <td>{{$production->user->region->name}}</td>
                                    @foreach($production->equipments as $key=>$equipment)
                                        <td>{{$equipment->name}} ({{$equipment->volume_name}})</td>
                                        <td>{{$equipment->pivot->volume}}</td>
                                    @endforeach
                                    @for($i=$production->equipments->count(); $i<$maxNumber; $i++)
                                        <td></td>
                                        <td></td>
                                    @endfor
                                    <td class="no-sort no-click">
                                        <a href="#" onclick="return confirm('Ushbu ma\'lumotni o\'chirib tashlamoqchimisiz');" title="Удалить" class="btn btn-sm btn-danger pull-right delete" style="margin: 5px;">
                                            <i class="fa fa-trash"></i> <span class="hidden-xs hidden-sm">O'chirish</span>
                                        </a>
                                        <a href="#" title="Редактирование" class="btn btn-sm btn-primary pull-right edit" style="margin: 5px;">
                                            <i class="fa fa-edit"></i> <span class="hidden-xs hidden-sm">O'zgartirish</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>--}}
                </div>
                <div id="section11" class="section">
                    <div class="page-header clearfix">
                        <div class="col-md-6">
                            <h2 class="">Йетказиб бериш</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-success btn-add-new pull-right" style="margin-top: 22px;">
                                <i class="fa fa-plus"></i> <span>Добавить</span>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <table id="delivery" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ишлаб чиқарувчи номи</th>
                                <th>Ҳудуд номи</th>
                                <th>Вилоят номи</th>
                                <th>Созлаш</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr role="row">
                                <td>1</td>
                                <td>sdasdasad</td>
                                <td>production->user->subject</td>
                                <td>production->user->city->name</td>
                                <td>production->user->region->name</td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div>
                                        <table>
                                            <thead>
                                            <tr role="row">
                                                <th>Subgrid 1
                                                </th>
                                                <th >Subgrid 2
                                                </th>
                                                <th>Subgrid 3
                                                </th>
                                                <th >Subgrid 4
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr role="row" >
                                                <td>Some data</td>
                                                <td>Some more data here</td>
                                                <td>Some really loooonnggg data in this column</td>
                                                <td>Yet more data</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr role="row">
                                <td>1</td>
                                <td>sdasdasad</td>
                                <td>production->user->subject</td>
                                <td>production->user->city->name</td>
                                <td>production->user->region->name</td>
                            </tr>
                            <tr role="row">
                                <td>1</td>
                                <td>sdasdasad</td>
                                <td>production->user->subject</td>
                                <td>production->user->city->name</td>
                                <td>production->user->region->name</td>
                            </tr>
                            </tbody>
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

            $('#example').DataTable({
                "dom": "lBfrtip",
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        title: "Ишлаб чиқариш",
                        filename: "Ишлаб чиқариш",
                        className: "btn btn-success pull-left",
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        //--------------------------
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var col = $('col', sheet);
                            col.each(function (index) {
                                if (index > 3 && index % 2 !== 0)
                                    $(this).attr('width', 8);
                            });
                        },
                        text: 'Excel',
                        buttons: [
                            'excel'
                        ]
                    }
                ],
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
                "scrollX": true,
                rowGroup: {
                    dataSrc: 3
                }
            });
            $('#delivery').DataTable({});
        }
    </script>
@endsection