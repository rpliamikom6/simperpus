<?php
    class Akun_model extends CI_Model {
        var $table='admin';

        public function login($username,$password){
            $this->db->where('username',$this->db->escape_str($username));
            $this->db->where('password',md5($password));
            $this->db->limit(1);
            if($query=$this->db->get($this->table)){
                if($query->num_rows()){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        public function add($data){
            
            $this->db->trans_begin();
            
            if($data['id_master_person']==0){
                $mp=$data['mp'];
                if($this->db->insert($this->table,$mp)){
                    if($this->db->trans_status()==false){
                        $this->db->trans_rollback();
                        return false;
                    }
                }
                else{
                    $this->db->trans_rollback();
                    return false;
                }
            }
            unset($data['mp']);

            $data['password']=md5($data['password']);

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

            $this->db->where('id',$id);
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

            $this->db->where('id',$id);
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