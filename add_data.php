<?php
   include 'function.php'; 
if(count($_POST)>0) {
	$sql = "INSERT INTO zstockprod (productid, name, category, available, unitprice, datechecked) VALUES ('" . $_POST["productid"] . "','" . $_POST["name"] . "','" . $_POST["category"] . "','" . $_POST["available"] . "','" . $_POST["unitprice"] . "','" . $_POST["datechecked"] . "')";
	mysqli_query($connection,$sql);
	$current_id = mysqli_insert_id($connection);
	if(!empty($current_id)) {
		$message = "New data Added Successfully";
	}
	echo '<script>window.location="index.php"</script>';
} 
?>
<html>
<head>
<title>Add New Data</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<div align="right" style="padding-bottom:5px;"><a href="index.php" class="link"><img alt='List' title='List' src='images/list.png' width='15px' height='15px'/> List Transaction</a></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Add New Data</td>
</tr>
<tr>
<td><label>Product ID</label></td>
<td><input type="text" name="productid" class="txtField"></td>
</tr>
<tr>
<td><label>Name</label></td>
<td><input type="text" name="name" class="txtField"></td>
</tr>
<tr>
<td><label>Category</label></td>
<td><input type="text" name="category" class="txtField"></td>
</tr>
<td><label>Available</label></td>
<td><input type="text" name="available" class="txtField"></td>
</tr>
<tr>
<td><label>Unit Price</label></td>
<td><input type="text" name="unitprice" class="txtField"></td>
</tr>
<tr>
<td><label>Date Checked</label></td>
<td><input type="text" name="datechecked" class="txtField"></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body>
</html>