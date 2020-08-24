<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cursos_Imagens_model extends CI_Model
{

    public function imagensCurso($curso_id){
        if(!empty($curso_id)){
            $this->db->select('cursos_imagens.*');
            $this->db->from('cursos_imagens');
            $this->db->where('id_curso', $curso_id);
            return $this->db->get()->result();
        }
        else{
            return array();
        }
    }

    public function deleteById($id){
        $this->db->delete('cursos_imagens', array('id' => $id)); 
    }

    public function inserir($data){
        $this->db->insert('cursos_imagens', $data);
        return $this->db->insert_id();
    }
}