@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Regra</h3>
            {!! Form::model($role, ['route' => ['authuser.roles.update', 'role' => $role->id],
                'class' => 'form', 'method' => 'PUT'])
             !!}

            @include('authuser::roles._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar Regra')->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection