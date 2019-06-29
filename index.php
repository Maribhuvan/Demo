<?php include('server.php'); ?>

 <!doctype html>
 <html>
 <head>
 <title>form</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
 <style>
 table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
  margin-left:600px;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}

.form-inline button:hover {
  background-color: royalblue;
}

#myBtn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  margin-left:20px;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
 </style>
 
 <?php
	if(isset($_GET['edit']))
	{
		$id=$_GET['edit'];
		$edit_state=true;
		$localhost="localhost";
		$username="root";
		$password="";
		$dbname="tutorials";
		
		$conn=mysqli_connect($localhost,$username,$password,$dbname);

		if($conn)
		{
			$sql="SELECT * from data where id=$id";
			$rec= mysqli_query($conn,$sql);
			
			$record= mysqli_fetch_assoc($rec);
			
			$name=$record['name'];
			$email=$record['email'];
			$age=$record['age'];
		}	
		?>
		<script>
		$(document).ready(function()
		{
			$('#myBtn').trigger('click');
		});
		</script>
		<?php
	}
	
	if (isset($_GET['delete']))
	{
			$id=$_GET['delete'];
			$localhost="localhost";
			$username="root";
			$password="";
			$dbname="tutorials";
		
			$conn=mysqli_connect($localhost,$username,$password,$dbname);
		
		if($conn)
		{
			$sql="DELETE FROM data WHERE id=$id";
			$resDel = mysqli_query($conn, $sql);
			if($resDel){
				$smsg = "deleted Successfully.";
			}
			else
			{
				$smsg ="delete failed";
			}
			$_SESSION['msg']=$smsg;
			header('location:index.php');
		}
	}	
 ?>
 
 </head>
 
 <body>
 <div>
	 <h2 style="color:green;"><?php if(isset($_SESSION['msg']))
			 {
				 echo $_SESSION['msg'];
				 unset($_SESSION['msg']);
			 }?></h2>
 </div>
	<div class ="row">
		<div class="col-sm-12">
			<button id="myBtn">Add user</button>
		</div>
	</div>
	<br>
	<br>
		<div style="overflow-x:auto;" class="table-responsive">
		<center>
		 <table border="2">
		 <tr>
			 
				<th>User name</th>
			 
			 
				<th>Email</th>
			 
			 
				<th>Age</th>
			 
		 </tr>
		 <?php while($row=mysqli_fetch_assoc($result))  { ?>
		 <tr>
			 <td>
				<?php echo $row['name']; ?>
			 </td>
			 <td>
				<?php echo $row['email']; ?>
			 </td>
			 <td>
				<?php echo $row['age']; ?>
			 </td>
			 <td>
				<a href="index.php?edit=<?php echo $row['id'];?>">Edit</a>
			 </td>
			 <td>
				<a href="index.php?delete=<?php echo $row['id'];?>">Delete</a>
			 </td>
		 </tr>
		 <?php } ?>
		 </center>
		 </table>
	 </div>
 
	<div id="myModal" class="modal">
		<div class="modal-content">
			<span class="close" id="closebutton">&times;</span>
				<form class="form-inline" method="post" action="server.php">
					
					<input type="hidden" name ="id" value="<?php echo $id; ?>">
						<center>
							<div style="margin-top:200px;">
								 <label>User name&nbsp;&nbsp;&nbsp;&nbsp;
								 <input type="text" name="name" value="<?php echo $name;?>" ></label>
								 <br>
								
								 <label>Email id&nbsp;&nbsp;&nbsp;&nbsp;
								 <input type="text" name="email" value="<?php echo $email;?>"></label>
								 <br>
							 
								 <label>Age&nbsp;&nbsp;&nbsp;&nbsp;
								 <input type="text" name="age" value="<?php echo $age;?>"></label>
								 <br>

								<?php if($edit_state == true){ ?>
								&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="update">update</button>
								<?php } else { ?>
								&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name ="save">save</button>
								<?php } ?>
							 </div>
						<center>
				<form>
			</div>
			
		</div>
		
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
 </body>
 </html>