@extends('gentelella.layouts.app')
@section('content')

<div class="x_panel modal-content ">
    <div class="x_title">
       <h2> Funcionários </h2>
       <a href="{{ url('funcionario/create') }}" 
          class="btn-circulo btn btn-primary btn-md   pull-right " 
          data-toggle="tooltip"  
          data-placement="bottom" 
          title="Adiciona um Funcionário">
          <span class="fa fa-plus">  </span>
       </a>
       <div class="clearfix"></div>
  </div>
  <div class="x_panel ">
      <div class="x_content">
          <table class="table table-hover table-striped compact" id="tb_funcionarios">
              <thead>
                  <tr>
                      <th>Nome</th> 
                      <th>CPF</th> 
                      {{-- <th>Secretaria</th> 
                      <th>Departamento</th>  --}}

                      <th>Ações</th>
                  </tr>						
              </thead>

              <tbody>
                  @foreach($funcionarios as $key=> $funcionario)
                      <tr>
                          <td> {{$funcionario->nome}}</td> 
                          <td> {{$funcionario->cpf}}</td> 
                          {{-- <td> {{$funcionario->departamento->secretaria}}</td> 
                          <td> {{$funcionario->departamento->nome}}</td>  --}}
                          
                          <td class="actions">

                              <a href="{{ url("funcionario/$funcionario->id/edit") }}" 
                                  id="btn_edita_funcionario"
                                  class="btn btn-warning btn-xs action botao_acao " 
                                  data-toggle="tooltip" 
                                  data-funcionario = {{ $funcionario->id }}
                                  data-placement="bottom" 
  
                                  title="Edita esse funcionario">  
                                  <i class="glyphicon glyphicon-pencil "></i>
                              </a>

                              <a href="#" 
                                  id="btn_exclui_funcionario"
                                  class="btn btn-danger btn-xs  action botao_acao  "  
                                  data-toggle="tooltip" 
                                  data-funcionario = {{ $funcionario->id }}
                                  data-placement="bottom" 

  
                                  title="Exclui esse funcionario"> 
                                  <i class="glyphicon glyphicon-remove "></i>
                              </a>

                          </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>

@endsection
@push("scripts")

	
	{{-- Vanilla Masker --}}
	<script src="{{ asset('js/vanillaMasker.min.js') }}"></script>
	

	<script>
		$(document).ready(function(){

			//configuração da tabela		 
			$.fn.dataTable.moment( 'DD/MM/YYYY' );
			
			var tabela_funcionarios = $("#tb_funcionarios").DataTable({
				language : {
					'url' : '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				}, 
				stateSave: false,
				stateDuration: -1,
				responsive: true,
				columnDefs: [
					{ "width": "40%", "targets": 0 },
					{ "width": "10%", "targets": 1 },
					{ "width": "10%", "targets": 2 },
					{ "width": "30%", "targets": 3 },
					{ "width": "10%", "targets": 4 },

				]			
			});

			//botão de edição
			$("table#tb_funcionarios").on("click", "#btn_edita_funcionario",function(){

				let id_funcionario = $(this).data('funcionario');
				let btn = $(this);

			});

			//botão de exclusão
			$("table#tb_funcionarios").on("click", "#btn_exclui_funcionario",function(){
				event.preventDefault();

				let id_funcionario = $(this).data('funcionario');
				let btn = $(this);
				

				swal({
					title: 'Confirma a EXCLUSÃO deste Funcionário?',
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim',
					cancelButtonText: 'Não'
				}).then((result) => {
					if (result.value) {
						$.post("{{ url('funcionario/') }}/"+id_funcionario, {
							_token  : "{{ csrf_token() }}",
							_method : 'DELETE',
							id_funcionario:	id_funcionario,
							},function(data){
								if(data =="ok"){

									//exclui a linha no datatables
									$("table#tb_funcionarios").DataTable().row( btn.parents('tr') ).remove().draw();
									
									swal(
										'Funcionário EXCLUÍDO',
										' ',
										'success'
									)
								}
			
							})         
						
					} else {
						swal(
							'Exclusão Cancelada',
							' ',
							'error'
						)
					}
				});
			});
		});
		
		
	</script>

@endpush
