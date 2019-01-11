<?php
if(!isset($_POST['submitted']))
{
	header("Location: /error_403?path=/request/post.php");
	die();
}
$fname  = $_POST["first_name"];
$lname  = $_POST["last_name"];
$email  = $_POST["email"];
$phone  = $_POST["phone"];
$org    = $_POST["organization"];
$site   = $_POST["website"];
$desc   = $_POST["org-desc"];
$reqs   = $_POST["org-web-requirements"];
$emplys = $_POST["num-employees"];
$incm   = $_POST["income"];
$prft   = (isset($_POST["profit"]) && $_POST['profit'] == 'on') ? 'For Profit' : 'Not for Profit';
$resp   = (isset($_POST["g-recaptcha-response"])) ? $_POST["g-recaptcha-response"] : "noresponse";
$ip     = $_SERVER['REMOTE_ADDR'];

filter_var(trim($fname,FILTER_SANITIZE_STRING));
filter_var(trim($lname,FILTER_SANITIZE_STRING));
filter_var(trim($email,FILTER_SANITIZE_EMAIL));
filter_var(trim($phone,FILTER_SANITIZE_NUMBER_INT));
filter_var(trim($org,FILTER_SANITIZE_STRING));
filter_var(trim($site,FILTER_SANITIZE_ENCODED));
filter_var(trim($desc,FILTER_SANITIZE_STRING));
filter_var(trim($reqs,FILTER_SANITIZE_STRING));
filter_var(trim($emplys,FILTER_SANITIZE_NUMBER_INT));
filter_var(trim($incm,FILTER_SANITIZE_NUMBER_FLOAT));
//filter_var(trim($prft,FILTER_SANITIZE_STRING));
filter_var(trim($resp,FILTER_SANITIZE_STRING));

/*First Google Capcha*/
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => '6LcnNikTAAAAAKBJuErJwuNOBQdMqCcv0Dc5ZlHr', 'remoteip' => $_SERVER['REMOTE_ADDR'], 'response' => $resp);
// use key 'http' even if you send the request to https://...
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data),
	),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$arr = (array)json_decode($result);
