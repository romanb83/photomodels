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
                    <a class="nav-link" href="{{ route('edit.profile') }}">Редактировать профиль</a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            @if ($fileis)
                            <img src="{{ asset($path.'avatar.jpg') }}">
                            @else
                            <img src="{{ asset(env('DEFAULT_AVATAR')) }}" width="200" height="400">
                            @endif
                        </div>
                        <div class="col-md-9">

                            <div class="card-title"></div>
                            <div class="card-subtitle mb-2 text-muted"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные
                                        данные</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Дополнительные
                                        данные</a>
                                </li>
                            </ul>
                            <br>
                            <div class="tab-content">
                                <div class="tab-pane active" id="maindata" role="tabpanel">
                                    <p class="text-justify border border-primary">Логин: {{ $itemShowUser->nick_name }}</p>
                                    <p class="text-justify border border-primary">Имя: {{ $itemShowUser->first_name }}</p>
                                    <p class="text-justify border border-primary">Фамилия: {{ $itemShowUser->last_name }}</p>
                                    <p class="text-justify border border-primary">E-mail: {{ $itemShowUser->email }}</p>
                                    <p class="text-justify border border-primary">Город: {{ $itemShowUser->city->city_name }}</p>
                                </div>
                                <div class="tab-pane" id="adddata" role="tabpanel">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection