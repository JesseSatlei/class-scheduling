@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nova Aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Aulas </a></button>
                    
                    <form action="{{route('createLesson')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type" >Professor</label>
                            <div>
                                <select class="form-control" name="prof" required>
                                    @if (!empty($profs) && $profs)
                                        @foreach ($profs as $prof)
                                            <option value="{{$prof->id}}">{{$prof->name}}</option>
                                        @endforeach
                                    @else 
                                        <option value="">Crie um professor</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" >Alunos</label>
                            <div>
                                <select class="form-control" name="student[]" multiple required>
                                    <option value="">Selecionar</option>
                                    @if ($students)
                                        @foreach ($students as $student)
                                            <option value="{{$student->id}}">{{$student->name}}</option>
                                        @endforeach
                                    @else
                                        <option value="">Crie um aluno</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="matter">Matéria</label>
                            <input type="text" class="form-control" name="matter" id="matter" required>
                        </div>
                        <div class="form-group">
                            <label for="hourclass">Data e Hora</label>
                            <input type="datetime-local" class="form-control" name="hourclass" id="hourclass" required>
                        </div>
                        <input type="submit" value="Cadastrar" class="btn btn-success">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection