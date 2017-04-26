<?php 
	
	/*
	** This is class is to generate work time
	** Daytime
	** Night time
	*/

	class workTime{
		
		/*
		** workLength() will return total work time
		** pass argument $start_time *required
		** pass argument $end_time *required
		*/
		
		public function workLength($start_time, $end_time){
			if(!empty($start_time) && !empty($end_time)){
				
				if($start_time < $end_time){
					$start_time = new DateTime($start_time);
					$end_time = new DateTime($end_time);
				}
				else{
					$start_date = date('Y-m-d', strtotime('now'));
					$start_time = $start_date.' '.$start_time;					
					$start_time = new DateTime($start_time);
					
					$end_date = strtotime($start_date);
					$end_date = strtotime('+1day', $end_date);
					$end_date = date('Y-m-d', $end_date);
					$end_time = $end_date.' '.$end_time;
					$end_time = new DateTime($end_time);
				}
				
				$work_length = $start_time->diff($end_time);				
				$work_length = $work_length->format('%H:%I');				
				return $work_length;
				
			}//if !empty
		}//workLength() end
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		** daytime() method will return daytime work hours
		** $start_time = work start time
		** $end_time = work end time
		** $nighttime_start = Defined Night Time Start
		** $nighttime_end = Defined Night time End
		** return time
		*/
		public function daytime($start_time, $end_time, $nighttime_start, $nighttime_end){
			$nighttime_start = $nighttime_start;
			$nighttime_end = $nighttime_end;
			
			if(($start_time <= $nighttime_start) && ($end_time <= $nighttime_end)){
				$start_time = new DateTime($start_time);
				$start_nighttime = new DateTime($nighttime_start);
				
				$dayTimeLength = $start_time->diff($start_nighttime);
				$dayTimeLength = $dayTimeLength->format('%H:%I');
			}
			elseif(($start_time <= $nighttime_start) && ($end_time >= $nighttime_start)){
				$start_time = new DateTime($start_time);
				$start_nighttime = new DateTime($nighttime_start);
				
				$dayTimeLength = $start_time->diff($start_nighttime);
				$dayTimeLength = $dayTimeLength->format('%H:%I');
			}
			elseif(($start_time <= $nighttime_start) && ($start_time > $end_time) && ($end_time >= $nighttime_end)){
				$start_time = new DateTime($start_time);
				$end_time = new DateTime($end_time);
				
				$start_nighttime = new DateTime($nighttime_start);				
				$first_half_time = $start_nighttime->diff($start_time);
				$first_half_time = $first_half_time->format('%H:%I');
				$first_half_time = strtotime($first_half_time);
				$first_half_time = date('H:i', $first_half_time);
				$first_half_time_array = explode(':', $first_half_time);
				$first_half_time_hour = $first_half_time_array[0]*60;
				$first_half_time_min = $first_half_time_array[1];
				$first_half_time = $first_half_time_hour+$first_half_time_min;
				
				$end_nighttime = new DateTime($nighttime_end);
				$second_half_time = $end_nighttime->diff($end_time);
				$second_half_time = $second_half_time->format('%H:%I');
				$second_half_time = strtotime($second_half_time);
				$second_half_time = date('H:i', $second_half_time);
				$second_half_time_array = explode(':', $second_half_time);
				$second_half_time_hour = $second_half_time_array[0]*60;
				$second_half_time_min = $second_half_time_array[1];
				$second_half_time = $second_half_time_hour+$second_half_time_min;
				
				$total_daytime_min = $first_half_time+$second_half_time;
				$daytime_hour = floor($total_daytime_min/60);
				$daytime_min = $total_daytime_min%60;
				
				$dayTimeLength = $daytime_hour. ':' . $daytime_min;
				$dayTimeLength = new DateTime($dayTimeLength);
				$dayTimeLength = $dayTimeLength->format('H:i');
			}
			elseif(($start_time <= $nighttime_start) && ($start_time < $end_time) && ($end_time >= $nighttime_end)){
				$start_time = new DateTime($start_time);
				$end_time = new DateTime($end_time);				
				
				$dayTimeLength = $end_time->diff($start_time);
				$dayTimeLength = $dayTimeLength->format('%H:%I');
			}
			else{
				$dayTimeLength = '00:00';
			}
			
			return $dayTimeLength;
			
		}//daytime() end
		
		
		
		
		
		
		
		
		
		
		/*
		** nighttime() will return night time length
		** $start_time = work start time
		** $end_time = work end time
		** $nighttime_start = defined night time start
		** $nighttime_end = defined night time end
		*/
		public function nighttime($start_time, $end_time, $nighttime_start, $nighttime_end){
			
			$total_work_length = $this->workLength($start_time, $end_time);
			$daytimelength = $this->daytime($start_time, $end_time, $nighttime_start, $nighttime_end);
			
			$total_work_time = new DateTime($total_work_length);
			$daytime = new DateTime($daytimelength);
			
			$nightTimeLength = $total_work_time->diff($daytime);
			$nightTimeLength = $nightTimeLength->format('%H:%I');
			return $nightTimeLength;
			
		}//nighttime() end
		
		
	}//workTime class end
	
?>