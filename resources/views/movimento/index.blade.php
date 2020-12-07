@extends('gentelella.layouts.app')

@section('content')
   <div class="x_panel modal-content ">
	  	<div class="x_title">
		 	<h2> Movimento </h2>
		 
		 	<div class="clearfix"></div>
	    </div>
	    <div class="x_panel ">
		    <div class="x_content">
                <table class="table table-hover table-striped compact" id="tb_movimentos">
					<thead>
						<tr>
							<th>Data</th> 
							<th>Tipo</th> 
							{{-- <th>Departamento</th>  --}}
							<th>Modelo</th> 
							<th>Qtd</th> 
							<th>Usuário ou Funcionário</th> 

							<th>Ações</th>
						</tr>						
					</thead>

					<tbody>
						@foreach($movimentos as $key=> $movimento)
							<tr>
								<td> {{$movimento->created_at}}</td> 
								<td> {{$movimento->tipo}}</td> 
								{{-- <td> 
									@isset($movimento->departamento)
									{{ $movimento->departamento->nome }} -- {{ $movimento->departamento->secretaria }}
								@endisset
								</td>  --}}
								<td> {{$movimento->material->modelo}}</td> 
								<td> {{$movimento->quantidade}}</td> 
								<td> 
									@if($movimento->tipo == "ENTRADA")	
										@isset($movimento->user)
											{{ $movimento->user->nome }}
										@endisset
									@else
										@isset($movimento->funcionario)
											{{ $movimento->funcionario->nome }}
										@endisset
									@endif
								</td> 

								
								<td class="actions">

									<a href="{{ url("movimento/$movimento->id/edit") }}" 
										id="btn_edita_movimento"
										class="btn btn-warning btn-xs action botao_acao " 
										data-toggle="tooltip" 
										data-movimento = {{ $movimento->id }}
										data-placement="bottom" 
		
										title="Edita esse movimento">  
										<i class="glyphicon glyphicon-pencil "></i>
									</a>

									<a href="#" 
										id="btn_exclui_movimento"
										class="btn btn-danger btn-xs  action botao_acao  "  
										data-toggle="tooltip" 
										data-movimento = {{ $movimento->id }}
										data-placement="bottom" 

		
										title="Exclui esse movimento"> 
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
	<!-- /page content -->

@endsection


@push("scripts")

	
	{{-- Vanilla Masker --}}
	<script src="{{ asset('js/vanillaMasker.min.js') }}"></script>
	

	<script>
		$(document).ready(function(){

			//configuração da tabela		 
			$.fn.dataTable.moment( 'DD/MM/YYYY' );
			
			var tabela_movimentos = $("#tb_movimentos").DataTable({
				language : {
					'url' : '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				}, 
				stateSave: false,
				stateDuration: -1,
				responsive: true,
				columnDefs: [
					{ "type": "num-fmt", targets: [4] },
					{ type: 'date-uk', targets: [0] },
					
					{ 
						render: function ( data, type, row )             
						{
							if( data == '---' || data == "") {
                            	return "";
							}else{
                            	return (moment(data).format("DD/MM/YYYY"));
							}
						},
						targets: [0],
					},  
					// { "width": "5%", "targets": 0 },
					// { "width": "5%", "targets": 1 },
					// { "width": "25%", "targets": 2 },
					// { "width": "15%", "targets": 3 },
					// { "width": "5%", "targets": 4 },
					// { "width": "25%", "targets": 5 },
					// { "width": "10%", "targets": 6 },

                    { "width": "5%", "targets": 0 },
					{ "width": "5%", "targets": 1 },
					// { "width": "25%", "targets": 2 },
					{ "width": "15%", "targets": 2 },
					{ "width": "5%", "targets": 3 },
					{ "width": "25%", "targets": 4 },
					{ "width": "10%", "targets": 5 },

				]			
			});

			//botão de edição
			$("table#tb_movimentos").on("click", "#btn_edita_movimento",function(){

				let id_movimento = $(this).data('movimento');
				let btn = $(this);

			});

			//botão de exclusão
			$("table#tb_movimentos").on("click", "#btn_exclui_movimento",function(){
				event.preventDefault();

				let id_movimento = $(this).data('movimento');
				let btn = $(this);
				

				swal({
					title: 'Confirma a EXCLUSÃO deste Material?',
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim',
					cancelButtonText: 'Não'
				}).then((result) => {
					if (result.value) {
						$.post("{{ url('movimento/') }}/"+id_movimento, {
							_token  : "{{ csrf_token() }}",
							_method : 'DELETE',
							id_movimento:	id_movimento,
							},function(data){
								if(data =="ok"){

									//exclui a linha no datatables
									$("table#tb_movimentos").DataTable().row( btn.parents('tr') ).remove().draw();
									
									swal(
										'Material EXCLUÍDO',
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