<?php 
require("../assets/functions.php");
functions::print_header("FAQ | HexR",array(),array(),array("<link rel='stylesheet' href='/assets/css/faq.css' type='text/css' />"));
?>
<h1 class="center">Here are some Frequently asked Questions we are asked</h1>
<ul>
	<li>
		<h2 class="question">What is HexR</h2>
		<p class="answer">HexR is an organization that was founded to provide <strong>free</strong>, modern websites to anyone because people should do what they do because they love it, not because it will pay the bills.</p>
	</li>
	<li>
		<h2 class="question">Where did you get the name HexR</h2>
		<p class="answer">HexR is split into two parts - Hex and R. The reason we have Hex in our name is because it's the most complex simple shape to use in generating a display. It's simple enough to make the math easy, complex enough to make the programming easy. The R stands for what we expect and give in return - Respect, responsibility, reliability and responsiveness.</p>
	</li>
	<li>
		<h2 class="question">How much does a website cost?</h2>
		<p class="answer">For us to write it? Free. If you want more personalized options, like a domain or Google Apps, we cannot give you a discount (since we don't own it), so you will have to pay the costs they charge.</p>
	</li>
</ul>
<p>This list is pretty short. If you have any questions, please, don't hesitate to <a href="<?php  print functions::get_link("contact");?>">contact us</a>. We care the most about you.</p>
<?php 
functions::print_footer();
?>