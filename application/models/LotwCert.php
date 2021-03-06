<?php

class LotwCert extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Function: lotw_certs
	|--------------------------------------------------------------------------
	| 
	| Returns all lotw_certs for a selected user via the $user_id parameter
	|
	*/
	function lotw_certs($user_id) {

		$this->db->where('user_id', $user_id);
		$this->db->order_by('cert_dxcc', 'ASC');
		$query = $this->db->get('lotw_certs');
			
		return $query;
	}

	function lotw_cert_details($callsign) {
		$this->db->where('callsign', $callsign);
		$query = $this->db->get('lotw_certs');

		return $query->row();
	}

	function find_cert($callsign, $user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('callsign', $callsign);
		$query = $this->db->get('lotw_certs');

		return $query->num_rows();
	}

	function store_certficiate($user_id, $callsign, $dxcc, $date_created, $date_expires, $cert_key, $general_cert) {
		$data = array(
		    'user_id' => $user_id,
		    'callsign' => $callsign,
		    'cert_dxcc' => $dxcc,
		    'date_created' => $date_created,
		    'date_expires' => $date_expires,
		    'cert_key' => $cert_key,
		    'cert' => $general_cert,
		);

		$this->db->insert('lotw_certs', $data);
	}

	function update_certficiate($user_id, $callsign, $dxcc, $date_created, $date_expires, $cert_key, $general_cert) {
		$data = array(
		    'cert_dxcc' => $dxcc,
		    'date_created' => $date_created,
		    'date_expires' => $date_expires,
		    'cert_key' => $cert_key,
		    'cert' => $general_cert
		);

		$this->db->where('user_id', $user_id);
		$this->db->where('callsign', $callsign);
		$this->db->update('lotw_certs', $data);
	}

	function delete_certficiate($user_id, $lotw_cert_id) {
		$this->db->where('lotw_cert_id', $lotw_cert_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('lotw_certs');
	}

	function last_upload($certID) {

      $data = array(
           'last_upload' => date("Y-m-d H:i:s"),
      );


    $this->db->where('lotw_cert_id', $certID);

    $this->db->update('lotw_certs', $data);

    return "Updated";
  }
	
	function empty_table($table) {
		$this->db->empty_table($table); 
	}
}
?>