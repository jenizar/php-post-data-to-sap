<?php
   include 'function.php'; 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Post Data to SAP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
</head>
<body>
  <h2>PHP Post Data to SAP</h2>
  <p>Product Inventory</p>   
<form name="frmUser" method="post" action="">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<div align="left" style="margin:16px 16px;" style="padding-bottom:1px;"><button type="button" class="btn btn-danger" id="delete">Post Data to SAP</button>
<div align="right" style="margin:1px 106px;" style="padding-bottom:1px;"><a href="add_data.php" class="link"><img alt='Add' title='Add' src='images/add.png' width='15px' height='15px'/>Add data</a></div>
<div class="container">
  <br/>         
  <table class="table table-striped" style="font-size:13px;">
    <thead>
      <tr>
        <th>
          <input type="checkbox" id="checkAll">
        </th>
        <th>Product ID</th>
        <th>Name</th>
        <th>Category</th>
		<th>Available</th>
		<th>Unit Price</th>
		<th>Date Checked</th>
      </tr>
    </thead>
    <tbody>
        
        <?php
          while($row  = mysqli_fetch_array($userObj)){ ?>
              <tr>
                <td><input class="checkbox" type="checkbox" id="<?php echo $row['ID'] ?>" name="ID[]"></td>
                <td><?php  echo $row['productid'] ?></td>
                <td><?php  echo $row['name'] ?></td>
                <td><?php  echo $row['category'] ?></td>
				<td><?php  echo $row['available'] ?></td>
				<td><?php  echo $row['unitprice'] ?></td>
				<td><?php  echo $row['datechecked'] ?></td>
              </tr>
           <?php } ?>   
    </tbody>
  </table>
  <br/>
</div>

<script>
  
  $(document).ready(function(){
      $('#checkAll').click(function(){
         if(this.checked){
             $('.checkbox').each(function(){
                this.checked = true;
             });   
         }else{
            $('.checkbox').each(function(){
                this.checked = false;
             });
         } 
      });


    $('#delete').click(function(){
       var dataArr  = new Array();
       if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('ID'));
              $(this).closest('tr').remove();
          });
          sendResponse(dataArr)
       }else{
         alert('No record selected ');
       }

    });  


    function sendResponse(dataArr){
        $.ajax({
            type    : 'post',
            url     : 'function.php',
            data    : {'data' : dataArr},
            success : function(response){
                       // alert(response);  // only for testing display json data (pop-up)
						submitData(response);
                      },
            error   : function(errResponse){
                      alert(errResponse);
                      }     					  
        });
    }
	// Send data to SAP server URL 
	function submitData(response){
       var xmlhttp = new XMLHttpRequest();   
       xmlhttp.open("POST", "http://10.3.3.135:8000/sap/bc/zsv_php_serv?sap-client=020");
       xmlhttp.send(response);
       console.log(response); 
	   
	   window.history.back();
       location.reload(); 	
	}
  });
</script>
</body>
</html>


  
   
 
  
 