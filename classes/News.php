<?php
	$filepath = realpath(dirname(__FILE__)); 
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class News{
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAllNews($start_from, $total_pages){
			$query = "SELECT * FROM tblposts WHERE Is_Active = '1' ORDER BY PostingDate DESC LIMIT $start_from, $total_pages";
			$result = $this->db->select($query);
			return $result;
		}

		public function getRecentNews(){
			$query = "SELECT * FROM (SELECT * FROM tblposts WHERE Is_Active = '1' ORDER BY RAND()LIMIT 4) u ORDER BY PostingDate DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleNewsDetails($nwid){
			$nwid = mysqli_real_escape_string($this->db->link, $nwid);
			$query = "SELECT * FROM tblposts WHERE id = '$nwid'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getViewsByNewsId($views, $nwid){
			$query = "UPDATE tblposts SET views = '$views' where id = '$nwid' ";
			$result = $this->db->update($query);
			return $result;
		}

		public function getPopularNews(){
			$query = "SELECT * FROM (SELECT * FROM tblposts WHERE Is_Active = '1' ORDER BY RAND()LIMIT 4) u ORDER BY views DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewsByCt($id, $start_from, $total_pages){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tblposts WHERE CategoryId = '$id' AND Is_Active = '1' ORDER BY PostingDate DESC LIMIT $start_from, $total_pages";
			$result = $this->db->select($query);
			return $result;
		}

		public function getRelatedNews($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$queryrelated = "SELECT * FROM tblposts WHERE CategoryId = '$id' AND Is_Active = '1' ORDER BY rand() LIMIT 10";
			$relatedpost  = $this->db->select($queryrelated);
			return $relatedpost;
		}

		public function searchNews($search, $start_from, $total_pages){
			$query = "SELECT * FROM tblposts WHERE PostTitle LIKE '%$search%' OR quote LIKE '%$search%' AND Is_Active = '1' ORDER BY PostingDate DESC LIMIT $start_from, $total_pages";
			$result = $this->db->select($query);
			return $result;
		}

		public function newsLetter($email){
			$email = $this->fm->validation($email);
			$email = mysqli_real_escape_string($this->db->link, $email);

			if (empty($email)){
				$msg = "Field must not be empty !";
				return $msg;
			} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            	$msg = "Provided Email Address Is Invalid !";
            	return $msg;
        	} else {
				$query = "INSERT INTO tblnewsletter(email) VALUES('$email')";
				$insertcat = $this->db->insert($query);
				if($insertcat){
					$msg = "Thanks for keeping touched with us !";
					return $msg;
				} else {
					$msg = "Something went wrong. Try Again !";
					return $msg;
				}
			}
		}

	}
?>