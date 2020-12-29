<?php
    class Katalog_model extends CI_Model {
        var $table='buku';

        public function get_data(){
            return $this->db->get($this->table);
        }

    }
?>