<script src="<?php echo base_url();?>site/js/jquery.counterup.min.js"></script>
<script src="<?php echo base_url();?>site/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>site/js/jquery.simplyscroll.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>site/css/jquery.simplyscroll.css" media="all" type="text/css">
<script>
    jQuery(document).ready(function( $ ) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
<script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
		$("#scroller123").simplyScroll({orientation:'vertical',customClass:'vert'});
	});
})(jQuery);
</script>

		
        <!-- end fixedmenu -->
		<?php $ses_data=$this->session->userdata('user_details'); ?>
          <!-- end servicesbox -->
		<section class="strip-colors">
		<div class="container">
			<div>
				<div class="col-md-3 text-center workshop-run">
					<div class="icon-box-top">
					<div class="value-disp">
						<p align="left" class="value-list">
							<span class="counter1" style="display:inline-block; color:#fff;"><?php echo $nodalcoordinatorcounthistroy[0]['participants']; ?>/<?php echo  $nodalcoordinatorworkshop['experiments']; ?></span><span class="resu-top">EXPERIMENTS</span>
						</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center labs-taken">
					<div class="icon-box-top">
						<div class="value-disp">
						<p align="left" class="value-list">
							<span class="counter1" style="display: inline-block;color:#fff;"><?php echo $nodalcoordinatorcounthistroy[0]['experiments']; ?>/<?php echo  $nodalcoordinatorworkshop['participants']; ?></span><span class="resu-top">PARTICIPANTS</span>
						</p>
					</div></div>
				</div>
				<div class="col-md-3 text-center workshop-run">
					<div class="icon-box-top">
					<div class="value-disp">
						<p align="left" class="value-list">
							<span class="counter1" style="display:inline-block; color:#fff;"><?php echo $nodalcoordinatorworkshopcount; ?>/<?php echo  $nodalcoordinatorworkshop['workshop']; ?></span><span class="resu-top">WORKSHOPS</span>
						</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-3 text-center node-centers">
					<div class="icon-box-top">
						<div class="value-disp">
						<p align="left" class="value-list">
							<span class="counter1" style="display: inline-block;color:#fff;"><?php echo $nodalcoordinatorcount; ?></span><span class="resu-top">NODEL CENTERS

					</span>
						</p>
					</div></div>
				</div>
				
			</div>
		</div>
        
		</section>
		
		
		
		
		<!-- end homerecentportfolio -->
        <div class="container" style="margin-top:30px;">
      
      <div role="tabpanel" class="tab-pane" id="profile">
										<table id="datatable2" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">

											<thead>

												<tr>

													<th>S.No</th>

													<th>Name</th>

													<th>Location</th>
													<th>Participating institutes</th>
												<!--	<th>Date</th>-->
													<th>No of participants</th>
													<th>No of sessions</th>
													<th>Duration of sessions</th>
													<th>Subject of sessions</th>
													<th>Labs planned</th>
												<!--	<th>Other </th>-->
													
												</tr>
											</thead>
												<?php
												
											foreach($view_reports as $workshopdata){
											
												//echo "<pre>";
												//print_r($workshopdata);
												//die();												?>
												
												<tr class="gradeX">
													<td><?php echo $workshopdata['workshop_id']; ?></td>
													<td><?php echo $workshopdata['name']; ?></td>
													<td><?php echo $workshopdata['location']; ?></td>
													<td><?php echo $workshopdata['participate_institute']; ?></td>
													<!--<td><?php echo $workshopdata['date'];  ?></td>-->
													<td><?php echo $workshopdata['number_of_participants'];  ?></td>
													<td><?php echo $workshopdata['no_of_sessions'];  ?></td>
													<td><?php echo $workshopdata['durationofsessions']; ?></td>
													<td><?php echo $workshopdata['subject_of_session'];  ?></td>
													<td><?php echo $workshopdata['labs_plan'];  ?></td>
													<!--<td><?php echo $workshopdata['upload_attend_sheet']; ?></td>-->
													</tr>
													<?php
											}
											 ?>
</table>
<?php if($workshopdata['upload_attend_sheet']){
													?>
													<style>
														
tabs-below > .nav-tabs,
.tabs-right > .nav-tabs,
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}

.tabs-below > .nav-tabs {
  border-top: 1px solid #ddd;
}

.tabs-below > .nav-tabs > li {
  margin-top: -1px;
  margin-bottom: 0;
}

.tabs-below > .nav-tabs > li > a {
  -webkit-border-radius: 0 0 4px 4px;
     -moz-border-radius: 0 0 4px 4px;
          border-radius: 0 0 4px 4px;
}

.tabs-below > .nav-tabs > li > a:hover,
.tabs-below > .nav-tabs > li > a:focus {
  border-top-color: #ddd;
  border-bottom-color: transparent;
}

.tabs-below > .nav-tabs > .active > a,
.tabs-below > .nav-tabs > .active > a:hover,
.tabs-below > .nav-tabs > .active > a:focus {
  border-color: transparent #ddd #ddd #ddd;
}

