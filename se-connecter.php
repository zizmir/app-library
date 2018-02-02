<?
 session_start();


 if(isset($_SESSION['user']))
 {
 	echo 'Bonjour !' . $_SESSION['user'];
 }else
 {
?>

<form action="" method="post">
 <p>L'email : <input type="email" name="email" /></p>
 <p>Le mot de passe : <input type="password" name="pwd" /></p>
 <p><input type="submit" value="OK" name="submit"></p>
</form>
<?php

if(isset($_POST['submit'])){ 
	$mail = $_POST['email'];
	$password = $_POST['pwd'];

	 $user = 'root';
	 $pass = '';
	 $your_db = 'bdd-library';
	try {

	 	$db = new PDO('mysql:host=localhost;dbname='.$your_db.';charset=UTF8', $user, $pass);

	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 }
	catch( PDOException $e) {
	    // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
	    // String.
	    echo 'Échec lors de la connexion : ' . $e->getMessage();
	}


	$statement=$db->prepare("SELECT nom , prenom FROM auteur  where  email ='".$mail."' AND password='".$password."' ");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	
	$_SESSION['user']= $results[0]['nom'] . ' ' . $results[0]['prenom'];
	var_dump($_SESSION['user']);

}
}
?>