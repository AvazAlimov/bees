@extends('layouts.app-admin')
@section('styles')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('nav')
    <nav class="navbar navbar-default" id="navigation">
        <ul class="nav navbar-nav" style="display:block; width: 100%">
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Asosiy sozlamalar </a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section1')"><i class="fa fa-users"></i>
                            Viloyatlar</a>
                    </li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section2')"><i class="fa fa-users"></i>
                            Rahbarlar</a>
                    </li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section3')"><i class="fa fa-money"></i>
                            Shaharlar</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Turlar</a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section4')"><i class="fa fa-building"></i>
                            Faoliyatlar</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section5')"><i class="fa fa-building"></i>
                            Asalari Zotlari</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section6')"><i class="fa fa-building"></i>
                            Jihoz Turlari</a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Заказы</a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section7')"><i class="fa fa-building"></i>
                            Заказы</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section8')"><i class="fa fa-building"></i>
                            Принятые заказы</a></li>
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section9')"><i class="fa fa-building"></i>
                            Непринятые заказы</a></li>
                </ul>
            </li>
            <li class="dropdown navs">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-users"></i>
                    Hisobot</a>
                <ul class="dropdown-menu">
                    <li data-toggle="tab" class="navs2"><a onclick="switchSection('section10')"><i class="fa fa-building"></i>
                            Hisobot</a></li>

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
                                            <td>
                                                <form action="{{ route('region.delete', $region->id) }}" method="get"
                                                      onclick="return confirm('Хотите удалить')">
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
                                                    <form action="{{ route('city.delete', $city->id) }}"
                                                          onclick="return confirm('Хотите удалить')" method="get">
                                                        <button type="submit" class="btn btn-danger pull-right">Удалить
                                                        </button>
                                                    </form>
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
                        <h2>Запросы </h2>
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
                <div id="section10" class="section">
                    <div class="page-header">
                        <h2>Hisobotlar</h2>
                    </div>
                   <div class="row">
                       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                           <tr>
                               <th>Name</th>
                               <th>Position</th>
                               <th>Office</th>
                               <th>Age</th>
                               <th>Start date</th>
                               <th>Salary</th>
                           </tr>
                           </thead>
                           <tfoot>
                           <tr>
                               <th>Name</th>
                               <th>Position</th>
                               <th>Office</th>
                               <th>Age</th>
                               <th>Start date</th>
                               <th>Salary</th>
                           </tr>
                           </tfoot>
                           <tbody>
                           <tr>
                               <td>Tiger Nixon</td>
                               <td>System Architect</td>
                               <td>Edinburgh</td>
                               <td>61</td>
                               <td>2011/04/25</td>
                               <td>$320,800</td>
                           </tr>
                           <tr>
                               <td>Garrett Winters</td>
                               <td>Accountant</td>
                               <td>Tokyo</td>
                               <td>63</td>
                               <td>2011/07/25</td>
                               <td>$170,750</td>
                           </tr>
                           <tr>
                               <td>Ashton Cox</td>
                               <td>Junior Technical Author</td>
                               <td>San Francisco</td>
                               <td>66</td>
                               <td>2009/01/12</td>
                               <td>$86,000</td>
                           </tr>
                           <tr>
                               <td>Cedric Kelly</td>
                               <td>Senior Javascript Developer</td>
                               <td>Edinburgh</td>
                               <td>22</td>
                               <td>2012/03/29</td>
                               <td>$433,060</td>
                           </tr>
                           <tr>
                               <td>Airi Satou</td>
                               <td>Accountant</td>
                               <td>Tokyo</td>
                               <td>33</td>
                               <td>2008/11/28</td>
                               <td>$162,700</td>
                           </tr>
                           <tr>
                               <td>Brielle Williamson</td>
                               <td>Integration Specialist</td>
                               <td>New York</td>
                               <td>61</td>
                               <td>2012/12/02</td>
                               <td>$372,000</td>
                           </tr>
                           <tr>
                               <td>Herrod Chandler</td>
                               <td>Sales Assistant</td>
                               <td>San Francisco</td>
                               <td>59</td>
                               <td>2012/08/06</td>
                               <td>$137,500</td>
                           </tr>
                           <tr>
                               <td>Rhona Davidson</td>
                               <td>Integration Specialist</td>
                               <td>Tokyo</td>
                               <td>55</td>
                               <td>2010/10/14</td>
                               <td>$327,900</td>
                           </tr>
                           <tr>
                               <td>Colleen Hurst</td>
                               <td>Javascript Developer</td>
                               <td>San Francisco</td>
                               <td>39</td>
                               <td>2009/09/15</td>
                               <td>$205,500</td>
                           </tr>
                           <tr>
                               <td>Sonya Frost</td>
                               <td>Software Engineer</td>
                               <td>Edinburgh</td>
                               <td>23</td>
                               <td>2008/12/13</td>
                               <td>$103,600</td>
                           </tr>
                           <tr>
                               <td>Jena Gaines</td>
                               <td>Office Manager</td>
                               <td>London</td>
                               <td>30</td>
                               <td>2008/12/19</td>
                               <td>$90,560</td>
                           </tr>
                           <tr>
                               <td>Quinn Flynn</td>
                               <td>Support Lead</td>
                               <td>Edinburgh</td>
                               <td>22</td>
                               <td>2013/03/03</td>
                               <td>$342,000</td>
                           </tr>
                           <tr>
                               <td>Charde Marshall</td>
                               <td>Regional Director</td>
                               <td>San Francisco</td>
                               <td>36</td>
                               <td>2008/10/16</td>
                               <td>$470,600</td>
                           </tr>
                           <tr>
                               <td>Haley Kennedy</td>
                               <td>Senior Marketing Designer</td>
                               <td>London</td>
                               <td>43</td>
                               <td>2012/12/18</td>
                               <td>$313,500</td>
                           </tr>
                           <tr>
                               <td>Tatyana Fitzpatrick</td>
                               <td>Regional Director</td>
                               <td>London</td>
                               <td>19</td>
                               <td>2010/03/17</td>
                               <td>$385,750</td>
                           </tr>
                           <tr>
                               <td>Michael Silva</td>
                               <td>Marketing Designer</td>
                               <td>London</td>
                               <td>66</td>
                               <td>2012/11/27</td>
                               <td>$198,500</td>
                           </tr>
                           <tr>
                               <td>Paul Byrd</td>
                               <td>Chief Financial Officer (CFO)</td>
                               <td>New York</td>
                               <td>64</td>
                               <td>2010/06/09</td>
                               <td>$725,000</td>
                           </tr>
                           <tr>
                               <td>Gloria Little</td>
                               <td>Systems Administrator</td>
                               <td>New York</td>
                               <td>59</td>
                               <td>2009/04/10</td>
                               <td>$237,500</td>
                           </tr>
                           <tr>
                               <td>Bradley Greer</td>
                               <td>Software Engineer</td>
                               <td>London</td>
                               <td>41</td>
                               <td>2012/10/13</td>
                               <td>$132,000</td>
                           </tr>
                           <tr>
                               <td>Dai Rios</td>
                               <td>Personnel Lead</td>
                               <td>Edinburgh</td>
                               <td>35</td>
                               <td>2012/09/26</td>
                               <td>$217,500</td>
                           </tr>
                           <tr>
                               <td>Jenette Caldwell</td>
                               <td>Development Lead</td>
                               <td>New York</td>
                               <td>30</td>
                               <td>2011/09/03</td>
                               <td>$345,000</td>
                           </tr>
                           <tr>
                               <td>Yuri Berry</td>
                               <td>Chief Marketing Officer (CMO)</td>
                               <td>New York</td>
                               <td>40</td>
                               <td>2009/06/25</td>
                               <td>$675,000</td>
                           </tr>
                           <tr>
                               <td>Caesar Vance</td>
                               <td>Pre-Sales Support</td>
                               <td>New York</td>
                               <td>21</td>
                               <td>2011/12/12</td>
                               <td>$106,450</td>
                           </tr>
                           <tr>
                               <td>Doris Wilder</td>
                               <td>Sales Assistant</td>
                               <td>Sidney</td>
                               <td>23</td>
                               <td>2010/09/20</td>
                               <td>$85,600</td>
                           </tr>
                           <tr>
                               <td>Angelica Ramos</td>
                               <td>Chief Executive Officer (CEO)</td>
                               <td>London</td>
                               <td>47</td>
                               <td>2009/10/09</td>
                               <td>$1,200,000</td>
                           </tr>
                           <tr>
                               <td>Gavin Joyce</td>
                               <td>Developer</td>
                               <td>Edinburgh</td>
                               <td>42</td>
                               <td>2010/12/22</td>
                               <td>$92,575</td>
                           </tr>
                           <tr>
                               <td>Jennifer Chang</td>
                               <td>Regional Director</td>
                               <td>Singapore</td>
                               <td>28</td>
                               <td>2010/11/14</td>
                               <td>$357,650</td>
                           </tr>
                           <tr>
                               <td>Brenden Wagner</td>
                               <td>Software Engineer</td>
                               <td>San Francisco</td>
                               <td>28</td>
                               <td>2011/06/07</td>
                               <td>$206,850</td>
                           </tr>
                           <tr>
                               <td>Fiona Green</td>
                               <td>Chief Operating Officer (COO)</td>
                               <td>San Francisco</td>
                               <td>48</td>
                               <td>2010/03/11</td>
                               <td>$850,000</td>
                           </tr>
                           <tr>
                               <td>Shou Itou</td>
                               <td>Regional Marketing</td>
                               <td>Tokyo</td>
                               <td>20</td>
                               <td>2011/08/14</td>
                               <td>$163,000</td>
                           </tr>
                           <tr>
                               <td>Michelle House</td>
                               <td>Integration Specialist</td>
                               <td>Sidney</td>
                               <td>37</td>
                               <td>2011/06/02</td>
                               <td>$95,400</td>
                           </tr>
                           <tr>
                               <td>Suki Burks</td>
                               <td>Developer</td>
                               <td>London</td>
                               <td>53</td>
                               <td>2009/10/22</td>
                               <td>$114,500</td>
                           </tr>
                           <tr>
                               <td>Prescott Bartlett</td>
                               <td>Technical Author</td>
                               <td>London</td>
                               <td>27</td>
                               <td>2011/05/07</td>
                               <td>$145,000</td>
                           </tr>
                           <tr>
                               <td>Gavin Cortez</td>
                               <td>Team Leader</td>
                               <td>San Francisco</td>
                               <td>22</td>
                               <td>2008/10/26</td>
                               <td>$235,500</td>
                           </tr>
                           <tr>
                               <td>Martena Mccray</td>
                               <td>Post-Sales support</td>
                               <td>Edinburgh</td>
                               <td>46</td>
                               <td>2011/03/09</td>
                               <td>$324,050</td>
                           </tr>
                           <tr>
                               <td>Unity Butler</td>
                               <td>Marketing Designer</td>
                               <td>San Francisco</td>
                               <td>47</td>
                               <td>2009/12/09</td>
                               <td>$85,675</td>
                           </tr>
                           <tr>
                               <td>Howard Hatfield</td>
                               <td>Office Manager</td>
                               <td>San Francisco</td>
                               <td>51</td>
                               <td>2008/12/16</td>
                               <td>$164,500</td>
                           </tr>
                           <tr>
                               <td>Hope Fuentes</td>
                               <td>Secretary</td>
                               <td>San Francisco</td>
                               <td>41</td>
                               <td>2010/02/12</td>
                               <td>$109,850</td>
                           </tr>
                           <tr>
                               <td>Vivian Harrell</td>
                               <td>Financial Controller</td>
                               <td>San Francisco</td>
                               <td>62</td>
                               <td>2009/02/14</td>
                               <td>$452,500</td>
                           </tr>
                           <tr>
                               <td>Timothy Mooney</td>
                               <td>Office Manager</td>
                               <td>London</td>
                               <td>37</td>
                               <td>2008/12/11</td>
                               <td>$136,200</td>
                           </tr>
                           <tr>
                               <td>Jackson Bradshaw</td>
                               <td>Director</td>
                               <td>New York</td>
                               <td>65</td>
                               <td>2008/09/26</td>
                               <td>$645,750</td>
                           </tr>
                           <tr>
                               <td>Olivia Liang</td>
                               <td>Support Engineer</td>
                               <td>Singapore</td>
                               <td>64</td>
                               <td>2011/02/03</td>
                               <td>$234,500</td>
                           </tr>
                           <tr>
                               <td>Bruno Nash</td>
                               <td>Software Engineer</td>
                               <td>London</td>
                               <td>38</td>
                               <td>2011/05/03</td>
                               <td>$163,500</td>
                           </tr>
                           <tr>
                               <td>Sakura Yamamoto</td>
                               <td>Support Engineer</td>
                               <td>Tokyo</td>
                               <td>37</td>
                               <td>2009/08/19</td>
                               <td>$139,575</td>
                           </tr>
                           <tr>
                               <td>Thor Walton</td>
                               <td>Developer</td>
                               <td>New York</td>
                               <td>61</td>
                               <td>2013/08/11</td>
                               <td>$98,540</td>
                           </tr>
                           <tr>
                               <td>Finn Camacho</td>
                               <td>Support Engineer</td>
                               <td>San Francisco</td>
                               <td>47</td>
                               <td>2009/07/07</td>
                               <td>$87,500</td>
                           </tr>
                           <tr>
                               <td>Serge Baldwin</td>
                               <td>Data Coordinator</td>
                               <td>Singapore</td>
                               <td>64</td>
                               <td>2012/04/09</td>
                               <td>$138,575</td>
                           </tr>
                           <tr>
                               <td>Zenaida Frank</td>
                               <td>Software Engineer</td>
                               <td>New York</td>
                               <td>63</td>
                               <td>2010/01/04</td>
                               <td>$125,250</td>
                           </tr>
                           <tr>
                               <td>Zorita Serrano</td>
                               <td>Software Engineer</td>
                               <td>San Francisco</td>
                               <td>56</td>
                               <td>2012/06/01</td>
                               <td>$115,000</td>
                           </tr>
                           <tr>
                               <td>Jennifer Acosta</td>
                               <td>Junior Javascript Developer</td>
                               <td>Edinburgh</td>
                               <td>43</td>
                               <td>2013/02/01</td>
                               <td>$75,650</td>
                           </tr>
                           <tr>
                               <td>Cara Stevens</td>
                               <td>Sales Assistant</td>
                               <td>New York</td>
                               <td>46</td>
                               <td>2011/12/06</td>
                               <td>$145,600</td>
                           </tr>
                           <tr>
                               <td>Hermione Butler</td>
                               <td>Regional Director</td>
                               <td>London</td>
                               <td>47</td>
                               <td>2011/03/21</td>
                               <td>$356,250</td>
                           </tr>
                           <tr>
                               <td>Lael Greer</td>
                               <td>Systems Administrator</td>
                               <td>London</td>
                               <td>21</td>
                               <td>2009/02/27</td>
                               <td>$103,500</td>
                           </tr>
                           <tr>
                               <td>Jonas Alexander</td>
                               <td>Developer</td>
                               <td>San Francisco</td>
                               <td>30</td>
                               <td>2010/07/14</td>
                               <td>$86,500</td>
                           </tr>
                           <tr>
                               <td>Shad Decker</td>
                               <td>Regional Director</td>
                               <td>Edinburgh</td>
                               <td>51</td>
                               <td>2008/11/13</td>
                               <td>$183,000</td>
                           </tr>
                           <tr>
                               <td>Michael Bruce</td>
                               <td>Javascript Developer</td>
                               <td>Singapore</td>
                               <td>29</td>
                               <td>2011/06/27</td>
                               <td>$183,000</td>
                           </tr>
                           <tr>
                               <td>Donna Snider</td>
                               <td>Customer Support</td>
                               <td>New York</td>
                               <td>27</td>
                               <td>2011/01/25</td>
                               <td>$112,000</td>
                           </tr>
                           </tbody>
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
    <script>
        function switchSection(id) {
            document.cookie = "admin=" + id + ";";
            var section = document.getElementsByClassName('section');
            for (var i = 0; i < section.length; i++)
                section[i].style.display = "none";
            document.getElementById(id).style.display = "block";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "section1";
        }

        window.onload = function () {
            switchSection(getCookie("admin"));
            var navs = document.getElementsByClassName("navs2");
            navs[getCookie("admin").replace("section", "") - 1].className = "navs2 active";
            $(navs[getCookie("admin").replace("section", "") - 1]).filter(function(){
                return $(this).parent().parent().is('li')
            }).parent().parent().addClass('active');
            $('#example').DataTable();
        }
    </script>
@endsection