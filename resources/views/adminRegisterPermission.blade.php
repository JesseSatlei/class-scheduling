@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminPermission') }}" style="color: #fff;"> Voltar </a></button>
                    <form action="{{route('createPermission')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" >Rota</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" required autocomplete="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type_user" >Tipo de Usuário</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type_user">
                                    <option value="A">Aluno</option>
                                    <option value="P">Professor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type_permission" >Tipo de Permissão</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type_permission">
                                    <option value="M">Modificar</option>
                                    <option value="N">Sem Permissão</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Registrar" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection