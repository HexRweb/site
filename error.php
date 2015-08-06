<?php

require("assets/functions.php");
header("HTTP/1.0 404 Not Found");
functions::print_header();

?>

<h1 class="center">404 | Page Not Found</h1>
<p >Uh-oh! HexR is not hosting a page at this address, or we changed the location of it. Our navigation is our sitemap, so click a link to go somewhere in HexR</p>

<?php functions::print_footer(); ?>
