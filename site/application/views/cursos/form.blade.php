@section('styles')
@parent
    <link rel="stylesheet" href="{{ base_url('assets/dropzone.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.3/css/lightgallery.min.css">
    <style type="text/css">
        .light-modal {
            background: rgba(0,0,0,.5)!important;
            display: flex!important;
            visibility: visible!important;
        }
        .image-previewer{
            text-align: center;
            max-width: 100%;
        }
        #custom-transitions{
            margin: 10px;
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
            min-height: 150px;
            padding: 10px;
        }
        .remove-btn{
            position: absolute;
            top: -10px;
            right: 5px;
            padding: 2px;
            z-index: 2;
            cursor: pointer;
        }
        .remove-btn i{
            color: red;
            font-size: 20px;
            background: white;
            border-radius: 50%;
            padding: 3px;
        }
    </style>
@stop

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label class="col-sm-3 control-label">Titulo:</label>
            <div class="col-sm-9">
                <input type="text" required="required" id="titulo" name="titulo" class="form-control" value="{{ $data->titulo }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Descrição:</label>
            <div class="col-sm-9">
                <textarea required="required" id="descricao" name="descricao" class="form-control" rows="5">{{ $data->descricao }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <input type="hidden" name="imagem_destaque" value="{{ $data->imagem_destaque }}">
        <div style="text-align: center;">
            @if(!empty($data->imagem_destaque))
                <img src="{{ base_url('uploads/'.$data->imagem_destaque) }}" class="img-rounded" style="width: 100%;">
            @endif
            <label for="input" class="image-previewer">Selecione uma Imagem de Destaque</label>
            <input id="input" name="file" {{ $data->imagem_destaque=='' ? 'required="required"' : ''}} class="form-control" type="file" accept="image/*">
            <!--<button onclick="alert(cropzeeGetImage('input'))">Get Image (as blob / data-url)</button>-->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6"><b>Galeria de Imagens</b></div>
    <div class="col-sm-6 text-right">
        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-add-img">Adicionar Imagens</a>
    </div>
    <div class="col-sm-12 demo-gallery dark mrb35">
        <ul id="custom-transitions" class="list-unstyled row">
            @foreach($imagens as $key => $item)
                <li class="col-xs-6 col-sm-4 col-md-3" data-src="{{ base_url('uploads/'.$item->imagem) }}">
                    <span attr-id="{{ $item->id }}" attr-img="{{ $item->imagem }}" class="remove-btn"><i class="glyphicon glyphicon-remove-circle"></i></span>
                    <a href="">
                        <img class="img-responsive" src="{{ base_url('uploads/'.$item->imagem) }}">
                        <!--<div class="demo-gallery-poster">
                            <img src="{{ base_url('assets/zoom.png') }}">
                        </div>-->
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row btn-form-bottom">
    <div class="col-xs-12">
        <div class="pull-right">
            <div> 
                <button type="submit" class="btn btn-success btn-lg save-btn">
                    <i class="fa fa-save append-icon"></i> Salvar
                </button> 
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.3/js/lightgallery-all.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('descricao');

        $('body').on('click', '.remove-btn', function(e){
            let el = $(this);
            $.ajax({
                method: "POST",
                url: "{{ site_url('cursos/remover_imagem') }}",
                dataType: 'json',
                data: { 
                    id_img: el.attr('attr-id'), 
                    imagem: el.attr('attr-img'),
                }
            })
            .done(function( json ) {
                el.parents('li').remove();
            });
        });

        var totalImgs = $('#custom-transitions li input').length-1;
        $('.btn-add-img').click(function(){
            var dialog = bootbox.dialog({
                title: 'Envio de Imagens - Galeria.',
                message:    '<div id="dropzone">'+
                            '    <div action="{{ site_url("cursos/upload") }}" class="needsclick" id="demo-upload">'+
                            '      <div class="dz-message needsclick">'+
                            '        <button type="button" class="dz-button">Solte os arquivos aqui ou clique para fazer o upload.</button><br />'+
                            '        <span class="note needsclick">Envio de imagens para a galeria.</span>'+
                            '      </div>'+
                            '    </div>'+
                            '</div>',
                size: 'large'
            });

            $('#demo-upload').dropzone({
                success: function(file, data){
                    var slide = $('#custom-transitions');
                    totalImgs++;
                    slide.append('<li class="col-xs-6 col-sm-4 col-md-3" data-src="{{ base_url('uploads/') }}'+data.data.file_name+'"><span attr-id="" attr-img="'+data.data.file_name+'" class="remove-btn"><i class="glyphicon glyphicon-remove-circle"></i></span><a href="">'+
                    '<input type="hidden" name="imagens['+totalImgs+'][imagem]" value="'+data.data.file_name+'" /><img class="img-responsive" src="{{ base_url('uploads/') }}'+data.data.file_name+'">'+
                    //'<div class="demo-gallery-poster"><img src="{{ base_url('assets/zoom.png') }}"></div>'+
                    '</a></li>');
                    /*slide.data('lightGallery').destroy(true);
                    slide.lightGallery({
                        mode: 'lg-fade'
                    });*/

                }
            });

            $('#demo-upload').addClass('dropzone');
        });

        /*$('#custom-transitions').lightGallery({
            mode: 'lg-fade'
        });*/
        //$('#demo-upload').dropzone();$('#demo-upload').addClass('dropzone')
    </script>
@stop