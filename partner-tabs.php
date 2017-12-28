				<style>
					* {
  box-sizing: border-box;
  -webkit-tap-highlight-color: rgba(255,255,255,0);
}
body {
 
}
a {
  text-decoration: none;
  color: inherit;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
.nav {
  will-change: transform;
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1;
  
  -webkit-transform: translateY(-100%);
          transform: translateY(-100%);
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
.nav--active {
  -webkit-transform: translateY(0);
          transform: translateY(0);
}
.nav__list {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
}
.nav__item {
	list-style: none!important;
  -webkit-box-flex: 1;
  -webkit-flex: 1;
      -ms-flex: 1;
          flex: 1;
  position: relative;
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
.nav__item:hover {
  opacity: 0.75;
}
@media (max-width: 720px) {
	.nav__item:nth-child(5) {
		display:none;	
	}
	
	
}
.nav__thumb {
  display: block;
  height: 120px;
  background: rgba(43,153,212, 0.9);
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
.nav__thumb:before {
  content: attr(data-letter);
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 70px;
  text-transform: uppercase;
  opacity: 0.15;
}
.nav__label {
  position: absolute;
  top: 50%;
  left: 50%;
  font-weight:600;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  text-transform: uppercase;
  letter-spacing: 2px;
  color: #fff;
  margin: 0;
  text-align:center;
}
@media (min-width:721px) and (max-width: 1200px) {
  .nav__label {
    font-size: 12px;
  }
}
@media (max-width: 539px) {
	.nav__label {
		font-size:1.6vw;
	}
					}
@media (min-width:540px) and (max-width: 720px) {
  .nav__label {
   /* display: none;*/
		font-size:10px;
	
  }
  .nav__thumb {
    height: 90px;
  }
  .nav__thumb:before {
    font-size: 32px;
    opacity: 0.7;
  }
}
.burger {
  position: absolute;
  right: 0;
  top: 100%;
  width: 60px;
  height: 60px;
  background: #1a1a1a;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
      -ms-flex-pack: center;
          justify-content: center;
}
.burger__patty {
  position: relative;
  width: 60%;
  height: 2px;
  background: #fff;
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
.burger__patty:before,
.burger__patty:after {
  will-change: transform;
  content: "";
  position: absolute;
  left: 0;
  background: #fff;
  height: 2px;
  width: 100%;
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
.burger__patty:before {
  top: -10px;
}
.burger__patty:after {
  top: 10px;
}
.burger--close .burger__patty {
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
}
.burger--close .burger__patty:before {
  -webkit-transform: rotate(-90deg) translate(-9px, 0);
          transform: rotate(-90deg) translate(-9px, 0);
}
.burger--close .burger__patty:after {
  opacity: 0;
  -webkit-transform: scaleX(0);
          transform: scaleX(0);
}

.partners-page {
  height:1000px;
  will-change: transform;
  -webkit-perspective: 400px;
          perspective: 400px;
  overflow-x: hidden;
  overflow-y: auto;
  -webkit-transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.45s cubic-bezier(0.23, 1, 0.32, 1);
}
@media(max-width:554px){
	.partners-page {
		height:3500px;
		
	}	
}
@media(min-width:556px){
	.partners-page {
		height:1230px;
		
	}	
}


@media(min-width:991px){
	.partners-page {
		height:1880px;
		
	}	
}

@media(min-width:1200px){
	.partners-page {
		height:1480px;
		
	}	
}

@media(min-width:1600px){
	.partners-page {
		height:1270px;
		
	}	
}



@media(min-width:1920px){
	.partners-page {
		height:1000px;
		
	}	
}
					.nav-link-active .nav__thumb{
						background: #40a3d8;
					}
					.nav__thumb{
						background: #2b6d91;
					}

.section {
  will-change: transform;
  position: absolute;
  width: 100%;
  top: 0;
  left: 0;

  overflow: hidden;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
      -ms-flex-pack: center;
          justify-content: center;
  text-align: center;
  background: #fff;
  -webkit-transform: translateX(100%);
          transform: translateX(100%);
  -webkit-transition: all 0.7s cubic-bezier(0.23, 1, 0.32, 1);
  transition: all 0.7s cubic-bezier(0.23, 1, 0.32, 1);
  height:100%;
}
.section--hidden {
  -webkit-transform: translateX(-100%);
          transform: translateX(-100%);
}
.section--active {
  -webkit-transform: translateX(0) rotateY(0);
          transform: translateX(0) rotateY(0);
  z-index: 2;
}
.section:before {
  content: attr(data-letter);
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 75vh;
  text-transform: uppercase;
  opacity: 0.15;
  color:rgba(255,255,255,1);
  z-index: -1;
}
.section__wrapper {
  width: 100%;
 align-self: flex-start;
  padding: 0px;
  margin-top:2em;
}
.section__title {
  margin: 0 0 25px 0;
  font-size: 24px;
  text-transform: uppercase;
  letter-spacing: 4px;
  color:#fff;
}
.section p {
	max-width:720px;
	padding:0px 5%;
	color:#fff;
	margin:0px auto;
	text-align:left;
}
.section span {
	color:#fff;
}
.section p:last-child {
  margin-bottom: 0;
}/**/
.color1 {
  background: #40a3d8;
  
}
.color2 {
  background: #40a3d8;
}
.color3 {
  background: #40a3d8;
}
.color4 {
  background: #40a3d8;
}
.color5 {
  background: #40a3d8;
}
.color5 span{
	color: rgba(255,255,255, 0.9);
}
.color5 h2.section__title{
   color: rgba(255,255,255, 0.9);
   
}
.color6 {
  background:  #2b6d91;
}

@media (max-width: 720px) {

}
					.nav_thumb{
						background:;
					}
.nav__item p{
	display:inline-block;
	float:left;
}
.nav__label img{
	width:65px;
	height:65px;
	display:block;
	margin:0px auto;
	
}
.nav__label span{
	display:block;
	text-align:center;
}

				</style>
               
                  <div id="partners-menu" class="clearfix">
                  <?php
					 $partner_categories = get_partner_categories();
					 $workflow = display_partner_categories($partner_categories['workflow']);
					 
					  $mam = display_partner_categories($partner_categories['media-asset-management']);
					   $storage = display_partner_categories($partner_categories['storage']);
					    $mobility = display_partner_categories($partner_categories['mobility']);
					  	$active = display_partner_categories($partner_categories['partners']);
						
					  ?>
                    <div id="partners-nav">
                    	<nav class="nav nav--active">
  <ul class="nav__list">
   
    <li class="nav__item">
      <a href="" class="nav__link">
        <div class="nav__thumb" data-letter=""></div>
        <p class="nav__label"><img src="/wp-content/uploads/2014/12/workflow.svg" alt="workflow"><span>Workflow</span></p>
      
        
      </a>
    </li>
    <li class="nav__item">
      <a href="" class="nav__link">
        <div class="nav__thumb" data-letter=""></div>
        <p class="nav__label"><img src="/wp-content/uploads/2014/12/infrastructure.svg" alt="workflow"><span>Infrastructure</span></p>
       
      </a>
    </li>
    <li class="nav__item">
      <a href="" class="nav__link">
        <div class="nav__thumb" data-letter=""></div>
        <p class="nav__label"><img src="/wp-content/uploads/2014/12/storage.svg" alt="Storage"><span>Storage</span></p>
       
      </a>
    </li>
    <li class="nav__item">
      <a href="" class="nav__link">
        <div class="nav__thumb" data-letter=""></div>
        <p class="nav__label"><img src="http://t2computing.staging.wpengine.com/wp-content/uploads/2014/12/mobility.svg" alt="Storage"><span>Mobility</span></p>
        
      </a>
    </li> 
     <li class="nav__item">
      <a href="" class="nav__link  nav-link-active">
        <div class="nav__thumb" data-letter="T2"></div>
        <p class="nav__label">All Partners</p>
      </a>
    </li>
  </ul>

</nav>
</div>
<div class="partners-page">
  <section class="section color1" data-letter="T2">
    <article class="section__wrapper">
      <h2 class="section__title">Workflow</h2>
  
      	<p>We manage broadcast and film post-production for global media companies, and independent post  production facilities.  We  are  known  for  our  experience  and  talent in
the media workflow space. From production to archive, our team pinpoints and installs the most reliable tools to advance end-to-end digital  media solutions.
.</p>
     
     	<?=$workflow?>
    </article>
  </section>
  <section class="section color2" data-letter="T2">
    <article class="section__wrapper">
      <h2 class="section__title">Infrastructure</h2>
      <p>Our best-in-breed approach enables us to execute our clients’ visions by applying unique networking solutions that address the challenges media-centric organizations encounter today. The immeasurable experience we possess equips us with the expertise to deliver high bandwidth and high availability solutions.
</p>
      
    	<?=$mam?>
        
    </article>
  </section>
  <section class="section color3" data-letter="T2">
    <article class="section__wrapper">
      <h2 class="section__title">Storage</h2>
      
<p>Well versed in broadcast workflows, our consultative methodology envelopes the delivery of storage solutions  that   are   efficient   and   flexible.   Unlike   other     solutions
designers, we do not believe in a one size fits all approach, delivering   a  best-of-breed  and  best-in-class  approach  to  storage  projects.
</p>
 	<?=$storage?>
  </section>
  <!----><section class="section color4" data-letter="T2">
    <article class="section__wrapper">
      <h2 class="section__title">Mobility</h2>
    	    	<p>From procurement, activation, and provisioning, to supervision, management, and repair, we deliver mobility services on any carrier, with or without an existing corporate contract. We partner with leading providers and employ proven methods to enable the most demanding mobile installations.</p>

		<?=$mobility?>
    </article>
  </section>
  <section class="section  section--active color5" data-letter="T2">
    <article class="section__wrapper">
      <h2 class="section__title">Partners</h2>
      <?=$active?>
    </article>
  </section>
 
</div>


              
					<?php
					 
					//  echo display_partners(4);
					
					?>
					
					</div>
			</div> <br>
<script>
var Nav = (function() {
  
  var
  	nav 		= jQuery('.nav'),
  	burger	= jQuery('.burger'),
    page 		= jQuery('.partners-page'),
    section = jQuery('.section'),
    link		= nav.find('.nav__link'),
    navH		= nav.innerHeight(),
    isOpen 	= true,
    hasT 		= false;
  
  var toggleNav = function() {
    nav.toggleClass('nav--active');
    burger.toggleClass('burger--close');
    shiftPage();
  };
  
  var shiftPage = function() {
    if (!isOpen) {
      page.css({
        //'transform': 'translateY(' + navH + 'px)',
        //'-webkit-transform': 'translateY(' + navH + 'px)'
      });
      isOpen = true;
    } else {
      page.css({
        'transform': 'none',
        '-webkit-transform': 'none'
      });
      isOpen = false;
    }
  };
  
	
	
  var switchPage = function(e) {
    var self = jQuery(this);
    var i = self.parents('.nav__item').index();
    var s = section.eq(i);
    var a = jQuery('section.section--active');
	var x = jQuery('.nav-link-active');
	  console.log(x);
	  x.removeClass('nav-link-active');
    var t = jQuery(e.target);
 	//clearSelectedNav();
    if (!hasT) {
      if (i == a.index()) {
        return false;
      }
	 
	  self.addClass("nav-link-active");	
      a
      .addClass('section--hidden')
      .removeClass('section--active')
		  .removeClass('nav-link-active');

      s.addClass('section--active');

      hasT = true;

      a.on('transitionend webkitTransitionend', function() {
        jQuery(this).removeClass('section--hidden');
        hasT = false;
        a.off('transitionend webkitTransitionend');
      });
    }

    return false;
  };
  
  var keyNav = function(e) {
    var a = jQuery('section.section--active');
    var aNext = a.next();
    var aPrev = a.prev();
    var i = a.index();
    
    
    if (!hasT) {
      if (e.keyCode === 37) {
      
        if (aPrev.length === 0) {
          aPrev = section.last();
        }

        hasT = true;

        aPrev.addClass('section--active');
        a
          .addClass('section--hidden')
          .removeClass('section--active');

        a.on('transitionend webkitTransitionend', function() {
          a.removeClass('section--hidden');
          hasT = false;
          a.off('transitionend webkitTransitionend');
        });

      } else if (e.keyCode === 39) {

        if (aNext.length === 0) {
          aNext = section.eq(0)
        } 


        aNext.addClass('section--active');
        a
          .addClass('section--hidden')
          .removeClass('section--active');

        hasT = true;

        aNext.on('transitionend webkitTransitionend', function() {
          a.removeClass('section--hidden');
          hasT = false;
          aNext.off('transitionend webkitTransitionend');
        });

      } else {
        return
      }
    }  
  };
    
  var bindActions = function() {
    burger.on('click', toggleNav);
    link.on('click', switchPage);
    jQuery(document).on('ready', function() {
     
    });
    jQuery('body').on('keydown', keyNav);
  };
  
  var init = function() {
    bindActions();
  };
  
  return {
    init: init
  };
  
}());

Nav.init();
</script>
			