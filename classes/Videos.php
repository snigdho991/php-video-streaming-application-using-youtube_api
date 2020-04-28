<?php
	$filepath = realpath(dirname(__FILE__)); 
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php 
	class Videos{
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getVideoByPl($id, $start_from, $total_pages){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tblvideos WHERE PlaylistId = '$id' AND Is_Active = '1' ORDER BY PostingDate DESC LIMIT $start_from, $total_pages";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleVideoDetails($vdid){
			$vdid = mysqli_real_escape_string($this->db->link, $vdid);
			$query = "SELECT * FROM tblvideos WHERE id = '$vdid'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getRelatedVideos($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$queryrelated = "SELECT * FROM tblvideos WHERE PlaylistId = '$id' AND Is_Active = '1' ORDER BY rand() LIMIT 10";
			$relatedpost  = $this->db->select($queryrelated);
			return $relatedpost;
		}

		public function getAllVideos($start_from, $total_pages){
			$query = "SELECT * FROM tblvideos WHERE Is_Active = '1' ORDER BY PostingDate DESC LIMIT $start_from, $total_pages";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllVideosByAdmin(){
			$query = "select tblvideos.id as videoid, tblvideos.VideoUrlLink, tblplaylist.PlaylistName as Playlist from tblvideos left join tblplaylist on tblplaylist.id=tblvideos.PlaylistId where tblvideos.Is_Active=1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getTrashVideosByAdmin(){
			$query = "select tblvideos.id as videoid, tblvideos.VideoUrlLink, tblplaylist.PlaylistName as Playlist from tblvideos left join tblplaylist on tblplaylist.id=tblvideos.PlaylistId where tblvideos.Is_Active=0";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPopularVideos(){
			$query = "SELECT * FROM (SELECT * FROM tblvideos WHERE Is_Active = '1' ORDER BY RAND()LIMIT 3) u ORDER BY views DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getViewsById($views, $vdid){
			$query = "UPDATE tblvideos SET views = '$views' where id = '$vdid' ";
			$result = $this->db->update($query);
			return $result;
		}

		public function getRecentVideos(){
			$query = "SELECT * FROM (SELECT * FROM tblvideos WHERE Is_Active = '1' ORDER BY RAND()LIMIT 6) u ORDER BY PostingDate DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getYouTubeVideoID($url) {
		    $queryString = parse_url($url, PHP_URL_QUERY);
		    parse_str($queryString, $params);
		    if (isset($params['v']) && strlen($params['v']) > 0) {
		        return $params['v'];
		    } else {
		        return "";
		    }
		}
	
	}
?>