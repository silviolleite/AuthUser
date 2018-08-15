@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Usuários</h3>
            {!! Button::primary('Novo Usuário')->asLinkTo(route('authuser.users.create')) !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('search', 'Pesquisar Usuários: ', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control', 'autofocus']) !!}
                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row">
            {!! Table::withContents($users->items())
            ->striped()
            ->bordered()
            ->callback('Ações', function ($field, $user){
                $linkEdit = route('authuser.users.edit', ['user' => $user->id]);
                $linkDestroy = route('authuser.users.destroy', ['user' => $user->id]);
                $index = "delete-form-{$user->id}";
                $form = Form::open(['route' => ['authuser.users.destroy', 'user' => $user->id], 'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).Form::close();
                $ancorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit()"
                ]);
                return '<ul class="list-inline">'.
                        '<li>'.Button::link('Editar')->asLinkTo($linkEdit).'</li>'.
                        '<li>|</li>'.
                        '<li>'.(($user->id == \Auth::user()->id) ? '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>' : $ancorDestroy).'</li>'.
                        '</ul>'.
                        $form;
            })
            !!}

            {{ $users->links() }}
        </div>
    </div>
@endsection