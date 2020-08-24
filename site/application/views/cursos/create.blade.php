@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" class="form-horizontal" action="{{ site_url('cursos/salvar') }}" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">Cadastrar Curso</h6>
                    </div>
                    <div class="panel-body">
                        @include('cursos.form')
                    </div>
                </div>
            </form>     
        </div>
    </div>
@stop
