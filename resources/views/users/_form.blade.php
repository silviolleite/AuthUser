{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name', 'Nome') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('email', $errors) !!}
{!! Form::label('email', 'E-mail') !!}
{!! Form::text('email', null, ['class' => 'form-control']) !!}
{!! Form::error('email', $errors) !!}
{!! Html::closeFormGroup() !!}