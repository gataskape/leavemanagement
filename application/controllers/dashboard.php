<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function _remap($param) {
        $this->index($param);
	}

	public function index( $content = "content" )
	{
		 $segs = $this->uri->segment_array();
		// echo end($segs);
		if( $this->session->userdata('uid') == 0 ){
			$this->session->sess_destroy();
			redirect(base_url(). 'login');
		}
		
		if( $this->session->userdata('user_type') == 0 ){
			$data = array(
				'content' => $content
			);
	
			$this->load->model('model_leave');
			$data["leaves"] = $this->model_leave->getLeave( $this->session->userdata('info')->EMP_ID);
			$data["ApprovedLeaves"] = array_filter( $data["leaves"], function ($var) {
				$startDate = new DateTime($var->start);
				$now = new DateTime();
				return ($var->status == 'Approved' && ($now->format('Y') == $startDate->format('Y') ));
			});

			$now = time(); // or your date as well
			$your_date = strtotime( $this->session->userdata('info')->HIRING_DATE );
			$datediff = $now - $your_date;
			$datediff = round($datediff / (60 * 60 * 24));
			$totalLeave = floor($datediff/15);
			if( $totalLeave < $this->session->userdata('info')->LEAVE_COUNT ){
				$totalLeave = floor($datediff/15);
			}else{
				$totalLeave = $this->session->userdata('info')->LEAVE_COUNT;
			}
			$approvedLeaveCount = 0 ;
			foreach ($data["ApprovedLeaves"] as $key => $value) {
				$approvedLeaveCount += $value->amt;
			}

			$data["AvailableLeaves"] = $totalLeave - $approvedLeaveCount;

			
			$this->load->view('includes/header');
			$this->load->view('employee/dashboard_header');
			$this->load->view('employee/sidebar',$data);
			
			$this->load->view('employee/'.$content,$data);
			$this->load->view('employee/dashboard_footer');
			$this->load->view('includes/footer');
		}else{
			$data = array(
				'content' => $content
			);
	
			$this->load->model('model_user');
			$this->load->model('model_leave');
			$data["users"] = $this->model_user->getUsers();
			$data["leaves"] = $this->model_leave->getAllLeave();

			$data["ApprovedLeaves"] = array_filter( $data["leaves"], function ($var) {
				$startDate = new DateTime($var->start);
				$now = new DateTime();
				return ($var->status == 'Approved' && ($now->format('Y') == $startDate->format('Y') ));
			});


			$this->load->view('includes/header');
			$this->load->view('dashboard/dashboard_header');
			$this->load->view('dashboard/sidebar',$data);
	
			if($content == "users"){
				if(end($segs) != 'users'){
					$data["userid"] = end($segs);
					$data["user"] = $this->model_user->getUser(end($segs));
					//echo count($data["user"]);
			
				}
			}
	
			$this->load->view('dashboard/'.$content,$data);
			$this->load->view('dashboard/dashboard_footer');
			$this->load->view('includes/footer');

		}

		
	}
}
?>
