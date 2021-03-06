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
										<li>Profile</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">My Profile</h3>
									</div>
									<div class="description"></div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<!-- EXPORT TABLES -->
						<div class="row">
							<div class="col-md-6">
								<!-- BOX -->
								<?php if(isset($msg)) { ?>
								<div class="alert alert-success display-none" style="display: block;">
									<a data-dismiss="alert" href="#" aria-hidden="true" class="close">×</a>
									<?php  echo $msg;?>
								</div>
								<?php } ?>
								<div class="box solid gray">
								
									<div class="box-title">
										<h4><i class="fa fa-meh-o"></i>My Profile</h4>
										<span style="float:right"><a href="<?php echo site_url('admin/home/editProfile');?>"><button class="btn btn-xs btn-success">Edit Profile</button></a></span>
									</div>
									<div class="box-body">
										<table id="datatable2" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
											<tbody>
												<tr class="gradeX">
													<td>First Name</td>
													<td><?php echo ucfirst($profile_details['first_name']);?></td>
												</tr>
												<tr class="gradeX">
													<td>Last Name</td>
													<td><?php echo ucfirst($profile_details['last_name']);?></td>
												</tr>
												<tr class="gradeX">
													<td>Email</td>
													<td><?php echo $profile_details['email'];?></td>
												</tr>
												<tr class="gradeX">
													<td>Last Logged In</td>
													<td><?php echo date('M d Y',strtotime($profile_details['last_login']));?></td>
												</tr>
											</tbody>

										</table>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /EXPORT TABLES -->
						
					</div><!-- /CONTENT-->
				</div>
			</div>
		</div>
	