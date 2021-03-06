<?php
/**
* Login Controller for End users.
**/
class home extends CI_Controller 
{
	function __construct(){ 
		error_reporting(0);
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('site/home_site_m');
		$this->load->library(array('form_validation','session','Layout'));
		$this->load->helper(array('url','html','form')); 
	}
/**
* Index (outreach home page)  
* @param string $data
* @return object if success  redirect to  Homepage
*/
	public function index($data="") {
		if($this->session->flashdata('msg')){
			$data['msg']=$this->session->flashdata('msg');
		}
		$data['get_workshop_upcoming']=$this->home_site_m->getHomeWorkshop();
		$data['nodalcenters']=$this->home_site_m->nodalcenterscount();
		$data['workshoprun']=$this->home_site_m->workshopruncount();
		$data['labstakencount']=$this->home_site_m->labstakencount();
		$data['mapaa']=$this->home_site_m->displayMap();
		$this->load->view('site/header',$data);
		$this->load->view('site/home/home',$data);
		$this->load->view('site/footer',$data);
					
	}
/**
* contact
* @param string $postdata
* @param string $data
* @return object if success  redirect to  contact page
*/
	public function contact($data="",$postdata="") {
			$this->load->library('recaptcha');
			$data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
			$this->load->view('site/header',$data);
			if($this->session->flashdata('msg')){
				$data['msg']=$this->session->flashdata('msg');
			}
			$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
			$this->form_validation->set_rules('comment', 'comment', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE ){
				$this->load->view('site/home/contact',$data);
			}else{
				$this->recaptcha->recaptcha_check_answer();
				if($this->recaptcha->getIsValid()){
					if ($this -> input ->post()){
						$postdata=$this -> input ->post();
						$res=$this->home_site_m->save_contact($postdata);
					if($res>0){
					$this->session->set_flashdata('msg',"Your comment send successfully.");
					redirect('Contact', 'refresh');
					}else{
					$this->session->set_flashdata('msg',"Your comment sending failed.");
					redirect('Contact', 'refresh');
					}
					}
				}elseif(!$this->recaptcha->getIsValid()) {
				$this->session->set_flashdata('msg', 'incorrect captcha.');
				redirect('Contact', 'refresh');
               }
			}
		$this->load->view('site/footer',$data);	
	}
/**
* cms 
* @param string $data)
* @return object if success  redirect to  about outreach page
*/
	public function cms($id="",$data=""){
		$id=str_replace("_","-",str_replace("-"," ",$id));
		$data['content'] = $this->home_site_m->get_cms($id);
		$data['cms_titles']=$this->home_site_m->get_cms_title();
		$this->load->view('site/header',$data);
		$this->load->view('site/home/cms',$data);
		$this->load->view('site/footer',$data);
	}
/**
* addWorkshop 
* @param string $inputdata
* @return object  if success redirect to addWorkshop Listing View with Success Message else Create addWorkshop View 
*/
	public function addWorkshop($inputdata=""){	
	        $ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
				redirect('Login');
			}
			$inputdata = $this->input->post();	
			$res=$this->home_site_m->addWorkshop1($inputdata);
			if($res){
				$this->session->set_flashdata('msg', 'Workshop add successfully.');
				redirect('nodal-coordinator',"refresh");
			}			
	}
/**
* addNodal 
* @param string $inputdata
* @return object  if success redirect to Create addNodal View 
*/	
	public function addNodal($inputdata=''){
			$ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
				redirect('Login');
			}
			$inputdata = $this->input->post();
			$res=$this->home_site_m->addNodal($inputdata);
			if($res){
				redirect('nodal-coordinator',"refresh");
			}
			
	}
/**
*  addNodal  
* @param string $postdata
* @param string $to
* @param string $subject
* @param string $message,$headers
* @return object  if success redirect to addNodal Listing View with Success Message else Create addNodal View 
*/	
	public function addNodalcenter($postdata="",$to,$subject,$message,$headers){
			$ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
					redirect('Login');
			}
			$postdata = $this->input->post();
			$target_dir = 'uploads/mou/';
			$target_file = $target_dir . basename($_FILES["mou"]["name"]);		
			if (move_uploaded_file($_FILES["mou"]["tmp_name"], $target_file)){
				$upload_attend_sheet=$_FILES["mou"]["name"];
			}
			$postdata['mou'] =$_FILES["mou"]["name"];
			$postdata['password'] = rand('000000','999999');
			$result = $this->home_site_m->addNodalcenter_m($postdata);
			if($result > 0)			
			{
				$message= "<html><head><META http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                   </head><body>
                                      <div style='margin:0;padding:0'>
 	                                <table border='0' cellspacing='0' cellpadding='0'>
    	                           <tbody>
								   <tr>
				                        <td valign='top'><p> Hi Nodal Coordinator,</p></td>
		                           </tr>
		                           <tr>
				                        <td valign='top'><p> Your   follow the below details to login</p></td>
		                           </tr>
		                          <tr>
				                       <td valign='top'><p><strong>User Name :</strong> ".$postdata['email']."</p></td>
		                          </tr>
								  <tr>
				                       <td valign='top'><p><strong>Password :</strong> ".$postdata['password']."</p></td>
		                          </tr>
		                    </tbody>
	                    </table>  
                     </div>
                    </body></html>";
				$to = $postdata['email'];
				$subject = "Your Nodal  account Password";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($to,$subject,$message,$headers);
				$page = ucfirst($this -> input -> post('las_name'))." has been added. ";
				$notification = array('subject' => $page, 'type' => 'Staff', 'msg_type' => 'success');			
				$this->session->set_flashdata('msg', 'Nodalcenter Added Successfully');
				redirect('manage-workshop', 'refresh');
			}else{
				$this->session->set_flashdata('msg', 'Nodalcenter already Exists');
				redirect('manage-workshop', 'refresh'); // on failure   				
			}
	} 
