@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Aulas') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"><a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    <button type="button" class="btn btn-primary"> <a href="{{ route('registerLesson') }}" style="color: #fff;"> Nova Aula </a></button>
                    @if (isset($message) && $message)
                        <button type="button" class="btn btn-success"> {{$message}}</button>
                    @endif
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
                        @if (isset($lessons))
                            @foreach($lessons as $lesson) 
                            <tr>
                                <td>{{$lesson->matter}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary"><a href="{{ route('lessorFormUpdate', $lesson->id) }}" style="color: #fff;"> Editar </a></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"><a href="{{ route('lessonInfo', $lesson->id) }}" style="color: #fff;"> Visualizar </a></button>
                                </td>
                                <td>
                                    <form action="{{ route('destroyLesson', $lesson->id) }}" method="post">
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