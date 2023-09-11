<script src="{{asset('js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">

<div class="general-fade"></div>

<div class="general-result"></div>

<div class="footer-wrapper">
<div class="footer container">

<div class="col-sm-4 nav-link share">
<div class="title btn">CONTACT US</div>
<a href="mailto:{{ $gen_class::$gen_email }}"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $gen_class::$gen_email }}</a>
<a href="tel:+{{ $gen_class::$gen_phone }}"><i class="fa fa-phone" aria-hidden="true"></i> {{ $gen_class::$gen_phone }}</a>
</div>

<div class="col-sm-4 nav-link">
<div class="title btn">QUICK LINKS</div>
<a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
<a href="about"><i class="fa fa-university" aria-hidden="true"></i> About Us</a>
<a href="contact"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
<a href="payment-options"><i class="fa fa-money" aria-hidden="true"></i> Payment Options</a>
<a href="size-guide"><i class="fa fa-female" aria-hidden="true"></i> Size Guide</a>
<a href="delivery"><i class="fa fa-car" aria-hidden="true"></i> Delivery</a>
<a href="exchange-and-returns"><i class="fa fa-file-text" aria-hidden="true"></i> Exchange &amp; Returns</a>
</div>

<div class="col-sm-4 subscribe">
<div class="title btn">NEWSLETTER</div>
<form  action="/privates/process-data" class="newsletter" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">

<input type="hidden" name="newsletter" value="1">

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa"><label for="name">Name</label></i></span>
<input type="text" name="name" id="name" class="form-control" value="" placeholder="Your name" required>
</div>

<div class="form-group input-group">
<span class="input-group-addon"><i class="fa"><label for="email">Email</label></i></span>
<input type="text" name="email" id="email" class="form-control" value="" placeholder="Your email" required>
</div>
<div style="text-align:right">
<button  name="subscribe" id="subscribe"><i class="fa fa-send"></i> Subscribe</button>
</div>	
</form>
<div class="footer-social">
<a href="javascript:void(0);" title="Facebook" class="fa fa-facebook btn" target="_blank"></a>
<a href="javascript:void(0);" title="Twitter" class="fa fa-twitter btn"></a>
<a href="javascript:void(0);" title="Google +" class="fa fa-google-plus btn"></a>
<a href="javascript:void(0);" title="Pinterest" class="fa fa-pinterest-p btn"></a>
<a href="javascript:void(0);" title="Instagram" class="fa fa-instagram btn"></a>
</div>
</div>

</div>
</div>

<div class="copyright">Copyright &copy; <?php //echo date("Y") . " " . $full_gen_name;?>. All Rights Reserved.<br />Developed by: <a href="http://reliancewisdom.com" target="_blank">Reliance Wisdom Digital.</a></div>

<script type="text/javascript" src="{{asset('js/portal.js')}}"></script>
@php detectCurrUserBrowser('</td></tr></table>','',7); @endphp
</body>
</html>