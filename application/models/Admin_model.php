<?php
    class Admin_model extends CI_Model {
        var $table='admin';

        public function get_data($id=NULL,$limit=NULL){
            $this->db->select('master_person.*');
            $this->db->select('admin.*');
            $this->db->join('master_person','master_person.id=admin.id_master_person');
            if(isset($id)){
                $this->db->where('id',$id);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            return $this->db->get($this->table);
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