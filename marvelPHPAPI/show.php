<? include_once './PDO/PDO.php';
$query=$PDO->prepare( "SELECT COUNT(*)as NBR FROM personnage");
$query->execute();
$resultat=$query->fetch();
$res=$resultat['NBR'];


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
  <?
  if($_GET['theme']=="ironman"){
    echo '<link rel="stylesheet" href="ironman.css">';
  }
  else if ($_GET['theme']=="cpta"){
    echo '<link rel="stylesheet" href="cpta.css">';
  }
  else if ($_GET['theme']=="hulk"){
    echo '<link rel="stylesheet" href="hulk.css">';
  }
  else{
    echo '<link rel="stylesheet" href="Style.css">';
  }
                ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <ul class="topnav">
  <li><a style="text-align:center"><img src="https://cdn.1min30.com/wp-content/uploads/2018/07/Symbole-Marvel.jpg" width="10%"></a></li>
</ul>



<script>
$(document).ready(function(){  
$( "#button " ).click(function() {
  $( "#formulaire" ).slideToggle() 
  apparition(document.getElementById('button '))
});
});
function apparition(x){
if (x.style.display === "none") {
      x.style.display = "block";
      } else {
      x.style.display = "none";

    }    }

</script>


</script>
<div id="container">
<div id="target-content">
</div>
  </div>
<ul>
                    <?php 
                   $total_pages=ceil($res/12);
					if(!empty($total_pages)){
						for($i=1; $i<=$total_pages; $i++){
								if($i == 1){
									?>
								<li style= 'display:inline' class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>
                <li style= 'display:inline'class="pageitem" id="<?php echo $i+1;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i+1;?>"><?php echo $i+1;?></a></li>
                <li style= 'display:inline'class="pageitem" id="<?php echo $i+2;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i+2;?>"><?php echo $i+2;?></a></li>
                <li style= 'display:inline'class="pageitem" id="<?php echo $i+3;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i+3;?>"><?php echo $i+3;?></a></li> 							
								<?php 
								}
								else{
									?>
								<li style= 'display:inline'class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
								<?php
                }
              }
            }
            ?>
					</ul>
          <script>
	$(document).ready(function() {
		$("#target-content").load("./API/Character/Get.php?page=1");
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			$.ajax({
				url: "./API/Character/Get.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
          $("#"+select_id).addClass("active");
          
          
					
				}
			});
		});
    });

</script>
<div id="foot">

  <div id="formulaire">
  
    <form method="POST" action="./API/Character/Add.php" id="form" enctype="multipart/form-data">
        <div>
          <fieldset>
           <label for="nom">Nom du personnage : </label>  
            <input type="text" id="nom"name="nom"></br>
            <label for="url"> Image du personnage : </label>
            <input type="file" id="url" name="url"></br>
            <button type="input"  id="submit" onclick='envoyer()'>Ajouter un personnage</button>  
          </fieldset>
        
        </div>
    </form>

  </div>
  <button id="button" href="#form"> Ajouter un personnage </button> 
</div>
 

<script>
 function envoyer(){
	event.preventDefault();
	if ((document.getElementById("nom").value != "") && (document.getElementById("url").value != ""))
	{
	var form = $('#form')[0];
	var data = new FormData(form);
	data.append("text", document.getElementById("nom").value);	
	$.ajax({	
		url : 'API/Character/Add.php',
		type : 'POST',
		enctype: 'multipart/form-data',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
    timeout: 600000,
    asynchronous:false,
		success : function(reponse){
      document.getElementById("form").reset(); 
      $(document).ready(function() {
		$("#target-content").load("./API/Character/Get.php?page=1");
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			$.ajax({
				url: "./API/Character/Get.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
          $("#"+select_id).addClass("active");
          apparition(document.getElementById('button '));
          $('#formulaire').slideToggle();
          
				
				}
			});
		});
    });
		}
	});
	}
}
</script>
</body>
   

</html>
