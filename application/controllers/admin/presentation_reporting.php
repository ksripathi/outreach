<?php 

	/**
	 * presentation_reporting Controller
	 **/

class presentation_reporting extends CI_Controller
{ 
	public function __construct() {

		parent::__construct();
		$this->loggedIn();
		$this->load->library(array('form_validation','session','Layout'));
		$this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
		$this->load->model(array('presentation_reporting_m'));
	}			
	public function index() { 
	
		$presentation_reportingData['menu'] = "documents";
        $this->load->library('my_pagination');
        $config['base_url'] = base_url().'admin/presentation_reporting/index';
        $config['total_rows'] = $this->presentation_reporting_m->presentation_reporting_Count();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div id = "datatable2_paginate" class="dataTables_paginate paging_bs_full "><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a><li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['num_links'] = 6; 
        
        $limit=$config['per_page'];
        $offset=$this->uri->segment(4);
        $this->my_pagination->initialize($config); 
		
		if($this->input->post("reset")){
			$this->session->unset_userdata('presentation_reporting_filter_data');
			} else {
				if($this->input->post()) {
					$post_data = $this->input->post();
					$presentation_reporting_filter_data=array(
					'document_name' => $post_data['document_name'],
					'date_range' => $post_data['date_range'],
					);
			$this->session->set_userdata('presentation_reporting_filter_data', $presentation_reporting_filter_data);
			}
		}
        
        $presentation_reportingData['presentation_reporting_details']=$this->presentation_reporting_m->getpresentation_reporting($id="",$limit,$offset);
        $presentation_reportingData['pagination'] = $this->my_pagination->create_links();
		$this->layout->view('presentation_reporting/view',$presentation_reportingData);
	}
	public function add() {
		$presentation_reportingData['menu'] = "documents";
		$this->form_validation->set_rules('document_name', 'Name', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE )
		{
			$this->layout->view('presentation_reporting/add',$presentation_reportingData);
		}
		else if ($this -> input ->post())
		{
			if(isset($_FILES['document_path']['name']) && ($_FILES['document_path']['name']!="")){
					$userfile_extn = explode(".",$_FILES['document_path']['name']);
				$filename=time()."-".rand(00,99).".".end($userfile_extn);
					$config['upload_path']		= 'uploads/presentation_reporting/';
					$config['allowed_types']	= 'doc|docx|txt|exe|pdf';
					$config['file_name'] = $filename;
				  $_FILES['file_var_name']['name']=$filename;
					$this->load->library('upload', $config);
					$uploadres=$this->upload->do_upload('document_path');
					if($uploadres){
			$postdata=array(
					'document_name'=>$this->input->post('document_name'),
					'document_path'=>$filename,
					'status'=>1
		           );
				$upd_status=$this->presentation_reporting_m->presentation_reporting_add($postdata);
				if($upd_status >0) {
				$this->session->set_flashdata('msg', 'presentation & reporting Created Successfully');
				redirect('admin/presentation_reporting/index');  
				}else {
					$this->session->set_flashdata('msg', 'presentation & reporting Failed to Create');
					redirect('admin/presentation_reporting/index');
					}
					}
					else{
		$this->session->set_flashdata('msg', 'Please upload Valid Format');
		$this->layout->view('presentation_reporting/add',$presentation_reportingData);
		}
					}
					else{
		$this->session->set_flashdata('msg', 'Please upload document');
		$this->layout->view('presentation_reporting/add',$presentation_reportingData);
		}

			}
		}
		
		
		public function edit() {
	$id=base64_decode($this->uri->segment(4));
	$presentation_reportingData['menu'] = "documents";
		$presentation_reportingData['certification']=$this->presentation_reporting_m->getpresentation_reporting($id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('document_name', 'Name', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE )
		{
			$this->layout->view('presentation_reporting/edit',$presentation_reportingData);
		}
		else if ($this -> input ->post())
		{
			$session_data = $this->session->userdata('adminDetails');
			if(isset($_FILES['document_path']['name']) && ($_FILES['document_path']['name']!="")){
					$userfile_extn = explode(".",$_FILES['document_path']['name']);
				$filename=time()."-".rand(00,99).".".end($userfile_extn);
					$config['upload_path']		= 'uploads/presentation_reporting/';
					$config['allowed_types']	= 'doc|docx|txt|exe|pdf';
					$config['file_name'] = $filename;
				  $_FILES['file_var_name']['name']=$filename;
					$this->load->library('upload', $config);
					$uploadres=$this->upload->do_upload('document_path');
	                if($uploadres){
					$data['document_path']=$filename;
					}
					else{
					$this->session->set_flashdata('msg', 'Please upload Valid Format');
		    $this->layout->view('presentation_reporting/edit',$presentation_reportingData);
					}
			}
					else{
					$data['document_path']=$presentation_reportingData['certification'][0]['document_path'];
					}
			$postdata=array(
					'document_name'=>$this->input->post('document_name'),
					'document_path'=>$data['document_path']
		           );
				$upd_status=$this->presentation_reporting_m->edit($id,$postdata);
				if($upd_status >0) {
				$this->session->set_flashdata('msg', 'presentation & reporting Updated Successfully');
				redirect('admin/presentation_reporting/index');  
				}else {
					$this->session->set_flashdata('msg', 'presentation & reporting Failed to Update');
					redirect('admin/presentation_reporting/index');
					}

			}
}
public function detailview() {
	error_reporting(0);
	$id=base64_decode($this->uri->segment(4));
	$presentation_reportingData['menu'] = "documents";
		$presentation_reportingData['presentation_reporting']=$this->presentation_reporting_m->getpresentation_reporting($id);
			$this->layout->view('presentation_reporting/detailview',$presentation_reportingData);
			}
			
			
public function Delete() {
	$id=base64_decode($this->uri->segment(4));
	$presentation_reportingData['menu'] = "documents";
		$result=$this->presentation_reporting_m->delete($id);
		if($result >0) {
				/* Add Logs */
				/* End Logs */
				$this->session->set_flashdata('msg', 'presentation reporting Deleted Successfully');
				redirect('admin/presentation_reporting/index');  
				}else {
					$this->session->set_flashdata('msg', 'presentation reporting deleted Fails');
					redirect('admin/presentation_reporting/index');
					}
			}
	public function loggedIn()
	{
	   $logged = $this->session->userdata('adminDetails');
		if ( $logged === FALSE){
			
				redirect("admin/home/index");
			}
	}
	
}

/* End of file presentation_reportingController.php */
/* Location: ./application/controllers/presentation_reportingController.php */


