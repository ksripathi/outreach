	<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- STYLER -->
									
									<!-- /STYLER -->
									<!-- BREADCRUMBS -->
									<ul class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a href="<?php echo site_url('admin/home/dashboard');?>">Home</a>
										</li>
										<li>
											<a href="<?php echo site_url('admin/certifications');?>">Certifications</a>
										</li>
										
										<li> Certification Detail View</li>
									</ul>
									<!-- /BREADCRUMBS -->

									<div class="description"></div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!-- ADVANCED -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box border green">
									<div class="box-title">
										<h4><i class="fa fa-bars"></i> Certification Detail View</h4>
									</div>
									<div class="box-body">
         <form id='agents-form' class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<div class="form-group">
	             <label class="col-sm-2 control-label">Certification Name</label>
                <div class="col-sm-8">
				    		<?php echo $certifications[0]['certifications_name'];?>
    			
	            </div>			
             </div>
				<div class="form-group">
	             <label class="col-sm-2 control-label">Certificate</label>
                <div class="col-sm-8">
		<a target="_blank" href="<?php echo base_url()."uploads/certifications/".$certifications[0]['certificate'];?>"><img src="<?php echo base_url();?>images/word.jpg"></img></a>
    			
	            </div>			
             </div>	
		 <div class="form-group">
                <label class="col-sm-2 control-label"> Created On</label>
 				<div class="col-sm-8">
    			<?php echo date('M jS Y',strtotime( $certifications[0]['created_on']));?>
    			
	            </div>	
		 </div>


									   </form>
									</div>
								</div>
                               
								<!-- /BOX -->
							</div>
						</div>
						<!-- /ADVANCED -->
						
					</div><!-- /CONTENT-->
				</div>
			</div>
		</div>