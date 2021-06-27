@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pagina Inicial') }}</div>

                <div class="card-body">
                    @if (isset($message) && $message)
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary" style="margin:15px;"> <a href="{{ route('adminPermission') }}" style="color: #fff;"> Permissão de Usuários </a></button>
                    <button type="button" class="btn btn-primary" style="margin:15px;"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Aulas </a></button>
                    <button type="button" class="btn btn-primary" style="margin:15px;"> <a href="{{ route('adminStudent') }}" style="color: #fff;"> Alunos </a></button>
                    <button type="button" class="btn btn-primary" style="margin:15px;"> <a href="{{ route('adminProf') }}" style="color: #fff;"> Professores </a></button>

                    <!-- <button type="button" class="btn btn-primary"> <a href="{{ route('class') }}" style="color: #fff;"> Aulas </a></button> -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
