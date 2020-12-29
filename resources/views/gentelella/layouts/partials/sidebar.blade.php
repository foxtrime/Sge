<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">

			<li>
				<a href="{{ route('home')}}"><i class="fas fa-home"></i> Principal </a>
			</li>
			

			<li><a><i class="fas fa-dolly"></i> Movimentos <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/movimento") }}">		<i class="fas fa-exchange-alt">	</i> Movimentos </a>
					<li><a href="{{ url("/saida") }}">			<i class="fas fa-sign-out-alt">	</i> Saída </a>
					<li><a href="{{ url("/entrada") }}">		<i class="fas fa-sign-in-alt">	</i> Entrada </a>
					
				</ul>
			</li>		
			<li><a><i class="fas fa-boxes"></i> Materiais <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/material") }}">		<i class="fas fa-boxes">		</i> Materiais </a>
					{{-- <li><a href="{{ url("/grupo") }}">	<i class="fas fa-bars">			</i> Grupos </a> --}}
					
				</ul>
			</li>		
		{{-- 
			<li><a><i class="fas fa-print"></i> Impressoras <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/impressora") }}">	<i class="fas fa-print">	</i> Impressoras </a>
					<li><a href="{{ url("/modelo") }}">		<i class="fas fa-bars">	</i> Modelos </a>
					<li><a href="{{ url("/fabricante") }}">	<i class="fas fa-bars">	</i> Fabricantes </a>
					
				</ul>
			</li>		--}}

			<li><a><i class="fas fa-user"></i> Funcionários <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/funcionario") }}">	<i class="fa fa-user">	</i> Funcionários </a>
				</ul>
			</li>		
			{{-- <li><a><i class="fas fa-building"></i> Locais <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/sede") }}">							<i class="fa fa-list">	</i> Sedes </a>
					<li><a href="{{ url("/departamento") }}">					<i class="fa fa-list">	</i> Departamentos </a> 
				</ul>
			</li>		
				 --}}

			

			<li>
				{{-- <a href="{{ route('logout')}}"><i class="fa fa-sign-out"></i> Sair do sistema </a> --}}
				<a href="{{ url('logout')}}"><i class="fa fa-sign-out"></i> Sair do sistema</a>
			</li>

		</ul>	
			
	</div>
</div>


