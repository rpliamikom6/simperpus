<?php
    class Kategori_model extends CI_Model {
        var $table='kategori';

        public function get_data(){
            return $this->db->get($this->table);
        }

    }
?>