 <?php
class functions
{
	private $pageName = "", $pageID = -1, $pageTitle = "";
	const JQUERY = "<script type=\"text/javascript\" defer src=\"//code.jquery.com/jquery-latest.min.js\"></script>";
	const FONTAWESOME = "<link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">";
	const GLOBALJS = "<script type=\"text/javascript\" async src=\"/assets/js/global.js\"></script>";
	const GLOBALCSS = "<link rel=\"stylesheet\" href=\"/assets/css/global.css\" type=\"text/css\" />";
	public static function print_header($pageTitle, $meta = array(),$scripts = array(),$styles=array())
	{
		print self::get_header($pageTitle,$meta,$scripts,$styles);
	}
	public static function get_header($pageTitle, $meta = array(),$scripts = array(),$styles=array())
	{
		$print = array("meta" => "", "styles" => self::GLOBALCSS, "scripts" => self::GLOBALJS);
		if(array_key_exists(self::JQUERY,$scripts))
			$print['scripts'] = self::JQUERY."".self::GLOBALJS;
		foreach($meta as $x)
			$print["meta"] .= $x;
		foreach($styles as $x)
			$print["styles"] .=$x;
		foreach($scripts as $x)
			$print['scripts'] .=$x;
		$meta = $print['meta'];
		$styles = $print['styles'];
		$scripts = $print['scripts'];
		$output ="<!doctype html><html><head><title>$pageTitle</title><meta name='description' content='HexR is a small independent nonprofit (not licensed) business that creates and manages semi-static websites for small business at little to no charge.' /><meta name='keywords' content='HexR Website Design Development Free' /> <meta name=\"robots\" content=\"index, follow\" /><meta name='language' content='english' /><meta name='author' content='HexR' /><meta name='HandheldFriendly' content='True' /><meta charset='UTF-8' />$meta<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script><script type='text/javascript' src=\"//code.jquery.com/ui/1.11.3/jquery-ui.js\"></script><script src='//cdn.goroost.com/roostjs/it20l9mk5wz2osjhh6jvj0ldjj6x88d6' async></script>$scripts<script type=\"text/javascript\" src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5525399e5f87884e\" async=\"async\"></script><link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css\">$styles<!--[if lt IE 9]><link rel=\"stylesheet\" type=\"text/css\" href=\"/assets/css/ie.css\" /><![endif]--></head><noscript><style>section{display:none;visibility:none;opacity:0;}.bad-people{display:block;width:100%;height:100vh;margin-top:25%;text-align:center;align-content:center;}</style></noscript><body><header><nav class=\"desktop\"><ul><li><a href=\"".self::get_link("home")."\"><img src='/assets/images/400x500-home.png' height=\"50px\" width=\"50px\" title=\"HexR\" alt=\"HexR\"></a></li><li><a href=\"".self::get_link("about")."\">About</a></li><li><a href=\"".self::get_link("initiative")."\">Initiative</a></li><li><a href=\"".self::get_link("projects")."\">Projects</a></li><li><a href=\"".self::get_link("pricing")."\">Pricing</a></li><li><a href=\"".self::get_link("faq")."\">FAQ</a></li><li><a href=\"".self::get_link("clients")."\">Clients</a></li><li><a href=\"".self::get_link("sponsors")."\">Sponsors</a></li><li><a href=\"".self::get_link("contact")."\">Contact</a></li></ul></nav><nav class=\"mobile\"><ul class=\"mobile-header\"><li><div class=\"mobile-hamburger\"><div class=\"line\"></div><div class=\"line\"></div><div class=\"line\"></div></div></li><li class='mobile-logo'><a href=\"".self::get_link("home")."\"><img src='/assets/images/400x500-home.png' height=\"50px\" width=\"50px\" title=\"HexR\" alt=\"HexR\"></a></li></ul><div class=\"mobile-links full-height\"><ul><li><a href=\"".self::get_link("about")."\">About</a></li><li><a href=\"".self::get_link("initiative")."\">Initiative</a></li><li><a href=\"".self::get_link("projects")."\">Projects</a></li><li><a href=\"".self::get_link("pricing")."\">Pricing</a></li><li><a href=\"".self::get_link("faq")."\">FAQ</a></li><li><a href=\"".self::get_link("clients")."\">Clients</a></li><li><a href=\"".self::get_link("sponsors")."\">Sponsors</a></li><li><a href=\"".self::get_link("contact")."\">Contact</a></li></ul></div></nav></header><div class=\"bad-people\"><h5>Uh-Oh!</h5><h4>Why no JavaScript?</h4><h3>This website requires javascript to run!</h3><h2><a href=\"http://enable-javascript.com/\" target='_blank'>Enable JavaScript</a> to find out what HexR is about!</h2></div><div class=\"ie-people\"><h5>Uh-Oh!</h5><h4>You are using an out of date browser!</h4><h3>This website requires a modern browser to run!</h3><h2><a href=\"http://browsehappy.com.com/\" target='_blank'>Upgrade your browser</a> to find out what HexR is about!</h2></div><section class=\"content\">";
		return $output;
	}
	public static function print_footer()
	{
		print self::get_footer();
	}
	
