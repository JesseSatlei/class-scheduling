@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Informações da Aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('class') }}" style="color: #fff;"> Aulas </a></button>
                    
                    <form action="{{route('classStore')}}" method="post">
                        @csrf
                        @foreach ($lessons as $lesson)
                            <div class="form-group">
                                <label for="matter">Matéria</label>
                                <input type="text" class="form-control" name="matter" id="matter" value="{{$lesson->matter}}" required disabled>
                            </div>
                            <div class="form-group">
                                <label for="hourclass">Data e Hora</label>
                                <input type="datetime" class="form-control" name="hourclass" id="hourclass" value="{{$lesson->date}}" required disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Professor</label>
                                <input type="text" class="form-control" name="matter" id="matter" value="{{$teacher_name}}" required disabled>
                            </div>
                        @endforeach
                        <div>Alunos:
                        @if ($students)
                            <ul>
                                @foreach ($students as $student)
                                    <li>{{$student}}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Nenhum aluno se inscreveu em sua aula</p>
                        @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection