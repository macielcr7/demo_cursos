<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title : 'Cursos' }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="{{ base_url('assets/datatables/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ base_url('assets/custom.css') }}">
    <script type="text/javascript">
    	window._ROOT_PATH = "<?php echo base_url('/'); ?>";
      window.__URL_BASE = "<?php echo site_url('/'); ?>";
    </script>
    @yield('styles')
  </head>
  <body>
  		<nav class="navbar navbar-inverse navbar-fixed-top">
		    <div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		            <a class="navbar-brand" href="#">Cursos</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		            <ul class="nav navbar-nav">
		                <li class="active"><a href="#">Curso</a></li>
		            </ul>
		        </div>
		        <!--/.nav-collapse -->
		    </div>
		</nav>

		<div class="container">
			@yield('content')
		</div>

    	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

    	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script type="text/javascript" src="{{ base_url('assets/datatables/datatables.min.js') }}"></script>
    	<script type="text/javascript" src="{{ base_url('assets/datatables/dataTables.bootstrap.js') }}"></script>
    	<script type="text/javascript" src="{{ base_url('assets/datatables/extensions/scroller.min.js') }}"></script>

    	@yield('scripts')

        <script type="text/javascript">
            @if(isset($successMessage) and !empty($successMessage))
                toastr.success('{{ $successMessage }}', 'Alerta');
            @endif
            @if(isset($dangerMessage) and !empty($dangerMessage))
                toastr.error('{{ $dangerMessage }}', 'Alerta');
            @endif
        </script>
  </body>
</html>