<?php
    class Katalog_model extends CI_Model {
        var $table='buku';

        public function get_data($id=NULL,$limit=NULL){
            if(isset($id)){
                $this->db->where('id_buku',$id);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            return $this->db->get($this->table);
        }

        public function add($data){
            $this->db->trans_begin();

            $i=0;
            if(isset($data['detail_buku']['detail'])){
                foreach($data['detail_buku']['detail'] as $d_buku){
                    $detail_buku[$i]['detail']=$d_buku;
                }
                $i=0;
                foreach($data['detail_buku']['value'] as $d_buku){
                    $detail_buku[$i]['value']=$d_buku;
                }
                unset($data['detail_buku']);
            }

            if($this->db->insert($this->table,$data)){
                if($this->db->trans_status()==false){
                    $this->db->trans_rollback();
                    return false;
                }
                else{
                    $id_buku=$this->db->insert_id();
                }
            }
            else{
                if($this->db->trans_status()==false){
                    $this->db->trans_rollback();
                    return false;
                }
            }

            for ($i=0; $i < sizeof($detail_buku); $i++) { 
                $detail_buku[$i]['id_buku']=$id_buku;
            }
            
            if(isset($detail_buku)){
                if($this->db->insert_batch('detail_buku',$detail_buku)){
                    if($this->db->trans_status()==true){
                        $this->db->trans_commit();
                        return true;
                    }
                    else{
                        $this->db->trans_rollback();
                        return false;
                    }
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else{
                if($this->db->trans_status()==true){
                    $this->db->trans_commit();
                    return true;
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }

        public function edit($id,$data){
            $this->db->trans_begin();

            $i=0;
            if(isset($data['detail_buku']['detail'])){
                foreach($data['detail_buku']['detail'] as $d_buku){
                    $detail_buku[$i]['detail']=$d_buku;
                }
                $i=0;
                foreach($data['detail_buku']['value'] as $d_buku){
                    $detail_buku[$i]['value']=$d_buku;
                }
                unset($data['detail_buku']);
            }

            $this->db->where('id_buku',$id);
            if($this->db->update($this->table,$data)){
                if($this->db->trans_status()==false){
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else{
                if($this->db->trans_status()==false){
                    $this->db->trans_rollback();
                    return false;
                }
            }

            for ($i=0; $i < sizeof($detail_buku); $i++) { 
                $detail_buku[$i]['id_buku']=$id;
            }

            $this->db->where('id_buku',$id);
            if($this->db->delete('detail_buku')){
                if($this->db->trans_status()==false){
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else{
                $this->db->trans_rollback();
                return false;
            }
            
            if(isset($detail_buku)){
                if($this->db->insert_batch('detail_buku',$detail_buku)){
                    if($this->db->trans_status()==true){
                        $this->db->trans_commit();
                        return true;
                    }
                    else{
                        $this->db->trans_rollback();
                        return false;
                    }
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else{
                if($this->db->trans_status()==true){
                    $this->db->trans_commit();
                    return true;
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
        }

        public function delete($id){
            $this->db->trans_begin();

            if($this->db->delete($this->table)){
                if($this->db->trans_status()==true){
                    $this->db->trans_commit();
                    return true;
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else{
                $this->db->trans_rollback();
                return false;
            }
        }

        public function get_detail_buku($id_buku){
            $this->db->where('id_buku',$id_buku);
            return $this->db->get('detail_buku');
        }

        public function get_data_detail_buku($id_buku){
            $this->db->where('id_buku',$id_buku);
            return $this->db->get('detail_buku');
        }

        public function hapus_detail($id_buku,$detail){
            $this->db->where('id_buku',$id_buku);
            $this->db->where('detail',$this->db->escape_str($detail));

            return $this->db->delete('detail_buku');
        }

    }
?>