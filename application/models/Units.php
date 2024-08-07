<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends CI_Model {

	public function index() {
		
	}

	public function get_available_units($from, $to){
		$query = $this->db->query("
			SELECT a.* FROM accomodation a
			WHERE 
			NOT EXISTS
				(SELECT 1 FROM schedule s WHERE a.id=s.accomodation_id 
				AND (
					'$from' BETWEEN s.from_date AND DATE_SUB(s.to_date, INTERVAL 1 DAY)
					OR '$to' BETWEEN s.from_date AND DATE_SUB(s.to_date, INTERVAL 1 DAY))
				)
		");
		if($query){
			return $query->result();
		}
		return [];
	}
}
