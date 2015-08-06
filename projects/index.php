<?php 
require("../assets/functions.php");
$projects_css = "<link rel='stylesheet' href='/assets/css/projects.css' type='text/css' />";
$projects_js  = "<script type='text/javascript' src='/assets/js/projects.js'></script>";
functions::print_header("Projects | HexR",array(),array($projects_js),array($projects_css));

?>
<h1 class="center">HexR Projects</h1>
<p>When not working with clients, HexR works on projects to better serve the community. Here are some of the projects that we are working on:</p>
<div class="projects">
	<div class="project-row">
		<div class="project">
			<div class="project-title">TWMaker</div>
			<div class="project-subtitle">Access all your teachers' websites in one page</div>
			<div class="project-description">TWMaker allows you to access the websites of 8 different teachers in one page, allowing you to access their websites anywhere with a simple to remember link.</div>
			<div class="project-logos">
				<div class="project-logo logo-github" data-bind-href="https://github.com/HexRdesign/twmaker"></div>
				<div class="project-logo logo-favicon logo-favicon-twmaker" data-bind-href="/projects/twmaker"></div>
			</div>
		</div>
		<div class="project">
			<div class="project-title">ImageHosting</div>
			<div class="project-subtitle">Quickly upload and store an image</div>
			<div class="project-description">Image Hosting allows a user to upload an image and choose the file-name or have it randomly generated</div>
			<div class="project-logos">
				<div class="project-logo logo-github" data-bind-href="https://github.com/HexRdesign/imagehosting"></div>
				<div class="project-logo logo-favicon logo-favicon-ih" data-bind-href="/projects/imagehosting"></div>
			</div>
		</div>
	</div>
	<div class="project-row">
		<div class="project project-coming-soon">
			<div class="project-coming-soon-ribbon">Coming Soon!</div>
			<div class="project-title">HexMS</div>
			<div class="project-subtitle">Website management made simple</div>
			<div class="project-description">HexR Management System is our take on CMS. Simple, Modern, Easy to install and use</div>
			<div class="project-logos">
				<div class="project-logo logo-github project-disabled-logo"></div>
				<div class="project-logo logo-favicon logo-favicion-null project-disabled-logo"></div>
			</div>
		</div>
	</div>
	<div class="project-row">
		<div class="project project-coming-soon">
			<div class="project-coming-soon-ribbon">Coming Soon!</div>
			<div class="project-title">MediaPHP</div>
			<div class="project-subtitle">Simple media manager</div>
			<div class="project-description">MediaPHP is a quick, simple and easy to use interface to manage media on a website - create playlists, shuffle and repeat music, manage collections</div>
			<div class="project-logos">
				<div class="project-logo logo-github project-disabled-logo"></div>
				<div class="project-logo logo-favicon logo-favicion-null project-disabled-logo"></div>
			</div>
		</div>
	</div>
	<div class="project-row">
		<div class="project project-coming-soon">
			<div class="project-coming-soon-ribbon">Coming Soon!</div>
			<div class="project-title">Spotify Web Player</div>
			<div class="project-subtitle">A simple to use extension to increase web interface productivity</div>
			<div class="project-description">Here at HexR, we use Spotify like crazy. With a beautiful web interface, we couldn't resist creating an extension that uses built in hotkeys to skip tracks.</div>
			<div class="project-logos">
				<div class="project-logo logo-github project-disabled-logo"></div>
				<div class="project-logo logo-favicon logo-favicion-null project-disabled-logo"></div>
			</div>
		</div>
	</div>
</div>
<?php 
functions::print_footer();
?>