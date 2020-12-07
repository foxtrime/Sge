@extends('gentelella.layouts.app')

@section('content')
   <div class="x_panel modal-content ">
	  	<div class="x_title">
		 	<h2> Materiais </h2>
		 	<a href="{{ url('material/create') }}" 
				class="btn-circulo btn btn-primary btn-md   pull-right " 
				data-toggle="tooltip"  
				data-placement="bottom" 
				title="Adiciona um Material">
				<span class="fa fa-plus">  </span>
		 	</a>
		 	<div class="clearfix"></div>
	    </div>
	    <div class="x_panel ">
		    <div class="x_content">
                <table class="table table-hover table-striped compact" id="tb_materiais">
					<thead>
						<tr>
							<th>Modelo</th> 
							<th>Quantidade</th> 

							<th>Ações</th>
						</tr>						
					</thead>

					<tbody>
						@foreach($materiais as $key=> $material)
							<tr>
								<td> {{$material->modelo}}</td> 
								<td> {{$material->quantidade}}</td> 
								
								<td class="actions">

									<a href="{{ url("material/$material->id/edit") }}" 
										id="btn_edita_material"
										class="btn btn-warning btn-xs action botao_acao " 
										data-toggle="tooltip" 
										data-material = {{ $material->id }}
										data-placement="bottom" 
		
										title="Edita esse material">  
										<i class="glyphicon glyphicon-pencil "></i>
									</a>

									<a href="#" 
										id="btn_exclui_material"
										class="btn btn-danger btn-xs  action botao_acao  "  
										data-toggle="tooltip" 
										data-material = {{ $material->id }}
										data-placement="bottom" 

		
										title="Exclui esse material"> 
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
			
			var tabela_materiais = $("#tb_materiais").DataTable({
				language : {
					'url' : '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				}, 
				stateSave: false,
				stateDuration: -1,
				responsive: true,
				columnDefs: [
					// { "width": "20%", "targets": 0 },
					// { "width": "30%", "targets": 1 },
					// { "width": "10%", "targets": 2 },
					// { "width": "10%", "targets": 3 },
					// { "width": "10%", "targets": 4 },

					{ "width": "50%", "targets": 0 },
					{ "width": "40%", "targets": 1 },
					{ "width": "10%", "targets": 2 },

				]			
			});

			//botão de edição
			$("table#tb_materiais").on("click", "#btn_edita_material",function(){

				let id_material = $(this).data('material');
				let btn = $(this);

			});

			//botão de exclusão
			$("table#tb_materiais").on("click", "#btn_exclui_material",function(){
				event.preventDefault();

				let id_material = $(this).data('material');
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
						$.post("{{ url('material/') }}/"+id_material, {
							_token  : "{{ csrf_token() }}",
							_method : 'DELETE',
							id_material:	id_material,
							},function(data){
								if(data =="ok"){

									//exclui a linha no datatables
									$("table#tb_materiais").DataTable().row( btn.parents('tr') ).remove().draw();
									
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