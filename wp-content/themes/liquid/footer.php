	<footer id="footer-global" role="contentinfo" class="clearfix">
		
		<section id="footer-main">
		
			<div class="container">
			
				<div class="row">
           MADE BY SCILLADYKE &copy; <?php echo date('Y'); ?>. ALL RIGHTS RESERVED. 
          
        </div><!-- end .row -->
			</div><!-- end .container -->
		
		</section><!-- end #contact -->
		
	</footer><!-- end #footer-global -->
	
<script type="text/javascript">
function scrollTo(target) {
    var targetPosition = $(target).offset().top;
    $('html,body').animate({
        scrollTop: targetPosition
    }, 'slow');
}
jQuery(document).ready(function () {
    jQuery('ul#navigation').mobileMenu({
        defaultText: '<?php _e("Navigation", "kula");?>',
        className: 'mobile-menu',
        subMenuDash: '&ndash;'
    });
});
</script>

<?php echo $data['google_analytics']; ?>
	
<?php wp_footer(); ?>
	
</body>

</html>