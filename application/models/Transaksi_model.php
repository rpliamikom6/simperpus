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

        public function checkout($data,$cart){
            if(!empty($cart)){
                $this->db->trans_begin();
    
                if($this->db->insert($this->table,$data)){
                    if(!$this->db->trans_status()==true){
                        $this->db->trans_rollback();
                        return false;
                    }
                    else{
                        $id_transaksi=$this->db->insert_id();
                    }
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
                unset($data);
                foreach($cart as $id_buku){
                    $data[]=array(
                        'id_transaksi'=>$id_transaksi,
                        'id_buku'=>$id_buku
                    );
                }
                
                if($this->db->insert_batch($this->table_detail,$data)){
                    if($this->db->trans_status()==true){
                        $this->db->trans_commit();
                        $this->session->unset_userdata('cart');
                        return true;
                    }
                    else{
                        $this->db->trans_rollback();
                        return false;
                    }
                }
            }
            else{
                return false;
            }
        }

        public function input_resi_peminjaman($id_transaksi=NULL,$resi){
            $this->db->trans_begin();

            $this->db->set('resi_pengiriman',$resi);
            $this->db->set('status',2);
            $this->db->where('id_transaksi',$id_transaksi);
            if($this->db->update($this->table)){
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

        public function input_resi_pengembalian($id_transaksi=NULL,$resi){
            $this->db->trans_begin();

            $this->db->set('id_metode_pengembalian',$resi['id_metode_pengembalian']);
            $this->db->set('resi_pengembalian',$resi['resi_pengembalian']);
            $this->db->set('status',4);
            $this->db->where('id_transaksi',$id_transaksi);
            if($this->db->update($this->table)){
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

        public function konfirmasi_peminjaman($id_transaksi,$status){
            if($status==1 || $status==99){
                $this->db->trans_begin();
                
                $this->db->set('status',$status);
                $this->db->where('id_transaksi',$id_transaksi);
                if($this->db->update($this->table)){
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
                return false;
            }
        }

        public function konfirmasi_pengembalian($id_transaksi){
            $this->db->trans_begin();
            
            $this->db->set('status',5);
            $this->db->where('id_transaksi',$id_transaksi);
            if($this->db->update($this->table)){
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
        
        public function konfirmasi_pengiriman($id_transaksi){
            $this->db->trans_begin();
            
            $this->db->set('status',3);
            $this->db->where('id_transaksi',$id_transaksi);
            if($this->db->update($this->table)){
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