<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('cursos_model');
        $this->load->model('cursos_imagens_model');
    }

	public function index()
	{
		if($this->input->is_ajax_request()){
			$total 	= $this->cursos_model->listagem(array('search' => $this->input->get('search')['value']));
			$data 	= $this->cursos_model->listagem(array(
				'search' 	=> $this->input->get('search')['value'],
				'orderBy' 	=> $this->input->get('columns')[ $this->input->get('order')[0]['column'] ]['data'],
				'sorterd' 	=> $this->input->get('order')[0]['dir'],
				'start' 	=> $this->input->get('start'),
				'limit' 	=> $this->input->get('limit'),
				'count' 	=> false
			));

			$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode(array(
		        	'data'				=> $data,
		        	'draw'				=> $this->input->get('draw'),
                    'recordsTotal'		=> $total,
                    'recordsFiltered'	=> $total,
		        )));
		}
		else{
			$data = array(
				'successMessage' => $this->session->flashdata('successMessage'),
				'dangerMessage' => $this->session->flashdata('dangerMessage'),
			);

			return view('cursos/index', $data);
		}
	}

	public function cadastrar()
	{
		$data = $this->cursos_model->newModel();
		$imagens = $this->cursos_imagens_model->imagensCurso($data->id);
		
		return view('cursos/create', array(
			'data' 		=> $data,
			'imagens' 	=> $imagens
		));
	}

	public function editar($id)
	{
		$data = $this->cursos_model->getById($id);
		$imagens = $this->cursos_imagens_model->imagensCurso($id);
		
		return view('cursos/edit', array(
			'data' 		=> $data,
			'imagens' 	=> $imagens
		));
	}

	public function salvar(){
		$imagem_destaque = '';

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
        	$data = $this->upload->data();
        	chmod($data['full_path'],0777);
        	$imagem_destaque = $data['file_name'];
        }

        $id = $this->cursos_model->inserir(array(
        	'imagem_destaque' 	=> $imagem_destaque,
        	'titulo'			=> $this->input->post('titulo'),
        	'descricao'			=> $this->input->post('descricao'),
       	));

       	foreach ($this->input->post('imagens') as $key => $value) {
       		$this->cursos_imagens_model->inserir(array(
       			'id_curso'	=> $id,
       			'imagem' 	=> $value['imagem']
       		));
       	}

       	$this->session->set_flashdata('successMessage', 'Registro Cadastrado');
       	redirect('/');
	}

	public function atualizar($id){
		$imagem_destaque = $this->input->post('imagem_destaque');

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')){
        	$data = $this->upload->data();
        	chmod($data['full_path'],0777);
        	$imagem_destaque = $data['file_name'];
        }

        $this->cursos_model->atualizar(array(
        	'imagem_destaque' 	=> $imagem_destaque,
        	'titulo'			=> $this->input->post('titulo'),
        	'descricao'			=> $this->input->post('descricao'),
       	), $id);

       	foreach ($this->input->post('imagens') as $key => $value) {
       		$this->cursos_imagens_model->inserir(array(
       			'id_curso'	=> $id,
       			'imagem' 	=> $value['imagem']
       		));
       	}

       	$this->session->set_flashdata('successMessage', 'Registro Atualizado');
       	redirect('/');
	}

	public function deletar($id){
		$this->cursos_model->deletar($id);
       	$this->session->set_flashdata('successMessage', 'Registro Deletado');
       	redirect('/');
	}

	public function upload(){
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file')){
        	$this->output->set_status_header(500, "Houve um erro no Upload");
        }
        else{
        	$data = $this->upload->data();
        	chmod($data['full_path'],0777);

        	$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode(array(
		        	'data' => $data,
		        )));
        }
	}

	public function remover_imagem(){
		if(!empty($this->input->post('id_img'))){
			$this->cursos_imagens_model->deleteById($this->input->post('id_img'));
		}
		unlink('./uploads/'.$this->input->post('imagem'));

		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode(array(
	        	'success' => true,
	        )));
	}
}
