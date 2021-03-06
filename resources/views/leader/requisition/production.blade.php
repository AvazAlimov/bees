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
                    <span class="badge">{{$waiting}}</span>
                    Аризалар
                </a>
            </li>
            <li class="navs">
                <a href="{{ route('leader.index') }}" onclick="switchSection('section2')">
                    <span class="badge">{{$accepted}}</span>
                    Қабул қилинган
                </a>
            </li>
            <li class="navs">
                <a href="{{ route('leader.index') }}" onclick="switchSection('section3')">
                    <span class="badge">{{$notAccepted}}</span>
                    Қабул қилинмаган
                </a>
            </li>
            <li class="dropdown navs active">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-bell"></i>
                   Янги ҳисоботлар</a>
                <ul class="dropdown-menu">
                    <li class="navs2 active"><a> Ишлаб чиқариш</a>
                    </li>
                    <li class="navs2"><a href="{{route('leader.requisition.export')}}">
                            Қадоқлаш ва реализация </a>
                    </li>
                    <li class="navs2"><a href="{{route('leader.requisition.realization')}}">
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
                            <h2 class="pull-left">Ишлаб чиқариш </h2>
                        </div>
                    </div>
                    <div class="row">
                        <table id="example" class="table table-striped table-bordered cell-border" cellspacing="0">
                            <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Созлаш</th>
                                <th rowspan="2">Статус</th>
                                <th rowspan="2">Ишлаб чиқарувчи номи</th>
                                <th colspan="2">Сана</th>
                                <th rowspan="2">Ҳудуд номи</th>
                                <th rowspan="2">Вилоят номи</th>

                                <th colspan="{{$equipments->count()}}">Ишлаб чиқариладиган жиҳозлап</th>
                            </tr>
                            <tr>
                                <th>Ой</th>
                                <th>Йил</th>
                                @foreach($equipments as $equipment)
                                    <th>{{$equipment->name }} ({{$equipment->volume_name}})</th>
                                @endforeach
                            </tr>
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
    <script src="{{asset('js/jquery.cookie.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>

    <script>
        function switchSection(id) {
            $.cookie("leader", id,{ expires: 7, path: '/leader' });
        }
        var table1 ;
        function editNomma(id) {
            var data = table1.rows().data()[id];
            var href='#';
            var myModal = "#myModal";
            $(myModal).modal();
            $(myModal).find('#form').attr('action',href+'/'+data.id);
            $(myModal).find('.subject').val(data.user.subject);
            $(myModal).find('.region').val(data.user.region.name);
            $(myModal).find('.city').val(data.user.city.name);
            var i;
            @foreach($equipments as $equipment)
            i='{{$equipment->id}}';
            $(myModal).find('#equipments1_{{$equipment->id}}').val(data.equipments[i].volume);
            $(myModal).find('#equipments2_{{$equipment->id}}').val(data.equipments[i].equipment_id);
            @endforeach
             $("#btn_edit").html('Ўзгартириш');
        }
        window.onload = function () {
           table1 = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('leader.requisition.production.ajax') !!}',
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
                            var accept = '{{route('leader.requisition.production.accept',null)}}';
                            var deny = '{{route('leader.requisition.production.deny',null)}}';
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
                        @foreach($equipments as $i=> $equipment)
                    {
                        data: 'equipments.{{$equipment->id}}.volume'
                    },
                        @endforeach
                ],
                "dom": "frtip",
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