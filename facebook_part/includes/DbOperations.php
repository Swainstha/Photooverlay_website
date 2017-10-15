<?php
	class DbOperations{
		private $con;
		function __construct() {
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		function createUser($user_id, $name, $link, $gender, $image) {
			if($this->isUserExist($name,$user_id)){
				$stmt = $this->con->prepare("UPDATE data SET choose=? WHERE user_id=?");
				$stmt->bind_param("ss",$image,$user_id);
				$stmt->execute();
				$stmt->close();
				return 0;
			} else {
				$stmt = $this->con->prepare("INSERT INTO data (user_id, name, link, gender, choose) VALUES(?, ?, ?, ?, ?);");
				if(!$stmt) {
					echo 'shit';
					return 2;
				} else{
					echo 'no';
					$stmt->bind_param("sssss",$user_id,$name,$link, $gender, $image);
					$stmt->execute();
					echo 'yeah';
					return 1;
				}
			}

		}
		public function userLogin($name, $pass) {
			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id FROM data WHERE username = ? AND password = ?");
			$stmt->bind_param("ss",$name,$password);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows > 0);
		}

		public function userLogin1($email, $pass) {
			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id FROM user WHERE email = ? AND password = ?");
			$stmt->bind_param("ss",$email,$password);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows > 0);
		}

		public function getUserByUsername1($email) {
			$stmt = $this->con->prepare("SELECT id FROM user WHERE email =?");
			$stmt->bind_param("s",$email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

		public function getUserByUsername($name) {
			$stmt = $this->con->prepare("SELECT * FROM data WHERE username =?");
			$stmt->bind_param("s",$name);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

		private function isUserExist($name, $user_id) {
			$stmt = $this->con->prepare("SELECT id FROM data WHERE name = ? OR user_id = ?");
			$stmt->bind_param("ss",$name,$user_id);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows > 0);
		}
	}
?>
