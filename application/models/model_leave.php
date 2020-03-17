<?php

class model_leave extends CI_Model {

    public function changeStatus($id, $status){
        if($status == "Approved"){
            // $data = array(
            //     'status' => $status
            // );
            // $this->db->update('tblschedule', $data, array('id' => $id));
        }
        $data = array(
            'status' => $status
        );
        $this->db->update('tblschedule', $data, array('id' => $id));
    }

    public function SwapLeave(){
        $handle1 = explode("-", $_POST['selection-swap']); 
        $handle2 = explode("-", $_POST['sid']);
        
        $data = array(
            'EMP_ID' => $handle1[1],
        );
        $this->db->update('tblschedule', $data, array('id' => $handle2[0]));

        $data = array(
            'EMP_ID' => $handle2[1],
        );
        $this->db->update('tblschedule', $data, array('id' => $handle1[0]));
    }

    public function Insert(){
        $startdate = explode(" - ", $_POST['STARTDATE']);

        $from = new DateTime($startdate[0]);
        $to = new DateTime($startdate[1]);

        $diff = $to->diff($from)->format("%a")+1;

        $data = array(
            'EMP_ID' => $_POST['EMP_ID'],
            'start' => $startdate[0],
            'amt' => $diff,
            'status' => 'Pending'
        );
        $this->db->insert('tblschedule', $data);
        return $this->db->insert_id();
    }

    public function Delete($id){
        $this->db->delete('tblschedule', array('id' => $id)); 
    }
    public function getLeave($id){
        $this->db->from('tblschedule b');
        $this->db->where('EMP_ID',$id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllLeave(){
        $this->db->from('tblschedule b');
        $this->db->join('tblpto u', 'b.EMP_ID = u.EMP_ID');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
}
?>