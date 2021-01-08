<?php
    class Transaksi_model extends CI_Model {
        var $table='transaksi';
        var $table_detail='detail_transaksi';

        public function get_data($id=NULL,$limit=NULL){
            $this->db->join('user','user.id='.$this->table.'.id_user');
            $this->db->join('master_person','master_person.id=user.id_master_person');
            if(isset($id)){
                $this->db->where($this->table.'.id_transaksi',$id);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            return $this->db->get($this->table);
        }

        public function get_cart($cart){
            foreach($cart as $keranjang){
                $this->db->or_where('id_buku',$keranjang);
            }
            $this->db->join('penerbit','penerbit.id_penerbit=buku.id_penerbit');
            return $this->db->get('buku');
        }
        public function get_detail($id_transaksi,$id_buku=NULL){
            if(isset($id_transaksi)){
                $this->db->where($this->table_detail.'.id_transaksi',$id_transaksi);
            }
            if(isset($id_buku)){
                $this->db->where($this->table_detail.'.id_buku',$id_buku);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            $this->db->join('buku','buku.id_buku='.$this->table_detail.'.id_buku');
            $this->db->join('penerbit','penerbit.id_penerbit=buku.id_penerbit');
            return $this->db->get($this->table_detail);
        }

        public function update_status($id_transaksi,$status){
            $this->db->where('id_transaksi',$id_transaksi);
            $this->db->set('status',$status);
            return $this->db->update($this->table);
        }

        public function add($data){
            $this->db->trans_begin();

            if($this->db->insert($this->table,$data)){
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

        public function edit($id,$data){
            $this->db->trans_begin();

            $this->db->where('id_penerbit',$id);
            if($this->db->update($this->table,$data)){
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

        public function delete($id){
            $this->db->trans_begin();

            $this->db->where('id_penerbit',$id);
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
    }
?>