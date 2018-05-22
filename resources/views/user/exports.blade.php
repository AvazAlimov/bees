@extends('layouts.app-user')

@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/client.css')}}" rel="stylesheet">
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
                                <li class="list-active">
                                    <p> Асални қадоқлаш ва реализация</p>
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
            <div class="col-sm-10">
                <h5>Асални қадоқлаш ва реализация</h5>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" id="form" action="{{ route('user.store.export') }}">
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
                                <div class="form-group col-md-6">
                                    <label for="annual_power">Йиллик қуввати</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="annual_power" value="{{old('annual_power')}}" class="form-control"
                                               id="annual_power" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="packed_honey">Қадоқланган асал миқдори</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="packed_honey" value="{{old('packed_honey')}}" class="form-control"
                                               id="packed_honey" required>
                                    </div>
                                </div>
                            </div>

                            <label for="shops_count" class="col-md-12">Мавжуд дўконлар</label>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Сони</span>
                                        <input type="number" name="shops_count" value="{{old('shops_count')}}" class="form-control"
                                               id="shops_count" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Рўйҳат манзили</span>
                                        <input type="text" name="shops_address" value="{{old('shops_address')}}" class="form-control"
                                               id="shops_address" required>
                                    </div>
                                </div>
                            </div>
                            <label for="inside_quantity" class="col-md-12">Реализация қилинган асал миқдори</label>
                            <div class="form-row">
                                <label class="col-md-12">Ички бозор</label>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="inside_quantity" value="{{old('inside_quantity')}}" class="form-control"
                                               id="inside_quantity" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="inside_price" value="{{old('inside_price')}}" class="form-control"
                                               id="inside_price" required>
                                    </div>
                                </div>
                                <label class="col-md-12">Ташқи бозор</label>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="outside_quantity" value="{{old('outside_quantity')}}" class="form-control"
                                               id="outside_quantity" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="outside_price" value="{{old('outside_price')}}" class="form-control" id="outside_price" required>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Қўшиш</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="services-list">
                        <div class="row background-white panel" id="services-list">
                            <div class="page-header clearfix">
                                <h2 class="pull-left">O'zbekiston asalarichilari uyushmasiga a'zo subyektlar to'g'risida
                                    ma'lumot</h2>
                            </div>
                            <table id="example2" class="table table-bordered realization-theader " cellspacing="0">
                                <thead style="width: 100%">
                                <tr>
                                    <th rowspan="2">Т/Р</th>
                                    <th rowspan="2">Статус</th>
                                    <th rowspan="2">Йиллик қуввати кг</th>
                                    <th colspan="2">Мавжуд дўконлар</th>
                                    <th rowspan="2">Қадоқланган асал миқдори кг</th>
                                    <th >Реализация қилинган асал миқдори</th>
                                    <th colspan="2"> Ички бозор</th>
                                    <th colspan="2">Ташқи бозор</th>
                                    <th rowspan="2">Ой</th>
                                    <th rowspan="2">Йил</th>
                                    <th rowspan="2">Созлаш</th>

                                </tr>
                                <tr>
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
                    <div class="tab-pane fade" id="edit">
                        @if ($errors->edit->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->edit->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                <div class="form-group col-md-6">
                                    <label for="annual_power">Йиллик қуввати</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="annual_power" value="{{old('annual_power')}}" class="form-control"
                                               id="annual_power_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="packed_honey">Қадоқланган асал миқдори</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="packed_honey" value="{{old('packed_honey')}}" class="form-control"
                                               id="packed_honey_2" required>
                                    </div>
                                </div>
                            </div>

                            <label for="shops_count_2" class="col-md-12">Мавжуд дўконлар</label>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Сони</span>
                                        <input type="number" name="shops_count" value="{{old('shops_count')}}" class="form-control"
                                               id="shops_count_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Рўйҳат манзили</span>
                                        <input type="text" name="shops_address" value="{{old('shops_address')}}" class="form-control"
                                               id="shops_address_2" required>
                                    </div>
                                </div>
                            </div>
                            <label for="inside_quantity_2" class="col-md-12">Реализация қилинган асал миқдори</label>
                            <div class="form-row">
                                <label class="col-md-12">Ички бозор</label>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="inside_quantity" value="{{old('inside_quantity')}}" class="form-control"
                                               id="inside_quantity_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="inside_price" value="{{old('inside_price')}}" class="form-control"
                                               id="inside_price_2" required>
                                    </div>
                                </div>
                                <label class="col-md-12">Ташқи бозор</label>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="outside_quantity" value="{{old('outside_quantity')}}" class="form-control"
                                               id="outside_quantity_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="outside_price" value="{{old('outside_price')}}" class="form-control"
                                               id="outside_price_2" required>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Қўшиш</button>
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
            var href='{{route('user.update.export', null)}}';
            $(edit).find('#form_2').attr('action',href+'/'+data.id);
            $(edit).find('#year_2').val(data.year);
            $(edit).find('#year_2').change();
            $(edit).find('#month_2').val(data.month);
            $(edit).find('#month_2').change();

            $(edit).find('#annual_power_2').val(data.annual_power);
            $(edit).find('#shops_count_2').val(data.shops_count);
            $(edit).find('#shops_address_2').val(data.shops_address);
            $(edit).find('#packed_honey_2').val(data.packed_honey);
            $(edit).find('#inside_quantity_2').val(data.inside_quantity);
            $(edit).find('#inside_price_2').val(data.inside_price);
            $(edit).find('#outside_quantity_2').val(data.outside_quantity);
            $(edit).find('#outside_price_2').val(data.outside_price);
        }
        $(document).ready(function () {
            @if ($errors->edit->any())
                $('.edit-nav').removeClass('hide');
                $('.nav-tabs a:last').tab('show');
                var href='{{route('user.update.export', Session::get('id'))}}';
                $('#edit').find('#form_2').attr('action',href);
            @endif
            $('.honey_type').select2();
            table = $('#example2').DataTable({
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('user.get.export')}}',
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
                            if (data == 1)
                                return "<span class='label label-success'>Тасдикланган</span>";
                            else if(data == -1)
                                return "<span class='label label-danger'>Рад килинган</span>";
                            else
                                return "<span class='label label-warning'>Тасдикланмаган</span>";
                        }

                    },
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
                    },
                    {
                        data:"month"
                    },
                    {
                        data:"year"
                    },
                    {
                        orderable:false,
                        data: null, render: function (data, type, full, meta) {

                        return '<a onclick="editExport('+meta.row+')" title="Узгартириш" class="btn btn-sm btn-primary pull-right edit"> <span class="">Ўзгартириш</span></a>';
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
