@extends('gentelella.layouts.app')

@section('htmlheader_title', 'Home')

@section('content')
   <div class="x_panel modal-content ">

	<div class="x_title">
	   <h2><i class="fas fa-medkit"></i> {{$titulo}} </h2>
	   <div class="clearfix"></div>
	</div>

	<div class="x_panel ">
	   <div class="x_content">

		   	@if( isset($material))
			
				<form id="frm_material" class="form-horizontal form-label-left needs-validation" method="post" action="{{ url("material/$material->id")}}" >
					<input type="hidden" id="material_id" class="form-control " name="material_id" value="{{$material->id}}"  >	
   					{!! method_field('PUT') !!}
			@else
				<form id="frm_material" class="form-horizontal form-label-left needs-validation" method="post" action="{{ url('saida') }}" >
			@endif

				{{ csrf_field()}}
				
				<div class="form-group row">
					<div class="x_panel ">
						<div class="x_content">
							<input type="hidden" id="funcionario" 	name="funcionario">
							<table class="table table-hover table-striped compact" id="tb_funcionarios">
								<thead>
									<tr>
										<th>Nome</th> 
										<th>CPF</th> 
										{{-- <th>Secretaria</th>  --}}
										{{-- <th>Departamento</th>  --}}
										<th>Selecionar</th> 
									</tr>						
								</thead>
			
								<tbody>
									@foreach($funcionarios as $key=> $funcionario)
										<tr>
											<td> {{$funcionario->nome}}</td> 
											<td> {{$funcionario->cpf}}</td> 
											{{-- <td> {{$funcionario->departamento->secretaria}}</td>  --}}
											{{-- <td> {{$funcionario->departamento->nome}}</td>  --}}
											<td class="actions">
			
												<a href="#" 
													id="btn_seleciona_funcionario"
													class="btn btn-success btn-xs action botao_acao " 
													data-toggle="tooltip" 
													data-funcionario = {{ $funcionario->id }}
													data-placement="bottom" 
					
													title="Seleciona o funcionario">  
													<i class="glyphicon glyphicon-ok "></i>
												</a>
											</td>
										</tr>
								
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="form-group col-md-3 col-sm-3 col-xs-12">
						<label class="control-label" for="material_id">Material</label>
						<select name = "material_id" id="material_id" class="form-control  selectpicker error" 
							data-style="select-with-transition has-dourado" required autofocus>
							<option value="0"> Selecione... </option>
							@if (isset($material))
								@foreach($materiais as $material)
									@if ( $material->material == $material)
										<option value="{{$material->id}}" selected="selected"> {{$material->modelo}}</option>
									@else
										<option value="{{$material->id}}"> {{$material->modelo}}</option>
									@endif
								@endforeach
							@else
								@foreach($materiais as $material)
									@if (old('material_id') == $material)
										<option value="{{$material->id}}" selected> {{$material->modelo}}</option>
									@else
										<option value="{{$material->id}}"> {{$material->modelo}}</option>
									@endif
								@endforeach
							@endif
						</select>	
					</div>
					<div class=" form-group col-md-2 col-sm-2 col-xs-12">
						<label class="control-label" >Quantidade no estoque</label>
						<input type="text" id="qtd" class="form-control " name="qtd" value=0 disabled >	
					</div>

				 	<div class=" form-group col-md-2 col-sm-2 col-xs-12">
						<label class="control-label" >Quantidade</label>
						<input type="number" id="quantidade" class="form-control " name="quantidade"   
						>	
					</div>

					{{-- <div class="form-group col-md-5 col-sm-5 col-xs-12">
						<label class="control-label" for="departamento_id">Departamento</label>
						<select name = "departamento_id" id="departamento_id" class="form-control  selectpicker error" 
							data-style="select-with-transition has-dourado" required autofocus>
							<option value=""> Selecione... </option>
							@if (isset($movimento))
								@foreach($departamentos as $departamento)
									@if ( $funcionario->departamento_id == $departamento->id)
										<option value="{{$departamento->id}}" selected="selected"> {{$departamento->nome}} </option>
									@else
										<option value="{{$departamento->id}}"> {{$departamento->nome}} </option>
									@endif
								@endforeach
							@else
								@foreach($departamentos as $departamento)
									@if (old('departamento_id') == $departamento)
										<option value="{{$departamento->id}}" selected> {{$departamento->nome}} - {{$departamento->secretaria}}</option>
									@else
										<option value="{{$departamento->id}}"> {{$departamento->nome}} - {{$departamento->secretaria}}</option>
									@endif
								@endforeach
							@endif
						</select>	
					</div> --}}
					
				</div>
				{{-- BOTÕES --}}
				<div class="clearfix"></div>
				<div class="ln_solid"> </div>
   		   		<div class="footer text-center"> {{-- col-md-3 col-md-offset-9 --}}
					<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" 
							data-material = "{{isset($material) ? $material->material : old('material')}}" >
						<span class="icone-botoes-acao mdi mdi-backburger"></span>   
						<span class="texto-botoes-acao"> CANCELAR </span>
						<div class="ripple-container"></div>
					</button>
			
					<button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
						<span class="icone-botoes-acao mdi mdi-send"></span>
						<span class="texto-botoes-acao"> SALVAR </span>
						<div class="ripple-container"></div>
					</button>
				</div>
   		</form>
	   </div>
	</div>

