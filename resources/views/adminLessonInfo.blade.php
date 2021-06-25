@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Informações da Aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Aulas </a></button>
                    
                   <div class="form-group">
                        <label for="matter">Professor</label>
                        <input type="text" class="form-control" name="matter" id="matter" value="{{$teacher->name}}" required disabled>
                   </div>
                   <div class="form-group">
                        <label for="type" >Alunos</label>
                        <div>
                            <select class="form-control" name="student[]" multiple disabled>
                                @if ($students)
                                    @foreach ($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                    @endforeach
                                @else
                                    <option value="">Não possui alunos nessa aula</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="matter">Matéria</label>
                        <input type="text" class="form-control" name="matter" id="matter"  value="{{$lessons->matter}}" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="hourclass">Data e Hora</label>
                        <input type="datetime" class="form-control" name="hourclass"  value="{{$lessons->date}}" id="hourclass" required disabled>
                    </div>       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection