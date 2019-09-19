<?php 

$connection  = mysqli_connect('localhost','root','' , 'sap'); 
$userObj  = mysqli_query($connection , 'SELECT * FROM `zstockprod`');

if(isset($_POST['data'])){
	$dataArr = $_POST['data'];
	$rows = array();

	foreach($dataArr as $id){
		$r_sql = mysqli_query($connection , "SELECT productid, name, category, available, unitprice, datechecked FROM `zstockprod` where id='$id'");
		$r_json = mysqli_fetch_assoc($r_sql);
		$rows[] = $r_json;
	    mysqli_query($connection , "DELETE FROM zstockprod where id='$id'");
	}
   // create format json
    echo json_encode($rows);
}

?>