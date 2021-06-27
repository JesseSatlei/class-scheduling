@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitação de Permissão para aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Voltar </a></button>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Matéria</th>
                                <th scope="col">Aluno</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $class)
                            <tr>
                            <td>{{$class['matter']}}</td>
                            <td>{{$class['name']}}</td>
                                <td>
                                    @if ($class['present'])
                                        <form action="{{ route('classStudentConfirm') }}" method="post">
                                        @csrf
                                            <input type="text" style="display:none;" name="student_id" value="{{$class['student_id']}}">
                                            <input type="text" style="display:none;" name="lesson_id" value="{{$class['lesson_id']}}">
                                            <button type="submit" class="btn btn-primary"> Remover</button>
                                        </form>
                                    @else
                                        <form action="{{ route('classStudentConfirm') }}" method="post">
                                        @csrf
                                            <input type="text" style="display:none;" name="student_id" value="{{$class['student_id']}}">
                                            <input type="text" style="display:none;" name="lesson_id" value="{{$class['lesson_id']}}">
                                            <button type="submit" class="btn btn-primary"> Aceitar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection