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
	    
	    $vwforlap = new vw_forlap;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ganti Password</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link type="text/css" href="../css/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
	<style type="text/css">
	 @import "../datatables/media/css/demo_page.css";
	 @import "../datatables/media/css/demo_table.css";
	.ui-widget { font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif; font-size: 9px; }
	</style>
	<script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="../datatables/media/js/jquery.dataTables.js"></script> 
	<script type="text/javascript">

	

	$(document).ready(function () {
		// Dialog
				$('#dialog').dialog({
					autoOpen: true,
					width: 700,
					open: function(){
														
							$("#tabsdsn").tabs();
							$("#tabsmhs").tabs();
							$("#rpendidikan").dataTable();
							$("#rpengajaran").dataTable();
							$("#rpenelitian").dataTable();
							$("#rstatklh").dataTable();
							$("#rklh").dataTable(); 
							$("#tabs1").tabs();
							$('#pgload').html("");
						  },
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						}
					}
				});
				
				$("#Angkatan").change(function(){
				           var thnmsmshs = $("#Angkatan").val();  
				           $.ajax({
                                     type : "POST",
				                     url : "local_class/ambilkelas.php",
				                     cache: false,
				                     data :"thnmsmshs="+thnmsmshs,
									 success : function(data){
					                            $("#kls").html(data);
													var kelas = $("#kls").val(); 
													$.ajax({
													 type : "POST",
													 url : "local_class/ambilnm.php",
													 cache: false,
													 data :"thnmsmshs="+thnmsmshs+"&kelas="+kelas,
													 success : function(data){
																$("#Mhs").html(data);															
																
															   }
												  });
												
				                               }
                                  });
				
				
				
				
				});
				
				$("#kls").change(function(){
				    var thnmsmshs = $("#Angkatan").val();  
				    var kelas = $("#kls").val(); 
					$.ajax({
							 type : "POST",
							 url : "local_class/ambilnm.php",
							 cache: false,
							 data :"thnmsmshs="+thnmsmshs+"&kelas="+kelas,
							 success : function(data){
					     					$("#Mhs").html(data);															
									   }
						  });
								
				
				});
				
				$("#filtermhs").click( function()
                  {
                    var nim = $("#Mhs").val();					
					var tmp = $('#Mhs').find('option:selected').text();
					$("#hsl_filtermhs").html("Hasil Filter : "+tmp);					
					$("#datamhs").html("<div id='pgload'><font size='1' color='red'>Mengontak Server ....</font> <img src='../img/ajax-loader.gif' /></div>");
					$.ajax({
                                     type : "POST",
				                     url : "../global_class/chg_conten.php",
				                     cache: false,
				                     data :"nim="+nim+"&idx=62",
									 success : function(data){
					                            $("#datamhs").html(data);												
												$("#tabsmhs").tabs();	
                                                $("#rstatklh").dataTable();
												$("#rklh").dataTable();      												
				                               }
                                  });
				  }
                );
				
				 $("#filterdsn").click( function()
												  {
													var kode = $("#Kode").val();					
													var tmp = $('#Kode').find('option:selected').text();
													$("#hsl_filterdsn").html("Hasil Filter : "+tmp);
													$("#datadosen").html("<div id='pgload'><font size='1' color='red'>Mengontak Server ....</font> <img src='../img/ajax-loader.gif' /></div>");
													$.ajax({
																	 type : "POST",
																	 url : "../global_class/chg_conten.php",
																	 cache: false,
																	 data :"nim="+kode+"&idx=63",
																	 success : function(data){
																				$("#datadosen").html(data);
																				$("#tabsdsn").tabs();
																				$("#rpendidikan").dataTable();
																				$("#rpengajaran").dataTable();
																				$("#rpenelitian").dataTable();
																			   }
																  });
																						  
												  });

 	});

	</script>
	
  <style type="text/css">
     
  </style>
</head>

<body>
   <div id='pgload'><font size='1' color='red'>Mengontak Server ....</font> <img src='../img/ajax-loader.gif' /></div>
   <!-- ui-dialog -->
		<div id="dialog" title="Data Forlap">
			<?php
		    echo $vwforlap->vw_dt_forlap();		   
		   ?>
		</div>
   
</body>

</html>
	 <?php }} ?>