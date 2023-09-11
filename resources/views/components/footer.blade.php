<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

<div class="general-fade"></div>

<div class="general-result"></div>

<div class="footer-container">
<div class="footer-wrapper">
<div class="footer container">

<div class="col-sm-5 nav-link share">
<div class="title btn">CONTACT US</div>
<p><a href="mailto:<?php //echo $gen_email; ?>"><b>Email:</b> <?php //echo $gen_email; ?></a></p>
<p><a href="tel:+2348063209539"><b>Phone:</b> <?php //echo $gen_phone; ?></a></p>
<p><b>Contact Office:</b> 30, Abata Street, Orile Iganmu, Lagos.</p>
</div>

<div class="col-sm-3 nav-link">
<div class="title btn">QUICK LINKS</div>
<a href="<?php directory(); ?>" class="<?php //echo current_page("index"); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
<a href="about/" class="<?php //echo current_page("about"); ?>"><i class="fa fa-university" aria-hidden="true"></i> About Us</a>
<a href="contact/" class="<?php //echo current_page("contact"); ?>"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
<a href="services/" class="<?php //echo current_page("services"); ?>"><i class="fa fa-cogs" aria-hidden="true"></i> Services</a>
<a href="projects-photos/" class="<?php //echo current_page("projects-photos"); ?>"><i class="fa fa-file-image-o" aria-hidden="true"></i> Past Projects</a>
</div>

<div class="col-sm-4">
<div class="title btn">ABOUT US</div>
<p><b>SamVick Technical Services Limited</b> is a company with years of experience in gas welding (argon) and Arc welding of all kinds of steel. Such as stainless steel, mild steel, galvanize aluminum etc as well as supply of materials. <a href="about/" style="color:#ff5;">Read more...</a></p>
</div>

</div>
</div>
</div>

<div class="copyright">Copyright &copy; <?php //echo date("Y") . " " . $full_gen_name; ?>. All Rights Reserved.<br />Developed by: <a href="http://reliancewisdom.com" target="_blank">Reliance Wisdom Digital.</a></div>

<script type="text/javascript" src="{{asset('js/general.js')}}"></script>
<script src="{{asset('js/general-form.js')}}"></script>
</body>
@php detectCurrUserBrowser('</td></tr></table>','',7); @endphp
</html>