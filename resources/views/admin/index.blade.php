@extends('layouts.app-admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
{{--    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css" rel="stylesheet">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">--}}
@stop
@section('nav')
    <nav class="navbar navbar-default" id="navigation">
        <ul class="nav navbar-nav" style="display:block; width: 100%">
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Асосий бўлим <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section2')">
                            Раҳбарият</a>
                    </li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section1')">
                            Вилоятлар</a>
                    </li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section3')">
                            Туманлар</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-compass"></i>
                    Йўналишлар <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section4')">
                            Фаолият тури</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section5')">
                            Боқилаётган асалари турлари</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section6')">
                            Жиҳозлар</a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-id-card"></i>
                    Аъзолик <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section7')">
                            Аризалар <span class="badge badge-info">{{$waiting->total() != 0 ? $waiting->total() : ''}}</span></a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section8')">
                            Қабул қилинган <span class="badge badge-info">{{$accepted->total() != 0 ? $accepted->total() : ''}}</span> </a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section9')">
                            Қабул қилинмаган <span class="badge badge-info">{{$notAccepted->count() != 0 ? $notAccepted->count() : ''}}</span> </a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-line-chart"></i>
                    Электрон ҳисобот <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('swot')}}">
                            Ҳисобот </a></li>
                    <li class="navs2"><a href="{{route('nomma')}}">
                            Таҳлилий ҳисобот </a></li>
                    <li class="navs2"><a href="{{route('ishlabchiqarish')}}">
                            Ишлаб чиқариш қувватлари </a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-bell"></i>
                    Янги ҳисоботлар <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="navs2"><a href="{{route('requisition.production')}}">
                            Ишлаб чиқариш</a></li>
                    <li class="navs2"><a href="{{route('requisition.export')}}">
                            Қадоқлаш ва реализация </a></li>
                    <li class="navs2"><a href="{{route('requisition.realization')}}">
                            Eтиштириш ва реализиция</a></li>
                </ul>
            </li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container-fluid" id="container" style="padding: 0 20px 20px 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section1" class="section" style="display: block;">
                    <div class="page-header">
                        <h2>Viloyatlar</h2>
                    </div>
                    @foreach ($regions as $region)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $region->name }}@if($region->leader != null) :
                                        <i>{{$region->leader->firstName}} {{$region->leader->lastName}}</i> @endif
                                    </strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('region.edit', $region->id) }}" method="GET">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form method="GET" action="{{ route('region.create')}}">
                        <button type="submit" class="btn btn-primary pull-right">
                            Region Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section2" class="section">
                    <div class="page-header">
                        <h2>Rahbarlar</h2>
                    </div>
                    @foreach ($leaders as $leader)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $leader->username }}</strong>
                                </div>
                                <div class="panel-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading">
                                                Ismi: {{ $leader->firstName }} {{ $leader->lastName }}</h3>
                                            <br>
                                            <p><strong>Elektron Pochtasi:</strong> {{ $leader->email }}</p>
                                            <p><strong>Telefon raqami:</strong> {{ $leader->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('leader.edit', $leader->id) }}" method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('leader.delete', $leader->id) }}"
                                                      onclick="return confirm('Хотите удалить')" method="get">
                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        <form action="{{ route('leader.create') }}" method="GET">
                            <button type="submit" class="btn btn-primary pull-right">
                                Добавить оператор
                            </button>
                        </form>
                    </div>
                </div>
                <div id="section3" class="section">
                    <div class="page-header">
                        <h2>Shaharlar</h2>
                    </div>
                    @foreach($regions as $region)
                        <div class="col-md-6" style="padding: 20px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $region->name }}</strong>
                                </div>
                                @foreach ($region->cities as $city)
                                    <div class="panel-body">
                                        <strong>{{ $city->name }}</strong>
                                    </div>
                                    <div class="panel-footer">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <form action="{{ route('city.edit', $city->id) }}"
                                                          method="get">
                                                        <button type="submit" class="btn btn-primary pull-right">
                                                            Изменить
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    {{--<form action="{{ route('city.delete', $city->id) }}"--}}
                                                          {{--onclick="return confirm('Хотите удалить')" method="get">--}}
                                                        {{--<button type="submit" class="btn btn-danger pull-right">Удалить--}}
                                                        {{--</button>--}}
                                                    {{--</form>--}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('city.create') }}" method="GET">
                        <button type="submit" class="btn btn-primary pull-right">
                            Shaharni Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section4" class="section">
                    <div class="page-header">
                        <h2>Faoliyatlar</h2>
                    </div>
                    @foreach ($activities as $activity)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $activity->name }}</strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('activity.edit', $activity->id) }}"
                                                      method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('activity.delete', $activity->id) }}"
                                                      method="get" onclick="return confirm('Хотите удалить')">

                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('activity.create') }}" method="GET">
                        <button type="submit" class="btn btn-primary pull-right">
                            Faoliyatni Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section5" class="section">
                    <div class="page-header">
                        <h2>Asalari Zotlari</h2>
                    </div>
                    @foreach ($families as $activity)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $activity->name }}</strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('family.edit', $activity->id) }}"
                                                      method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('family.delete', $activity->id) }}"
                                                      method="get" onclick="return confirm('Хотите удалить')">

                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('family.create') }}" method="GET">
                        <button type="submit" class="btn btn-primary pull-right">
                            Asalari Zotini Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section6" class="section">
                    <div class="page-header">
                        <h2>Jihoz Turlari</h2>
                    </div>
                    @foreach ($equipments as $activity)
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>{{ $activity->name }}</strong>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form action="{{ route('equipment.edit', $activity->id) }}"
                                                      method="get">
                                                    <button type="submit" class="btn btn-primary pull-right">Изменить
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('equipment.delete', $activity->id) }}"
                                                      method="get" onclick="return confirm('Хотите удалить')">

                                                    <button type="submit" class="btn btn-danger pull-right">Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('equipment.create') }}" method="GET">
                        <button type="submit" class="btn btn-primary pull-right">
                            Jihoz Turlarini Qo'shish
                        </button>
                    </form>
                </div>
                <div id="section7" class="section">
                    <div class="page-header">
                        <h2>Аризалар </h2>
                    </div>
                    @foreach($waiting as $user)
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Идентификационный номер
                                    заказа: #{{ $user->id }}
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Foydalanuvchi turi:</strong></div>
                                        <div class="col-md-8">{{ $user->typeName() }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Viloyat:</strong></div>
                                        <div class="col-md-8">{{ $user->region->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Shaxar:</strong></div>
                                        <div class="col-md-8">{{ $user->city->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Mahalla nomi:</strong></div>
                                        <div class="col-md-8">{{ $user->neighborhood }}</div>
                                    </div>
                                    @if($user->type != 4)
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->subject }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt Ro'yhatdan O'tkazilgan Sana</strong></div>
                                            <div class="col-md-8">
                                                {{ $user->reg_date}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>INN:</strong></div>
                                            <div class="col-md-8">{{ $user->inn}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->bank_name }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank MFO:</strong></div>
                                            <div class="col-md-8">{{ $user->mfo }}</div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Telefon Raqami:</strong></div>
                                        <div class="col-md-8">{{ $user->phone }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Elektron Pochta Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->email }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Direktor FIO:</strong></div>
                                        <div class="col-md-8">{{ $user->fullName }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Ишчилар сони сони:</strong></div>
                                        <div class="col-md-8">{{ $user->labors}}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Faloliyat turlari:</strong></div>
                                        @foreach($user->activities as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Боқлаётган асалари оилалари сони:</strong></div>
                                        <div class="col-md-8">{{ $user->bees_count}}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Boqilayotgan asalari zotlari:</strong></div>
                                        @foreach($user->families as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('admin.user.accept', $user->id)}}">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-success form-group"
                                                       value="Принять">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('admin.user.refuse', $user->id)}}" onsubmit="return confirm('Хотите отказать?');">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-warning form-group"
                                                       value="Отказать">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form action="{{route('admin.user.edit', $user->id)}}" method="get">
                                                <input type="submit" class="btn btn-block btn-primary form-group"
                                                       value="Изменить">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('admin.user.delete', $user->id)}}" onsubmit="return confirm('Хотите удалить?');">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-danger" value="Удалить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        {{ $waiting->links() }}
                    </div>
                </div>
                <div id="section8" class="section">
                    <div class="page-header">
                        <h2>Принятые заказы</h2>
                    </div>
                    @foreach($accepted as $user)
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    Идентификационный номер
                                    заказа: {{ $user->id }}
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Foydalanuvchi turi:</strong></div>
                                        <div class="col-md-8">{{ $user->typeName() }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Viloyat:</strong></div>
                                        <div class="col-md-8">{{ $user->region->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Shaxar:</strong></div>
                                        <div class="col-md-8">{{ $user->city->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Mahalla nomi:</strong></div>
                                        <div class="col-md-8">{{ $user->neighborhood }}</div>
                                    </div>
                                    @if($user->type != 4)
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->subject }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt Ro'yhatdan O'tkazilgan Sana</strong></div>
                                            <div class="col-md-8">
                                                {{ $user->reg_date}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>INN:</strong></div>
                                            <div class="col-md-8">{{ $user->inn}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->bank_name }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank MFO:</strong></div>
                                            <div class="col-md-8">{{ $user->mfo }}</div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Telefon Raqami:</strong></div>
                                        <div class="col-md-8">{{ $user->phone }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Elektron Pochta Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->email }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Direktor FIO:</strong></div>
                                        <div class="col-md-8">{{ $user->fullName }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Faloliyat turlari:</strong></div>
                                        @foreach($user->activities as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Boqilayotgan asalari zotlari:</strong></div>
                                        @foreach($user->families as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Восстановить?');"
                                                      action="{{route('admin.user.retrieve',$user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-primary"
                                                           value="Восстановить">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Хотите удалить?');"
                                                      action="{{route('admin.user.delete', $user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        {{ $accepted->links() }}
                    </div>
                </div>
                <div id="section9" class="section">
                    <div class="page-header">
                        <h2>Непринятые заказы</h2>
                    </div>
                    @foreach($notAccepted as $user)
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    Идентификационный номер
                                    заказа: {{ $user->id }}
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Foydalanuvchi turi:</strong></div>
                                        <div class="col-md-8">{{ $user->typeName() }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Viloyat:</strong></div>
                                        <div class="col-md-8">{{ $user->region->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Shaxar:</strong></div>
                                        <div class="col-md-8">{{ $user->city->name }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Mahalla nomi:</strong></div>
                                        <div class="col-md-8">{{ $user->neighborhood }}</div>
                                    </div>
                                    @if($user->type != 4)
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->subject }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Subyekt Ro'yhatdan O'tkazilgan Sana</strong></div>
                                            <div class="col-md-8">
                                                {{ $user->reg_date}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>INN:</strong></div>
                                            <div class="col-md-8">{{ $user->inn}}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank nomi:</strong></div>
                                            <div class="col-md-8">{{ $user->bank_name }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-4"><strong>Bank MFO:</strong></div>
                                            <div class="col-md-8">{{ $user->mfo }}</div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Telefon Raqami:</strong></div>
                                        <div class="col-md-8">{{ $user->phone }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Elektron Pochta Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->email }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Manzil:</strong></div>
                                        <div class="col-md-8">{{ $user->address }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Direktor FIO:</strong></div>
                                        <div class="col-md-8">{{ $user->fullName }} </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Faloliyat turlari:</strong></div>
                                        @foreach($user->activities as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Boqilayotgan asalari zotlari:</strong></div>
                                        @foreach($user->families as $activity)
                                            <div class="col-md-8"><span>{{$activity->name}}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Восстановить?');"
                                                      action="{{route('admin.user.retrieve',$user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-primary"
                                                           value="Восстановить">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Хотите удалить?');"
                                                      action="{{route('admin.user.delete', $user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        {{ $notAccepted->links() }}
                    </div>
                </div>
                <div id="section10" class="section"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <script>
        function switchSection(id) {
            $.cookie("admin",id,{ expires: 7, path: '/admin' });

            var section = document.getElementsByClassName('section');
            for (var i = 0; i < section.length; i++)
                section[i].style.display = "none";
            document.getElementById(id).style.display = "block";

        }

        window.onload = function () {
            if(typeof $.cookie("admin") === "undefined"){
                $.cookie("admin","section2",{ expires: 7, path: '/admin' });
            }
            var cookie = $.cookie("admin");

            switchSection(cookie);
            var navs = document.getElementsByClassName("navs2");
            navs[cookie.replace("section", "") - 1].className = "navs2 active";
            $(navs[cookie.replace("section", "") - 1]).filter(function(){
                return $(this).parent().parent().is('li')
            }).parent().parent().addClass('active');

        }
 

    </script>
@endsection