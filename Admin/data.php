<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost","ferrydraw","hsh0729!","ferrydraw");

//쿼리는 수정해야함 무슨 php인지 몰라서 수정 못함
$sqlQuery = "SELECT Place, COUNT(Person) AS Visitor FROM reserveform_table GROUP BY Place";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>