@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nova Aula') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary"> <a href="{{ route('class') }}" style="color: #fff;"> Aulas </a></button>
                    
                    <form action="{{route('classStore')}}" method="post">
                        @csrf
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