<?php

require_once(app_root . '/Database.php');
class User
{
	public function getDegree($teacherID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM degree WHERE teacherID='$teacherID'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

	public function getExperience($teacherID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM experience WHERE teacherID='$teacherID'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

	public function getPrimary($studentID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM education WHERE studentID='$studentID' AND learnDeg='Primary'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

	public function getSecondary($studentID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM education WHERE studentID='$studentID' AND learnDeg='Secondary'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

	public function getHigh($studentID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM education WHERE studentID='$studentID' AND learnDeg='High'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

	public function getUniversity($studentID)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM education WHERE studentID='$studentID' AND learnDeg='University'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}

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


	public function getMemById($id)
	{
		$db = Database::getInstance();
		$sql = "SELECT * FROM user WHERE userID='$id'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}


	public function updateUserInfo($id, $fullName, $address, $bdate, $phoneNum)
	{
		$db = Database::getInstance();
		$sql = "UPDATE user SET fullName='$fullName', address='$address', dob='$bdate', phoneNum=$phoneNum WHERE userID='$id'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}


	public function updatePassword($userId, $password)
	{
		$db = Database::getInstance();
		$sql = "UPDATE user SET password = '$password' WHERE id='$userId'";
		$result = mysqli_query($db->con, $sql);
		return $result;
	}
}
