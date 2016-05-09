<?php 

class Dashboard_Model extends Model {

	function __construct() {
		parent::__construct();
	}

	function xhrInsert() {
		// sanitize text
		
		$text = $_POST['text'];

		$insert = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
		$insert->bindParam(':text', $text);
		$insert->execute();
		$data = array('text' => $text, 'id' => $this->db->lastInsertId());
		echo json_encode($data);
	}

	function xhrGetListings() {
		$query = $this->db->prepare('SELECT * FROM data');
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$query->execute();
		$data = $query->fetchAll();

		echo json_encode($data);
	}

	function xhrDeleteListing() {
		$id = $_POST['id'];
		$delete = $this->db->prepare('DELETE FROM data WHERE id = :id');
		$delete->bindParam(':id', $id);
		$delete->execute();
	}
}