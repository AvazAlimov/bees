@extends('layouts.app-user')

@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
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
    <!-- Styles -->
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
                                <li class="list-active">
                                    <p> Асал етиштириш ва реализиция</p>
                                </li>
                                <li>
                                    <a href="{{route('user.exports')}}"> Асални қадоқлаш ва реализация</a>
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
                <h5>Асал етиштириш ва реализиция</h5>
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
                        <form method="post" id="form" action="{{route('user.store.realization')}}">
                            {{csrf_field()}}
                            <label for="realized_quantity" class="col-md-12">Ойма ой киритиладиган сана</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Йил</span>
                                        <select class="form-control" id="year" name="year">
                                            @for($i = date('Y'); $i>1999; $i--)
                                                <option>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Ой</span>
                                        <select class="form-control" id="month" name="month">
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
                                <div class="form-group col-md-12">
                                    <label for="honey_type">Асал тури</label>
                                    <select class="honey_type" name="honey_types[]" multiple="multiple" style="width: 100%">
                                        @foreach($families as $family)
                                            <option value="{{$family->id}}">{{$family->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</label>
                                    <input type="number" name="annual_prog" class="form-control" id="annual_prog"
                                           min="0" value="{{old('annual_prog')}}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="produced_honey">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</label>
                                    <input type="number" name="produced_honey" value="{{old('produced_honey')}}" class="form-control" id="produced_honey" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="reserve">Ҳисобот даври бошига асал заҳираси кг</label>
                                    <input type="number" name="reserve" value="{{old('reserve')}}" class="form-control" id="reserve" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="family_count">Боқилаётган асалари оиласи</label>
                                    <input type="number" class="form-control" id="family_count"
                                           name="family_count" value="{{old('family_count')}}" min="0" required>
                                </div>
                            </div>

                            <label for="realized_quantity" class="col-md-12">Реализация қилган асал миқдори</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="realized_quantity" value="{{old('realized_quantity')}}" class="form-control"
                                               id="realized_quantity" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="realized_price" value="{{old('realized_price')}}" class="form-control"
                                               id="realized_price" required>
                                    </div>
                                </div>
                            </div>
                            <label for="realized_quantity" class="col-md-12">Асал захираси </label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="stock_quantity" value="{{old('stock_quantity')}}" class="form-control"
                                               id="stock_quantity" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="stock_price" value="{{old('stock_price')}}" class="form-control" id="stock_price" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Қўшиш</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="services-list">

                        <div class="page-header clearfix ">
                            <h2 class="pull-left">O'zbekiston asalarichilari uyushmasiga a'zo subyektlar to'g'risida
                                ma'lumot</h2>

                        </div>
                        <table id="example2" class="table table-bordered realization-theader " cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Т/Р</th>
                                <th rowspan="2">Статус</th>
                                <th rowspan="2">Боқилаётган асалари оиласи</th>
                                <th rowspan="2">Асал тури</th>
                                <th rowspan="2">Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</th>
                                <th rowspan="2">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</th>
                                <th rowspan="2">Ҳисобот даври бошига асал заҳираси кг</th>
                                <th colspan="2">Реализация қилган асал миқдори</th>
                                <th colspan="2">Асал захираси</th>
                                <th rowspan="2">Созлаш</th>
                                <th rowspan="2">Йил</th>
                                <th rowspan="2">Созлаш</th>
                            </tr>
                            <tr>
                                <th>кг</th>
                                <th>сўм</th>
                                <th>кг</th>
                                <th>сўм</th>
                            </tr>
                        </table>

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
                        <form method="POST" id="form_2">
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
                                <div class="form-group col-md-12">
                                    <label for="honey_type">Асал тури</label>
                                    <select class="honey_type" name="honey_types[]" multiple="multiple" style="width: 100%" id="honey_type_2">
                                        @foreach($families as $family)
                                            <option value="{{$family->id}}">{{$family->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="annual_prog_2">Йиллик ишлаб чмқариш ҳажми (ПРОГНОЗ) кг</label>
                                    <input type="number" name="annual_prog" class="form-control" id="annual_prog_2"
                                           min="0" value="{{old('annual_prog')}}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="produced_honey_2">Ишлаб чиқарилган асал миқдори (ФАКТ) кг</label>
                                    <input type="number" name="produced_honey" value="{{old('produced_honey')}}" class="form-control" id="produced_honey_2" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="reserve_2">Ҳисобот даври бошига асал заҳираси кг</label>
                                    <input type="number" name="reserve" value="{{old('reserve')}}" class="form-control" id="reserve_2" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="family_count_2">Боқилаётган асалари оиласи</label>
                                    <input type="number" class="form-control" id="family_count_2"
                                           name="family_count" value="{{old('family_count')}}" min="0" required>
                                </div>
                            </div>

                            <label for="realized_quantity_2" class="col-md-12">Реализация қилган асал миқдори</label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="realized_quantity" value="{{old('realized_quantity')}}" class="form-control"
                                               id="realized_quantity_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="realized_price" value="{{old('realized_price')}}" class="form-control"
                                               id="realized_price_2" required>
                                    </div>
                                </div>
                            </div>
                            <label for="realized_quantity" class="col-md-12">Асал захираси </label>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">кг</span>
                                        <input type="number" name="stock_quantity" value="{{old('stock_quantity')}}" class="form-control"
                                               id="stock_quantity_2" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">сўм</span>
                                        <input type="number" name="stock_price" value="{{old('stock_price')}}" class="form-control" id="stock_price_2" required>
                                    </div>
                                </div>
                            </div>

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
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script>
        var table;
        function editRealization(id) {
            var edit = "#edit";
            $('.edit-nav').removeClass('hide');
            $('.nav-tabs a:last').tab('show');
            var data = table.rows().data()[id];
            var href='{{route('user.update.realization', null)}}';
            $(edit).find('#form_2').attr('action',href+'/'+data.id);
            $(edit).find('#year_2').val(data.year);
            $(edit).find('#year_2').change();
            $(edit).find('#month_2').val(data.month);
            $(edit).find('#month_2').change();
            var array_ids=[];
            for(var i = 0; i<data.families.length; i++) {
                array_ids.push(data.families[i].id);
            }
            $(edit).find('#honey_type_2').val(array_ids);
            $(edit).find('#honey_type_2').trigger('change');
            $(edit).find('#annual_prog_2').val(data.annual_prog);
            $(edit).find('#produced_honey_2').val(data.produced_honey);
            $(edit).find('#reserve_2').val(data.reserve);
            $(edit).find('#family_count_2').val(data.family_count);
            $(edit).find('#realized_quantity_2').val(data.realized_quantity);
            $(edit).find('#realized_price_2').val(data.realized_price);
            $(edit).find('#stock_quantity_2').val(data.stock_quantity);
            $(edit).find('#stock_price_2').val(data.stock_price);
        }
        $(document).ready(function () {
            @if ($errors->edit->any())
                $('.edit-nav').removeClass('hide');
                $('.nav-tabs a:last').tab('show');
                var href='{{route('user.update.realization', Session::get('id'))}}';
                $('#edit').find('#form_2').attr('action',href);
            @endif
            $('.honey_type').select2();
            table = $('#example2').DataTable({
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('user.get.realization')}}',
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
                        return '<a onclick="editRealization('+meta.row+')" title="Узгартириш" class="btn btn-sm btn-primary pull-right edit"> <span class="">Ўзгартириш</span></a>';
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