@endsection

@push("scripts")

	{{-- Vanilla Masker --}}
	<script src="{{ asset('js/vanillaMasker.min.js') }}"></script>



	<script>
		//foco no nome ao carregar
		$( "#fabricante" ).focus();

		VMasker ($("#cpf")).maskPattern("999.999.999-99");
		
	
		$(document).ready(function(){
			//configuração da tabela		 
			$.fn.dataTable.moment( 'DD/MM/YYYY' );
			
			var tabela_funcionarios = $("#tb_funcionarios").DataTable({
				pageLength: 3,
				lengthChange: false,
				/* select: true, */
				language : {
					'url' : '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
				}, 
				stateSave: false,
				stateDuration: -1,
				responsive: true,
				columnDefs: [
					{ "width": "60%", "targets": 0 },
					{ "width": "30%", "targets": 1 },
					// { "width": "10%", "targets": 2 },
					// { "width": "30%", "targets": 3 },
					{ "width": "10%", "targets": 2 },
			
				]			
			});
			

			tabela_funcionarios.on( 'click', '#btn_seleciona_funcionario', function () {
				event.preventDefault();
				let id_funcionario = $(this).data('funcionario');
				let btn = $(this);
				let inputValue;

				var closestRow = $(this).closest('tr');
				var data = tabela_funcionarios.row(closestRow).data();
				var taskID = data[0];
				var departamento = data[3] +" - " +data[2];

				if ( closestRow.hasClass('selected') ) {
					closestRow.removeClass('selected');
					$("#departamento_id").val("").change();

					//seta a campo hidden do formulario
					$( "#funcionario" ).val() = "";
				}else {
					tabela_funcionarios.$('tr.selected').removeClass('selected');
					closestRow.addClass('selected');
					$("#departamento_id option:contains(" + departamento.trim() + ")").prop('selected', 'selected').change();		

					//seta a campo hidden do formulario
					$( "#funcionario" ).val(data[1])  ;	
				}
			
			} );


			//transforma todas as letras do input em MAIÚSCULAS
			$('input').keyup(function() {
				this.value = this.value.toLocaleUpperCase();
			});
		 	
			
			
			//botão de cancelar
			$("#btn_cancelar").click(function(){
				event.preventDefault();
				//window.history.back();
				let url = "{{url("material")}}" ;
				document.location.href=url;
			});


			//botão de salvar
			$("#btn_salvar").click(function(){
				event.preventDefault();

				$( "#frm_material" ).submit();
			});
			
			$("select#material_id").change(function() {
				let material_id = $("select#material_id").find(":selected").val();

				$.get(url_base + "/api/buscaMaterial/" + material_id , function(resultado){

					qtd_min = resultado[0]['qtd_min'];
					qtd 	= resultado[0]['quantidade'];

					$("#qtd_min").val(qtd_min) ; 
					$("#qtd").val(qtd) ; 

				});
			})

		});
   </script>

@endpush
