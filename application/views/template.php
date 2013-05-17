<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo isset($title) ? $title : "Leads"; ?></title>
	<?php /*<meta name="description" content="<?php echo $description ?>"> */ ?>
	<meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css">
  <script src="<?php echo base_url(); ?>public/js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body>
	<!--[if lt IE 7]>
	  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
	<![endif]-->

	<div class="container-fluid">

		<div class="main row-fluid" role="main">

			<div class="span3">

				<h2>Administration</h2>
				<p class="lead">The description goes here . . .</p>
			
				<?php $this->load->view("_includes/navigation") ?>
			</div>

			<div class="span9">
			
				<?php $this->load->view($main_content);?>

			</div>
				
		
		</div>
	</div>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>public/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	
	<script src="<?php echo base_url(); ?>public/js/vendor/bootstrap.min.js"></script>
	<script src="https://raw.github.com/Polychart/polychart2/develop/polychart2.standalone.js"></script>


	<script src="<?php echo base_url(); ?>public/js/plugins.js"></script>
	<script src="<?php echo base_url(); ?>public/js/main.js"></script>


	<script>
		
		jQuery(document).ready(function($) {
			
			var jsondata = [
		    {Leads: 'Site 1', Count: 5}, 
		    {Leads: 'Site 2', Count: 23}, 
		    {Leads: 'Site 3', Count: 4}, 
		    {Leads: 'Site 4', Count: 8}, 
		    {Leads: 'Site 5', Count: 20}, 
		    {Leads: 'Site 6', Count: 8}, 
		    {Leads: 'Site 7', Count: 15}, 
		    {Leads: 'Site 8', Count: 30}, 
		    {Leads: 'Site 9', Count: 14}, 
		    {Leads: 'Site 10', Count: 18}, 
		    {Leads: 'Site 11', Count: 10}, 
		    {Leads: 'Site 12', Count: 9}, 
		    {Leads: 'Site 13', Count: 20}, 
		    {Leads: 'Site 14', Count: 19}
			];
			polyjs.chart({
			    title: 'Leads Performance per week',
			    dom: 'chart',
			    width: $('.span9').width(),
			    layer: {
			        data: polyjs.data({data: jsondata}),
			        type: 'bar',
			        x: 'Leads',
			        y: 'Count',
			        color: { const: '#36454F' }
			    }
			});

		});
	</script>

</body>
</html>