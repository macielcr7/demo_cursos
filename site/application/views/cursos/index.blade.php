@extends('layouts.master')

@section('content')
	<div class="panel panel-default">
        <div class="panel-heading">
        	<div class="row">
        		<div class="col-sm-8">
        			<h6 class="panel-title">Listagem de Cursos</h6>
        		</div>
        		<div class="col-sm-4" style="text-align: right;">
        			<a href="{{ site_url('cursos/cadastrar') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus position-left"></i> Cadastrar</a>
        		</div>
        	</div>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table id="table-data" class="small table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th class="actions">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
	<script type="text/javascript">
		function prepareDataIndex(json){
            for(var i=0;i<json.data.length;i++){
                json.data[i].seq = i+1;
            }
            return json;
        }
        $('#table-data').DataTable({
            "ajax": {
                "url": "<?php echo site_url('/');?>",
                "dataSrc": function ( json ) {
                    json = prepareDataIndex(json);
                    window._dataJSON = json;
                    return json.data;
                }
            },
            
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "paging": true,
            "info": true,

            "language": {
                "url": window._ROOT_PATH+"assets/datatables/Portuguese-Brasil.json"
            },

            "pagingType": "bootstrap",
            "pageLength": 25,
            "order": [[ 1, "asc" ]],
            "columns": [
                { "data": "id" },
                { "data": "titulo" },
                { "data": "descricao" },
                { "data": "acoes" }
            ],
            "aoColumnDefs":[
                {
                    "aTargets": [ 0 ],
                    "mRender": function ( data, type, full )  {
                        var i = data-1;
                        return '<input indexData="'+i+'" type="hidden" class="row-selected" value="'+i+'" /> '+data;
                    }
                },
                {
                    "aTargets": [ 3 ],
                    "bSortable": false,
                    "mRender": function ( data, type, full )  {
                        return '<a href="'+__URL_BASE+'cursos/'+full.id+'/editar" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"></i></a>'+
                                '<a href="'+__URL_BASE+'cursos/'+full.id+'/deletar" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove-circle"></i></a>';
                    }
                }
            ]
        });

        $('body').on('click', '.btn-danger', function(e){
            let link = $(this);
            e.preventDefault();
            bootbox.confirm({
                message: "Deseja remover o curso?",
                buttons: {
                    confirm: {
                        label: 'Sim',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Não',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result==true){
                        $.ajax({
                            url: link.attr('href'),
                            dataType: 'json'
                        })
                        .done(function( json ) {
                            $('#table-data').DataTable().ajax.reload();
                        });
                    }
                }
            });
        });
	</script>
@stop
