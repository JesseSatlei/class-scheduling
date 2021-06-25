@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"> <a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    

                    <input style="display:none;" value="{{$user->id}}" name="user_id"/>
                    <div class="form-group">
                        <label for="type" >Tipo</label>
                        <div class="col-md-6">
                            <select class="form-control" name="type">
                                <option value="AD" <?= $user->type == 'AD' ? 'selected': ''?> >Administrador</option>
                                <option value="A"  <?= $user->type == 'A' ?  'selected': ''?>>Aluno</option>
                                <option value="P"  <?= $user->type == 'P' ?  'selected': ''?>>Professor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" >Nome</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="{{$user->name}}" required autocomplete="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autocomplete="email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection