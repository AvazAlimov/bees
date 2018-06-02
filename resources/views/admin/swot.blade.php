@extends('layouts.app-admin')
@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        table.dataTable tr.group td {
            font-weight: bold;
            background-color: #e0e0e0
        }

        td.details-control {
            background: white ;
            background-size: 10px 10px;
            cursor: pointer;
        }
    </style>
@endsection
@section('nav')
    @include('admin.navbar',['section'=>1,$waiting, $accepted, $notAccepted])
@endsection
@section('content')
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section10" class="section">
                    {{--<div class="page-header clearfix">
                        <div class="col-md-4">
                            <h2 >Ишлаб чиқариш </h2>
                        </div>
                        <div class="col-md-8">
                            <a href="#" class="btn btn-success btn-add-new pull-right" style="margin-top: 22px;">
                                <i class="fa fa-plus"></i> <span>Добавить</span>
                            </a>
                        </div>
                    </div>--}}
                    <div class="row">
                        <div class="page-header">
                            <h2 class="pull-left">Хисоботлар</h2>
                            <div>
                                <a href="{{route('region.export')}}" class="btn btn-success" tabindex="0"
                                   aria-controls="example"
                                   style="margin-top: 20px; margin-left: 20px;">Excel
                                </a>
                            </div>
                        </div>

                        <table id="example1" class="table table-bordered realization-theader" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Худуд</th>
                                <th rowspan="2">Уюшмага аъзо субъектлар сони</th>
                                <th colspan="3" scope="colgroup">Субъектлар</th>
                                <th rowspan="2">Мавсум бошидаги асал захираси</th>
                                <th rowspan="2">Ишлаб чикариш хажми (Прогноз)</th>
                                <th rowspan="2">Ишлаб чикариш хажми (Факт)</th>
                                <th rowspan="2">Етиштирилган асал миқдори (кг)</th>
                                <th colspan="2" scope="colgroup">Реализация килинган асал микдори</th>
                                <th colspan="2" scope="colgroup">Асал захираси</th>
                            </tr>
                            <tr>
                                <th scope="col">Юридик шахслар (МЧЖ, ХК, ҚК, ДХ)</th>
                                <th scope="col">ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари</th>
                                <th scope="col">Шахсий ёрдамчи хўжаликлари (жисмоний шахслар)</th>
                                <th scope="col">Кг</th>
                                <th scope="col">Сум</th>
                                <th scope="col">Кг</th>
                                <th scope="col">Сум</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Жами:</th>
                                <th>{{$total[0]->total != null ? $total[0]->total : 0 }}</th>
                                <th>{{$total[0]->yuridik != null ? $total[0]->yuridik : 0}}</th>
                                <th>{{$total[0]->yakka != null ? $total[0]->yakka : 0}}</th>
                                <th>{{$total[0]->jismoniy != null ? $total[0]->jismoniy: 0}}</th>
                                <th>{{$total[0]->reserves != null ? $total[0]->reserves : 0}}</th>
                                <th>{{$total[0]->annual_prog != null ? $total[0]->annual_prog : 0}}</th>
                                <th>{{$total[0]->produced_honey != null ? $total[0]->produced_honey  : 0}}</th>
                                <th>{{$total[0]->honey_quantity != null ? $total[0]->honey_quantity  : 0}}</th>
                                <th>{{$total[0]->realized_quantity != null ? $total[0]->realized_quantity: 0}}</th>
                                <th>{{$total[0]->realized_price != null ? $total[0]->realized_price : 0}}</th>
                                <th>{{$total[0]->stock_quantity != null ? $total[0]->stock_quantity : 0}}</th>
                                <th>{{$total[0]->stock_price != null ? $total[0]->stock_price: 0}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="page-header">
                            <h2 class="pull-left">Ўзбекистон асаларичилари уюшмасига аъзо субектлар тўғрисида маълумот</h2>
                            <div>
                                <a id="swot-export" href="{{route('swot.export')}}" class="btn btn-success" tabindex="0"
                                   aria-controls="example"
                                   style="margin-top: 20px; margin-left: 20px;">Excel
                                </a>
                            </div>
                        </div>
                        <table id="example2" class="table table-bordered realization-theader " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Худуд</th>
                                <th rowspan="2">Туман номи</th>
                                <th rowspan="2">Уюшмага аъзо субъектлар сони</th>
                                <th colspan="3" scope="colgroup">Субъектлар</th>
                                <th colspan="{{$activities->count()}}" scope="colgroup">Фаолият тури</th>
                                <th rowspan="2" scope="colgroup">Етиштирилган асал миқдори (кг)</th>
                                <th rowspan="2" scope="colgroup">Боқилаётган асалари оилалари сони</th>
                                <th rowspan="2" scope="colgroup">Ишчилар сони</th>
                            </tr>
                            <tr>
                                <th scope="col">Юридик шахслар (МЧЖ, ХК, ҚК, ДХ)</th>
                                <th scope="col">ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари</th>
                                <th scope="col">Шахсий ёрдамчи хўжаликлари (жисмоний шахслар)</th>
                                @foreach($activities as $activity)
                                    <th scope="col">{{$activity->name}}</th>
                                @endforeach
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="page-header">
                            <h2 class="pull-left">
                                Ўзбекистон асаларичилари уюшмасига аъзо субектлар тўғрисида маълумот
                            </h2>
                            <div>
                                <a id="swot-user-export" href="{{route('user.export')}}" class="btn btn-success" tabindex="0"
                                   aria-controls="example"
                                   style="margin-top: 20px; margin-left: 20px;">Excel
                                </a>
                            </div>
                        </div>
                        <table id="example3" class="table table-bordered realization-theader " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                               <th>Т/Р</th>
                                <th>Субъект номи</th>
                                <th>Вилоят номи</th>
                                <th>Туман/шаҳар номи</th>
                                <th>Маҳалла (МФЙ) номи</th>
                                <th>Корхона давлат рўйҳатидан ўтган сана</th>
                                <th>СТИР (ИНН)</th>
                                <th>Банк МФО</th>
                                <th>Хизмат кўрсатиладиган банк номи</th>
                                <th>Манзил</th>
                                <th>Телефон рақами</th>
                                <th>Электрон почта</th>
                                <th>Хўжалик раҳбари исми шарифи</th>
                                <th>Етиштирилган асал миқдори (кг)</th>
                                <th>Ишчилар сони</th>
                                <th>Боқлаётган асалари оилалари сони</th>
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

        function fetch_data(params) {
            var url;

            if(params) {
                url = '{!! route('getSwot') !!}' + '/' + params;
            }else{
                url = '{!! route('getSwot') !!}';
            }
            var table2 = $('#example2').DataTable({
                rowGroup: {
                    dataSrc: 'region_name'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'region_name'},
                    {
                        data: 'city_name',
                        className: 'details-control'
                    },
                    {data: 'total'},
                    {data: 'yuridik'},
                    {data: 'yakka'},
                    {data: 'jismoniy'},
                        @foreach($activities as $activity)
                    {
                        data: 'activity{{$activity->id}}'
                    },
                        @endforeach
                    {
                        data: 'honey_quantity',
                        defaultContent: 0
                    },
                    {
                        data: 'bees_count',
                        defaultContent: 0
                    },
                    {data: 'labors'}
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
            return table2;
        }

        function fetch_user_data(params) {
            var url;

            if(params) {
                url = '{!! route('getUsers') !!}' + '/' + params;
            }else{
                url = '{!! route('getUsers') !!}';
            }
            var table3 = $('#example3').DataTable({
                rowGroup: {
                    dataSrc: 'city_name'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'id'},
                    {
                        data: 'subject',
                        render:function (data, type, row) {
                            if(data == null || data == ''){
                                return row.fullName;
                            }else{
                                return data;
                            }
                        }
                    },
                    {data: 'region_name'},
                    {data: 'city_name'},
                    {data: 'neighborhood'},
                    {data: 'reg_date'},
                    {data: 'inn'},
                    {data: 'mfo'},
                    {data: 'bank_name'},
                    {data: 'address'},
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'fullName'},
                    {
                        data: 'honey_quantity',
                        defaultContent: 0
                    },
                    {
                        data: 'labors',
                        defaultContent: 0
                    },
                    {
                        data: 'bees_count',
                        defaultContent: 0
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

        $(document).ready(function() {
            var params = '';

            var table1 = $('#example1').DataTable({
                pageLength: 25,
                lengthChange: false,
                paging:false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('getRegion') !!}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        data: 'region',
                        className: 'details-control'
                    },
                    {data: 'total'},
                    {data: 'yuridik'},
                    {data: 'yakka'},
                    {data: 'jismoniy'},
                    {
                        data: 'reserves',
                        defaultContent: 0
                    },
                    {
                        data: 'annual_prog',
                        defaultContent: 0
                    },
                    {
                        data: 'produced_honey',
                        defaultContent: 0
                    },
                    {
                        data: 'honey_quantity',
                        defaultContent: 0
                    },
                    {
                        data: 'realized_quantity',
                        defaultContent: 0
                    },
                    {
                        data: 'realized_price',
                        defaultContent: 0
                    },
                    {
                        data: 'stock_quantity',
                        defaultContent: 0
                    },
                    {
                        data: 'stock_price',
                        defaultContent: 0
                    },
                    {
                        data: 'id',
                        visible: false,
                        orderable:false
                    }
                ],
                "language": {
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi"
                    },
                    "processing": "Qidirilyapti",
                    "lengthMenu": "Ҳар бир сахифа учун _MENU_ ёзувларни кўрсатиш",,
                    "zeroRecords": "Хеч нарса топилмади",
                    "search": "Қидириш:",
                    "info": "_PAGES_ дан _PAGE_ таси сахифа кўрсатилган",
                    "infoEmpty": "Ёзувлар мавжуд эмас",
                    "infoFiltered": "(жами _MAX_ ёзувлар филти килинган)"
                },
                "scrollX": true
            });
            var table2 = fetch_data(params);

            fetch_user_data(params);
            $('#example1 tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table1.row( tr );
                var id =row.data().id;

                $('#example2').DataTable().destroy();

                table2 = fetch_data(id);
                $("#swot-export").attr("href",  '{!! route('swot.export') !!}'+'/'+id);
                $('html,body').animate({
                        scrollTop: $("#example2").offset().top-200},
                    'slow');
            });

            $('#example2 tbody').on('click', 'td.details-control', function () {
                var tr2 = $(this).closest('tr');
                var row = table2.row( tr2 );
                var id =row.data().city_id;
                $('#example3').DataTable().destroy();

                fetch_user_data(id);
                $("#swot-user-export").attr("href",  '{!! route('user.export') !!}'+'/'+id);
                $('html,body').animate({
                        scrollTop: $("#example3").offset().top-200},
                    'slow');
            });
        });

    </script>
@endsection