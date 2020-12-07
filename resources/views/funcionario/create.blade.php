@extends('gentelella.layouts.app')
@section('content')
<div class="x_panel modal-content ">

	<div class="x_title">
	   <h2><i class="fas fa-medkit"></i> {{$titulo}} </h2>
	   <div class="clearfix"></div>
	</div>

	<div class="x_panel ">
	   <div class="x_content">

		   	@if( isset($funcionario))
			
				<form id="frm_funcionario" class="form-horizontal form-label-left needs-validation" method="post" action="{{ url("funcionario/$funcionario->id")}}" >
					<input type="hidden" id="funcionario_id" class="form-control " name="funcionario_id" value="{{$funcionario->id}}"  >	
   					{!! method_field('PUT') !!}
			@else
				<form id="frm_funcionario" class="form-horizontal form-label-left needs-validation" method="post" action="{{ route('funcionario.store') }}" >
			@endif

				{{ csrf_field()}}

				<div class="form-group row">
					<div class=" form-group col-md-7 col-sm-7 col-xs-12">
						<label class="control-label" >Nome</label>
						<input type="text" id="nome" class="form-control " name="nome"   
						value="{{ isset($funcionario) ? $funcionario->nome : old('$nome')}}" >	
					</div>

					<div class=" form-group col-md-3 col-sm-3 col-xs-12">
						<label class="control-label" >CPF</label>
						<input type="text" id="cpf" class="form-control " name="cpf"   
						value="{{ isset($funcionario) ? $funcionario->cpf: old('$cpf')}}" >	
					</div>		
				</div>

				{{-- BOTÕES --}}
				<div class="clearfix"></div>
				<div class="ln_solid"> </div>
   		   		<div class="footer text-center"> {{-- col-md-3 col-md-offset-9 --}}
					<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" 
							data-funcionario = "{{isset($funcionario) ? $funcionario->funcionario : old('funcionario')}}" >
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
				let url = "{{url("funcionario")}}" ;
				document.location.href=url;
			});


			//botão de salvar
			$("#btn_salvar").click(function(){
				event.preventDefault();
				$( "#frm_funcionario" ).submit();
			});
		});
   </script>

@endpush
