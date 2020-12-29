<?php
    class Katalog_model extends CI_Model {
        var $table='buku';

        public function get_data($id=NULL){
            if(isset($id)){
                $this->db->where('id_buku',$id);
                $this->db->limit(1);
            }
            return $this->db->get($this->table);
        }

        public function get_data_detail_buku($id_buku){
            $this->db->where('id_buku',$id_buku);
            return $this->db->get('detail_buku');
        }

    }
?>