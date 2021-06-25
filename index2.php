
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "thanhvien";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 


	if(isset($_GET['menu'])){
		if($_GET['menu']=="themthanhvien"){

			if(isset($_POST['themthanhvien'])){
				$q="INSERT INTO thanhvien(`hoten`, `chucvu`,  `ngaysinh`) VALUES ('".$_REQUEST['hoten']."','".$_REQUEST['chucvu']."','".$_REQUEST['ngaysinh']."')";
				if ($conn->query($q) === TRUE) {
					echo "Da them thanh vien:".$_REQUEST['hoten']." | ".$_REQUEST['chucvu']." | ".$_REQUEST['ngaysinh']."<br><br>" ;
				} else {
					echo "Error: " . $q . "<br>" . $conn->error;
				}

			}

		?>
			
			<form method="post" action="http://localhost/c/index.php?menu=themthanhvien">
			  	Ho va ten:<br>
			  	<input type="text"  name="hoten"><br>
			  	chuc vu:<br>
			  	<input type="text"  name="chucvu"><br>
			 	 ngay sinh:<br>
			  	<input type="text"  name="ngaysinh"><br>
			  	
			  	<br>
			  	<input type="submit" name="themthanhvien" value="Them thanh vien">
			</form>

			<a href="http://localhost/c/index.php">Quay lai</a>

		<?php	

		}

	}else{


			?>

			<form method="get" action="http://localhost/c/index.php">
			  	Ho va ten:<br>
			  	<input type="text"  name="hoten">
			  	
			  	<input type="submit" name="timkiem" value="tim thanh vien">
			</form>
		<a href='http://localhost/c/index.php?menu=themthanhvien'>Them Thanh Vien</a>

			<?php


			if(isset($_GET['timkiem'])){
				$ht=$_GET['hoten'];
				$sql = "SELECT * FROM thanhvien WHERE hoten LIKE '%$ht%'";
			}else{
				$sql = "SELECT * FROM thanhvien ";
			}




			
			$result = mysqli_query($conn, $sql);



			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    echo "<table>";
			    echo "<tr><th>hoten</th> <th>chucvu</th><th>ngaysinh</th></tr>";
			    while($row = mysqli_fetch_assoc($result)) {
			        // echo "id: " . $row["hoten"].  "<br>";

			        echo "<tr> <td>".$row["hoten"]."</td><td>".$row["chucvu"]."</td><td>".$row["ngaysinh"]."</td></tr>";
			    }
			    echo "</table>";

			    echo "<a href='http://localhost/c/index.php'>Trang chu</a>";
			    echo "<br>";
			    echo "<a href='http://localhost/c/index.php?menu=themthanhvien'>Them Thanh Vien</a>";
			    
			} else {
			    echo "0 results";
			}




	}

?>


