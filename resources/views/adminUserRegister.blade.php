@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar</div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary"> <a href="{{ route('home') }}" style="color: #fff;"> Voltar </a></button>
                    
                    <form action="{{route('adminProfRegister')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="type" >Tipo</label>
                            <div class="col-md-6">
                                <select class="form-control" name="type">
                                    <option value="AD">Administrador</option>
                                    <option value="A">Aluno</option>
                                    <option value="P">Professor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" >Nome</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" required autocomplete="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
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