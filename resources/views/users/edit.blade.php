@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar  Usuário</h3>
            {!! Form::model($user, ['route' => ['authuser.users.update', 'user' => $user->id],
                'class' => 'form', 'method' => 'PUT'])
             !!}

            @include('authuser::users._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar Usuário')->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection