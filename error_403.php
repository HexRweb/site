<?php

header("HTTP/1.1 403 Unauthorized");

require("assets/functions.php");

functions::print_header();
?>

<h1 class="center">Error | 403</h1>
<p class="center"> You are not to allowed to access this resource.</p>

<?php

functions::print_footer();


?>
