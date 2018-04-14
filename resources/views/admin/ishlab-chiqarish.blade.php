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
            <li class="dropdown navs active">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Hisobot</a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('swot')}}"><i class="fa fa-building"></i>
                            Свод</a></li>
                    <li class="navs2"><a href="{{route('nomma')}}"><i class="fa fa-building"></i>
                            Номма-ном</a></li>
                    <li class="navs2 active"><a><i class="fa fa-building"></i>
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
                <div id="section10" class="section">
                    <div class="page-header clearfix">
                        <div class="col-md-4">
                            <h2 class="pull-left">Ишлаб чиқариш </h2>
                            <div>
                                <a href="{{route('ishlabchiqarish.export')}}" class="btn btn-success" tabindex="0"
                                   aria-controls="example"
                                   style="margin-top: 20px; margin-left: 20px;">Excel
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
                                <th>#</th>
                                <th>Ишлаб чиқарувчи номи</th>
                                <th>Ҳудуд номи</th>
                                <th>Вилоят номи</th>
                                @foreach($equipments as $equipment)
                                    <th>{{$equipment->name }} ({{$equipment->volume_name}})</th>
                                @endforeach
                                <th>Созлаш</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Жами</th>
                                @foreach($equipments as $equipment)
                                    <th></th>
                                @endforeach
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
                    <form action="{{route('update.ishlabchiqarish', null)}}" id="form" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="subject" class="col-md-2 col-form-label">Субъект номи</label>
                            <div class="col-md-8">
                                <input class="form-control subject" type="text" value="" id="subject" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="region" class="col-md-2 col-form-label">Ҳудуд номи</label>
                            <div class="col-md-8">
                                <input class="form-control region" type="text" value="" id="region" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-2 col-form-label">Вилоят номи</label>
                            <div class="col-md-8">
                                <input class="form-control city" type="text" value="" id="city" readonly>
                            </div>
                        </div>
                        @foreach($equipments as $equipment)
                            <div class="form-group row">
                                <label for="equipments_{{$equipment->id}}"
                                       class="col-md-2 col-form-label">{{$equipment->name}} ({{$equipment->volume_name}})</label>
                                <div class="col-md-8">
                                    <input class="form-control equipments1_{{$equipment->id}}" type="number" value="" step="any"
                                           name="equipments[{{$equipment->id}}][volume]" id="equipments1_{{$equipment->id}}">
                                    <input class="form-control equipments2_{{$equipment->id}}" type="hidden" value="" step="any"
                                           name="equipments[{{$equipment->id}}][id]" id="equipments2_{{$equipment->id}}">
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" id="btn_edit">Ўзгартириш</button>
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

    <script>
        var table1 ;
        function editNomma(id) {
            var data = table1.rows().data()[id];
            var href='{{route('update.ishlabchiqarish', null)}}';
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
                rowGroup: {
                    dataSrc: 'user.region.name'
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('ishlabchiqarish.data') !!}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'user.subject'},
                    {data: 'user.region.name'},
                    {data: 'user.city.name'},
                        @foreach($equipments as $i=> $equipment)
                    {
                        data: 'equipments.{{$equipment->id}}.volume'
                    },
                        @endforeach
                    {
                        data: null,
                        render: function (data, type, full, meta) {
                            var href = '{{route('delete.ishlabchiqarish', null)}}';
                            return '<a href="' + href + '/' + data.id + '" onclick="return confirm(\'Ростанхам ўчиришни истайсизми\')" title="Удалить" class="btn btn-sm btn-danger pull-right delete"> <span class="">Ўчириш</span> </a>' +
                                '<a onclick="editNomma(' + meta.row + ')" title="Редактирование" class="btn btn-sm btn-primary pull-right edit"> <span class="">Ўзгартириш</span></a>';
                        }
                    }
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