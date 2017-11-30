@extends('layouts.app-admin')
@section('nav')
    <nav class="navbar navbar-default" id="navigation">
        <ul class="nav navbar-nav" style="display:block; width: 100%">
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section1')"><i class="fa fa-car"></i>
                    Viloyatlar</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section2')"><i class="fa fa-users"></i>
                    Rahbarlar</a>
            </li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section3')"><i class="fa fa-money"></i>
                    Shaharlar</a>
            </li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section4')"><i class="fa fa-building"></i>
                    Faoliyatlar</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section5')"><i class="fa fa-building"></i>
                    Asalari Zotlari</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section6')"><i class="fa fa-building"></i>
                    Заказы</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section7')"><i class="fa fa-building"></i>
                    Принятые заказы</a></li>
            <li data-toggle="tab" class="navs"><a onclick="switchSection('section8')"><i class="fa fa-building"></i>
                    Непринятые заказы</a></li>
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
                <div id="section7" class="section">
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
                <div id="section8" class="section">
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
            var navs = document.getElementsByClassName("navs");
            navs[getCookie("admin").replace("section", "") - 1].className = "navs active";
        }
    </script>
@endsection