<div id="footer-wrap" >
	<div class="container mx-auto">
		<div class="row">
			<?php for($i=0;$i<4;++$i){ ?>
			<div class="footer-<?php echo $i;?> col-3">						
				<?php dynamic_sidebar( 'footer-sidebar-'.$i ); ?>
			</div>
		<?php } ?>
		</div>
	</div>
	
</div>