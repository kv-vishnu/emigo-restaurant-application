<?php
class Reportmodel extends CI_Model {
   
	public function timesheet_reports(){//select timesheet details where work_id = ?
		$this->db->select('t.id,t.timesheet_no,t.work_assign_id,t.date,c.name,u.Name as tech_name');
		$this->db->from('timesheet as t');
        $this->db->join('work_assign as wa', 't.work_assign_id = wa.id');
        $this->db->join('client as c', 'wa.client_id = c.id');
        $this->db->join('users as u', 't.technician_id = u.userid');

		$query = $this->db->get();
        //echo $this->db->last_query();exit;
		$data = $query->result_array();
		//print_r($data);exit;
		$timesheet = array();
		foreach ($data as $row) {
			$timesheet_id = $row['id'];
			if (!isset($timesheet[$timesheet_id])) {
				$timesheet[] = array(
					'timesheet_id' => $timesheet_id,
					'timesheet_no' => $row['timesheet_no'],
                    'cl_name' => $row['name'],
                    'tech_name' => $row['tech_name'],
					'task_id' => $row['work_assign_id'],
					'date' => $row['date']
					// 'travel_to_site' => $row['travel_to_site'],
					// 'loading_prep_time' => $row['loading_prep_time'],
					// 'waiting_time' => $row['waiting_time'],
					// 'field_work' => $row['field_work'],
					// 'travel_to_base'=>$row['travel_to_base'],
					// 'processing_and_reporting'=>$row['processing_and_reporting'],
					// 'interpretation_and_film_sub' => $row['interpretation_and_film_sub'],
					// 'total_joints' => $row['total_joints'],
					// 'technician_id' => $row['technician_id'],
					// 'timesheet_image' => $row['timesheet_image']
					//'completed_joints' => $this->get_completed_joints($timesheet_id),
					//'consumables_used' => $this->get_consumables_used($timesheet_id)
				);
			}
		}
		return $timesheet;
	}

	public function fetchReport($client_id,$technician_id,$criteria,$criteria_value){
		//echo $client_id;echo $technician_id;echo $criteria;echo $criteria_value;
		
		$this->db->select('t.id,t.timesheet_no,t.work_assign_id,t.date,c.name,u.Name as tech_name');
		$this->db->from('timesheet as t');
        $this->db->join('work_assign as wa', 't.work_assign_id = wa.id');
        $this->db->join('client as c', 'wa.client_id = c.id');
        $this->db->join('work_assign_crew_members as wacm', 'wacm.work_assign_id = t.work_assign_id');
        $this->db->join('users as u', 'wacm.user_id = u.userid');
        
		
        if ($client_id != 'null') {
            $this->db->where('c.id', $client_id);
        }
        if ($technician_id != 'null') {
            $this->db->where('wacm.user_id', $technician_id);
        }
		if ($criteria != 'null') {
            if($criteria == 'date'){
				//echo $criteria_value;exit;
				$date = date('Y-m-d',strtotime($criteria_value));
				$this->db->where('t.date', $date);
			}
			if($criteria == 'week'){
				//echo $criteria_value;
				$splitStrings = explode("-", $criteria_value);
				$startDate = date('Y-m-d',strtotime($splitStrings[0]));
				$endDate = date('Y-m-d',strtotime($splitStrings[1]));
				$this->db->where('t.date >=', $startDate);
				$this->db->where('t.date <=', $endDate);

			}
			if($criteria == 'month'){
				$splitStrings = explode(" ", $criteria_value);
				$monthName = $splitStrings[0];
				$year = $splitStrings[1];
				$dateParts = date_parse($monthName);
				$monthNumber = $dateParts['month'];
				$where = "MONTH(t.date) = $monthNumber AND YEAR(t.date) = $year";
				$this->db->where($where);
			}
			if($criteria == 'range'){
				$date = $criteria_value;//get date range
				$splitStrings = explode("/", $date);
				$start_date = date('Y-m-d',strtotime($splitStrings[0]));
				$end_date = date('Y-m-d',strtotime($splitStrings[1]));
				$this->db->where('t.date >=', $start_date);
				$this->db->where('t.date <=', $end_date);
			}
        }
        
        $this->db->group_by('id');
		$query = $this->db->get();
        //echo $this->db->last_query();exit;
		$data = $query->result_array();
		//print_r($data);exit;
		$timesheet = array();
		foreach ($data as $row) {
			$timesheet_id = $row['id'];
			if (!isset($timesheet[$timesheet_id])) {
				$timesheet[] = array(
					'timesheet_id' => $timesheet_id,
					'timesheet_no' => $row['timesheet_no'],
                    'cl_name' => $row['name'],
                    'tech_name' => $row['tech_name'],
					'task_id' => $row['work_assign_id'],
					'date' => $row['date']
					// 'travel_to_site' => $row['travel_to_site'],
					// 'loading_prep_time' => $row['loading_prep_time'],
					// 'waiting_time' => $row['waiting_time'],
					// 'field_work' => $row['field_work'],
					// 'travel_to_base'=>$row['travel_to_base'],
					// 'processing_and_reporting'=>$row['processing_and_reporting'],
					// 'interpretation_and_film_sub' => $row['interpretation_and_film_sub'],
					// 'total_joints' => $row['total_joints'],
					// 'technician_id' => $row['technician_id'],
					// 'timesheet_image' => $row['timesheet_image']
					//'completed_joints' => $this->get_completed_joints($timesheet_id),
					//'consumables_used' => $this->get_consumables_used($timesheet_id)
				);
			}
		}
		return $timesheet;
	}


