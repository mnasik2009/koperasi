
<?php
	$host	 = "localhost";
	$user	 = "root";
	$pass	 = "Nasikin20091980Baru";
	$dabname = "u1732122_koperasi";

	$conn = mysqli_connect( $host, $user, $pass,$dabname) or die('Could not connect to mysql server.' );
	//mysqli_select_db($dabname, $conn) or die('Could not select database.');
	$baseurl="http://localhost/newkoperasi/";
?>
