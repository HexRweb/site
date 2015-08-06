<?php 
$plans = array("basic","plus","platinum");
require("../assets/functions.php");
//functions::email(array("hexrdesign@gmail.com"));
if(isset($_GET['plan']) && in_array($_GET['plan'],$plans))
{
	switch($_GET['plan'])
	{
		case "basic":
			print "test";
			break;
		case "plus":
			print "plus";
			break;
		case "platinum":
			print "platinum";
			break;
	}
}
else
{
	functions::print_header("Plans | HexR",array(),array(),array("<link rel=\"stylesheet\" href=\"../assets/css/request.css\" type='text/css' />"));
?>
<div class="container">
	<h1 class="center">HexR | Plans</h1>
	<p>The table below gives a quick description of our "plans". Click "Choose this plan" to request the plan.</p>
	<table class="tg">
		<tr>
			<th class="normal">Feature</th>
			<th class="special-2">Basic</th>
			<th class="normal">Plus</th>
			<th class="special-2">Platinum</th>
		</tr>
		<tr>
			<td class="special">CMS</td>
			<td class="special">Wordpress<br>(Can use other upon request)</td>
			<td class="special">Wordpress(Can use other upon request)</td>
			<td class="special">Wordpress(Can use other upon request)</td>
		</tr>
		<tr>
			<td class="normal">Mail</td>
			<td class="special-2">Up to 10 names w/ autoforward</td>
			<td class="normal">Up to 10 names w/ autoforward<br></td>
			<td class="special-2">Google Apps Integration</td>
		</tr>
		<tr>
			<td class="special">Drive</td>
			<td class="special">OwnCloud Setup<br> (Google Drive for private domains)</td>
			<td class="special">OwnCloud Setup<br>(Google Drive for private domains)</td>
			<td class="special">OwnCloud Setup<br>(Google Drive for private domains)</td>
		</tr>
		<tr>
			<td class="normal">Domain<br>and Hosting</td>
			<td class="special-2">Free basic subdomain and hosting</td>
			<td class="normal">Domain setup w/ hosting provider</td>
			<td class="special-2">Domain setup w/ hosting provider</td>
		</tr>
		<tr>
			<td class="special">Other Features</td>
			<td class="special">Upon Request</td>
			<td class="special">Upon Request</td>
			<td class="special">Upon Request</td>
		</tr>
		<tr>
			<td class="normal">Price</td>
			<td class="special-2">$0.00</td>
			<td class="normal">$5.00 - $15.00 / month</td>
			<td class="special-2">Starting at $5 / user / month + domain</td>
		</tr>
		<tr>
			<td class="special">Choose your plan</td>
			<td class="special choose"><a href="mailto:support@hexr.org?subject=I would like to request the basic plan&body=Please fill out some details about your request" target="_blank">Choose this plan</a></td>
			<td class="special choose"><a href="mailto:support@hexr.org?subject=I would like to request the plus plan&body=Please fill out some details about your request" target="_blank">Choose this plan</a></td>
			<td class="special choose"><a href="mailto:support@hexr.org?subject=I would like to request the platinum plan&body=Please fill out some details about your request" target="_blank">Choose this plan</a></td>
		</tr>
	</table>
</div>
<?php 
functions::print_footer();
}
?>