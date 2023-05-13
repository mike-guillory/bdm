<?php if(!defined('BASEPATH')) exit('No direct script access'); ?>
		<div id="edit-schedule-div">
			<h1>Insert Performance</h1>
			<div id="edit-schedule-container">
				<div id="edit-schedule-left">
					<?php 

						//session_start();

						$sd = "";
						$sc = "";
						$sv = "";
						$sa = "";
						$st = "";
						$sdet = "";

						if(isset($_SESSION['errors'])){
							$sd = $_SESSION['date'];
							$sc = $_SESSION['city'];
							$sv = $_SESSION['venue'];
							$sa = $_SESSION['address'];
							$st = $_SESSION['time'];
							$sdet = $_SESSION['details'];
						}

						echo form_open('edit_schedule/insert_performance'); 

						//$date_ph = 'placeholder="YYYY/MM/DD"';
						$date_id = "id='datepicker'";
						echo "<div>".form_label('Date: ', 'performance_date_label');
						echo form_input('performance_date', "$sd", "$date_id")."</div><br/>";

						echo "<div>".form_label('City, Province: ', 'performance_city_label');
						echo form_input('performance_city', "$sc")."</div><br/>";

						echo "<div>".form_label('Place: ', 'performance_venue_label');
						echo form_input('performance_venue', "$sv")."</div><br/>";

						echo "<div>".form_label('Address: ', 'performance_address_label');
						echo form_input('performance_address', "$sa")."</div><br/>";

						$time_ph = 'placeholder="0:00"';
						echo "<div>".form_label('Time: ', 'performance_time_label');
						echo form_input('performance_time', "$st", $time_ph);
						echo form_label('PM: ', 'pm_label');
						echo form_radio('am_pm', 'pm', true);
						echo form_label('AM: ', 'am_label');
						echo form_radio('am_pm', 'am')."</div><br/>";

						$texarea_data = array(
							'name'			=> 'performance_details',
							'id'			=> 'performance_details',
							'value'			=> $sdet,
						);


						echo "<div>".form_label('Details: ', 'performance_details_label')."<br/>";
						echo form_textarea($texarea_data)."</div><br/>";

						echo "<div id='upload-btn-div'>".form_submit('upload', "Upload")."</div>";
						echo form_close(); 
					?>
					<div id="errors">
						<?php
							if(isset($_SESSION['errors'])){

								echo $_SESSION['errors'];		
								unset($_SESSION['errors']);
							}	
						?>
					</div><!-- end #errors -->
				</div><!-- end #edit-schedule-left -->
				<div id="edit-schedule-right">
					<div id="up-div">
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
										<tr class="listing<?php if($i == 0){echo ' showDetails';} ?>" id="<?=$id?>">
											<td class="date" id="date<?=$id?>"><?=$performanceDate?></td>
											<input type="hidden" id="hidden-date<?=$id?>" value="<?=$performance['date']?>">
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
									<p style="margin-top: 100px; margin-bottom: -100px; text-align: center">No scheduled performances</p>
								<?php endif; ?>
							</tbody>
						</table>
						<!-- <button onclick="doItAgain()">Click Me</button> -->
						<p id="updated">Updated</p>
					</div><!-- end #upcoming-performances-div -->
					<hr style="margin-bottom: 0" />
					<div id="details-div">
						<h3 style="text-align: center; margin-top: 0">Edit Performance Details</h3>
						<table style="margin-left: 40px">
							<tr>
								<th class="city-heading">City</th>
								<th class="date-heading" colspan='2' >Date</th>
							</tr>
							<tr>
								<td class='city'>
									<input id='city' type='text'/>
								</td>
								<td class='date' colspan='2' >
									<input id='date' type='text'/>
								</td>
							</tr>
							<tr>
								<th class="venue-heading">Place</th>
								<th class="time-heading" colspan='2' style="text-align: left">Time</th>
							</tr>
							<tr>
								<td class="edit_venue">
									<input id='venue' type='text'/>
								</td>
								<td class="edit_time">
									<input id='time' type='text' size='5' style="width: 35px" />
								</td>
								<td class="am_pm">
									<input type="radio" name="edit_am_pm" id="pm" value="pm">PM
									<input type="radio" name="edit_am_pm" id="am" value="am">AM
								</td>
							</tr>
							<tr>
								<td class="edit_address">
									<input id='address' type='text'/>
								</td>
							</tr>
							<tr>
								<th class="details-heading">Details</th>
							</tr>
							<tr>
								<td class="edit_details" colspan='3'>
									<textarea id="details" rows='8' cols='45'></textarea>
								</td>
							</tr>
						</table>
						<input type="hidden" id="hiddenId">
						<div style="padding-left: 40px">
							<!-- Update Button -->
							<button value="Update" style="background: #00f; color: #fff; font-weight: bold; padding: 5px; font-size: 14px;" id="" onclick="updateSchedule()">Update</button>
							<!-- Delete Button -->
							<button value="Delete" style="background: #f00; color: #fff; font-weight: bold; padding: 5px; font-size: 14px;" id="" onclick="deletePerformance()">Delete</button>
						</div>
					</div><!-- end #details-div -->					
				</div><!-- end #edit-schedule-right -->
			</div><!-- end #edit-schedule-container -->
		</div><!-- end #edit-schedule-div -->
		<div id="hr-div"><hr /></div>
	</div><!-- end #admin-wrapper -->
	<script type="text/javascript" src="scripts/js/myscroll.js"></script>
	<script type="text/javascript" src="scripts/js/scheduleDetails.js"></script>
	<script type="text/javascript" src="scripts/js/lib/jquery-ui-1.10.4.custom.min.js"></script>
<body>
</html>

