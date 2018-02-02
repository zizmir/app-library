 <?php

 $user = 'root';
 $pass = '';
 $your_db = 'bdd-library';

 try {

 	$db = new PDO('mysql:host=localhost;dbname='.$your_db.';charset=UTF8', $user, $pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 }
catch( PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

$sql = "SELECT nom , id FROM auteur";
	
 ?>


<form action="" method="post">
 <p>Le titre : <input type="text" name="title" /></p>
 <p>la description : <input type="text" name="describe" /></p>
 <p>résume : <input type="text" name="body" /></p>
 <select name="author">

 	<?php 
	foreach  ($db->query($sql) as $row) { 
			echo "<option value='".$row['id']."'>".$row['nom']."</option>";
	 }
 	?>
</select>
 <p><input type="submit" value="OK" name="submit"></p>
</form>


 <?php

 
if(isset($_POST['submit'])){ 




$statement=$db->prepare("INSERT INTO articles (`titre`, `description`, `corps`, `id_auteur`) VALUES ('".$_POST['title']."','".$_POST['describe']."','".$_POST['body']."','".$_POST['author']."')");
$statement->execute();







}   


   

