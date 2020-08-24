<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cursos_model extends CI_Model
{

    private function _listagem($params=[]){
        $paramsDefault = array(
            'search'    => '',
            'orderBy'   => false,
            'sorterd'   => false,
            'start'     => false,
            'limit'     => false,
            'count'     => true
        );

        $params = array_merge($paramsDefault, $params);

        $this->db->from('cursos');
        if(!empty($params['search'])){
            $this->db->where("
                (
                    titulo like '%{$params['search']}%' or
                    descricao like '%{$params['search']}%'
                )
            ");
        }

        if($params['count']!==true){
            $this->db->select('cursos.*');

            if($params['start']!=false and $params['limit']!=false){
                $this->db->limit($params['start'], $params['limit']);
            }
            if($params['orderBy']!=false and $params['sorterd']!=false){
                $this->db->order_by($params['orderBy'], $params['sorterd']);
            }
            
            return $this->db->get()->result();
        }
        else{
            $this->db->select('COUNT(*) as total');
            return $this->db->get()->row()->total;
        }
    }

    public function listagem($params=[]){
        return $this->_listagem($params);
    }

    public function newModel(){
        $fields = $this->db->list_fields('cursos');
        foreach ($fields as $key => $field) {
            $this->$field = '';
        }
        return $this;
    }

    public function inserir($data){
        $this->db->insert('cursos', $data);
        return $this->db->insert_id();
    }

    public function atualizar($data, $id){
        $this->db->where('id', $id);
        $this->db->update('cursos', $data);
    }

    public function deletar($id){
        $this->db->delete('cursos', array('id' => $id)); 
    }

    public function getById($id){
        $this->db->from('cursos');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
}