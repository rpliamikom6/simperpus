<?php
    class User_model extends CI_Model {
        var $table='user';

        public function login($username,$password){
            $this->db->where('username',$this->db->escape_str($username));
            $this->db->where('password',md5($password));
            $this->db->limit(1);
            if($query=$this->db->get($this->table)){
                if($query->num_rows()){
                    $user=$query->result_array()[0];
                    $data=array(
                        'username'=>$username,
                        'is_admin'=>$user['is_admin']
                    );
                    $this->session->set_userdata('login',$data);
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

        public function get_data($id=NULL,$limit=NULL){
            $this->db->select('master_person.*');
            $this->db->select('user.*');
            $this->db->join('master_person','master_person.id=user.id_master_person');
            if(isset($id)){
                $this->db->where('user.id',$id);
            }
            if(isset($limit)){
                $this->db->limit($limit);
            }
            return $this->db->get($this->table);
        }

        public function add($data){
            
            $this->db->trans_begin();

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