/*** editWorkshop   Updating edit Workshop Page
* @param string $inputdata
* @param string $data
* @return object  if success redirect to editWorkshop View
*/	
	 public function editWorkshop($inputdata,$data){
			$ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
				redirect('Login');
			}
			$inputdata = $this->uri->segment(3); 
			$data['editWorkshop1']= $this->home_site_m->editWorkshop($inputdata);
			if($data){
				$this->load->view('site/header',$data);
				$this->load->view('site/nodal-coordinator/editWorkshop',$data);
				$this->load->view('site/footer');
			}else{
				redirect('nodal-coordinator',"refresh");
			}
			
	}
/**
* updateWorkshop  
* @param string $inputdata
* @return object  if success redirect to Workshop  Listing View with Success Message else editWorkshop View 
*/

	public function updateWorkshop($inputdata=''){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->input->post();
		$res=$this->home_site_m->updateWorkshop($inputdata);
		if($res){
			$this->session->set_flashdata('msg', 'Update Successfully ');
			redirect('nodal-coordinator',"refresh");
		}
	}
/**
* Calls an HTTP POST function to verify if the user's guess was correct
* @param string $inputdata
* @param string $value
* @return object  if success redirect to Workshop  Listing View listing
*/

	public function deleteWorkshop($inputdata=''){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->uri->segment(3); 
		$res=$this->home_site_m->deleteWorkshop($inputdata);
		if($res){
			redirect('nodal-coordinator',"refresh");
		}
	}
