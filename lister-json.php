 <?php
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


$statement=$db->prepare("SELECT ar.titre, ar.description, ar.corps , au.nom FROM articles ar LEFT JOIN auteur au on  au.id = ar.id");
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
$json=json_encode($results);
   

   echo $json;