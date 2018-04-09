@extends('layouts.app-admin')
@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        table.dataTable tr.group td {
            font-weight: bold;
            background-color: #e0e0e0
        }

        td.details-control {
            background: url('http://icons.iconarchive.com/icons/custom-icon-design/flatastic-1/512/add-1-icon.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('https://cdn3.iconfinder.com/data/icons/softwaredemo/PNG/256x256/Minus_Circle_Green.png') no-repeat center center;
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
            <li class="dropdown navs active">
                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i>
                    Hisobot</a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('swot')}}"><i class="fa fa-building"></i>
                            Свод</a></li>
                    <li class="navs2 active"><a><i class="fa fa-building"></i>
                            Номма-ном</a></li>
                    <li class="navs2"><a href="{{route('ishlabchiqarish')}}"><i class="fa fa-building"></i>
                            Ишлаб чиқариш</a></li>

                </ul>
            </li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @for($i=1; $i<10; $i++)
                    <div id="section{{$i}}" class="section"></div>
                @endfor
                <div id="section10" class="section">
                    <div class="page-header">
                        <div>
                            <h2 class="text-center">Ўзбекситон асаларичилари уюшмасига азо субьектлар тўғрисида
                                номма-ном МАЪЛУМОТ </h2>
                                                  </div>
                    </div>
                    <div class="row">
                        <div class="page-header clearfix">

                            <div>
                                <a id="swot-export" href="{{route('export.nomma')}}" class="btn btn-success pull-left" tabindex="0"
                                   aria-controls="example">Excel
                                </a>
                                <a  onclick="showModal()" class="btn btn-primary pull-right"
                                   tabindex="0"
                                   aria-controls="example">Қўшиш
                                </a>
                            </div>
                        </div>

                        <table id="example1" class="table table-bordered realization-theader" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Асаларичилик субъекти номи</th>
                                <th>Ташкилий ҳуқуқий шакли</th>
                                <th>ҳудуд номи</th>
                                <th>туман номи</th>
                                <th>Фаолият тури</th>
                                <th>Боқилаётган асалари оилалари сони</th>
                                <th>ИНН</th>
                                <th>Корхона директори
                                    Исм-Шарифи
                                </th>
                                <th>Тел рақами</th>
                                <th>Ишчилар сони</th>
                                <td>Созлаш</td>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td></td>
                                <th>Жами</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>{{$sums->sum_bees_count}}</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>{{$sums->sum_labors}}</th>
                                <th></th>
                            </tr>

                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Номма-ном маьлумот қўшиш</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('submit.nomma')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="subject" class="col-md-2 col-form-label">Субъект номи</label>
                            <div class="col-md-8">
                                <input class="form-control subject" type="text" name="subject" value="" id="subject" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label">Ташкилий ҳуқуқий шакли</label>
                            <div class="col-md-8">
                                <input class="form-control type" type="text" name="type" value="" id="type" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="region" class="col-md-2 col-form-label">Вилоят номи</label>
                            <div class="col-md-8">
                                <select class="form-control" id="region" name="region"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-2 col-form-label">Туман/шаҳар номи</label>
                            <div class="col-md-8">
                                <select class="form-control city" id="city" name="city" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="activity" class="col-md-2 col-form-label">Фаолият тури</label>
                            <div class="col-md-8">
                                <input class="form-control activity" type="text" value="" name="activity" id="activity" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="family_count" class="col-md-2 col-form-label">Aсалари оилалари сони</label>
                            <div class="col-md-8">
                                <input class="form-control family_count" type="number" value="" name="family_count" id="family_count" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inn" class="col-md-2 col-form-label">ИНН</label>
                            <div class="col-md-8">
                                <input class="form-control inn" type="number" value="" name="inn" id="inn" minlength="9" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Корхона директори
                                Исм-Шарифи</label>
                            <div class="col-md-8">
                                <input class="form-control name" type="text" value="" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-2 col-form-label">Телефон рақами</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control phone" id="phone" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="labors" class="col-md-2 col-form-label">Ишчилар сони</label>
                            <div class="col-md-8">
                                <input class="form-control labors" type="number" value="" name="labors" id="labors" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" id="btn_edit">Қўшиш</button>
                            </div>
                        </div>
                    </form>
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
    <script src="{{ asset('dist/js/jquery.mask.min.js') }}"></script>
    <script>
        var arrays = [{!! $regions !!}];
        arrays.push({!! $cities !!});
        var table1;
        function regionChanged(id) {
            var selected = document.getElementById(id).value;
            var select = "city";
            document.getElementById(select).innerHTML = "";

            for (var i = 0; i < arrays[1].length; i++) {
                if (selected == arrays[1][i]["region_id"]) {
                    var opt = document.createElement('option');
                    opt.value = arrays[1][i]['id'];
                    opt.innerHTML = arrays[1][i]['name'];
                    document.getElementById(select).appendChild(opt);
                }
            }
        }
        function showModal() {
            var myModal = "#myModal";
            var href='{{route('submit.nomma')}}';
            $(myModal).modal();
            $(myModal).attr('href',href);
            $(myModal).find('.subject').val("");
            $(myModal).find('.type').val("");
            $(myModal).find('#region').val("");
            $(myModal).find('#region').change();
            $(myModal).find('#city').val("");
            $(myModal).find('#city').change();

//            $(myModal).find('.city').val(data.city_id).change();
            $(myModal).find('.activity').val("");
            $(myModal).find('.family_count').val("");
            $(myModal).find('.inn').val("");
            $(myModal).find('.name').val("");
            $(myModal).find('.phone').val("");
            $(myModal).find('.labors').val("");
            $("#btn_edit").html('Қўшиш');
        }
        function editNomma(id) {
            var data = table1.rows().data()[id];
            var href='{{route('update.nomma', null)}}';
            var myModal = "#myModal";
            $(myModal).modal();
            $(myModal).attr('href',href+'/'+data.id);
            $(myModal).find('.subject').val(data.subject);
            $(myModal).find('.type').val(data.type);
            $(myModal).find('#region').val(data.region_id);
            $(myModal).find('#region').change();
            $(myModal).find('#city').val(data.city_id);
            $(myModal).find('#city').change();

//            $(myModal).find('.city').val(data.city_id).change();
            $(myModal).find('.activity').val(data.activity);
            $(myModal).find('.family_count').val(data.family_count);
            $(myModal).find('.inn').val(data.inn);
            $(myModal).find('.name').val(data.name);
            $(myModal).find('.phone').val(data.phone);
            $(myModal).find('.labors').val(data.labors);
            $("#btn_edit").html('Ўзгартириш');
        }
        $(document).ready(function () {
            regionChanged('region');
            $('.phone').mask('+AAB (00) 000-00-00', {
                'translation': {
                    A: {pattern: /[9]/},
                    B: {pattern: /[8]/}
                }
            });
            $('.inn').mask('000000000', {
                'translation': {
                    0: {pattern: /[0-9*]/}
                }
            });
             table1 = $('#example1').DataTable({
                rowGroup: {
                    dataSrc: 'region'
                },
                processing: true,
                serverSide: true,
                ajax: '{!! route('getNomma') !!}',
                columns: [
                    {data: 'id'},
                    {data: 'subject'},
                    {data: 'type'},
                    {data: 'region'},
                    {data: 'city'},
                    {data: 'activity'},
                    {data: 'family_count'},
                    {data: 'inn'},
                    {data: 'name'},
                    {data: 'phone'},
                    {data: 'labors'},
                    {
                        data: null, render: function (data, type, full, meta) {
                            var href='{{route('delete.nomma', null)}}';
                            return '<a href="'+href+'/'+data.id+'" onclick="return confirm(\'Ростанхам ўчиришни истайсизми\')" title="Удалить" class="btn btn-sm btn-danger pull-right delete"> <span class="">Ўчириш</span> </a>' +
                                '<a onclick="editNomma('+meta.row+')" title="Редактирование" class="btn btn-sm btn-primary pull-right edit"> <span class="">Ўзгартириш</span></a>';
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
    {{-- <script>
         function fetch_data(params) {
             var table2 = $('#example2').DataTable({
                 rowGroup: {
                     dataSrc: 'region_name'
                 },
                 processing: true,
                 serverSide: true,
                 ajax: '{!! route('getSwot') !!}'+'/'+params,
                 columns: [
                     {data: 'region_name'},
                     {data: 'city_name'},
                     {data: 'total'},
                     {data: 'yuridik'},
                     {data: 'yakka'},
                     {data: 'jismoniy'},
                     {
                         data: null,
                         orderable: false,
                         defaultContent: ''
                     },
                     {
                         data: null,
                         orderable: false,
                         defaultContent: ''
                     },
                     {
                         data: null,
                         orderable: false,
                         defaultContent: ''
                     },
                     {
                         data: 'bees_count',
                         defaultContent: 0
                     },
                     {data: 'labors'}
                     /* {
                      data: null, render: function (data, type, full, meta) {
                      return '<a href="' + data.id + '">Here</a>';
                      }
                      }*/
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
                 ajax: '{!! route('getRegion') !!}',
                 columns: [
                     {
                         data: 'region',
                         className: 'details-control'
                     },
                     {data: 'total'},
                     {data: 'type4_count'},
                     {data: 'type2_count'},
                     {data: 'type1_count'},
                     {data: 'type3_count'},
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
                     /* {
                      data: null, render: function (data, type, full, meta) {
                      return '<a href="' + data.id + '">Here</a>';
                      }
                      }*/
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
             fetch_data(params);
             $('#example1 tbody').on('click', 'td.details-control', function () {
                 var tr = $(this).closest('tr');
                 var row = table1.row( tr );
                 var id =row.data().id;

                 $('#example2').DataTable().destroy();

                 fetch_data(id);
                 $("#swot-export").attr("href",  '{!! route('swot.export') !!}'+'/'+id);
                 $('html,body').animate({
                         scrollTop: $("#example2").offset().top-200},
                     'slow');
             });
         });

     </script>--}}
@endsection