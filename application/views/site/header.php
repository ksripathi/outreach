<!DOCTYPE html>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>outreach</title>
<link href="<?php echo base_url();?>site/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/inc/shortcodes/css/shortcodes.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/css/wowslider.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/style.css" rel="stylesheet">

<link href="<?php echo base_url();?>site/css/fullwidth.css" rel="stylesheet">

<link href="<?php echo base_url();?>site/css/skins/orange.css" rel="stylesheet">
<link href="<?php echo base_url();?>site/media-query.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css'/>

<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>

   <script type='text/javascript' src='<?php echo base_url();?>site/js/jquery.js'></script>
   <script>
   function appr_error(){
   alert("Your account is not yet activated.Kindly contact Administrator");
   return false;
   }
   </script>

</head>
<body class="boxedlayout" oncontextmenu="return false;">
	<div class="boxedcontent">
		<div class="fixedmenu">
			<div class="container">
				<div class="row">
					<a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>site/img/logo.png" alt="" width="124%" style="width: 150px;"></a>					
                   <div class="col-md-10 less-padding login-widht align-right" align="right"><!-- nav-margin-top  -->
                   		
						
						<?php $ses_data=$this->session->userdata('user_details');
						
		if (empty($ses_data)){ ?>
						
						<?php } else {
							
		?>
		
<div class="col-md-2 less-padding">

<li class="dropdown user"  id="header-user" style="list-style:none; float: right;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					
					<i class="fa fa-angle-down"></i><span class="username"><?php echo ucfirst($ses_data['name']); ?> </span>
					
					
					<img alt="" style="widht:40px;height:40px;border-radius: 50px;"src="<?php echo base_url();?>images/outreach-profile-images/<?php echo $ses_data['profile_image']; ?>"  style="border-radius: 50%;">
					
					
					
					
					
				</a></br><?php if($ses_data['user_type']==1){ ?>
				<?php } ?>
				
<ul class="dropdown-menu">
					
					<li><a href="<?php echo base_url();?>Logout"><i class="fa fa-power-off"></i> Log Out</a></li>
				</ul>
				</li>
</div>





<?php }?>
<style>
	.dashboard-top{
		padding-top: 8px;
	}
	ul li{
		list-style-type:none;
	}
</style>
<div class="col-md-2 less-padding">
<ul><li class="username dashboard-top"><?php
if($this->uri->segment(1)!="nodal-coordinator" && $this->uri->segment(1)!="manage-workshop"){
if($ses_data['user_type']==1){ ?><a href="<?php echo base_url(); ?>manage-workshop">My Dashboard</a><?php }elseif($ses_data['user_type']==2){?><a href="<?php echo base_url(); ?>nodal-coordinator">My Dashboard</a><?php } ?> 
<?php } ?></li></ul>
</div>



		
		
						
						<nav class="navbar pull-right" role="navigation">
					<div class="nav-top collapse navbar-collapse">
						<ul id="main-menu" class="nav navbar-nav">
					
                                          </ul>
					</div>
                    </nav>
						
						
                   </div>
                   <div id="divaid" style="text-align:center;font-size:14px;font-weight:600">
		<?php if($ses_data['user_type']==2){  ?> <span > Welcome <?php echo ucfirst($ses_data['name']); ?>, Nodal	Center	Coordinator</span><?php }?>
		</div>
		     
		
				</div>
			</div>
		</div>	
	
		<style>
		.button-nav{
		 padding: 10px 10px;
		  }
		</style>
	<div class="row task-title">
    <div class="container">
		<?php $ses_data=$this->session->userdata('user_details'); if($ses_data){?>
		
		<?php }else{ ?>
		<?php }?>
		
    </div>
    	<div id="divaid1" style="text-align:center;font-size:14px;font-weight:600">
		<?php if($ses_data['user_type']==1){  ?> <span > Welcome <?php echo ucfirst($ses_data['name']); ?>, Outreach Coordinator</span><?php }?>
		</div>
</div>	