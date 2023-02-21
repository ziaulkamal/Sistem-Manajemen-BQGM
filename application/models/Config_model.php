<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Config_model extends CI_Model 
{

    function auth($username,$password)
    {
       $parse = array(
           'username' => $username, 
           'password' => md5($password), 
        );
       
       $this->db->select('*');
       $this->db->where($parse);
       return $this->db->get('administrator');    
    }
             
    function auth_update($id)
    {
        $data = array('lastLogin' => date('Y-m-d'));
        $this->db->where('id_admin', $id);
        $this->db->update('administrator', $data);
        return;
    }

    function save_master($data)
    {
        return $this->db->insert('bq_master', $data);     
    }

    function get_master()
    {
        $this->db->order_by('id_master', 'ASC');
        return $this->db->get('bq_master');
    }

    function select_single_master($id)
    {
        $this->db->where('id_master', $id);
        return $this->db->get('bq_master')->row_array();
        
    }

    function update_master($id, $data)
    {
        $this->db->where('id_master', $id);
        $this->db->update('bq_master', $data);
        return;
    }

    function delete_master($id)
    {   
        $this->db->where('id_master', $id);
        return $this->db->delete('bq_master');
    }

    function getProfilById($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->get('administrator')->row();  
    }

    function updateProfilById($id, $data)
    {
        $this->db->where('id_admin', $id);
        return $this->db->update('administrator', $data);
        
        
    }
    
}


/* End of file Config_model.php and path /application/models/Config_model.php */
