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
				<form id="frm_material" class="form-horizontal form-label-left needs-validation" method="post" action="{{ route('material.store') }}" >
			@endif

				{{ csrf_field()}}
				
				<div class="form-group row">				
					<div class=" form-group col-md-5 col-sm-5 col-xs-12">
						<label class="control-label" >Modelo</label>
						<input type="text" id="modelo" class="form-control " name="modelo"   
						value="{{ isset($material) ? $material->modelo : old('$modelo')}}" >	
					</div>

				{{-- 	<div class=" form-group col-md-2 col-sm-2 col-xs-12">
						<label class="control-label" >Quantidade</label>
						<input type="number" id="quantidade" class="form-control " name="quantidade"   
						value="{{ isset($material) ? $material->quantidade: old('$quantidade')}}" >	
					</div> --}}
					
					{{-- <div class=" form-group col-md-2 col-sm-2 col-xs-12">
						<label class="control-label" >Qtd. mínima</label>
						<input type="number" id="qtd_min" class="form-control " name="qtd_min"   
						value="{{ isset($material) ? $material->qtd_min: old('$qtd_min')}}" >	
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
			
		});
   </script>

@endpush
