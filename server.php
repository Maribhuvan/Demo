<?php
$edit_state=false;
$name='';
$email='';
$age='';
$id=0;

session_start();

$localhost="localhost";
$username="root";
$password="";
$dbname="tutorials";

$conn=mysqli_connect($localhost,$username,$password,$dbname);

	if($conn)
	{
		if (isset($_POST['save']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$age = $_POST['age'];

			$sql = "INSERT INTO data (name, email, age) VALUES ('$name', '$email', '$age')";
			$res = mysqli_query($conn, $sql);
				if($res){
					$smsg = "Added Successfully.";
				}
				else
				{
					$smsg ="adding failed";
				}
				$_SESSION['msg']=$smsg;
				header('location:index.php');
		}
		
			$sql="SELECT * FROM data";
		$result=mysqli_query($conn,$sql);
		
		if (isset($_POST['update']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$age = $_POST['age'];
			$id=$_POST['id'];
			
			$sql="UPDATE data SET name='$name',email='$email',age='$age' WHERE id='$id'";
			$resUpd = mysqli_query($conn, $sql);
			if($resUpd){
				$smsg = "updated Successfully.";
			}
			else
			{
				$smsg ="update failed";
			}
			$_SESSION['msg']=$smsg;
			header('location:index.php');
		}
		
	}
 ?>