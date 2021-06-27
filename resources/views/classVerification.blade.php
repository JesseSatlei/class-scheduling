@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmação da Aula') }}</div>

                <div class="card-body">

                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Voltar </a></button>
                    <div>
                        {{$status}}
                    </div>
                    <form action="{{route('classStore')}}" method="post">
                        @csrf
                        <button type="button" class="btn btn-primary"> <a href="{{ route('classCancelation', $id_lesson) }}" style="color: #fff;"> Cancelar Participação </a></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection