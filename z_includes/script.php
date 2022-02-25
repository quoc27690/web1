<!-- jQuery-->
<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/init.js"></script>
<script src="/js/owl.carousel.js"></script>
<script src="/js/waypoints.min.js"></script>
<script type="text/javascript" src="/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/js/custom.js"></script>
<?
if ($act == "home") {
	if (get_bien("hien_thi") == 1) {
?>
		<script type="text/javascript">
			$(window).load(function() {
				$('#myModal').modal('show');
			});
		</script>
<?
	}
}
?>
<?
if ($act == "lien_he") {
?>
	<script src="/lien_he/init.js" type="text/javascript"></script>
<?
}
?>