.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a,
.tabs-right > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}

.tabs-right > .nav-tabs {
  float: right;
  margin-left: 19px;
  border-left: 1px solid #ddd;
}

.tabs-right > .nav-tabs > li > a {
  margin-left: -1px;
  -webkit-border-radius: 0 4px 4px 0;
     -moz-border-radius: 0 4px 4px 0;
          border-radius: 0 4px 4px 0;
}

.tabs-right > .nav-tabs > li > a:hover,
.tabs-right > .nav-tabs > li > a:focus {
  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
}

.tabs-right > .nav-tabs .active > a,
.tabs-right > .nav-tabs .active > a:hover,
.tabs-right > .nav-tabs .active > a:focus {
  border-color: #ddd #ddd #ddd transparent;
  *border-left-color: #ffffff;
}
													</style>
													<form method="post" action="<?php echo site_url('home/approverepost');?>">
													 <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#a" data-toggle="tab">Attendance sheets</a></li>
          <li ><a href="#b" data-toggle="tab">College report</a></li>
          <li><a href="#c" data-toggle="tab">Workshop Photos</a></li>
          <li><a href="#d" data-toggle="tab">Comments</a></li>
        </ul>
        <div class="tab-content">
         <div class="tab-pane active" id="a"><div >
		 	<object data="<?php echo base_url(); ?>uploads/attend_sheet/<?php echo $workshopdata['upload_attend_sheet']; ?>" type="application/pdf" width="50%" height="100%">
  <p>Alternative text - include a link <a href="<?php echo base_url(); ?>uploads/attend_sheet/<?php echo $workshopdata['upload_attend_sheet']; ?>">to the PDF!</a></p>
</object>
  <!--<img src="http://ideativedigital.com/outreach/uploads/attend_sheet/<?php //echo $workshopdata['upload_attend_sheet']; ?>" width="250px" height="250px">--></div>
         	
         	<table>
	<tr>
		<th>Checklist for approval</th>
		<th>yes &nbsp; no</th>
	</tr>
	<tr>
		<td>Total attendance matches the reported participants</td>
		<td><input type="radio" name="signed" value="yes">&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="signed" value="no"></td>
	</tr>
	
</table>
         	
         	
         	</div>
         	
         <div class="tab-pane" id="b">
         	<div >
			<object data="<?php echo base_url(); ?>uploads/college_report/<?php echo $workshopdata['college_report']; ?>" type="application/pdf" width="50%" height="100%">
  <p>Alternative text - include a link <a href="<?php echo base_url(); ?>uploads/college_report/<?php echo $workshopdata['college_report']; ?>">to the PDF!</a></p>
</object>
         		<!--<img src="http://ideativedigital.com/outreach/uploads/college_report/<?php echo $workshopdata['upload_attend_sheet']; ?>"width="250px" height="250px">--></div>
         		
<table>
	<tr>
		<th>Checklist for approval</th>
		<th>yes &nbsp; no</th>
	</tr>
	<tr>
		<td>Report is on the college letterhead</td>
		<td><input type="radio" name="letterhead" value="yes">&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="letterhead" value="no"></td>
	</tr>
	<tr>
		<td>Report is signed by the college principal</td>
		<td><input type="radio" name="signed" value="yes">&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="signed" value="no"></td>
	</tr>
	<tr>
		<td>Report has the college seal stamped</td>
		<td><input type="radio" name="seal" value="yes">&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="seal" value="no"></td>
	</tr>
</table>
         		</div>
         <div class="tab-pane" id="c">
		<!-- <object data="<?php echo base_url(); ?>/uploads/workshop_photos/<?php echo $workshopdata['upload_attend_sheet']; ?>" type="application/pdf" width="50%" height="100%">
  <p>Alternative text - include a link <a href="<?php echo base_url(); ?>uploads/college_report/<?php echo $workshopdata['upload_attend_sheet']; ?>">to the PDF!</a></p>
</object>-->
		 <img src="<?php echo base_url(); ?>/uploads/workshop_photos/<?php echo $workshopdata['workshop_photos']; ?>" width="250px" height="250px">

		 </div>
         <div class="tab-pane" id="d"><span>comments positive</span></br><?php echo $workshopdata['comments_positive']; ?><span>
        </br> comments negative</br>	<?php echo $workshopdata['comments_negative']; ?>
         </span></div>
        </div>
      </div>
      <input type="hidden"name="workshort_report" value="<?php echo $this->uri->segment(3);  ?>">
	<input type="submit" name="approve" value="approve">
</form>
<div class="reportsattached">
	
</div>

<div class="signed">
	
</div>

<div class="seal">
	


			</div>
			<?php

											}        ?>
</div> </div> 
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>

 

       
		
		
        
        
        <section class="infoarea whites">
        <div class="container placemetns-top">
		

		</div>
        </section>