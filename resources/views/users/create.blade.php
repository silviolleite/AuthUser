@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuários</h3>
            {!! Form::open(['route' => 'authuser.users.store', 'class' => 'form']) !!}

            @include('authuser::users._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Usuário')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection