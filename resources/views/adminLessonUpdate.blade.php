@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Atualizar Aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Aulas </a></button>

                    <form action="{{route('lessonUpdate')}}" method="post">
                        @method('PUT')
                        @csrf
                        <input style="display:none;" value="{{$lessons->id}}" name="lesson_id"/>
                        <div class="form-group">
                            <label for="type" >Professor</label>
                            <div class="col-md-6">
                                <select class="form-control" name="prof">
                                    @if ($profs)
                                        @foreach ($profs as $prof)
                                            @if ($teacher_lesson == $prof->id)
                                                <option value="{{$prof->id}}" selected>{{$prof->name}}</option>
                                            @else
                                                <option value="{{$prof->id}}">{{$prof->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" >Alunos</label>
                            <div>
                                <select class="form-control" name="student[]" multiple>
                                    <option value="">Selecionar</option>
                                    @if ($students)
                                        @foreach ($students as $student)
                                            <option value="{{$student->id}}">{{$student->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="matter">Matéria</label>
                            <input type="text" class="form-control" name="matter" id="matter" value="{{$lessons->matter}}" required>
                        </div>
                        <div class="form-group">
                            <label for="hourclass">Data e Hora</label>
                            <input type="datetime" class="form-control" name="hourclass" value="{{date_format(date_create($lessons->date), 'Y-m-d H:i')}}"  id="hourclass" required>
                        </div>
                        <input type="submit" value="Alterar" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection