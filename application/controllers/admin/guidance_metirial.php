<?php 

	/**
	 * guidance_metirial Controller
	 * index Method
	 **/

class Guidance_metirial extends CI_Controller
{ 
	public function __construct() {

		parent::__construct();
							$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
							$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
							$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
							$this->output->set_header('Pragma: no-cache');
		$this->loggedIn();
		$this->load->library(array('form_validation','session','Layout'));
		$this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
		$this->load->model(array('guidance_metirial_m'));
	}
	/**
     * guidance_metirial index   Listing outreach guidance material
     * @param string $guidance_metirial_filter_data
     * @param string $id
     * @param string $limit
     * @param string $offset
     * @param string $guidance_metirialData
     * @return object guidance material Listing View 
     */
	
					
	public function index($guidance_metirial_filter_data="",$id="",$limit="",$offset="",$guidance_metirialData="") { 
	
		$guidance_metirialData['menu'] = "documents";
        $this->load->library('my_pagination');
        $config['base_url'] = base_url().'admin/guidance_metirial/index';
        $config['total_rows'] = $this->guidance_metirial_m->guidance_metirial_Count();
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
			$this->session->unset_userdata('guidance_metirial_filter_data');
			} else {
				if($this->input->post()) {
					$post_data = $this->input->post();
					$guidance_metirial_filter_data=array(
					'document_name' => $post_data['document_name'],
					'date_range' => $post_data['date_range'],
					);
			$this->session->set_userdata('guidance_metirial_filter_data', $guidance_metirial_filter_data);
			}
		}
        
        $guidance_metirialData['guidance_metirial_details']=$this->guidance_metirial_m->getguidance_metirial($id="",$limit,$offset);
        $guidance_metirialData['pagination'] = $this->my_pagination->create_links();
		$this->layout->view('admin/guidance_metirial/view',$guidance_metirialData);
	}
	/**
     * add   Create guidance material Page
     * @param string $guidance_metirialData
     * @param string $postdata
     * @return object  if success redirect to guidance material Listing View with Success Message else Create guidance material View
     */	
	public function add($guidance_metirialData="",$postdata="") {
		$guidance_metirialData['menu'] = "documents";
		$this->form_validation->set_rules('document_name', 'Name', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE )
		{
			$this->layout->view('admin/guidance_metirial/add',$guidance_metirialData);
		}
		else if ($this -> input ->post())
		{
			if(isset($_FILES['document_path']['name']) && ($_FILES['document_path']['name']!="")){
					$userfile_extn = explode(".",$_FILES['document_path']['name']);
				$filename=time()."-".rand(00,99).".".end($userfile_extn);
					$config['upload_path']		= 'uploads/guidance_metirial/';
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
				$upd_status=$this->guidance_metirial_m->guidance_metirial_add($postdata);
				if($upd_status >0) {
				$this->session->set_flashdata('msg', 'guidance metirial Created Successfully');
				redirect('admin/guidance_metirial/index');  
				}else {
					$this->session->set_flashdata('msg', 'guidance metirial Failed to Create');
					redirect('admin/guidance_metirial/index');
					}
					}
					else{
		$this->session->set_flashdata('msg', 'Please upload Valid Format');
		$this->layout->view('admin/guidance_metirial/add',$guidance_metirialData);
		}
					}
					else{
		$this->session->set_flashdata('msg', 'Please upload document');
		$this->layout->view('admin/guidance_metirial/add',$guidance_metirialData);
		}

			}
		}
			/**
     *  edit   Updating guidance material Page
     * @param string $guidance_metirialData
     * @param string $id,$postdata
     * @return object  if success redirect to guidance material Listing View with Success Message else Update guidance material View 
     */	
		public function edit($id,$postdat,$guidance_metirialData) {
	$id=base64_decode($this->uri->segment(4));
	$guidance_metirialData['menu'] = "documents";
		$guidance_metirialData['certification']=$this->guidance_metirial_m->getguidance_metirial($id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('document_name', 'Name', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE )
		{
			$this->layout->view('admin/guidance_metirial/edit',$guidance_metirialData);
		}
		else if ($this -> input ->post())
		{
			$session_data = $this->session->userdata('adminDetails');
			if(isset($_FILES['document_path']['name']) && ($_FILES['document_path']['name']!="")){
					$userfile_extn = explode(".",$_FILES['document_path']['name']);
				$filename=time()."-".rand(00,99).".".end($userfile_extn);
					$config['upload_path']		= 'uploads/guidance_metirial/';
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
		    $this->layout->view('admin/guidance_metirial/edit',$guidance_metirialData);
					}
			}
					else{
					$data['document_path']=$guidance_metirialData['certification'][0]['document_path'];
					}
			$postdata=array(
					'document_name'=>$this->input->post('document_name'),
					'document_path'=>$data['document_path']
		           );
				$upd_status=$this->guidance_metirial_m->edit($id,$postdata);
				if($upd_status >0) {
				$this->session->set_flashdata('msg', 'guidance metirial Updated Successfully');
				redirect('admin/guidance_metirial/index');  
				}else {
					$this->session->set_flashdata('msg', 'guidance metirial Failed to Update');
					redirect('admin/guidance_metirial/index');
					}

			}
}
	/**
     *  detailview    If Admin session exist redirecting to guidance material detail view page else Login Page
     * @param string $guidance_metirialData
     * @param string $id
     * @return  object detail view guidance material Listing   else Login View 
     */	

public function detailview() {
	error_reporting(0);
	$id=base64_decode($this->uri->segment(4));
	$guidance_metirialData['menu'] = "documents";
		$guidance_metirialData['guidance_metirial']=$this->guidance_metirial_m->getguidance_metirial($id);
			$this->layout->view('admin/guidance_metirial/detailview',$guidance_metirialData);
			}
			/**
     *  Delete   deleting guidance material (changing status)
     * @param string $id
     * @return object  if success redirect to guidance material listing
     */	

public function Delete() {
	$id=base64_decode($this->uri->segment(4));
	$guidance_metirialData['menu'] = "documents";
		$result=$this->guidance_metirial_m->delete($id);
		if($result >0) {
				/* Add Logs */
				/* End Logs */
				$this->session->set_flashdata('msg', 'guidance_metirial Deleted Successfully');
				redirect('admin/guidance_metirial/index');  
				}else {
					$this->session->set_flashdata('msg', 'guidance_metirial deleted Fails');
					redirect('admin/guidance_metirial/index');
					}
			}
			 /**
     * loggedIn   check if admin session exists or not  
     * @param  Null 
     * @return object  redirect to index method if session not exits
     */
			
			
	public function loggedIn()
	{
	   $logged = $this->session->userdata('adminDetails');
		if ( $logged === FALSE){
			
				redirect("admin/home/index");
			}
	}
	
}

/* End of file guidance_metirialController.php */
/* Location: ./application/controllers/guidance_metirialController.php */



