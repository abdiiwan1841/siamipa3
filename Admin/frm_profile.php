<?php require_once 'shared.php'; 
     
     
	 
     
	 $islog = isset($_SESSION['islog']) ? $_SESSION['islog'] : 0;
	 
     
	 if($islog==0)
	 {
		 header("Location: ../global_code/frm_login.php?idx=1");
		 exit();
	 }
	 else
	 {	
         
        $login = new login;
		if($login->logintime()){		  
		  header("Location: ../global_code/frm_login.php?idx=1&isout=1");
		  exit();	
		}else{   
		  $user = $_SESSION['user'];
	      
		  
		  $vAdmin = new dt_staff;
	      $data = $vAdmin->getData($user);
	 
	      foreach ($data as $vrow) {
                 $row = $vrow;
          } // foreach
	 
	      $nama = str_replace(' ', '&nbsp;',$row['nm_user']); 
	      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>User Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link type="text/css" href="../css/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
	<style type="text/css">
	.ui-widget { font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif; font-size: 11px; }
	</style>
	<script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript">

	

	$(document).ready(function () {
		         
					

		// Dialog
				$('#dialog').dialog({
					autoOpen: true,
					autoResize:false,
					width : 265,
					height : 130,
					resizable: false,
					draggable: false,
					modals : true,
					open : function(event,ui){$(".ui-dialog-titlebar-close").hide();$('#pgload').html("");},
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						}
					}
				});

 	});

	</script>
	
  <style type="text/css">
     
  </style>
</head>

<body>
   <div id='pgload'><font size='1' color='red'>Mengontak Server ....</font> <img src='../img/ajax-loader.gif' /></div>
   <!-- ui-dialog -->
		<div id="dialog" title="User Profile">
			<table>
			<tr><td>Nama User </td><td>:</td><td><?php echo $nama ?></td></tr>
			
			<tr>
			  <td>Hak Akses</td>
			  <td>:</td>
			  <td>
			     <select id="hak">
						<?php
						  if($row['hak_akses']=="1")
						  {
						?>						
						<option value="1" selected="selected">1- Admin</option>
						<?php
						  }
						  else {
						 ?>
						 <option value="1" >1- Admin</option>
						<?php 
						  }
						?>
						<?php
						  if($row['hak_akses']=="2")
						  {
						?>						
						<option value="2" selected="selected">2- User</option>
						<?php
						  }
						  else {
						 ?>
						 <option value="2" >2- User</option>
						<?php 
						  }
						?>
						
					</select> 
			  </td>
			</tr>
			
			
			</table>
		</div>
   
</body>

</html>
	 <?php }} ?>