	public function filter_timesheet($client_id,$technician_id,$criteria,$criteria_value){
		$this->db->select('t.id,t.timesheet_no,t.work_assign_id,t.date,c.name,u.Name as tech_name');
		$this->db->from('timesheet as t');
        $this->db->join('work_assign as wa', 't.work_assign_id = wa.id');
        $this->db->join('client as c', 'wa.client_id = c.id');
        $this->db->join('users as u', 't.technician_id = u.userid');
		
        if ($client_id != 'null') {
            $this->db->where('c.id', $client_id);
        }
        if ($technician_id != 'null') {
            $this->db->where('t.technician_id', $technician_id);
        }
		if ($criteria != 'null') {
            if($criteria == 'date'){
				//echo $criteria_value;exit;
				$date = date('Y-m-d',strtotime($criteria_value));
				$this->db->where('t.date', $date);
			}
			if($criteria == 'week'){
				//echo $criteria_value;
				$splitStrings = explode("-", $criteria_value);
				$startDate = date('Y-m-d',strtotime($splitStrings[0]));
				$endDate = date('Y-m-d',strtotime($splitStrings[1]));
				$this->db->where('t.date >=', $startDate);
				$this->db->where('t.date <=', $endDate);

			}
			if($criteria == 'month'){
				$splitStrings = explode(" ", $criteria_value);
				$monthName = $splitStrings[0];
				$year = $splitStrings[1];
				$dateParts = date_parse($monthName);
				$monthNumber = $dateParts['month'];
				$where = "MONTH(t.date) = $monthNumber AND YEAR(t.date) = $year";
				$this->db->where($where);
			}
			if($criteria == 'range'){
				$date = $criteria_value;//get date range
				$splitStrings = explode("/", $date);
				$start_date = date('Y-m-d',strtotime($splitStrings[0]));
				$end_date = date('Y-m-d',strtotime($splitStrings[1]));
				$this->db->where('t.date >=', $start_date);
				$this->db->where('t.date <=', $end_date);
			}
        }
        

		$query = $this->db->get();
        //echo $this->db->last_query();exit;
		$data = $query->result_array();
		//print_r($data);exit;
		$timesheet = array();
		foreach ($data as $row) {
			$timesheet_id = $row['id'];
			if (!isset($timesheet[$timesheet_id])) {
				$timesheet[] = array(
					'timesheet_id' => $timesheet_id,
					'timesheet_no' => $row['timesheet_no'],
                    'cl_name' => $row['name'],
                    'tech_name' => $row['tech_name'],
					//'task_id' => $row['work_assign_id'],
					'date' => $row['date']
					// 'travel_to_site' => $row['travel_to_site'],
					// 'loading_prep_time' => $row['loading_prep_time'],
					// 'waiting_time' => $row['waiting_time'],
					// 'field_work' => $row['field_work'],
					// 'travel_to_base'=>$row['travel_to_base'],
					// 'processing_and_reporting'=>$row['processing_and_reporting'],
					// 'interpretation_and_film_sub' => $row['interpretation_and_film_sub'],
					// 'total_joints' => $row['total_joints'],
					// 'technician_id' => $row['technician_id'],
					// 'timesheet_image' => $row['timesheet_image']
					//'completed_joints' => $this->get_completed_joints($timesheet_id),
					//'consumables_used' => $this->get_consumables_used($timesheet_id)
				);
			}
		}
		return $timesheet;
	}
}
?>