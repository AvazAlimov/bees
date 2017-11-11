@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="section1" class="section">
                    <div class="page-header">
                        <h2>Запросы </h2>
                    </div>
                    @foreach($users as $user)
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Идентификационный номер
                                    заказа: {{ $user->id }}
                                </div>
                                <div class="panel-body">
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
                                        <div class="col-md-4"><strong>Bank MFO:</strong></div>
                                        <div class="col-md-8">{{ $user->mfo }}</div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="col-md-4"><strong>Address:</strong></div>
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
                                            <form>
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-warning form-group"
                                                       value="Отказать">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form>
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-primary form-group"
                                                       value="Изменить">
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" onsubmit="return confirm('Хотите удалить?');">
                                                {{csrf_field()}}
                                                <input type="submit" class="btn btn-block btn-danger" value="Удалить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>

</script>
@endsection