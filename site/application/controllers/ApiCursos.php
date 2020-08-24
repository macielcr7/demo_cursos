<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiCursos extends CI_Controller {

	public function __construct()
    {
    	header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct();
        $this->load->model('cursos_model');
        $this->load->model('cursos_imagens_model');
    }

	public function index()
	{
		$data 	= $this->cursos_model->listagem(array(
			'count' => false
		));
		$response = array();
		foreach ($data as $key => $value) {
			$value->imagem_destaque = base_url('/uploads/'.$value->imagem_destaque);
			$response[] = $value;
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode(array(
	        	'data' => $data,
	        )));
	}

	public function show($id)
	{
		$data = $this->cursos_model->getById($id);
		$imagens = $this->cursos_imagens_model->imagensCurso($id);
		$response = array();
		$data->imagem_destaque = base_url('/uploads/'.$data->imagem_destaque);
		foreach ($imagens as $key => $value) {
			$value->imagem = base_url('/uploads/'.$value->imagem);
			$response[] = $value;
		}
		$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode(array(
	        	'data' 		=> $data,
	        	'imagens' 	=> $response,
	        )));
	}
}
