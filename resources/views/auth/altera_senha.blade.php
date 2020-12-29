@extends('gentelella.layouts.app')

@section('htmlheader_title', 'Home')

@section('content')
   
<div class="row">
   <div class="col-md-4"></div>
   <div class="col-md-4">
      <div class="x_panel">
         <div class="x_title">
            <center> Alteração de Senha</center>             
         </div>
         <div class="x_content">
            <form action="{{ url('salvasenha') }}" method="POST" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">
               {{ csrf_field() }}
               <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="senha-atual">Senha Atual<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 ">
                     <input type="password" name="password_atual" required="required" class="form-control ">
                  </div>
               </div>
               <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nova-senha">Nova Senha<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 ">
                     <input type="password" name="password" required="required" class="form-control">
                  </div>
               </div>
               <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="confirmacao">Confirmar Senha<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 ">
                     <input type="password" name="password_confirmation" required="required" class="form-control">
                  </div>
               </div>
               <div class="ln_solid"></div>
               <div class="item form-group">
                  <div>
                     <center>
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                     </center>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-md-4"></div>
</div>

@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            var tempo = 0;
            var incremento = 500;
            
            // Testar se há algum erro, e mostrar a notificação
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
                    tempo += incremento;
                @endforeach
            @endif
            demo.initFormExtendedDatetimepickers();
        });
        function enviaForm(){
            document.getElementById("form-altera-senha").submit();
        }
        function VoltaPagina() {
            window.history.back();
        }
    </script>

@endpush