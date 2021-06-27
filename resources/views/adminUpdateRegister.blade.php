@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"> <a href="{{ route('adminPermission') }}" style="color: #fff;"> Voltar </a></button>
                    <form action="{{route('permissionUpdate')}}" method="post">
                        @method('PUT')
                        @csrf
                        <input style="display:none;" value="{{$permission->id}}" name="permission_id"/>
                        <div class="form-group">
                            <label for="name" >Nome</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{$permission->route}}" required autocomplete="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" >Tipo</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type_user">
                                    <option value="A"  <?= $permission->type_user == 'A' ?  'selected': ''?>>Aluno</option>
                                    <option value="P"  <?= $permission->type_user == 'P' ?  'selected': ''?>>Professor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type_permission" >Tipo de Permissão</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type_permission">
                                    <option value="M" <?= $permission->type_permission == 'M' ?  'selected': ''?>>Modificar</option>
                                    <option value="N" <?= $permission->type_permission == 'N' ?  'selected': ''?>>Sem Permissão</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Atualizar" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection