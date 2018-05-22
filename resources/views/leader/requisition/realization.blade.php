@extends('layouts.app')
@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        table.dataTable tr.group td {
            font-weight: bold;
            background-color: #e0e0e0
        }
        .delete{
            margin: 5px;
        }
        .edit{
            margin: 5px 5px;
        }
    </style>
@endsection
@section('nav')
    <nav id="navigation" class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li class="navs">
                <a href="{{ route('leader.index') }}" onclick="switchSection('section1')">
                    <i class="fa fa-columns icon"></i>
                    Заказы
                </a>
            </li>
            <li class="navs">
                <a href="{{ route('leader.index') }}" onclick="switchSection('section2')">
                    <i class="fa fa-columns icon"></i>
                    Принятые заказы
                </a>
            </li>
            <li class="navs">
                <a href="{{ route('leader.index') }}" onclick="switchSection('section3')">
                    <i class="fa fa-columns icon"></i>
                    Непринятые заказы
                </a>
            </li>
            <li class="dropdown navs active">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-bell"></i>
                   Янги ҳисоботлар</a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('leader.requisition.production')}}"> Ишлаб чиқариш</a>
                    </li>
                    <li class="navs2"><a href="{{route('leader.requisition.export')}}">
                            Қадоқлаш ва реализация </a>
                    </li>
                    <li class="navs2 active"><a >
                            Eтиштириш ва реализиция </a>
                    </li>
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
                            <h2 class="pull-left">Асал етиштириш ва реализиция</h2>
                        </div>
                    </div>
                    <div class="row">
                        <table id="example2" class="table table-bordered realization-theader " cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Т/Р</th>
                                <th rowspan="2">Созлаш</th>
                                <th rowspan="2">Статус</th>
                                <th rowspan="2">Ишлаб чиқарувчи номи</th>
                                <th colspan="2">Сана</th>
                                <th rowspan="2">Ҳудуд номи</th>
                                <th rowspan="2">Вилоят номи</th>

                                <th rowspan="2">Боқилаётган асалари оиласи</th>
                                <th rowspan="2">Асал тури</th>
                                <th rowspan="2">Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</th>
                                <th rowspan="2">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</th>
                                <th rowspan="2">Ҳисобот даври бошига асал заҳираси кг</th>
                                <th colspan="2">Реализация қилган асал миқдори</th>
                                <th colspan="2">Асал захираси</th>
                            </tr>
                            <tr>
                                <th>Ой</th>
                                <th>Йил</th>
                                <th>кг</th>
                                <th>сўм</th>
                                <th>кг</th>
                                <th>сўм</th>
                            </tr>
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
    <script src="{{asset('js/jquery.cookie.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>
        function switchSection(id) {
            $.cookie("leader", id,{ expires: 7, path: '/leader' });
        }
        var table;
        window.onload = function () {
            table = $('#example2').DataTable({
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('leader.requisition.realization.ajax')}}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        data: null,
                        render: function (data, type, full, meta) {
                            return meta.row+1;
                        },
                        orderable:false
                    },
                    {
                        data: null,
                        orderable:false,
                        render: function (data, type, full, meta) {
                            var accept = '{{route('leader.requisition.realization.accept',null)}}';
                            var deny = '{{route('leader.requisition.realization.deny',null)}}';
                            return '<a href="' + accept + '/' + data.id + '" onclick="return confirm(\'Ростанхам қабул қилишни истайсизми\')" title="Қабул" class="btn btn-sm btn-success  delete"> <span class="">Қабул</span> </a>' +
                                '<a href="' + deny + '/' + data.id + '" onclick="return confirm(\'Ростанхам рад қилишни истайсизми\')" title="Рад" class="btn btn-sm btn-danger edit"> <span class="">Рад</span></a>';
                        }
                    },
                    {
                        data: "state",
                        render: function (data, type, row) {
                            if (data == 0)
                                return "<span class='label label-warning'>Тасдикланмаган</span>";
                            if(data == -2)
                                return "<span class='label label-danger'>Рад килинган</span>";
                        }

                    },
                    {data: 'user.subject'},
                    {data: 'month'},
                    {data: 'year'},
                    {data: 'user.region.name'},
                    {data: 'user.city.name'},
                    {
                        data: "family_count"
                    },
                    {
                        data: "family_type"
                    },
                    {
                        data: "annual_prog"
                    },
                    {
                        data: "produced_honey"
                    },
                    {
                        data: "reserve"
                    },
                    {
                        data: "realized_quantity"
                    },
                    {
                        data: "realized_price"
                    },
                    {
                        data: "stock_quantity"
                    },
                    {
                        data: "stock_price"
                    }
                ],
                "language": {
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi"
                    },
                    "processing": "Qidirilyapti",
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