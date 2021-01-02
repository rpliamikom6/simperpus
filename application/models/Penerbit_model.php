<?php
    class Penerbit_model extends CI_Model {
        var $table='penerbit';

        public function get_data($id=NULL,$limit=NULL){
            if(isset($id)){
                $this->db->where('id',$id);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            return $this->db->get($this->table);
        }

    }
?>