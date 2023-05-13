<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>
		<hr>
		<div id="news-div">
			<div id="availableNow-div">
				<h2 id="available-now">Available Now</h2>
				<h3 id="get-yours">Get Your Copy</h3>
			</div>				
			<img id="ad-my-desire-front-cover" src="images/front_cover.png">
		</div><!-- end news-div -->
		<div id="myDesireBanner">
			<h4>The Time Has Come</h4>
			<h3>MY DESIRE<span>&nbsp; by Brian Dorsey</span></h3>
			<h5>The New Inspirational CD</h5>
			<!-- <a id="order-here" href="buy">Order Your Copy Here</a><a id="listen-here" href="buy?lp=home">Listen Here</a> -->
			<a id="order-here" href="buy">Order Your Copy Here</a><!-- <a id="listen-here" href="buy" onclick="">Listen Here</a> -->
			<hr></hr>
		</div><!-- end myDesireBanner -->	
		<div id="upcoming-performances-div">
			<h2>Upcoming Performances</h2>
			<p style="text-align: center; color: #fd7700; margin-top: -15px">Click a date to see details.</p>
			<div id="upcoming-performances-left">
				<table>
					<tbody id="upcoming-performances-listing">
						<?php if($performances): ?>
							<?php $i = 0; ?>
							<?php foreach($performances as $performance): ?>
									<?php 	
										$id = $performance['id']; 
										$date = date_create($performance['date']);
										$performanceDate = date_format($date, "M j, Y");
									?>
									<tr class="listing<?php if($i == 0){echo ' showDetails';}; ?>" id="<?=$id?>">
										<td class="date" id="date<?=$id?>"><?=$performanceDate?></td>
										<td class="city" id="city<?=$id?>"><?=$performance['city_province']?></td>
										<input type="hidden" id="venue<?=$id?>" value="<?=$performance['venue']?>">
										<input type="hidden" id="address<?=$id?>" value="<?=$performance['street_address']?>">
										<input type="hidden" id="time<?=$id?>" value="<?=$performance['time']?>">
										<input type="hidden" id="hidden_am_pm<?=$id?>" value="<?=$performance['am_pm']?>">
										<input type="hidden" id="details<?=$id?>" value="<?=$performance['details']?>">
									</tr>
									<?php $i++; ?>
							<?php endforeach; ?>
						<?php else: ?>
							<p style="margin-top: 100px; margin-bottom: -100px; text-align: center">No scheduled performances at this time</p>
						<?php endif; ?>
					</tbody>
				</table>
			</div><!-- end #upcoming-performances-left -->
			<div id="upcoming-performances-right" style="padding-top: 0px">
				<table>
					<caption style="margin-bottom: 20px; font-size: 20px; font-weight: 600; border-bottom: 1px solid black; padding-bottom: 5px" class="details-date"></caption>
					<tr><th class="venue-heading">Address</th><th class="time-heading">Time</th></tr>
					<tr><td class="address"></td><td class="time"></td></tr>
					<!-- <tr><td colspan='2' class="address"></td></tr> -->
					<tr><th colspan='2' class="details-heading">Details</th></tr>
					<tr><td colspan='2' class="details" id="details"></td></tr>
				</table>
			</div><!-- end #upcoming-performances-right -->
			<div style="display: block; height: 20px; margin-top: 300px;"><hr style="width: 95%"/></div>
			
		</div><!-- end #upcoming-performances-div -->	
		<hr style="margin-top: 30px">
	
	<script type="text/javascript" src="scripts/js/myscroll.js"></script>
	<script type="text/javascript" src="scripts/js/scheduleDetails.js"></script>
	<script type="text/javascript" src="scripts/js/lib/jquery-ui-1.10.4.custom.min.js"></script>
