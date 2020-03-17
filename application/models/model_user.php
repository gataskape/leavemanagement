<?php

class model_user extends CI_Model {

    function can_login($username, $password)  
    {  

        $this->db->from('tbllogin l');
        $this->db->join('tblpto u', 'l.EMP_ID = u.EMP_ID');
        $this->db->where('l.username',$username);
        $this->db->where('l.password',$password);
       
        $query = $this->db->get();  
        //echo $query->num_rows();
        
        if( $query->num_rows() > 0 )  
        {  
            
            return $query->result()[0];  
        }  
        else  
        {  
            return -1;       
        }
    }

    public function mail_exists($key)
    {
        $this->db->where('email',$key);
        $query = $this->db->get('tblpto');
        if ($query->num_rows() > 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function getUsers()
    {
            //$this->db->where('type',0);
            $query = $this->db->get('tblpto');
            return $query->result();
    }

    public function MakeAccount(){
        $users = $this->getUsers();
        foreach ($users as $key => $value) {

            $data = array(
                'username' => $value->EMP_ID,
                'password' => $value->EMP_ID,
                'EMP_ID' => $value->EMP_ID,
                'type' => 0
            );
            $this->db->insert('tbllogin', $data);
            
            $this->db->insert_id();
        }
    }

    public function deleteUser(){
        $this->db->delete('tblpto', array('EMP_ID' => $_POST['EMP_ID'],)); 
    }
    
    public function getUser($id)
    {
            $this->db->where('EMP_ID',$id);
            $query = $this->db->get('tblpto');
            return $query->result();
            
    }

    public function insertUser()
    {
        $data = array(
            'EMP_ID' => $_POST['EMP_ID'],
            'EMP_NAME' => $_POST['EMP_NAME'],
            'DEPARTMENT' => $_POST['DEPARTMENT'],
            'HIRING_DATE' => $_POST['HIRING_DATE'],
            'EMPLOYMENT_STATUS' => $_POST['EMPLOYMENT_STATUS'],
            'LEAVE_COUNT' => $_POST['LEAVE_COUNT'],
        );
        $this->db->insert('tblpto', $data);

        $data = array(
            'username' => $_POST['EMP_ID'],
            'password' => $_POST['EMP_ID'],
            'EMP_ID' => $_POST['EMP_ID'],
            'type' => 0
        );
        $this->db->insert('tbllogin', $data);
        
        $this->db->insert_id();
     
    }

    public function updateUser()
    {
        $data = array(
            'EMP_NAME' => $_POST['EMP_NAME'],
            'DEPARTMENT' => $_POST['DEPARTMENT'],
            'HIRING_DATE' => $_POST['HIRING_DATE'],
            'LEAVE_TYPE' => $_POST['LEAVE_TYPE'],
            'LEAVE_COUNT' => $_POST['LEAVE_COUNT'],
        );
        $this->db->update('tblpto', $data, array('EMP_ID' => $_POST['EMP_ID']));
    }
}

?>
