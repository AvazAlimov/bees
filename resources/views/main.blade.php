@extends('layouts.main')

@section('style')
    <style>
        .jumbotron {
            margin: 0;
            min-height: 400px;
            background: #17234E url({{ asset('Resources/background.jpg') }}) no-repeat center;
            -webkit-background-size: cover;
            background-size: cover;
            border-radius: 0;
        }
        .todo{
            border:2px solid #ffc107;
            border-radius:10px;
            padding: 15px 10px 5px 0px;
            background-image: url({{ asset('Resources/halftone-yellow1.png') }});

        }

        @media (max-width: 800px) {
            .jumbotron {
                min-height: 200px;
            }
        }

        #register {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/halftone-yellow.png') }}) repeat scroll 0 0;
        }

        #about {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/sayagata.png') }}) repeat scroll 0 0;
        }

        #contacts {
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/halftone-yellow.png') }}) repeat scroll 0 0;
        }

        /*.nav-link {*/
        /*color: #555;*/
        /*}*/

        /*.nav-link:hover {*/
        /*color: #333;*/
        /*}*/

        .display-5 {
            color: #582E2A;
            font-weight: Bold;

        }


    </style>
@endsection

@section('content')
    <div class="jumbotron bg-warning text-center">
        <img src="{{ asset('Resources/logo-4.png') }}" class="img-fluid" alt="logo" style="width: 800px;">

    </div>

    <div id="register">
        <br>
        <div class="container">
            <h2 class="display-5 text-center">Рўйхатдан ўтиш йўриқномаси</h2>
            <hr>
           <div class="todo">
            <ol>
                <li><p class="text-justify">Ўзингиз учун логин танланг ва уни тегишли майдонга киритинг.  Логин камидан 6 та белгидан иборат бўлиши лозим,  логин ҳарфлар,  сонлар ва белгилардан иборат бўлиши мумкин.</p> </li>
                <li><p class="text-justify">Ўзингиз учун парол танланг ва тегишли майдонга киритиг.  Парол камида 6 та белгидан иборат бўлиши лозим.  Киритилган паролни тасдиқланг. </p></li>
                <li><p class="text-justify">Шахсий маълумотларингизни киритинг:  исмингиз,  фамилиянгиз,  отангизнинг исми,  жинсингиз,  туғилган сана ва яшаш манзилингиз.</p> </li>
                <li><p class="text-justify">Боғланиш учун маълумотларингизни киритинг:  электрон почта манзилингиз ва мобил телефон рақамингиз.</p> </li>
                <li><p class="text-justify">Мобил телефонингиз рақамини киритганингиздан сўнг "Рўйхатдан ўтиш" тугмасини босинг. </p></li>
                <li><p class="text-justify">Боқилайотган асалари зотларини кўрсатинг.</p></li>
                <li><p class="text-justify">Фаолият турини танланг.</p></li>
            </ol>
           </div>
            <br>
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="type" class="col-form-label col-form-label-sm">Фойдаланувчи тури</label>
                            <select id="type" class="form-control form-control-sm" onchange="changeType(this.id)">
                                <option value="1" selected>Юридик корхоналар (МЧЖ, ХК, ҚК)</option>
                                <option value="2">ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари</option>
                                <option value="3">Шахсий ёрдамчи хўжалик (Жисмоний шахслар)</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body tab-content" id="nav-tabContent">
                    {{--  <form action="{{route('submit.form',1)}}" method="post" class="container tab-pane fade show active"
                            aria-labelledby="nav-user_1-tab" id="user_1">
                          {{csrf_field()}}
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="region_1" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                  <select class="form-control form-control-sm" id="region_1" name="region_id"
                                          onchange="regionChanged(this.id)" required>
                                      @foreach($regions as $region)
                                          <option value="{{$region->id}}">{{ $region->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="city_1" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                  <select class="form-control form-control-sm" id="city_1" name="city_id" required>
                                      @foreach($cities as $city)
                                          <option value="{{$city->id}}">{{$city->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="mahalla_1" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                      номи</label>
                                  <input type="text" class="form-control form-control-sm" id="mahalla_1"
                                         name="neighborhood" value="{{old('neighborhood')}}"
                                         required>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="subject_1" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                      номи</label>
                                  <input type="text" class="form-control form-control-sm" id="subject_1" name="subject"
                                         value="{{old('subject')}}"
                                         required>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="date_1" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                      ўтган сана</label>
                                  <input type="date" class="form-control form-control-sm" id="date_1" name="reg_date"
                                         value="{{old('reg_date')}}"
                                         required>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="inn_1" class="col-form-label col-form-label-sm">СТИР (ИНН)</label>
                                  <input type="text" class="form-control form-control-sm inn" id="inn_1" name="inn"
                                         value="{{old('inn')}}" minlength="9"
                                         required>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="mfo_1" class="col-form-label col-form-label-sm">Банк МФО</label>
                                  <input type="text" class="form-control form-control-sm bankmfo" id="mfo_1" name="mfo"
                                         value="{{old('mfo')}}" required minlength="5" v-model="mfo" list="mfos"/>
                                  <datalist id="mfos">
                                      @foreach($banks as $bank)
                                          <option>{{ $bank->mfo }}</option>
                                      @endforeach
                                  </datalist>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="bank_1" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                      номи</label>
                                  <input type="text" class="form-control form-control-sm" id="bank_1" name="bank_name"
                                         value="{{old('bank_name')}}"
                                         required v-model="bank" readonly>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="address_1" class="col-form-label col-form-label-sm">Манзил</label>
                                  <input type="text" class="form-control form-control-sm" id="address_1" name="address"
                                         value="{{old('address')}}"
                                         required>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="phone_1" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                  <input type="text" class="form-control form-control-sm phone" id="phone_1" name="phone"
                                         value="{{old('phone') or '+'}}"
                                         required>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="email_1" class="col-form-label col-form-label-sm">Электрон почта</label>
                                  <input type="email" class="form-control form-control-sm" id="email_1" name="email"
                                         value="{{old('email')}}">
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="fullName_1" class="col-form-label col-form-label-sm">Корхона директори исми
                                      шарифи</label>
                                  <input type="text" class="form-control form-control-sm" id="fullName_1" name="fullName"
                                         value="{{old('fullName')}}"
                                         required>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="labors_1" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                  <input type="number" class="form-control form-control-sm" id="labors_1" name="labors"
                                         value="{{old('labors')}}" min="0"
                                         required>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="bees_count_1" class="col-form-label col-form-label-sm">Боқлаётган асалари
                                      оилалари сони</label>
                                  <input type="number" class="form-control form-control-sm" id="bees_count_1"
                                         name="bees_count" min="0"
                                         value="{{old('bees_count')}}"
                                         required>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="family_1" class="col-form-label col-form-label-sm">Боқилаётган асалари
                                      зотлари</label>
                                  <div class="col-md-12">
                                      @foreach($families as $family)
                                          <input type="checkbox" name="families[]" value="{{$family->id}}"
                                                 id="family_1"> {{$family->name}}<br>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="activity_1" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                      нечтасини танласа бўлади)</label>
                                  <div class="col-md-12">
                                      @foreach($activities as $activity)
                                          <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                                 id="activity_1"> {{$activity->name}}<br>
                                      @endforeach
                                  </div>
                              </div>
                          </div>

                          <hr>

                          <div class="text-center">
                              <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                          </div>
                      </form>
  --}}
                    <form action="{{route('submit.form', 2)}}" method="post" class="container tab-pane fade show active"
                          aria-labelledby="nav-user_2-tab" id="user_2">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_2" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_2" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_2" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_2" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_2" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_2"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_2" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_2" name="subject"
                                       value="{{old('subject')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_2" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                    ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_2" name="reg_date"
                                       value="{{old('reg_date')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_2" class="col-form-label col-form-label-sm">СТИР (ИНН)</label>
                                <input type="text" class="form-control form-control-sm inn" id="inn_2" name="inn"
                                       value="{{old('inn')}}" minlength="9"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mfo_2" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="text" class="form-control form-control-sm bankmfo" id="mfo_2" name="mfo"
                                       value="{{old('mfo')}}" v-model="mfo" list="mfos" minlength="5" required>
                                <datalist id="mfos">
                                    @foreach($banks as $bank)
                                        <option>{{ $bank->mfo }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_2" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_2" name="bank_name"
                                       value="{{old('bank_name')}}" v-model="bank">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_2" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_2" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_2" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_2" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_2" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_2" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_2" class="col-form-label col-form-label-sm">Хўжалик раҳбари исми
                                    шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_2" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="labors_2" class="col-form-label col-form-label-sm">Ишчилар сони</label>
                                <input type="number" class="form-control form-control-sm" id="labors_2" name="labors"
                                       value="{{old('labors')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bees_count_2" class="col-form-label col-form-label-sm">Боқлаётган асалари
                                    оилалари сони</label>
                                <input type="number" class="form-control form-control-sm" id="bees_count_2"
                                       name="bees_count"
                                       value="{{old('bees_count')}}" min="0"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="family_2" class="col-form-label col-form-label-sm">Боқилаётган асалари
                                    зотлари</label>
                                <div class="col-md-12">
                                    @foreach($families as $family)
                                        <input type="checkbox" name="families[]" value="{{$family->id}}"
                                               id="family_2"> {{$family->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_2" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_2"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>

                    <form action="{{route('submit.form', 3)}}" method="post" class="container tab-pane fade show"
                          aria-labelledby="nav-user_3-tab" id="user_3">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_3" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_3"
                                        onchange="regionChanged(this.id)" name="region_id" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_3" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_3" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_3" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_3"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject_3" class="col-form-label col-form-label-sm">Субъект (корхона, ЯТТ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="subject_3" name="subject"
                                       value="{{old('subject')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_3" class="col-form-label col-form-label-sm">Корхона давлат рўйҳатидан
                                    ўтган сана</label>
                                <input type="date" class="form-control form-control-sm" id="date_3" name="reg_date"
                                       value="{{old('reg_date')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inn_3" class="col-form-label col-form-label-sm">СТИР (ИНН)</label>
                                <input type="text" class="form-control form-control-sm inn" id="inn_3" name="inn"
                                       value="{{old('inn')}}" minlength="9"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mfo_3" class="col-form-label col-form-label-sm">Банк МФО</label>
                                <input type="text" class="form-control form-control-sm bankmfo" id="mfo_3" name="mfo"
                                       value="{{old('mfo')}}" v-model="mfo" list="mfos" minlength="5" required>
                                <datalist id="mfos">
                                    @foreach($banks as $bank)
                                        <option>{{ $bank->mfo }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_3" class="col-form-label col-form-label-sm">Хизмат кўрсатиладиган банк
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="bank_3" name="bank_name"
                                       value="{{old('bank_name')}}" v-model="bank">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_3" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_3" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_3" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_3" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_3" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_3" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_3" class="col-form-label col-form-label-sm">Хўжалик раҳбари исми
                                    шарифи</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_3" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bees_count_3" class="col-form-label col-form-label-sm">Боқлаётган асалари
                                    оилалари сони</label>
                                <input type="number" class="form-control form-control-sm" id="bees_count_3"
                                       name="bees_count"
                                       value="{{old('bees_count')}}" min="0"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="family_3" class="col-form-label col-form-label-sm">Боқилаётган асалари
                                    зотлари</label>
                                <div class="col-md-12">
                                    @foreach($families as $family)
                                        <input type="checkbox" name="families[]" value="{{$family->id}}"
                                               id="family_3"> {{$family->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_3" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_3"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>

                    <form action="{{route('submit.form', 4)}}" method="post" class="container tab-pane fade show"
                          aria-labelledby="nav-user_4-tab" id="user_4">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="region_4" class="col-form-label col-form-label-sm">Вилоят номи</label>
                                <select class="form-control form-control-sm" id="region_4" name="region_id"
                                        onchange="regionChanged(this.id)" required>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city_4" class="col-form-label col-form-label-sm">Туман/шаҳар номи</label>
                                <select class="form-control form-control-sm" id="city_4" name="city_id" required>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mahalla_4" class="col-form-label col-form-label-sm">Маҳалла (МФЙ)
                                    номи</label>
                                <input type="text" class="form-control form-control-sm" id="mahalla_4"
                                       name="neighborhood" value="{{old('neighborhood')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName_4" class="col-form-label col-form-label-sm">ФИШ</label>
                                <input type="text" class="form-control form-control-sm" id="fullName_4" name="fullName"
                                       value="{{old('fullName')}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address_4" class="col-form-label col-form-label-sm">Манзил</label>
                                <input type="text" class="form-control form-control-sm" id="address_4" name="address"
                                       value="{{old('address')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_4" class="col-form-label col-form-label-sm">Телефон рақами</label>
                                <input type="text" class="form-control form-control-sm phone" id="phone_4" name="phone"
                                       value="{{old('phone') or '+'}}"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email_4" class="col-form-label col-form-label-sm">Электрон почта</label>
                                <input type="email" class="form-control form-control-sm" id="email_4" name="email"
                                       value="{{old('email')}}"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bees_count_4" class="col-form-label col-form-label-sm">Боқлаётган асалари
                                    оилалари сони</label>
                                <input type="number" class="form-control form-control-sm" id="bees_count_4"
                                       name="bees_count"
                                       value="{{old('bees_count')}}" min="0"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="family_4" class="col-form-label col-form-label-sm">Боқилаётган асалари
                                    зотлари</label>
                                <div class="col-md-12">
                                    @foreach($families as $family)
                                        <input type="checkbox" name="families[]" value="{{$family->id}}"
                                               id="family_4"> {{$family->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="activity_4" class="col-form-label col-form-label-sm">Фаолият тури (бир
                                    нечтасини танласа бўлади)</label>
                                <div class="col-md-12">
                                    @foreach($activities as $activity)
                                        <input type="checkbox" name="activities[]" value="{{$activity->id}}"
                                               id="activity_4"> {{$activity->name}}<br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <input type="submit" class="btn btn-warning" value="Рўйхатдан ўтиш">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div id="about">
            <br>
            <div class="container text-center">
                <h2 class="display-5">Биз ҳақимизда</h2>
                <hr>

                {{--<img src="https://aloqabank.uz/gallery/aloqa1-2-1-bannery-na-vnutrennyuyu39.jpg"--}}
                {{--alt="Generic placeholder image" class="img-responsive">--}}
                <div>
                    <br>
                    <p class="text-justify">
                        "Ўзбекистон асаларичилари" уюшмаси Ўзбекистон Республикаси Президентининг 2017 йил 16 октябрдаги
                        ПҚ-3327 сонли қарорига асосан асаларичилик тармоғини бошқариш, тизимини тубдан такомиллаштириш,
                        тармоқда наслчилик ишларини илмий асосда ташкил этиш, асаларичилик хўжаликлари фаолияти
                        самарадорлигини ошириш, асал маҳсулотлари ишлаб чиқариш ҳажми ва турларини янада кўпайтириш,
                        асални қайта ишлаш бўйича замонавий технологияларни жорий этиш, соҳанинг экспорт салоҳиятини
                        ошириш, шунингдек, асаларичилик соҳасидаги илғор тажрибаларни республикамизнинг барча
                        ҳудудларида татбиқ этиш мақсадида ташкил этилган.
                        <br>
                        <strong>Уюшманинг асосий вазифалари:</strong>
                        <br>
                        • асаларичилик тармоғини ривожлантиришга қаратилган норматив-хуқуқий базани ишлаб чиқишда
                        иштирок этиш;
                        <br>
                        • асаларичилик тармоғини ривожлантириш дастурларини амалга оширишни мувофиқлаштириш, ягона
                        илмий-техника, технологик, инвестиция ва экспорт сиёсатини амалга оширишни мувофиқлаштириш;
                        <br>
                        • олий ва ўрта махсус, касб-ҳунар таълими, шу жумладан, хорижий муассасаларда асаларичилик
                        тармоғига кадрлар тайёрлаш, қайта тайёрлаш ва уларнинг малакасини ошириш ишларини самарали
                        ташкил этиш ва мувофиқлаштиришда иштирок этиш.
                        <br>
                        <strong>Уюшманинг асосий фаолият йўналишлари:</strong>
                        <br>
                        • маҳаллий ижро этувчи ҳокимият органлари ва манфаатдор ташкилотлар билан ҳамкорликда
                        асаларичилик хўжаликларини ўрмон фонди ерларига, тоғ ва тоғолди ҳудудларига, табиий пичанзор ва
                        яйловларга ҳамда қишлоқ хўжалиги ерларига жойлаштиришни амалга ошириш;
                        <br>
                        • асаларилар учун сунъий озуқалар ишлаб чиқаришни марказлашган ҳолда ташкил этишга кўмаклашиш ва
                        ушбу тажрибани кенг қўллаш ҳисобига асаларичилик хўжаликларининг озуқа базасини мустаҳкамлаш;
                        <br>
                        • асалари касалликларининг олдини олиш, даволаш ва ташхис қўйиш бўйича замонавий ва илғор
                        усулларни жорий этиш ишларига кўмаклашиш;
                    </p>
                </div>
            </div>
            <br>
        </div>

        <div id="contacts">
            <br>
            <div class="container text-center">
                <h2 class="display-5">Боғланиш</h2>
                <hr>
                <br>
                <h3>Тошкент Шаҳар, Алишер Навоий шоҳ кўчаси, 40 А уй</h3>
                <h3>(0371) 200 70 00</h3>
                <br>
            </div>
            <div id="map" style="width:100%;height:500px"></div>
        </div>
    </div>
@endsection

@section('script')
    <!--suppress EqualityComparisonWithCoercionJS -->
    <script>
        var arrays = [{!! $regions !!}];
        arrays.push({!! $cities !!});
        arrays.push({!! $banks !!});
        var mfos = [];

        function regionChanged(id) {
            var selected = document.getElementById(id).value;
            var select = "city_" + id.substring(7, 8);
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

        function changeType(id) {
            var selected = document.getElementById(id).selectedIndex + 2;
            for (var i = 2; i < 5; i++)
                document.getElementById("user_" + i).classList.remove("active");
            document.getElementById("user_" + selected).classList.add("active");
        }


        $(document).ready(function () {
            regionChanged('region_2');
            regionChanged('region_3');
            regionChanged('region_4');
            $('.phone').mask('+AAB (00) 000-00-00', {
                'translation': {
                    A: {pattern: /[9]/},
                    B: {pattern: /[8]/}
                }
            });

            $('.bankmfo').mask('00000');
            $('.inn').mask('000000000', {
                'translation': {
                    0: {pattern: /[0-9*]/}
                }
            });

            @if($type != null)
            document.getElementById('type').selectedIndex = {!! $type !!} -1;
                    @endif

            for (var i = 0; i < arrays[2].length; i++)
                mfos.push(arrays[2][i]['mfo']);
        });
    </script>

    <script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lodash.min.js') }}" type="text/javascript"></script>

    <!--suppress JSUnusedLocalSymbols -->
    <script>
        var app = new Vue({
            el: '#register',
            data: {
                mfo: '',
                bank: '',
                address: '',
                refresh: false
            },
            watch: {
                mfo: function () {
                    this.address = '';
                    if (this.mfo.length > 0) {
                        this.lookupAddress();
                    }
                }
            },
            methods: {
                lookupAddress: _.debounce(function () {
                    var app = this;
                    app.bank = "Searching...";
                    var found = false;
                    for (var i = 0; i < mfos.length; i++)
                        if (mfos[i] === app.mfo) {
                            found = true;
                            app.bank = arrays[2][i]['name'];
                            break;
                        }
                    if (!found)
                        app.bank = '';
                }, 500)
            }
        });
    </script>

    <!--suppress JSUnresolvedVariable, JSUnresolvedFunction, JSUnusedLocalSymbols -->
    <script>
        function myMap() {
            var myCenter = new google.maps.LatLng(41.310441, 69.278460);
            var mapCanvas = document.getElementById("map");
            var mapOptions = {center: myCenter, zoom: 16};
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({position: myCenter});
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo3ndgX7wPYPEsnAsGiqW0Qxem1Ni4TW4&callback=myMap"></script>
@endsection