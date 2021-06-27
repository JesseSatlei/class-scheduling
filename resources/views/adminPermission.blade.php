@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Permissões') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"><a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    <button type="button" class="btn btn-primary"><a href="{{ route('registerPermission') }}" style="color: #fff;"> Nova Permissão </a></button>
                </div>
            </div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scopt="col">Tipo de Usuario</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($permissions))
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->route}}</td>
                                <td>{{$permission->type_user == 'P' ? 'Professor' : 'Aluno'}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><a href="{{ route('updatePermission', $permission->id) }}" style="color: #fff;"> Editar </a></button>
                                </td>
                                <td>
                                    <form action="{{ route('destroyPermission', $permission->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-primary"> Deletar </button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection