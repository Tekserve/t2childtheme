<?php
/*
Template Name: Tekserve


*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300' rel='stylesheet' type='text/css'>
<title><?=$post->post_title?> - A T2 Computing Computing Brand</title>
<style>
		* {
		font-family: 'Open Sans', sans-serif;
	}
	html, body{
		height:100%;
	
		position: relative;
		padding: 0;
		margin: 0;
	}
	#outer{
		max-width:1200px;
		
	}
	a{
		text-decoration: none;
		
	}
	a:hover{
		text-decoration: underline;
	}
	
	header{
		
		position: fixed;
		height: 70px;
		width: 100%;
		background-color: #fff;
		z-index: 100;
		top:0px;
	}
	#wrapper{
		
		padding: 120px 0px 90px;
		position: relative;
		width:90%;
		margin: 0px auto;
	}
	#nav-bar{
		background-color:#0A4D72;
		display: table;
		width: 100%;
		border-bottom:2px solid #eee;
	}
	.watermark{
		
		color:rgba(255,0,0,0.15);
		font-size:2em;
	 
		display: inline-block;
		float: left;
		text-transform: uppercase;
		margin-left: 5%;
		font-weight: bold;
	
	}
	h1{
		color:#0A4D72;
		display: block;
		clear: both;
		text-align: center;
	}
	h2{
		color:#0A4D72;
		display: block;
		clear: both;
		margin-top: 2em;
	}
	#tekserve-logo{
		max-width: 100%;
		float: left;
		display: inline-block;		
		height:50px;
		padding: 10px 0px;
		margin-left: 4%;
	}
	#t2brand{
		height:35px;
		float: right;
		display: inline-block;
		margin-right: 5%;
		padding: 10px 0px;
	}
	.inline-image{
			display: inline;
		}
		.left{
			float:left;
			margin:0px 15px 15px 0px;
		}
	
	#tekserve-logo img{
		height:100%;		
	}
	#t2brand img{
		height:70%;		
	}
	footer{
		text-align: center;
		background-color:#0A4D72;
		font-size: 80%;
		color: #fff;
		
		width: 100%;
		position: fixed;
		    padding: 15px 0px;
		bottom:0px;
	} 
	footer a{
		color: #fff;
	}
	footer span{
		max-width:80%;
		display: block;
		margin:30px auto;
	}
	
	#tekserve-menu{
		
		font-size: 80%;
		color: #fff;
		display: inline-block;
		float:right;
		margin-right: 5%;
			
	}
	
	#tekserve-menu ul {
		display: inline-block;
		float: right;
		margin-right: 25px;
	}
	#tekserve-menu ul li{
		display: inline-block;
		list-style-type: none;
		padding:0px 5px;
		border-left:1px solid #eee;
	}
	#tekserve-menu ul li:first-child{
		border-left:0px solid #eee;
	}
	#tekserve-menu ul li.current-menu-item a{
		color: #9AD8E2;
	}
	#tekserve-menu ul li a{
		color: #fff;
	}
	.vector{
		height:100px;
		width:100px;
		
	}
	@media(max-width:540px){
		h2 {
			text-align: center;
		}
		header{
			height:130px;
			padding: 0px;
		}
		footer{
			font-size: 65%;
		} 
		#tekserve-logo{
			padding: 10px;
			margin: 0px auto;
			float:none;
			display: block;
			clear:both;
			max-width: 250px;
			height:75px;
		}
		.inline-image{
			display:block;
		}
		
		.left{
			float:none;
			max-width:	270px;
			margin:0px auto 15px;
		
		}
		#t2brand{
			display: block;
			float: none;
			margin: 0px auto;;
			clear:both;
			max-width: 140px;
			padding:0px;
		}	
		
		#wrapper{
			margin-top: 120px;
			position: relative;
			padding:50px 0px 100px;
			
		}
		
	}
	
	
</style>
</head>

<body>
	<div id="outer">
	<header>
		<div id="tekserve-logo" class="header-logo">
<a href="/tekserve-enterprise"><img src="/wp-content/uploads/2014/12/TekserveEnterprise-01.svg" alt="Tekserve"></a>
		</div>
		<div id="t2brand" class="header-logo">
<a href="http://t2computing.com"><img src="/wp-content/uploads/2014/12/a-t2-brand-01.svg" alt="A T2 Computing Brand"></a>
		</div>
		<div id="nav-bar">
	<div class="watermark">BETA</div>		
		<nav id="tekserve-menu" class="" role="navigation">
				<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' => 'tekserve-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		</div>
	</header>	
		<div id="wrapper">
		
		
			<h1><?=$post->post_title?></h1>
			<?=wpautop($post->post_content)?>
			
		</div>
	
	<footer>
		
	
						 <a href="/privacy">Privacy Statement</a> | <a href="/terms-of-use">Terms of Use</a> | © 2017 - T2 Computing, Inc.
									
</footer>
		</div>
</body>
</html>
	