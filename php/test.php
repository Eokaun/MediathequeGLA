<!DOCTYPE html>

<?php

include "../php/fonctions.php";

//Debug :
$_SESSION['type_utilisateur'] = "Admin";

$erreur = false;
$msg_erreur = "Erreur";
$html = "";
$id_media = $_POST['id_media']??null;

if(!isset($id_media))
{
  $erreur = true;
  $msg_erreur .= " - media manquant";
}

if(!$erreur)
{
  $requete_media = "select *
  from Média m
  where m.id = ".$id_media;
}

//$media = requete_tableau($requete_media)[0];
$media = [
  'photo' => "photo",
  'titre' => "Le livre de la jungle",
  'auteur' => 'Rudyard Kipling',
  "nb_exemplaire" => 3,
  "prix" => 5,
  "type" => "Livre",
];

$requete_commentaires = "select *
from Média m
left outer join Commentaire c on c.media = m.id
left outer join Client cl on cl.id = c.client
where m.id = ".$id_media;

//$commentaires = requete_tableau($requete_commentaires);
$commentaires[0] = ["commentaire" => "Très bon livre !","nom" => "Delpech","prenom" => "Michel","note" => 5];
$commentaires[1] = ["commentaire" => "Fin un peu décevante","nom" => "Ngijol","prenom" => "Thomas","note" => 2];
$commentaires[2] = ["commentaire" => "Mon fils a adoré","nom" => "Carmil","prenom" => "Sandrine","note" => 4];
$commentaires[3] = ["commentaire" => "Moyen","nom" => "Goodenough","prenom" => "David","note" => 3];
$commentaires[4] = ["commentaire" => "A la fin, le héros meurt !!!","nom" => "lheur","prenom" => "Spoï","note" => 1];
?>

<html lang=fr dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="../js/fonctions.js"></script>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Font Awesome, Google Font -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display" rel="stylesheet">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="../css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $('#content').load("nav.html");
  });
  </script>
</head>
<body>

  <div id="content"></div>

  <div class="container">

    <p> Mon Media = <?= $media["titre"] ?></p>
    <table>
      <?php
      foreach($commentaires as $commentaire)
      {
        echo "<tr><td>".$commentaire['prenom']." ".$commentaire['nom']."</td><td>".$commentaire['commentaire']."</td><td>".$commentaire['note']."/5</td></tr>";
      }
      ?>
    </table>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
  crossorigin="anonymous"></script>
</body>
</html>
