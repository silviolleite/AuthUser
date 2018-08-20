@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Regras</h3>
            {!! Button::primary('Nova Regra')->asLinkTo(route('authuser.roles.create')) !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('search', 'Pesquisar Regras: ', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control', 'autofocus']) !!}
                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row">
            {!! Table::withContents($roles->items())
            ->striped()
            ->bordered()
            ->callback('Ações', function ($field, $role){
                $linkEdit = route('authuser.roles.edit', ['role' => $role->id]);
                $linkDestroy = route('authuser.roles.destroy', ['role' => $role->id]);
                $index = "delete-form-{$role->id}";
                $form = Form::open(['route' => ['authuser.roles.destroy', 'role' => $role->id], 'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).Form::close();
                $ancorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                ]);
                return '<ul class="list-inline">'.
                        '<li>'.Button::link('Editar')->asLinkTo($linkEdit).'</li>'.
                        '<li>|</li>'.
                        '<li>'.(($role->id == 1) ? '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>' : $ancorDestroy).'</li>'.
                        '</ul>'.
                        $form;
            })
            !!}

            {{ $roles->links() }}
        </div>
    </div>
@endsection