/**
* activeworkshop  (changing status)
* @param string $inputdata
* @return object  if success redirect to Workshop  Listing View listing
*/
	public function activeworkshop($inputdata=''){
		$ses_data=$this->session->userdata('user_details');
		if(empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->uri->segment(3); 
		$res=$this->home_site_m->activeworkshop($inputdata);
		if($res){
			redirect('manage-workshop',"refresh");
		}
	}
/**
* viewReport    If user session exist redirecting to detail view page else Login Page
* @param string $inputdata
* @param string $data
* @return object detail view  Listing   else Login View
*/
	public function viewReport($inputdata="",$data=""){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->uri->segment(3); 
		$data['nodalcoordinatorcount']=$this->home_site_m->nodalcoordinatorcount();	
		$data['nodalcoordinatorworkshop']=$this->home_site_m->nodalcoordinatorworkshop();	
		$data['nodalcoordinatorcounthistroy']=$this->home_site_m->nodalcoordinatorcounthistroy();	
		$data['nodalcoordinatorworkshopcount']=$this->home_site_m->nodalcoordinatorworkshopcount();	
		$data['view_reports']=$this->home_site_m->getViewReport($inputdata);
		$this->load->view('site/header',$data);
		$this->load->view('site/outreachcoordinator/viewReport',$data);
	    $this->load->view('site/footer');
	}
/**
* hostoryViewReport    If user session exist redirecting to history View Report  page else Login Page
* @param string $inputdata
* @param string $data
* @return object detail view  Listing   else Login View 
*/

	public function hostoryViewReport($inputdata="",$data=""){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->uri->segment(3); 
		$data['view_reports']=$this->home_site_m->getViewReport($inputdata);
		$this->load->view('site/header',$data);
		$this->load->view('site/outreachcoordinator/hostoryViewReport',$data);
	    $this->load->view('site/footer');
}
/**
* deleteNodalcenter   deleting Nodalcenter (changing status)
* @param string $nodal_id
* @return object  if success redirect to workshop  listing
*/
	public function deleteNodalcenter($nodal_id=""){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$nodal_id = base64_decode($this->uri->segment(3)); 
		$result = $this->home_site_m->deleteNodalcenter($nodal_id);
		if($result > 0)			
		{
			$page = " has been deleted. ";
			$notification = array('subject' => $page, 'type' => 'Nodalcenter', 'msg_type' => 'success');
			$this->session->set_flashdata('msg', 'Nodal center deleted Successfully');
			redirect('nodal-coordinator', 'refresh');
		}else{
			$this->session->set_flashdata('msg', 'Sorry try again');
			redirect('nodal-coordinator', 'refresh');			
		}
	}
/**
* submitReports
* @param string $inputdata (urisegment)
* @param string $data
* @return object  if success redirect to submit Reports  page
*/
	 public function submitReports($inputdata="",$data="")
	{
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
		$inputdata = $this->uri->segment(3); 
		$data['editWorkshop1']= $this->home_site_m->editWorkshop($inputdata);
		if($data['editWorkshop1']){
			$data['report_data']= $this->home_site_m->get_report($inputdata);
			$this->session->set_userdata('report_data',$data['report_data']);
			$this->load->view('site/header',$data);
			if(!empty($data['report_data'])){
				$this->load->view('site/nodal-coordinator/editReports',$data);
			}
			else{
				$this->load->view('site/nodal-coordinator/submitReports',$data);
			}
			$this->load->view('site/footer');
		}else{
			redirect('nodal-coordinator',"refresh");
		}
		
	}
/**
* submitReport   (changing workshop status)
* @param string $inputdata
* @return object  if success redirect to workshop page else submit Reports  page
*/
	public function submitReport($filea=""){
		$ses_data=$this->session->userdata('user_details');
		if (empty($ses_data)){
			redirect('Login');
		}
			 
		$inputdata = $this->input->post();
		$report_data=$this->session->userdata('report_data');	
		$uploads_dir = '/images/attend-files';
		$target_dir = 'uploads/attend_sheet/';
		$target_dir1 = 'uploads/college_report/';
		$target_dir2 = 'uploads/workshop_photos/';
		$target_file = $target_dir . basename($_FILES["upload_attend_sheet"]["name"]);
		$target_file1 = $target_dir1 . basename($_FILES["college_report"]["name"]);
		$target_file2 = $target_dir2 . basename($_FILES["workshop_photos"]["name"]);		
		if (move_uploaded_file($_FILES["upload_attend_sheet"]["tmp_name"], $target_file)){
		$upload_attend_sheet=$_FILES["upload_attend_sheet"]["name"];
		}else{
			$upload_attend_sheet=$report_data[0]['upload_attend_sheet'];
		}
		if(move_uploaded_file($_FILES["college_report"]["tmp_name"], $target_file1)) {
			$college_report=$_FILES["college_report"]["name"];
		}else{
			  $college_report=$report_data[0]['college_report'];
		}
		if (move_uploaded_file($_FILES["workshop_photos"]["tmp_name"], $target_file2)) {
			$workshop_photos =$_FILES["workshop_photos"]["name"];  
		}else{
			$workshop_photos =$report_data[0]['workshop_photos'];;
		}
		$filea = array(
				'upload_attend_sheet'=>$upload_attend_sheet,
				'college_report'=>$college_report,
				'workshop_photos'=>$workshop_photos,
				'participate_attend'=>$inputdata['participate_attend'],
				'participate_experiment'=>$inputdata['participate_experiment'],
				'comments_positive'=>$inputdata['comments_positive'],
				'comments_negative'=>$inputdata['comments_negative'],
				'workshop_id'=>$inputdata['workshop_id']
				);
		if($inputdata['submit']=="save"){
			$res=$this->home_site_m->editReport_m($filea);
			if($res>0){
				$this->session->set_flashdata('msg', 'Saved Reports Successfully');
				redirect('nodal-coordinator',"refresh");
				$this->session->unset_userdata('report_data');	
			}
		}else{
			$res=$this->home_site_m->submitReport_m($filea);
			if($res>0){
				$this->session->set_flashdata('msg', 'Submit Reports Successfully');
				redirect('nodal-coordinator',"refresh");
				$this->session->unset_userdata('report_data');
			}
		}
			
     
	}
/**
* approverepost   (changing workshop status)
* @param string $inputdata
* @return object  if success redirect to workshop page 
*/

	public function approverepost($inputdata=""){
			$ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
				redirect('Login');
			}
			$inputdata = $this->input->post();
			$res=$this->home_site_m->approverepost_m($inputdata);
			if($res){
				$this->session->set_flashdata('msg', 'approve workshop Successfully ');
				redirect('manage-workshop',"refresh");
			}
		}
/**
* cancelworkshop   (changing workshop status)
* @param string $inputdata
* @return object  if success redirect to workshop page 
*/

	public function cancelworkshop($postval=""){
			$ses_data=$this->session->userdata('user_details');
			if (empty($ses_data)){
				redirect('Login');
			}
			$inputdata = $this->input->post();
			$res=$this->home_site_m->cancelworkshop_m($inputdata);
			if($res){
				$this->session->set_flashdata('msg', 'cancel workshopp Successfully ');
				redirect('nodal-coordinator',"refresh");
			}
		}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
?>