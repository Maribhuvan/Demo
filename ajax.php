<?php
$conn = mysqli_connect('localhost','root','','chart');
if(isset($_POST['id'])){
	
	
	if($_POST['id']){
		$res=array();
		$sql = "SELECT * FROM chart_1 where month='".$_POST['id']."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $res[]=$row;
    }
	}
	
	
	$res1=array();
		$sql1 = "SELECT * FROM chart_2 where month='".$_POST['id']."'";
		$result1 = mysqli_query($conn, $sql1);
		if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_assoc($result1)) {
        $res1[]=$row1;
    }
	}	
	
	echo json_encode(array($res,$res1));	
	}	
	
}

?>