<?php 

	/**
	 * Contacts Controller
	 * index Method
	 * detailview Method
	 * Delete Method
	 * loggedIn Method
	 
	 */
class Contacts extends CI_Controller

{ 

	public function __construct() {



		parent::__construct();

		$this->loggedIn();

		$this->load->library(array('form_validation','session','Layout'));

		$this->load->helper(array('url','html','form'));  // load url,html,form helpers optional

		$this->load->model(array('contacts_m','logmodel'));

	}			
/*
		@method  Contacts Page Index    If Admin session exist redirecting to Contacts page else Login Page
		@param  Null 
		@return object outreach Contacts Listing View  else Login View 
 */
	public function index() { 

		$contacts['menu'] = "branch";

        $this->load->library('my_pagination');

        $config['base_url'] = base_url().'admin/contacts/index';

        $config['total_rows'] = $this->contacts_m->contacts_Count();

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

			$this->session->unset_userdata('contacts_filter_data');

			} else {

				if($this->input->post()) {

					$post_data = $this->input->post();

					$company_filter_data=array(

					'company_name' => $post_data['company_name'],

					'date_range' => $post_data['date_range'],

					);

			$this->session->set_userdata('branch_filter_data', $company_filter_data);

			}

		}

        

        $contacts['contact_details']=$this->contacts_m->getcontacts($id="",$limit,$offset);

        $contacts['pagination'] = $this->my_pagination->create_links();
		$this->layout->view('admin/contacts/view',$contacts);

	}
/*
		@method  detailview    If Admin session exist redirecting to Contacts detail view page else Login Page
		@param  Post Values
		@return object detail view Contacts Listing   else Login View 
 */
public function detailview() {

	$id=base64_decode($this->uri->segment(4));

	$contactsData['menu'] = "branch";

		$contactsData['contacts']=$this->contacts_m->getcontacts($id);

			$this->layout->view('admin/contacts/detailview',$contactsData);

			}

 
 /*
		@method  Delete   deleting Contact (changing status)
		@param  Contact id 
		@return object  if success redirect to Contact listing
	 */

			public function Delete() {

	$id=base64_decode($this->uri->segment(4));

	$corporateData['menu'] = "branch";

		$result=$this->contacts_m->delete($id);

		if($result >0) {

				/* Add Logs */

				$page ="Contact has been deleted. ";

				$notification = array('subject' => $page, 'type' => 'category', 'msg_type' => 'success');

				$this -> logmodel -> add_record($notification);

				/* End Logs */

				$this->session->set_flashdata('msg', 'Contact Deleted Successfully');

				redirect('admin/contacts/index');  

				}else {

					$this->session->set_flashdata('msg', 'Contact deleted Fails');

					redirect('admin/contacts/index');

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



/* End of file corporateController.php */

/* Location: ./application/controllers/admin/Contact.php */







