@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Estudantes') }}</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"><a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminRegister') }}" style="color: #fff;"> Novo Estudante </a></button>
                </div>
            </div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Visualizar</th>
                            <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($studants))
                            @foreach($studants as $studant) 
                            <tr>
                                <td>{{$studant->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><a href="{{ route('adminUserUpdate', $studant->id) }}" style="color: #fff;"> Editar </a></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"><a href="{{ route('adminUserInfo', $studant->id) }}" style="color: #fff;"> Visualizar </a></button>
                                </td>
                                <td>
                                    <form action="{{ route('adminProfDelete', $studant->id) }}" method="post">
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