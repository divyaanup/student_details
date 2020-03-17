<?php
class student
{

	function __construct(){
		$this->db	     = new mysqlcls();
	}
	public function insertStudent($studArr)
	{
		$this->db->connect();
		$insid=$this->db->insertRecord("student_details", $studArr);
		$this->db->close();
		return $insid;
	}	
	public function getStudent()
	{
		$this->db->connect();
		$query = "SELECT * from student_details";
		$stud_details = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $stud_details;
	}
	public function getCourse()
	{
		$this->db->connect();
		$query = "SELECT * from student_course";
		$course_det = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $course_det;
	}
	public function checkStudent($studid)
	{
		$this->db->connect();
		$query = "SELECT * from student_details WHERE s_id='$studid'";
		$stud_det = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $stud_det;
	}
	public function existsStudent($studid)
	{
		$this->db->connect();
		$query = "SELECT * from student_details WHERE student_id='$studid'";
		$stud_det = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $stud_det;
	}
	public function insertScore($scoreArr)
	{
		$this->db->connect();
		$insid=$this->db->insertRecord("student_score", $scoreArr);
		$this->db->close();
		return $insid;
	}
    public function listStudent()
	{
		$this->db->connect();
		$query = "SELECT student_details.student_id, student_details.student_name,student_details.dob,student_score.score,student_course.course_name FROM student_details JOIN student_score ON student_details.s_id= student_score.s_id JOIN student_course ON student_score.course_id=student_course.course_id
";
		$stud_det = $this->db->fetchArray($this->db->query($query));
		$this->db->close();
		return $stud_det;
	}
 
}

?>