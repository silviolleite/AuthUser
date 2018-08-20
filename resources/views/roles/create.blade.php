@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Regras</h3>
            {!! Form::open(['route' => 'authuser.roles.store', 'class' => 'form']) !!}

            @include('authuser::roles._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Regras')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection