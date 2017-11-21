@extends('layouts.app')
@section('nav')
    <nav id="navigation" class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li data-toggle="tab" class="navs">
                <a onclick="switchSection('section1')">
                    <i class="fa fa-columns icon"></i>
                    Заказы
                </a>
            </li>
            <li data-toggle="tab" class="navs">
                <a onclick="switchSection('section2')">
                    <i class="fa fa-columns icon"></i>
                    Принятые заказы
                </a>
            </li>
            <li data-toggle="tab" class="navs">
                <a onclick="switchSection('section3')">
                    <i class="fa fa-columns icon"></i>
                    Непринятые заказы
                </a>
            </li>
        </ul>
    </nav>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section1" class="section">
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
                                        <div class="col-md-4"><strong>Asalari turi:</strong></div>
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
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('leader.user.accept', $user->id)}}">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-success form-group"
                                                       value="Принять">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('leader.user.refuse', $user->id)}}" onsubmit="return confirm('Хотите отказать?');">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-warning form-group"
                                                       value="Отказать">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form action="{{route('leader.user.edit', $user->id)}}" method="get">
                                                <input type="submit" class="btn btn-block btn-primary form-group"
                                                       value="Изменить">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" action="{{route('leader.user.delete', $user->id)}}" onsubmit="return confirm('Хотите удалить?');">
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
                <div id="section2" class="section">
                    <div class="page-header">
                        <h2>Принятые заказы</h2>
                    </div>
                    <form action="{{route('leader.search')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Найти"/>
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-default">
                                <i class="fa fa-search" aria-hidden="true"></i>
                              </button>
                             </span>
                        </div>
                    </form>
                    <h4>Сортировать по:</h4>
                    <div class="col-md-12" style="padding: 10px;">
                        <form class="col-md-3" action="{{route('leader.search')}}" method="get">
                            <button type="submit" name="filter" value="id" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                Ид номеру
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search')}}" method="get">
                            <button type="submit" name="filter" value="name" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                ФИО
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search')}}" method="get">
                            <button type="submit" name="filter" value="bank_name" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                Bank nomi
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search')}}" method="get">
                            <select class="form-control input-sm" name="type" onchange="this.form.submit()">
                                <option>Asalari turi</option>
                                <option value="1" {{Request::get('type') == 1 ? "selected" : ""}}>Корхона/ЯТТ</option>
                                <option value="2" {{Request::get('type') == 2 ? "selected" : ""}}>Кўп тармоқли фермер хўжаликлари</option>
                                <option value="3" {{Request::get('type') == 3 ? "selected" : ""}}>Деҳқон (шахсий ёрдамчи) хўжаликлари</option>
                                <option value="4" {{Request::get('type') == 4 ? "selected" : ""}}>Жисмоний шахс</option>
                            </select>
                        </form>
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
                                        <div class="col-md-4"><strong>Asalari turi:</strong></div>
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

                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Восстановить?');"
                                                      action="{{route('leader.user.retrieve',$user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-primary"
                                                           value="Восстановить">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Хотите удалить?');"
                                                      action="{{route('leader.user.delete', $user->id)}}">
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
                <div id="section3" class="section">
                    <div class="page-header">
                        <h2>Непринятые заказы</h2>
                    </div>
                    <form action="{{route('leader.search.notAccepted')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Найти"/>
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-default">
                                <i class="fa fa-search" aria-hidden="true"></i>
                              </button>
                             </span>
                        </div>
                    </form>
                    <h4>Сортировать по:</h4>
                    <div class="col-md-12" style="padding: 10px;">
                        <form class="col-md-3" action="{{route('leader.search.notAccepted')}}" method="get">
                            <button type="submit" name="filter" value="id" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                Ид номеру
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search.notAccepted')}}" method="get">
                            <button type="submit" name="filter" value="name" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                ФИО
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search.notAccepted')}}" method="get">
                            <button type="submit" name="filter" value="bank_name" class="btn btn-sm btn-default"
                                    style="display: block; width: 100%;">
                                Bank nomi
                            </button>
                        </form>
                        <form class="col-md-3" action="{{route('leader.search.notAccepted')}}" method="get">
                            <select class="form-control input-sm" name="type" onchange="this.form.submit()">
                                <option>Asalari turi</option>
                                <option value="1" {{Request::get('type') == 1 ? "selected" : ""}}>Корхона/ЯТТ</option>
                                <option value="2" {{Request::get('type') == 2 ? "selected" : ""}}>Кўп тармоқли фермер хўжаликлари</option>
                                <option value="3" {{Request::get('type') == 3 ? "selected" : ""}}>Деҳқон (шахсий ёрдамчи) хўжаликлари</option>
                                <option value="4" {{Request::get('type') == 4 ? "selected" : ""}}>Жисмоний шахс</option>
                            </select>
                        </form>
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
                                        <div class="col-md-4"><strong>Asalari turi:</strong></div>
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

                                </div>
                                <div class="panel-footer">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Восстановить?');"
                                                      action="{{route('leader.user.retrieve',$user->id)}}">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="btn btn-primary"
                                                           value="Восстановить">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" onsubmit="return confirm('Хотите удалить?');"
                                                      action="{{route('leader.user.delete', $user->id)}}">
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
            document.cookie = "leader=" + id + ";";
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
            switchSection(getCookie("leader"));
            var navs = document.getElementsByClassName("navs");
            navs[getCookie("leader").replace("section", "") - 1].className = "navs active";
        }
    </script>
@endsection