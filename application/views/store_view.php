<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>

		<div id="store-content" style="margin-top: 170px">

			<h1 style="text-align: center">Here is the store</h1>

		</div>

		<div id="cd_listing_container">
			<?php if($cds): ?>
				<?php foreach($cds as $cd): ?>
					<div class="cd_listing blue" style="float: left; width: 100%">
						<div class="cd_image_div" style="float: left">
							<img class="red" src="<?=$cd['path']?>">
						</div>
						<div class="cd_title_div" style="float: left; width: 760px; text-align: center">
							<p class="red"><?=$cd['title']?></p>
						</div>
						<div class="cd_price_div" style="float: right">
							<p class="red"><?=$cd['price']?></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div><!-- end wrapper -->
</body>
</html>
