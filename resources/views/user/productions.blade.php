@extends('layouts.app-admin')

@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
    <style>
        .background-white {
            background-color: #fff;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .panel {
            border-color: #ffc107 !important;
        }
    </style>

@endsection
@section('content')

    <!-- Content -->
    <div id="wrapper">
        <div class="container-fluid">
            <div class="col-sm-2">
                <!-- Profile -->
            @include('user.profile',['user'=>\Illuminate\Support\Facades\Auth::user()])
            <!-- /Profile -->

                <!-- Site services -->
                <div class="panel panel-default">
                    <div class="panel-heading bg-warning">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#services">
                                Профил <b class="caret"></b></a>
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
                                <li class="list-active">
                                    <p> Ишлаб чиқарилган жиҳоз</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Site services -->
            </div>
            <div class="col-sm-10">
                <h5>Ишлаб чиқарилган жиҳоз</h5>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#add">Қўшиш</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#services-list">Маълумот </a>
                    </li>
                    <li class="hide edit-nav">
                        <a data-toggle="tab" href="#edit">Ўзгартириш </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="add">
                        <form method="post" id="form">
                            {{csrf_field()}}
                            <label class="col-md-12">Ойма ой киритиладиган сана</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Йил</span>
                                        <select class="form-control" id="year_2" name="year">
                                            @for($i = date('Y'); $i>1999; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Ой</span>
                                        <select class="form-control" id="month_2" name="month">
                                            <option value="1" {{date('m') == "01" ? "selected" : ""}} >Январь</option>
                                            <option value="2" {{date('m') == "02" ? "selected" : ""}}>Февраль</option>
                                            <option value="3" {{date('m') == "03" ? "selected" : ""}}>Март</option>
                                            <option value="4" {{date('m') == "04" ? "selected" : ""}}>Апрель</option>
                                            <option value="5" {{date('m') == "05" ? "selected" : ""}} >Май</option>
                                            <option value="6" {{date('m') == "06" ? "selected" : ""}}>Июнь</option>
                                            <option value="7" {{date('m') == "07" ? "selected" : ""}}>Июль</option>
                                            <option value="8" {{date('m') == "08" ? "selected" : ""}}>Август</option>
                                            <option value="9" {{date('m') == "09" ? "selected" : ""}}>Сентябрь</option>
                                            <option value="10" {{date('m') == "10" ? "selected" : ""}}>Октябрь</option>
                                            <option value="11" {{date('m') == "11" ? "selected" : ""}}>Ноябрь</option>
                                            <option value="12" {{date('m') == "12" ? "selected" : ""}}>Декабрь</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div style="height: 80px;"></div>
                            </div>
                            <label class="col-md-12">Ишлаб чиқариладиган жиҳозлар</label>
                            @for($j = 0; $j<=$equipments->count(); $j+=5)
                                <div class="form-row">
                                    <div class="col-md-12">
                                        @for($i=$j; $i<=$j+4 && $i<$equipments->count(); $i++)
                                            <div class="form-group col-md-2">
                                                <label for="reserve">{{$equipments[$i]->name}} ({{$equipments[$i]->volume_name}})</label>
                                                <input type="number" name="equipments[{{$equipments[$i]->id}}]" value="{{old('reserve')}}"
                                                       class="form-control" id="reserve" required>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endfor

                            <button type="submit" class="btn btn-primary">Қўшиш</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="services-list">
                        <div class="row background-white panel" id="services-list">
                            <div class="page-header clearfix">
                                <h2 class="pull-left">O'zbekiston asalarichilari uyushmasiga a'zo subyektlar to'g'risida
                                    ma'lumot</h2>
                            </div>
                            <table id="example2" class="table table-bordered realization-theader" cellspacing="0">
                                <thead style="width: 100%">
                                <tr>
                                    <th rowspan="2">Т/Р</th>
                                    <th rowspan="2">Статус</th>
                                    <th colspan="{{$equipments->count()}}">Ишлаб чиқариладиган жиҳозлар</th>
                                    <th rowspan="2">Ой</th>
                                    <th rowspan="2">Йил</th>
                                    <th rowspan="2">Созлаш</th>
                                </tr>
                                <tr>
                                    @foreach($equipments as $equipment)
                                        <th>{{$equipment->name }} ({{$equipment->volume_name}})</th>
                                    @endforeach
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="edit">
                        <form method="post" id="form_2">
                            {{csrf_field()}}
                            <label class="col-md-12">Ойма ой киритиладиган сана</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Йил</span>
                                        <select class="form-control" id="year_2" name="year">
                                            @for($i = date('Y'); $i>1999; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Ой</span>
                                        <select class="form-control" id="month_2" name="month">
                                            <option value="1" {{date('m') == "01" ? "selected" : ""}} >Январь</option>
                                            <option value="2" {{date('m') == "02" ? "selected" : ""}}>Февраль</option>
                                            <option value="3" {{date('m') == "03" ? "selected" : ""}}>Март</option>
                                            <option value="4" {{date('m') == "04" ? "selected" : ""}}>Апрель</option>
                                            <option value="5" {{date('m') == "05" ? "selected" : ""}} >Май</option>
                                            <option value="6" {{date('m') == "06" ? "selected" : ""}}>Июнь</option>
                                            <option value="7" {{date('m') == "07" ? "selected" : ""}}>Июль</option>
                                            <option value="8" {{date('m') == "08" ? "selected" : ""}}>Август</option>
                                            <option value="9" {{date('m') == "09" ? "selected" : ""}}>Сентябрь</option>
                                            <option value="10" {{date('m') == "10" ? "selected" : ""}}>Октябрь</option>
                                            <option value="11" {{date('m') == "11" ? "selected" : ""}}>Ноябрь</option>
                                            <option value="12" {{date('m') == "12" ? "selected" : ""}}>Декабрь</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div style="height: 80px;"></div>
                            </div>
                            <label class="col-md-12">Ишлаб чиқариладиган жиҳозлар</label>
                            @for($j = 0; $j<=$equipments->count(); $j+=5)
                                <div class="form-row">
                                    <div class="col-md-12">
                                        @for($i=$j; $i<=$j+4 && $i<$equipments->count(); $i++)
                                            <div class="form-group col-md-2">
                                                <label for="reserve">{{$equipments[$i]->name}} ({{$equipments[$i]->volume_name}})</label>
                                                <input type="number" name="equipments[{{$equipments[$i]->id}}]" value="{{old('reserve')}}"
                                                       class="form-control" id="equipment_{{$equipments[$i]->id}}" required>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endfor

                            <button type="submit" class="btn btn-primary">Ўзгартириш</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /Content -->
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dataTables.rowGroup.min.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script>
        var table;
        function editExport(id) {
            var edit = "#edit";
            $('.edit-nav').removeClass('hide');
            $('.nav-tabs a:last').tab('show');
            var data = table.rows().data()[id];

            var href = '{{route('user.update.realization', null)}}';
            $(edit).find('#form_2').attr('action', href + '/' + data.id);
            $(edit).find('#year_2').val(data.year);
            $(edit).find('#year_2').change();
            $(edit).find('#month_2').val(data.month);
            $(edit).find('#month_2').change();

            $.each(data.equipments, function( key, equipment ) {
                $(edit).find('#equipment_'+key).val(equipment.volume);
            })

        }
        $(document).ready(function () {

            $('.honey_type').select2();
            table = $('#example2').DataTable({
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('user.get.production')}}',
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
                        data: "state",
                        render: function (data, type, row) {
                            if (data == 0)
                                return "<span class='label label-warning'>Тасдикланмаган</span>";
                            else if(data == -1)
                                return "<span class='label label-danger'>Рад килинган</span>";
                            else
                                return "<span class='label label-success'>Тасдикланган</span>";
                        }

                    },
                        @foreach($equipments as $i=> $equipment)
                    {
                        data: 'equipments.{{$equipment->id}}.volume'
                    },
                        @endforeach
                    {
                        data:"month"
                    },
                    {
                        data:"year"
                    },

                    {
                        data: null,
                        orderable:false,
                        render: function (data, type, full, meta) {
                            return '<a onclick="editExport(' + meta.row + ')" title="Узгартириш" class="btn btn-sm btn-primary pull-right edit"> <span class="">Ўзгартириш</span></a>';
                        }
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
        });
    </script>
@endsection