$clientText = "**Client Copy**";
$hexrcopy   = "*Our Copy*";
/*This is what it boils down to*/
if($arr["success"])
{

	//Load required libraries

	require("../assets/class.mail.php");
	require("../assets/mail.smtp.php");

	$mailer = new PHPMailer;
	$meMailer = new PHPMailer;

	$mailer->isSMTP();
	$mailer->SMTPSecure = "ssl";
	$mailer->SMTPDebug = 0;
	$mailer->DebugOutput = 'html';
	$mailer->Host = 'smtp.mailgun.org';
	$mailer->Port = 465;
	$mailer->SMTPAuth = true;
	$mailer->Username = "request@robots.hexr.org";
	$mailer->Password = "npiudzdkoyaqsrgz";
	$mailer->setFrom("request@robots.hexr.org", "HexR Request Robot");
	$mailer->addReplyTo("request@hexr.org", "HexR Request Management");
	$mailer->addAddress($email, $fname . " ". $lname);


    $meMailer->isSMTP();
 	$meMailer->SMTPSecure = "ssl";
    $meMailer->SMTPDebug = 0;
    $meMailer->DebugOutput = 'html';
    $meMailer->Host = 'smtp.mailgun.org';
    $meMailer->Port = 465;
    $meMailer->SMTPAuth = true;
    $meMailer->Username = "request@robots.hexr.org";
    $meMailer->Password = "npiudzdkoyaqsrgz";
    $meMailer->setFrom("request@robots.hexr.org", "HexR Request Robot");
    $meMailer->addReplyTo("request@hexr.org", "HexR Request Management");
    $meMailer->addAddress("request@hexr.org","HexR Request Management");


	/*now set up the email*/
	$subject = "$fname $lname from $org wants a website";
	$body = "
	Hello! \n<br/>
	\t	Thank you for requesting a website from HexR. This is your copy of the 'receipt' saying you asked for this website. If you didn't ask for this website, please contact us immediately so we don't bother you. The information below is what you provided to us. \n\n<br/><br/>
	Information: \n<br/>
	<strong>First name      </strong> : $fname  \n<br/>
	<strong>Last name       </strong> : $lname  \n<br/>
	<strong>Email Address   </strong> : $email  \n<br/>
	<strong>Phone Number    </strong> : $phone  \n<br/>
	<strong>Organization    </strong> : $org    \n<br/>
	<strong>Current Site    </strong> : $site   \n<br/>
	<strong>Org Description </strong> : $desc   \n<br/>
	<strong>Site Requirments</strong> : $reqs   \n<br/>
	<strong>Number Employees</strong> : $emplys \n<br/>
	<strong>Income          </strong> : $incm   \n<br/>
	<strong>NonProfit       </strong> : $prft   \n<br/>
	<strong>Requesting IP   </strong> : $ip     \n<br/>
	\n<br/>
	===This email was sent by a robot. Please contact <a href='mailto:support@hexr.org' target='_blank'> support@hexr.org</a> for help.=== \n<br/>
	";
/*	$headers = 'From: HexR Robot <noreply@hexr.org>' . "\r\n" .
    'Reply-To: support@hexr.org' . "\r\n" .
    'MIME-Version: 1.0\r\n' . "\r\n" .
	'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();*/
	//print $body;
	//print("Sending to $email returned ");
	//print(mail($email,$subject,$body.$clientText,$headers));
	//print("Sending to us returned ");
	//print(mail("request@hexr.org",$subject,$body.$hexrcopy,$headers));

	$mailer->Subject = $subject;
	$mailer->msgHTML($body.$clientText);

	$meMailer->Subject = $subject;
	$meMailer->msgHTML($body.$hexrcopy);

	$header = "Request Your Site";
	$mailerSuccess = $mailer->send();
	$meSuccess =$meMailer->send();
	$content = "<div id='status'>Email to {$email}: {$mailerSuccess}<br/>Email to HexR: {$meSuccess}</div><div class='container'><h1>Thanks for requesting a site!</h1><p class='flow-text'>We just sent you an email with the following content:</p><blockquote><p>{$body}</p></blockquote><p class='flow-text'>We'll respond to you as soon as possible.</p></div>";
}
else
{
	//based off 403 template
	Header( "HTTP/1.1 403 Restricted Content" );
	$header = "403 - Unauthorized";
	$content = "<div class='container'><h1 class='center'>Error | 403</h1><p class='center flow-text'>Form resubmissions are disabled. You are not allowed to access this page.</p></div>";
}
?>
<!doctype html><html><head><title><?php echo $header;?> | HexR</title><meta name='description' content='An empty page' /><meta name='keywords' content='HexR Website Design Development Free' /><meta name="robots" content="index, follow" /><meta name='language' content='english' /><meta name='author' content='HexR' /><meta name='viewport' content="width=device-width, initial-scale=1"><meta name='HandheldFriendly' content='true' /><meta charset='UTF-8' /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css" type="text/css" /><link href="/assets/css/global.css" rel="stylesheet"><script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script><script type="text/javascript" src="/assets/js/combined.min.js"></script><noscript><style>main,footer{display:none}#noscript{display:inherit}</style></noscript></head><body class="cyan darken-2"><header><div class="navbar-fixed hexr-background"><nav class="hexr-background"><div class="nav-wrapper hexr-background"><a href="/" class="brand-logo font-anders hide-on-med-and-down">HexR</a><a href="/" class="brand-logo font-anders center hide-on-large-only">HexR</a><a href="#" data-activates="mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a><ul class="right hide-on-med-and-down"><li><a class="flow-text" href="/about">About</a></li><li><a class="flow-text" href="/initiative">Initiative</a></li><li><a class="flow-text" href="/projects">Projects</a></li><li><a class="flow-text" href="/pricing">Pricing</a></li><li><a class="flow-text" href="/faq">FAQ</a></li><li><a class="flow-text" href="/clients">Clients</a></li><li><a class="flow-text" href="/sponsors">Sponsors</a></li><li><a class="flow-text" href="/contact">Contact</a></li><li><a class="center" href="/the-book">The Book</a></li></ul><ul class="side-nav page-background white-text" id="mobile"><li><a class="center" href="/about">About</a></li><li><a class="center" href="/initiative">Initiative</a></li><li><a class="center" href="/projects">Projects</a></li><li><a class="center" href="/pricing">Pricing</a></li><li><a class="center" href="/faq">FAQ</a></li><li><a class="center" href="/clients">Clients</a></li><li><a class="center" href="/the-book">The Book</a></li><li><a class="center" href="/sponsors">Sponsors</a></li><li><a class="center" href="/contact">Contact</a></li></ul></div></nav></div></header><div id="noscript" class="center valign-wrapper animated bounce"><div class="valign center" id="noscript-wrapper"><h5>Uh-Oh!</h5><h4>Why no JavaScript?</h4><h3>This website requires javascript to run!</h3><h2><a href="http://enable-javascript.com/" target="_blank">Enable JavaScript</a> to find out what HexR is about!</h2></div></div><main class='white-text grey darken-4'><?php echo $content; ?></main><footer class="page-footer hexr-background"><div class="container valign-wrapper"><div class="row valign"><div class="col l6 s12 valign"><br/><img src="/assets/img/logo.png" class="center logo small responsive-img" alt="hexr logo" /><p class="grey-text text-lighten-4">HexR. The only organization fully dedicated to producing the best websites for everyone. We're ready to take any challenge you throw at us, from a small single page site to a large ten thousand page site. From the fearing individual to the tech savvy engineer. Whoever you are and whatever you need, we're ready to help you.<a href="/request" class="teal-text text-accent-4" >Let's get started</a>!</p></div><div class="col l4 offset-l2 s12"><br class="hide-on-med-and-down"/><br class="hide-on-med-and-down"/><br class="hide-on-med-and-down"/><h5 class="white-text center">Quick Links</h5><ul class="center"><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/contact">Contact</a></li><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/policies#legal">Legal</a></li><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/initiative">Initiative</a></li><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/about">About</a></li><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/policies#tos">Terms of Service</a></li><li><a class="teal-text text-accent-4 flow-text footer-nav-link" href="/policies#privacy">Privacy Policy</a></li></ul></div></div></div><div class="footer-copyright"><div class="container center">&copy; 2016 HexR Website Design, Development and Production. <a href="/contact" class="teal-text text-accent-4">Contact for information</a></div></div></footer></body><div id="scripts" class="hide"><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><script type="text/javascript" src="/assets/js/global.js" defer></script><script src='https://www.google.com/recaptcha/api.js' async></script><!-- Piwik --><script type="text/javascript">var _paq = _paq || [];_paq.push(['trackPageView']);_paq.push(['enableLinkTracking']);(function() {var u="//proxy.hexr.org/a/p";_paq.push(['setTrackerUrl', u+'piwik.php']);_paq.push(['setSiteId', 1]);var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'.js'; s.parentNode.insertBefore(g,s);})();</script><noscript><p><img src="//assets.hexr.org/lib/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript><!-- End Piwik Code --></div></html>
