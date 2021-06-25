@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($type) && $type == 'AD')
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminPermission') }}" style="color: #fff;"> Permissão de Usuários </a></button>
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminClass') }}" style="color: #fff;"> Aulas </a></button>
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminStudent') }}" style="color: #fff;"> Alunos </a></button>
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminProf') }}" style="color: #fff;"> Professores </a></button>

                    @else
                        <button type="button" class="btn btn-primary"> <a href="{{ route('class') }}" style="color: #fff;"> Aulas </a></button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
