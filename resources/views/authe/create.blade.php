@extends('gentelella.layouts.app')

@section('htmlheader_title', 'Home')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Button trigger modal -->
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i></a>
            </button>
        </div>
        <table id="relatorios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        {{-- <th class="disabled-sorting text-right">Editar</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $dado)
                        <tr>
                            <td>{{$dado->name}}</td>
                            <td>{{$dado->email}}</td>
                            <td>{{$dado->perfil}}</td>
                            {{-- <td><a href="{{ url("imprensa/$dado->id/edit")}}"
                                class="btn btn-warning btn-xs action  pull-right botao_acao btn_control" 
                                data-toggle="tooltip" 
                                data-placement="bottom" 
                                title="Editar Relatorio">  
                                <i class="glyphicon glyphicon-pencil "></i>
                            </a>
                            </td> --}}
                        </tr>
                    @endforeach 
                </tbody>
            
            </table>
      
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/register">
            {{ csrf_field() }}
                
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmação de Senha:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
            </div>
          </div>
        </div>
      </div>
</div>
   
@stop