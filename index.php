<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
//- Dans le dossier sql, j'ai ajouté un fichier mysql workbench, ouvrez le en utilisant mysql workbench
//- En analysant le diagramme uml des tables, reproduire ces tables en utilisant phpmyadmin
$server = 'localhost';
$user = 'root';
$db = 'exercice203';
$password = '';
try {
    $conn = new PDO("mysql:host=$server;dbname=$db;charset=UTF8;", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $exception) {
    die($exception->getMessage());
}
//- Creer un script php qui permet d'afficher les éléves et les informations de l'éléve dans une seule et même requete sql
$stmt = $conn->prepare("
    SELECT eleve.prenom AS p, eleve.nom AS n, eleve.login AS l, eleve.information_id AS i 
    FROM eleve
    INNER JOIN eleve_information on eleve_information.id = eleve.id 
    ");

$state = $stmt->execute();
if($state) {
    $eleves = $stmt->fetchAll();
    foreach ($eleves as $eleve) {
      if($eleve) {
          echo "<div class = 'eleves'>";
          echo "mes eleves sont :" .$eleve['prenom'] . "<br>";
          echo "mes eleves sont :" .$eleve['nom'] . "<br>";
          echo "mes eleves sont :" .$eleve['login'] . "<br>";
          echo "mes eleves sont :" .$eleve['information_id'] . "<br>";
          echo "</div>";
      }
    }
}

//- Lister les compétences de l'éléve et son niveau dans cette compétence.

//- Vous afficherez le niveau d'une compétence sous la forme d'un diagramme polaire.

?>

</body>
</html>