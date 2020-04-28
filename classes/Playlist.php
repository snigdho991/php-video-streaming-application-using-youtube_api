<?php
	$filepath = realpath(dirname(__FILE__)); 
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Playlist{
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAllPlaylist(){
			$query = "SELECT * FROM tblplaylist WHERE Is_Active = '1' ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPlById($id){
			$query = "SELECT * FROM tblplaylist WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>