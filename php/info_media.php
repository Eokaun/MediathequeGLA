<?php

  include "../php/header.php";
  include "../php/includes.php";
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
  'photo' => "LivreJungle.jpg",
  'titre' => "Le livre de la jungle",
  'auteur' => 'Rudyard Kipling',
  "nb_exemplaire" => 0,
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

  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <img src="../imgs/<?=$media["photo"]?>" class="img-thumbnail imgFM" alt="Responsive image">
      </div>
      <div class="col-lg-6">
        <h1>Infos Pratiques</h1>
        <br>
        <table class="table table-hover self-align-center">
          <tbody>
            <tr>
              <th scope="row"><?= $media["type"]?></th>
              <td>
                <div>
                <span id="span_titre"><?= $media["titre"]?></span>

                </div>
              </td>
              <?php
              if($_SESSION['type_utilisateur'] == "Admin" || $_SESSION['type_utilisateur'] == "Employe")
              echo "
              <td><input id=\"input_titre\" value=\"".$media["titre"]."\" hidden></input>
              <i id=\"pen_titre\" class=\"fas fa-pen\" onclick=\"bascule_masque('span_titre', 'input_titre', 'pen_titre', 'check_titre')\"></i>
              <i id=\"check_titre\" class=\"fas fa-check\" onclick=\"bascule_masque('span_titre', 'input_titre', 'pen_titre', 'check_titre'); modifie_titre('".$id_media."')\" hidden></i></td>";
              ?>
            </tr>
            <tr>
              <th scope="row">Auteur</th>
              <td>
                <div>
                <span id="span_auteur"><?= $media["auteur"]?></span>
                </div>
              </td>
              <?php
              if($_SESSION['type_utilisateur'] == "Admin" || $_SESSION['type_utilisateur'] == "Employe")
              echo "
              <td><input id=\"input_auteur\" value=\"".$media["auteur"]."\" hidden></input>
              <i id=\"pen_auteur\" class=\"fas fa-pen\" onclick=\"bascule_masque('span_auteur', 'input_auteur', 'pen_auteur', 'check_auteur')\"></i>
              <i id=\"check_auteur\" class=\"fas fa-check\" onclick=\"bascule_masque('span_auteur', 'input_auteur', 'pen_auteur', 'check_auteur'); modifie_auteur('".$id_media."')\" hidden></i></td>";
              ?>
            </tr>
            <tr>
              <th scope="row">Prix</th>
              <td>
                <div>
                <span id="span_prix"><?= $media["prix"]?> euros</span>
                </div>
              </td>
              <?php
              if($_SESSION['type_utilisateur'] == "Admin" || $_SESSION['type_utilisateur'] == "Employe")
              echo "
              <td><input type=\"number\" id=\"input_prix\" value=\"".$media["prix"]."\" hidden></input>
              <i id=\"pen_prix\" class=\"fas fa-pen\" onclick=\"bascule_masque('span_prix', 'input_prix', 'pen_prix', 'check_prix')\"></i>
              <i id=\"check_prix\" class=\"fas fa-check\" onclick=\"bascule_masque('span_prix', 'input_prix', 'pen_prix', 'check_prix'); modifie_prix('".$id_media."')\" hidden></i></td>";
              ?>
            </tr>
            <tr>
              <th scope="row">Nombre d'exemplaire restant </th>
              <td>
                <div>
                <span id="span_nb_exemplaire"><?= $media["nb_exemplaire"]?></span>
                </div>
              </td>
              <?php
              if($_SESSION['type_utilisateur'] == "Admin" || $_SESSION['type_utilisateur'] == "Employe")
              echo "
              <td><input type=\"number\" id=\"input_nb_exemplaire\" value=\"".$media["nb_exemplaire"]."\" hidden></input>
              <i id=\"pen_nb_exemplaire\" class=\"fas fa-pen\" onclick=\"bascule_masque('span_nb_exemplaire', 'input_nb_exemplaire', 'pen_nb_exemplaire', 'check_nb_exemplaire')\"></i>
              <i id=\"check_nb_exemplaire\" class=\"fas fa-check\" onclick=\"bascule_masque('span_nb_exemplaire', 'input_nb_exemplaire', 'pen_nb_exemplaire', 'check_nb_exemplaire'); modifie_nb_exemplaire('".$id_media."')\" hidden></i></td>";
              ?>
            </tr>
          </tbody>
        </table>
        <?php
        if($media["nb_exemplaire"] == 0)
        echo "
        <div>
          <button onClick=\"demande_notification('".$id_media."')\">Me notifier en cas de disponibilité</button>
        </div>";
        ?>
      </div>
    </div>
    <br>
    <fieldset>
      <legend>Commentaires</legend>
      <table class="table table-striped">
        <?php
        foreach($commentaires as $commentaire)
        {
          echo "<tr>
              <td>".$commentaire['prenom']." ".$commentaire['nom']."</td>
              <td>".$commentaire['commentaire']."</td><td>".$commentaire['note']."/5</td>
            </tr>";
        }
        ?>
      </table>
    </fieldset>
  </div>

  <?php
    include "../php/footer.php";
   ?>