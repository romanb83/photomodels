@extends('layouts.base')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-3">
                Content
            </div> --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                        
                        <h6>Профиль пользователя {{ $itemUserProfile->nick_name }}</h6>                       
                    </div>
                    <div class="card-body">
                        <form action="{{ route('save.profile') }}" method="post">
                            @csrf
                            {{-- @method('PATCH') --}}
                            <div class="form-group">
                                <div class="row">                           
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/250">
                                        <span><a href="#">загрузить аватарку</a></span>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="email" class="col-form-label col-form-label-sm"><strong>Email: </strong></label>
                                                <span id="email" class="form-control form-control-sm">{{ $itemUserProfile->email }}</span>
                                            </div>
                                        </div>

                                        <div id="app2">
                                                <p>@{{ message }}</p>
                                                <button v-on:click="reverseMessage">Reverse Message</button>
                                        </div>      
                                    </div>                                
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="first_name" class="col-form-label col-form-label-sm">Имя</label>
                                            <input class="form-control form-control-sm" type="text" name="first_name" id="first_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name" class="col-form-label col-form-label-sm">Фамилия</label>
                                            <input class="form-control form-control-sm" type="text" name="last_name" id="last_name">
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked>
                                            <label class="form-check-label col-form-label col-form-label-sm" for="gender1">
                                                Мужской
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
                                            <label class="form-check-label col-form-label col-form-label-sm" for="gender2">
                                                Женский
                                            </label>
                                        </div>
                                        </div>                                        
                                        <label for="bithdate" class="col-form-label col-form-label-sm">Дата рождения</label>
                                        <div class="form-row" id="bithdate">
                                            <div class="form-group col-md-3">
                                                <select class="form-control form-control-sm" name="day" id="day">
                                                    <option class="form-control form-control-sm" value="0">День</option>
                                                    @foreach ($itemDay as $item)
                                                        <option class="form-control form-control-sm" value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach                                            
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select class="form-control form-control-sm" name="month" id="month">
                                                    <option class="form-control form-control-sm" value="0">Месяц</option>
                                                    @foreach ($itemMonth as $key => $item)
                                                        <option class="form-control form-control-sm" value="{{ $key }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <select class="form-control form-control-sm" name="year" id="year">
                                                    <option class="form-control form-control-sm" value="0">Год</option>
                                                    @foreach ($itemYear as $item)
                                                        <option class="form-control form-control-sm" value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class="col-form-label col-form-label-sm">Страна</label>
                                            <select class="form-control form-control-sm" name="country" id="country">
                                                <option class="form-control form-control-sm" value="0">Выбрать</option>
                                                @foreach ($itemCountry as $item)
                                                    <option class="form-control form-control-sm" value="{{ $item->alias }}">{{ $item->country_name }}</option>
                                                @endforeach                                            
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="region" class="col-form-label col-form-label-sm">Область\Край</label>
                                            <select class="form-control form-control-sm" name="region" id="region">
                                                <option class="form-control form-control-sm" value="0">Выбрать</option>
                                                @foreach ($itemRegion as $item)
                                                    <option class="form-control form-control-sm" value="{{ $item->alias }}">{{ $item->region_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city_id" class="col-form-label col-form-label-sm">Город</label>
                                            <select class="form-control form-control-sm" name="city_id" id="city_id">
                                                <option class="form-control form-control-sm" value="0">Выбрать</option>
                                                @foreach ($itemCity as $item)
                                                    <option class="form-control form-control-sm" value="{{ $item->id }}">{{ $item->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label col-form-label-sm">Номер телефона</label>
                                            <input class="form-control form-control-sm" type="text" name="phone" id="phone">
                                        </div>

                                        <div class="form-group">
                                            <label for="about" class="col-form-label col-form-label-sm">Расскажите о себе</label>
                                            <textarea class="form-control form-control-sm" name="about" id="" cols="40" rows="10">О себе</textarea>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-md-12">
                                                <label for="group_id" class="col-form-label col-form-label-sm">Кто вы?</label>
                                                <select class="form-control form-control-sm" name="group_id" id="group_id">
                                                    <option class="form-control form-control-sm" value="0">Выбрать</option>
                                                    @foreach ($itemGroup as $item)
                                                        <option class="form-control form-control-sm" value="{{ $item->id }}">{{ $item->group_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="eye_color" class="col-form-label col-form-label-sm">Цвет глаз</label>
                                                <input class="form-control form-control-sm col-12" type="text" name="eye_color" id="eye_color">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="hair_color" class="col-form-label col-form-label-sm">Цвет волос</label>
                                                <input class="form-control form-control-sm col-12" type="text" name="hair_color" id="hair_color">
                                            </div>    
                                        </div>                                   
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="height" class="col-form-label col-form-label-sm">Рост</label>
                                                <input class="form-control form-control-sm col-6" type="text" name="height" id="height" placeholder="см">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="weight" class="col-form-label col-form-label-sm">Вес</label>
                                                <input class="form-control form-control-sm col-6" type="text" name="weight" id="weight" placeholder="кг">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="chest" class="col-form-label col-form-label-sm">Грудь</label>
                                                <input class="form-control form-control-sm col-8" type="text" name="chest" id="chest" placeholder="см">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="waist" class="col-form-label col-form-label-sm">Талия</label>
                                                <input class="form-control form-control-sm col-8" type="text" name="waist" id="waist" placeholder="см">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="hip" class="col-form-label col-form-label-sm">Бёдра</label>
                                                <input class="form-control form-control-sm col-8" type="text" name="hip" id="hip" placeholder="см">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="clothing_size" class="col-form-label col-form-label-sm">Размер одежды</label>
                                                <input class="form-control form-control-sm col-8" type="text" name="clothing_size" id="clothing_size">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="foot_size" class="col-form-label col-form-label-sm">Размер обуви</label>
                                                <input class="form-control form-control-sm col-8" type="text" name="foot_size" id="foot_size">
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="genre" class="col-form-label col-form-label-sm">Жанры</label>
                                            <select class="form-control form-control-sm" name="genre" id="genre">
                                                <option class="form-control form-control-sm" value="0">Выбрать</option>
                                                @foreach ($itemGenre as $item)
                                                    <option class="form-control form-control-sm" value="{{ $item->genre }}">{{ $item->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exp" class="col-form-label col-form-label-sm">Опыт</label>
                                            <select class="form-control form-control-sm" name="exp" id="exp">                                                
                                                @foreach ($itemExp as $key => $item)
                                                    <option class="form-control form-control-sm" value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="tfp" name="tfp" value="1">
                                                    <label class="form-check-label" for="tfp">
                                                        TFP
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="commerce" name="commerce" value="1">
                                                    <label class="form-check-label" for="commerce">
                                                        Коммерция
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        {{-- <a href="{{ route('group.edit', [$group, $itemUser->id]) }}">Редактировать</a>
                                        <form method="POST" action="{{ route('group.destroy', [$group, $itemUser->id]) }}">
                                            @method('DELETE')
                                            @csrf                                    
                                            <button type="submit" class="btn btn-link">Удалить</button>                                             
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Сохранить</button>
                        </form>                                                      
                    </div>                 
                </div>
            </div>
        </div>            
    </div>
@endsection