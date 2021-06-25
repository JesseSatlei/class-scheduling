@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Aulas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary"><a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    @if ($permission)
                        <button type="button" class="btn btn-primary"> <a href="{{ route('classForm') }}" style="color: #fff;"> Nova Aula </a></button>
                    @endif

                    @if ($solicitation)
                        <button type="button" class="btn btn-primary"> <a href="{{ route('classStudent') }}" style="color: #fff;"> Adicionar/Remover Aluno da Aula </a></button>
                    @endif
                </div>
            </div>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Matéria</th>
                            @if ($type != 'A')
                                <th scope="col">Visualizar</th>
                            @else
                                <th scope="col">Status</th>
                                <th scope="col">Visualizar</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class) 
                        <tr>
                        <td>{{$class->matter}}</td>
                        @if ($type != 'A')
                            <td>
                                <button type="button" class="btn btn-primary"><a href="{{ route('classInfo', $class->id) }}" style="color: #fff;"> Visualizar </a></button>
                            </td>
                            </tr>
                        @else
                            <td>
                                <button type="button" class="btn btn-primary"><a href="{{ route('classEnter', $class->id) }}" style="color: #fff;"> Entrar na Aula </a></button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary"><a href="{{ route('classInfo', $class->id) }}" style="color: #fff;"> Visualizar </a></button>
                            </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection