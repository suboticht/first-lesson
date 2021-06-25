
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
		if($_GET['menu'] == 'themthanhvien'){
			if(isset($_POST['themthanhvien'])){
				$sql = "INSERT INTO thanhvien(`hoten`, `chucvu`, `ngaysinh`) VALUES ('".$_REQUEST['hoten']."', '".$_REQUEST['chucvu']."', '".$_REQUEST['ngaysinh']."' )";
				if($conn->query($sql) === TRUE ){
					echo "đã thêm thành công '".$_REQUEST['hoten']."'|'".$_REQUEST['chucvu']."'|'".$_REQUEST['ngaysinh']."'";
				}else{
					echo 'thêm không thành công: "'.$_REQUEST["ngaysinh"].'"|"'.$conn->error.'"';
				}
			}
			?>
				<form method='post' action='http://localhost/c/index.php?menu=themthanhvien'>
					<div>
						<h4>Họ tên:</h4></br>
						<input type='text' name='hoten' />
					</div>
					<div>
						<h4>Chức vụ:</h4></br>
						<input type='text' name='chucvu' />
					</div>
					<div>
						<h4>Ngày sinh:</h4></br>
						<input type='date' name='ngaysinh' />
					</div>
					<input type="submit" name="themthanhvien" value="them thanh vien" />
				</form>
				<a href='http://localhost/c/index.php'>trang chủ</a>
				</br>
				<a href='http://localhost/c/index.php?menu=themthanhvien'>quay lại</a>
			<?php
		}
	}else {
		?>
			<form method="post" action="http://localhost/c/index.php">
			  	<input type="text"  name="hoten">
			  	
			  	<input type="submit" name="timkiem" value="tim kiem">
			</form>
		<?php
		if(isset($_POST['timkiem'])){
			$ht=$_REQUEST['hoten'];
			$sql = "SELECT * FROM thanhvien WHERE hoten LIKE '%$ht%'";
		}else {
			$sql = 'SELECT * FROM thanhvien';
		}
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0 ){
			// output data of each row
			echo "<table>";
			echo "<tr><th>hoten</th> <th>chucvu</th><th>ngaysinh</th></tr>";
			while($row = mysqli_fetch_assoc($result)) {
				// echo "id: " . $row["hoten"].  "<br>";

				echo "<tr> <td>".$row["hoten"]."</td><td>".$row["chucvu"]."</td><td>".$row["ngaysinh"]."</td></tr>";
			}
			echo "</table>";
			echo "<a href='http://localhost/c/index.php'>Trang chu</a>";
			echo "</br>";
			echo "<a href='http://localhost/c/index.php?menu=themthanhvien'>Them Thanh Vien</a>";
		} else{
			echo 'null';
		}
	}
?>