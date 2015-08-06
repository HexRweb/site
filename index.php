<?php 
	include("assets/functions.php");
$onload = '<script>$(document).ready(function()
{
if(! $.fn.fullpage)
	throw new Error("FullPage.js was not properly loaded.");

	$("#content").fullpage(
		{
			menu:"button-nav",
			srollingSpeed:500,
			navigation:!0,
			responsive:1,
			onLeave:function(l,o,e)
			{
				0 === o ? $(".fa.fa-5x.fa-arrow-circle-up").css("visibility","hidden") : $(".fa.fa-5x.fa-arrow-circle-up").css("visibility","visible"); 
				1==o ? setTimeout(function()
					{
						$(".scrollup").fadeOut();
					},300) :setTimeout(function()
					{
						$(".scrollup").fadeIn();
					},300);
				$(".scroll").removeClass("active");
				$($(".scroll")[o-1]).addClass("active");
				if(window.localStorage)	window.localStorage.setItem("hexr-last-position",o);
			}
			,nav:!1
		});
	if(window.localStorage && window.localStorage.getItem("hexr-last-position"))
	{
		$.fn.fullpage.moveTo(parseInt(window.localStorage.getItem("hexr-last-position")));
		$("header").fadeIn();
	}
	$(".nav ul li").click(function()
	{
		$.fn.fullpage.moveTo(parseInt($(this).attr("data-scroll")));
	});
	$(".scroll-button a").click(function()
	{
		$.fn.fullpage.moveTo(parseInt($(this).parent().parent().attr("data-scroll")));
	});
	$(".scrollup").click(function()
	{
		$.fn.fullpage.moveTo(parseInt($("body").attr("class").split("fp-viewing-")[1])-1 > 0 ? parseInt($("body").attr("class").split("fp-viewing-")[1]):1)
	});
});</script>';
$fullpage = "<script type='text/javascript' src=\"/assets/js/fullpage.min.js\"></script>";
$fullpagecss = "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.5.6/jquery.fullPage.css\" type='text/css' />";
$main = "<link rel=\"stylesheet\" href=\"/assets/css/home.css\" type='text/css' />";
functions::print_header("Home | HexR", $meta = array(),$scripts = array($fullpage,$onload),$styles=array(functions::FONTAWESOME,$fullpagecss,$main));
?>
		<section>
			<div id="content">
				<div class='section' id="home" data-anchor="home">
					<div class="container content"><h1>HexR</h1><h4>Simply modern websites</h4></div>
					<div class="scroll-button home-scroll" data-scroll="2">
						<p>About us</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: About us"></a></div>
					</div>
				</div>
				<div class='section' id="about" data-anchor="about">
					<div class="container">
						<h1>About HexR</h1><p>HexR - Noun - An organization founded in April 2014 dedicated to embodying the principles of the <a href="#" onclick="$.fn.fullpage.moveTo('initiative')">HexR initiative</a>.
					</div>
					<div class="scroll-button contact-scroll" data-scroll="3">
						<p>Initiative</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: Initiative"></a></div>
					</div>
				</div>
				<div class='section' id="initiative" data-anchor="initiative">
					<div class="container">
						<h1>The HexR Initiative</h1>
						<p>HexR initiave - Noun - An idea, developed by HexR creating a set of guiding priciples on making the internet a simple, better and modern place. <a class="more" href="<?php  print functions::get_link("initiative");?>">See it</a> | <a href="<?php  print functions::get_link("initiative");?>/#about">Learn More</a></p>
					</div>
					<div class="scroll-button initiative-scroll" data-scroll="4">
						<p>Projects</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: Projects"></a></div>
					</div>
				</div>
				<div class='section' id="projects" data-anchor="projects">
					<div class="container">
						<h1>Projects from HexR</h1>
						<p>At HexR, our goal is more than a client. <a href="<?php  print functions::get_link("projects");?>">Check out the projects to see what else we do</a></p>
					</div>
					<div class="scroll-button projects-scroll" data-scroll="5">
						<p>Pricing</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: Pricing"></a></div>
					</div>
				</div>
				<div class='section' id="pricing" data-anchor="pricing">
					<div class="container">
						<h1>Plans</h1>
						<p>We have <a href="<?php  print functions::get_link("plans");?>">plans</a>! Not really. Our plans just take into account how much you would spend for services. To see our plan summaries, <a href="<?php  print functions::get_link("plans");?>">click here</a></p>
					</div>
					<div class="scroll-button projecs-scroll" data-scroll="6">
						<p>Contact us</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: Contact us"></a></div>
					</div>
				</div>
				<div class='section' id="contact" data-anchor="contact">
					<div class="container">
						<h1>Contact HexR</h1>
						<p>Do <i>YOU</i> want your own website? Do you want to talk to us? Want to donate? Something we didn't list? Comments on our new website? <a href="<?php  print functions::get_link("contact");?>">Why not contact us?</a></p>
					</div>
					<div class="scroll-button contact-scroll" data-scroll="7">
						<p>Nutshell</p>
						<div><a class="fa fa-5x fa-arrow-circle-down scroll-arrow" title="Next Section: Nutshell"></a></div>
					</div>
				</div>
				<div class='section' id="footer" data-anchor="foother">
					<h1>HexR is <em>simple</em> yet <i>modern</i></h1>
					<p>Like this nutshell. Click something below to learn more</p>
					<div class="home-cards">
						<div class="home-card"><a href="<?php  print functions::get_link("about"); ?>">About</a></div>
						<div class="home-card"><a href="<?php  print functions::get_link("initiative"); ?>">Initiative</a></div>
						<div class="home-card"><a href="<?php  print functions::get_link("projects"); ?>">Projects</a></div>
						<div class="home-card"><a href="<?php  print functions::get_link("plans"); ?>">Plans</a></div>
						<div class="home-card"><a href="<?php  print functions::get_link("contact"); ?>">Contact</a></div>
					</div>
				</div>
			</div>
		</section>
		<section class="scrollup"><a class="fa fa-5x fa-arrow-circle-up" title="Previous Section"></a></section>
		<section class='nav'>
			<ul class="home">
				<li title="Home" data-scroll="1" class='scroll scroll-hero active'></li>
				<li title="About" data-scroll="2" class='scroll scroll-about'></li>
				<li title="Initiative" data-scroll="3" class='scroll scroll-initiative'></li>
				<li title="Projects" data-scroll="4" class='scroll scroll-projects'></li>
				<li title="Pricing" data-scroll="5" class='scroll scroll-pricing'></li>
				<li title="Contact" data-scroll="6" class='scroll scroll-contact'></li>
				<li title="Nutshell" data-scroll="0" class="scroll scroll-contact"></li>
			</ul>
		</section>
		<footer></footer>
	</body>
</html>