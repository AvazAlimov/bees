@extends('layouts.app-admin')
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
    @include('admin.navbar',['section'=>5,$waiting, $accepted, $notAccepted])
@endsection
@section('content')
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section10" class="section">
                    <div class="page-header clearfix">
                        <div class="col-md-6">
                            <h2 class="pull-left">Қадоқлаш ва реализация</h2>
                        </div>
                    </div>
                    <div class="row">
                        <table id="example2" class="table table-bordered realization-theader " cellspacing="0">
                            <thead style="width: 100%">
                            <tr>
                                <th rowspan="2">Т/Р</th>
                                <th rowspan="2">Созлаш</th>
                                <th rowspan="2">Статус</th>
                                <th rowspan="2">Ишлаб чиқарувчи номи</th>
                                <th colspan="2">Сана</th>
                                <th rowspan="2">Ҳудуд номи</th>
                                <th rowspan="2">Вилоят номи</th>

                                <th rowspan="2">Йиллик қуввати кг</th>
                                <th colspan="2">Мавжуд дўконлар</th>
                                <th rowspan="2">Қадоқланган асал миқдори кг</th>
                                <th>Реализация қилинган асал миқдори</th>
                                <th colspan="2"> Ички бозор</th>
                                <th colspan="2">Ташқи бозор</th>

                            </tr>
                            <tr>
                                <th>Ой</th>
                                <th>Йил</th>
                                <th>Сони</th>
                                <th>Рўйҳат манзили</th>
                                <th>кг (6+8)</th>
                                <th>кг</th>
                                <th>сўм</th>
                                <th>кг</th>
                                <th>сўм</th>
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
            $.cookie("admin", id,{ expires: 7, path: '/admin' });
        }
        var table1 ;
        window.onload = function () {
            table = $('#example2').DataTable({
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('requisition.export.ajax')}}',
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
                            var accept = '{{route('requisition.export.accept',null)}}';
                            var deny = '{{route('requisition.export.deny',null)}}';
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
                        data: "annual_power"
                    },
                    {
                        data: "shops_count"
                    },
                    {
                        data: "shops_address"
                    },
                    {
                        data: "packed_honey"
                    },
                    {
                        data:null,
                        render: function (data, type, row) {
                            return parseInt(row.inside_quantity) +parseInt(row.outside_quantity);
                        }
                    },
                    {
                        data: "inside_quantity"
                    },
                    {
                        data: "inside_price"
                    },
                    {
                        data: "outside_quantity"
                    },
                    {
                        data: "outside_price"
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