	public static function get_footer()
	{
		$output ="</section><hr for='footer'><footer id=\"footer\"><div class=\"footer-nav\"><ul><li><h3><a href='".self::get_link("home")."'>Home</a></h3></li><li><h3><a href='".self::get_link("about")."'>About</a></h3></li><li><h3><a href='".self::get_link("initiative")."'>Initiative</a></h3></li><li><h3><a href='".self::get_link("plans")."'>Plans</a></h3></li><li><h3><a href='".self::get_link("faq")."'>FAQ</a></h3></li><li><h3><a href='".self::get_link("clients")."'>Clients</a></h3></li><li><h3><a href='".self::get_link("sponsors")."'>Sponsors</a></h3></li><li><h3><a href='".self::get_link("contact")."'>Contact</a></h3></li></ul></div><div class=\"center addthis_horizontal_follow_toolbox\"></div><p class=\"copyright\"> &copy; ".date('o')." by HexR. <a href='".self::get_link("contact")."'>Contact for details</a></p></footer></html>";
		return $output;
	}
	public static function email($to = array(),$subject = "",$content="",$bcc = array())
	{
		if($content == "")
			$content = "The current time is ".date("M-J-Y, g:i:s")."\n Hello user, \n This email is a test email sent by HexR.\n Thanks!\n-The HexR Robots \n (hexr.org). \n Please direct emails to hello@hexr.org.";
		if($subject == "")
			$subject = "HexR | NoReply email (Random String:".password_hash(rand(0,10214814814),PASSWORD_DEFAULT).")";
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/plain; charset=iso-8859-1";
		$headers[] = "From: HexR Robot <robot@hexr.org>";
		$headers[] = "Bcc:".implode(",",$bcc);
		$headers[] = "Reply-To: HexR Relations <hello@hexr.org>";
		$headers[] = "Subject: {$subject}";
		$headers[] = "X-Mailer: PHP/".phpversion();
		$headers[] = "X-Random-String: ".crypt("HEXR".time());
		mail(implode(",",$to), $subject, $content, implode("\r\n", $headers));
	}
	
	public static function get_link($where = "home")
	{
		$base = "";
		switch(strtolower($where))
		{
			case "home":
				return $base."/";
			case "about":
				return $base."/about";
			case "initiative":
				return $base."/initiative";
			case "projects":
				return $base."/projects";
			case "contact":
				return $base."/contact";
			case "plans":
				return $base."/request";
			case "sponsors":
				return $base."/sponsors";
			case "donate":
				return $base."/donate";
			case "faq":
				return $base."/faq";
			case "clients":
				return $base."/clients";
			case "pricing":
				return $base."/request";
			default:
				return $base;
			
		}
	}
}