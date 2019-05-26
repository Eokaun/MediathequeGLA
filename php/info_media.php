<?php
	include "../php/fonctions.php";
	/*
	*
	*	GESTION DES VARIABLES ET ERREURS
	*
	*/

	$erreur = false;
	$msg_erreur = "Erreur";
	$html = "";
  $id_media = $_POST['id_media']??null;

	if(!isset($id_media))
	{
		$erreur = true;
		$msg_erreur .= " - media manquant";
	}

	/*
	*
	*	GESTION DES VARIABLES ET ERREURS
	*
	*/

	if(!$erreur)
	{
    $requete_media = "select *
    from Média m
    where m.id = ".$id_media;

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
    $commentaires[0] = [
      "commentaire" => "Très bon livre !",
      "nom" => "Delpech",
      "prenom" => "Michel",
      "note" => 5];
    $commentaires[1] = [
      "commentaire" => "Fin un peu décevante",
      "nom" => "Ngijol",
      "prenom" => "Thomas",
      "note" => 2];
    $commentaires[2] = [
      "commentaire" => "Mon fils a adoré",
      "nom" => "Carmil",
      "prenom" => "Sandrine",
      "note" => 4];
    $commentaires[3] = [
      "commentaire" => "Moyen",
      "nom" => "Goodenough",
      "prenom" => "David",
      "note" => 3];
    $commentaires[4] = [
      "commentaire" => "A la fin, le héros meurt !!!",
      "nom" => "lheur",
      "prenom" => "Spoï",
      "note" => 1];

    $html .= "<h2>
        &nbsp;Fiche d'information&nbsp;:&nbsp;".$media['titre']."
      </h2>
      <hr></br>
      <div>
        <div id=\"div_photo\" class=\"div_25\">".$media['photo']."</div>
        <div id=\"div_attributs\" class=\"div_75\">
          <label>Auteur&nbsp;:&nbsp;</label>".$media['auteur']."</br>
          <label>Exemplaires&nbsp;libres&nbsp;:&nbsp;</label>".$media['nb_exemplaire']."</br>
          <label>Prix&nbsp;:&nbsp;</label>".$media['prix']."</br>
          <label>Type&nbsp;:&nbsp;</label>".$media['type']."</br>
        </div>
      </div>
      </br>
      <div id=\"div_commentaires\">
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Commentaire</th>
              <th>Note</th>
            </tr>
          </thead>
          <tbody>";
    foreach($commentaires as $commentaire)
    {
      $html .= "<tr>
        <td>".$commentaire['prenom']." ".$commentaire['prenom']."</td>
        <td>".$commentaire['commentaire']."</td>
        <td>".$commentaire['note']."/5</td>
      </tr>";
    }

		$html .= "
			    </tbody>
			</table>
    </div>
    </br></br>
    <label>Ajouter un commentaire :</label>
    <input type=\"text\" id=\"input_commentaire\"></input>
    <button onClick=\"noteCommentaire(1)\">*</button>
    <button onClick=\"noteCommentaire(2)\">*</button>
    <button onClick=\"noteCommentaire(3)\">*</button>
    <button onClick=\"noteCommentaire(4)\">*</button>
    <button onClick=\"noteCommentaire(5)\">*</button>&nbsp;
    <span id=\"span_note_commentaire\">5/5</span>
    <button id=\"button_commentaire\">Ajouter un commentaire</button></br>
    <button id=\"retour\" onClick=\"charge_conteneur_central('catalogue')\">Fleche + retour au catalogue</button>";

    echobr($html);
  }
  else
    echobr($msg_erreur);
  ?>
