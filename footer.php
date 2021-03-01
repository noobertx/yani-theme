		<footer class="bg-dark">
			<div id="footer-wrap" >
				<?php for($i=0;$i<4;++$i){ ?>
					<div class="footer-<?php echo $i;?>">						
						<?php dynamic_sidebar( 'footer-sidebar-'.$i ); ?>
					</div>
				<?php } ?>
			</div>
		</footer>
		<?php wp_footer();?>
	</body>
</html>