<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_func extends CI_Controller {

    public function index( $content = "content" )
	{
        redirect(base_url(). 'dashboard');
    }

    public function ExecuteUser(){
        // $this->load->model('model_user');
        // $this->model_user->MakeAccount();
    }

    public function ApproveLeave(){
        $segs = $this->uri->segment_array();
        $this->load->model('model_leave');
        $this->model_leave->changeStatus($segs[3], "Approved");

        $this->session->set_flashdata('success',"Leave Approved");
        redirect(base_url(). 'dashboard/approved/');
    }

    public function SwapLeave(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('selection-swap','Swap to', 'trim|required');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url(). 'dashboard/approved/');
		}else{
            $this->load->model('model_leave');
            $this->model_leave->SwapLeave();
            $this->session->set_flashdata('success','Leave Swapped');
            redirect(base_url(). 'dashboard/approved/');
        }


    }


    public function requestLeave(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('STARTDATE','Date', 'trim|required');


        $startdate = explode(" - ", $_POST['STARTDATE']);
        $from = new DateTime($startdate[0]);
        $to = new DateTime($startdate[1]);
        $diff = $to->diff($from)->format("%a")+1;

        if( $diff > $_POST['LEAVE_COUNT'] ){
            $this->session->set_flashdata('error','you file leave for '.$diff.' days, your available leave is '.$_POST['LEAVE_COUNT'].'');
            redirect(base_url(). 'dashboard/request/');
        } else if($this->form_validation->run() == false){
            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url(). 'dashboard/request/');
		}else{
            $this->load->model('model_leave');
            $this->model_leave->Insert();
            $this->session->set_flashdata('success','Request Submitted');
            redirect(base_url(). 'dashboard/request/');
        }
    }

    public function DeleteLeave(){
        $segs = $this->uri->segment_array();

        $this->load->model('model_leave');
        $this->model_leave->Delete($segs[3]);

        $this->session->set_flashdata('success',"Leave Deleted");
        redirect(base_url(). 'dashboard/request/');
    }

    public function DeclineLeave(){
        $segs = $this->uri->segment_array();

        $this->load->model('model_leave');
        $this->model_leave->changeStatus($segs[3], "Declined");

        $this->session->set_flashdata('success',"Leave Declined");
        redirect(base_url(). 'dashboard/request/');
    }

    public function AddUser(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('EMP_ID','EMP_ID', 'trim|required');
        $this->form_validation->set_rules('EMP_NAME','EMPLOYEE NAME', 'trim|required');
        $this->form_validation->set_rules('DEPARTMENT','DEPARTMENT', 'trim|required');
        $this->form_validation->set_rules('HIRING_DATE','HIRING DATE', 'trim|required');
        $this->form_validation->set_rules('EMPLOYMENT_STATUS','EMPLOYMENT_STATUS', 'trim|required');
        $this->form_validation->set_rules('LEAVE_COUNT','LEAVE COUNT', 'trim|required');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url(). 'dashboard/users/' );
		}else{
            $this->load->model('model_user');
            $this->model_user->insertUser();
            $id = $_POST['EMP_ID'];
            //echo 'test';
            $this->session->set_flashdata('success','Success');
            redirect(base_url(). 'dashboard/users/'. $_POST['EMP_ID'] );
        }

    }

    public function DeleteUser(){
        $this->load->model('model_user');
        $this->model_user->deleteUser();
        $this->session->set_flashdata('success','User Deleted');
        redirect(base_url(). 'dashboard/users/');
    }
    public function UpdateUser(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('EMP_NAME','EMPLOYEE NAME', 'trim|required');
        $this->form_validation->set_rules('DEPARTMENT','DEPARTMENT', 'trim|required');
        $this->form_validation->set_rules('HIRING_DATE','HIRING DATE', 'trim|required');
        $this->form_validation->set_rules('LEAVE_TYPE','LEAVE TYPE', 'trim|required');
        $this->form_validation->set_rules('LEAVE_COUNT','LEAVE COUNT', 'trim|required');


        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error',validation_errors());
            redirect(base_url(). 'dashboard/users/'. $_POST['EMP_ID'] );
		}else{
            $this->load->model('model_user');
            $this->model_user->updateUser();
            $id = $_POST['uid'];
            $this->session->set_flashdata('success','Success');
            redirect(base_url(). 'dashboard/users/'. $_POST['EMP_ID'] );
        }

    }

}
?>