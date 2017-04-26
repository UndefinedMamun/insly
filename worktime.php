<?php include_once('header.php'); ?>
<?php include_once('classes/worktime.class.php'); ?>
<?php


	// The start and end of nighttime hours
	$SETTINGS_nighttime_start = '22:00';
	$SETTINGS_nighttime_end   = '07:00';
	
	// Employees and their shifts
	$EMPLOYEES = array(
		
		'0' => array(
			'name'        => 'Bernice Lyons',
			'shift_start' => '15:15',
			'shift_end'   => '23:45'
		),
		
		'1' => array(
			'name'        => 'Gregg Santos',
			'shift_start' => '10:00',
			'shift_end'   => '22:00'
		),
		
		'2' => array(
			'name'        => 'Bennie Montgomery',
			'shift_start' => '22:30',
			'shift_end'   => '08:00'
		),
		
		'3' => array(
			'name'        => 'Nelson Austin',
			'shift_start' => '20:00',
			'shift_end'   => '10:00'
		),
		
		'4' => array(
			'name'        => 'Garrett Sims',
			'shift_start' => '09:00',
			'shift_end'   => '17:00'
		),
		
		'5' => array(
			'name'        => 'Joanna Pratt',
			'shift_start' => '23:00',
			'shift_end'   => '06:00'
		),
		
		'6' => array(
			'name'        => 'Bernice Lyons',
			'shift_start' => '15:15',
			'shift_end'   => '23:45'
		),
		
		'7' => array(
			'name'        => 'Gregg Santos',
			'shift_start' => '10:00',
			'shift_end'   => '22:00'
		),
		
		'8' => array(
			'name'        => 'Bennie Montgomery',
			'shift_start' => '22:30',
			'shift_end'   => '08:00'
		),
		
		'9' => array(
			'name'        => 'Nelson Austin',
			'shift_start' => '20:00',
			'shift_end'   => '10:00'
		),
		
		'10' => array(
			'name'        => 'Garrett Sims',
			'shift_start' => '09:00',
			'shift_end'   => '17:00'
		),
		
		'11' => array(
			'name'        => 'Joanna Pratt',
			'shift_start' => '23:00',
			'shift_end'   => '06:00'
		)
		
	);
	

?>






<div class="assignment-3">
		<div class="mask">
			<div class="worktime-table">
				<table class="table table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<td>Name</td>
							<td>Start Time</td>
							<td>End Time</td>
							<td>Work Length</td>
							<td>Daytime Shift</td>
							<td>Nighttime Shift</td>
						</tr>
					</thead>
					
					<tbody>
						<?php
							$workTime = new workTime;
							foreach($EMPLOYEES as $employee):
								$name = $employee['name'];
								$shift_start = $employee['shift_start'];
								$shift_end = $employee['shift_end'];
						?>
						<tr>
							<td><?php echo $name; ?></td>
							<td><?php echo $shift_start; ?> h</td>
							<td><?php echo $shift_end; ?> h</td>
							<td><?php echo $workTime->workLength($shift_start, $shift_end); ?> Hours</td>
							<td>
								<?php echo $workTime->daytime(
									$shift_start,
									$shift_end,
									$SETTINGS_nighttime_start,
									$SETTINGS_nighttime_end
								); 
							?> Hours
							</td>
							<td>
								<?php echo $workTime->nighttime(
									$shift_start,
									$shift_end,
									$SETTINGS_nighttime_start,
									$SETTINGS_nighttime_end
								); 
							?> Hours
							</td>
						</tr>
						<?php
							endforeach; 
						?>
					</tbody>
				</table>
			</div><!--worktime table ends-->
		</div><!--mask end-->
	</div><!--assignment 3 end-->
	
	


<?php include_once('footer.php'); ?>