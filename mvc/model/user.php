<?php

require_once(app_root.'/Database.php');
class User
{
        

		// public function getListMember(){
	    //     $sql = "SELECT * FROM user WHERE roleID='2'";
	    //     $result = mysqli_query($db->con, $sql);
	    //     return $result;
		// }

		// public function removeMember($id){
		// 	$db = Database::getInstance();
	    //     $sql = "DELETE FROM user WHERE id='$id'";
	    //     $result = mysqli_query($db->con, $sql);
		// 	echo mysqli_error($db->con);
	    //     return $result;
		// }


		// public function getMemById($id){
		// 	$db = Database::getInstance();
	    //     $sql = "SELECT * FROM user WHERE id='$id' AND roleId=2";
	    //     $result = mysqli_query($db->con, $sql);
	    //     return $result;
		// }


		// public function getMemByEmailAndPassword($email,$password){
		// 	$db =Database::getInstance();
		// 	$sql ="SELECT * FROM user WHERE email='$email' AND password = '$password'";
		// 	$result = mysqli_query($db->con,$sql);
		// 	return $result;
		// }


		public function updateName($userId, $name){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET fullName = '$name' WHERE userID='$userId'";
	        $result = mysqli_query($db->conn, $sql);
	        return $result;
		}



		public function updateEmail($userId, $email){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET email = '$email' WHERE id='$userId'";
	        $result = mysqli_query($db->con, $sql);
	        return $result;
		}


		public function updatePhone($userId, $phone){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET phoneNum = '$phone' WHERE id='$userId'";
	        $result = mysqli_query($db->con, $sql);
	        return $result;
		}

		public function updateDob($userId, $dob){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET dob = '$dob' WHERE id='$userId'";
	        $result = mysqli_query($db->con, $sql);
	        return $result;
		}


		public function updateAddress($userId, $address){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET address = '$address' WHERE id='$userId'";
	        $result = mysqli_query($db->con, $sql);
	        return $result;
		}


		public function updatePassword($userId, $password){
			$db = Database::getInstance();
	        $sql = "UPDATE user SET password = '$password' WHERE id='$userId'";
	        $result = mysqli_query($db->con, $sql);
	        return $result;
		}

	}
