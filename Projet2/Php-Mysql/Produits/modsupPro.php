<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Détail</title>
</head>
<body>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
    *{
      margin: 0;
      padding: 0;
      text-decoration: none;
    }


    body{
      height: 100vh;
      overflow: hidden;
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
    }

    header{
      position: absolute;
      width: 100%;
      height: 20px;
      right: 0;
      top: 0;
      z-index: 9999;
      display: flex;
      align-items: center;
      background: white;
      padding: 10px 3%;
      box-shadow: 0px 5px 10px -5px rgba(0, 0, 0, 0.5);
    }

    .logo{
      font-size: 1.3rem;
      font-weight: 600;
      color: black;
      margin-left: 30px;
      padding: 0 40px 0 30px;
    }

    .logo span{
      color: #08d80f;
    }

    .list{
      font-size: 20;
      font-weight: bold;
      margin-left: 40px;
      color: black;
    }

    .list:hover{
      color: #08d80f;
    }

    .container {
      width: 500px;
      margin: 60px auto 0 auto;
      padding: 20px 40px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
    }

    .form-field {
      position: relative;
      margin-bottom: 31px;
    }

    input {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    label {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      font-size: 16px;
      font-weight: bold;
      color: black;
      transition: all 0.2s ease-in-out;
      pointer-events: none;
    }

    input:focus ~ label,
    input:valid ~ label {
      top: -10px;
      font-size: 12px;
      color: black;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 5px;
    }

    .submit-button,
    .reset-button {
      width: 48%;
      padding: 8px;
      font-size: 16px;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .submit-button {
      background-color: #08d80f;
    }

    .reset-button {
      background-color: red;
    }

    .submit-button:hover{
      background-color: #047a0a;
    }

    .reset-button:hover {
      background-color: #800000;
    }

    .message1{
      margin: 5px 95px;
      color: #08d80f;
      height: 100%;
    }

.message2{
  margin: 5px 95px;
  color: red;
  height: 100%;
}
</style>



<?php
// Connexion à la base de données
require('../dbconnect.php');
session_start();

// Vérifier si un identifiant a été transmis dans l'URL
if (isset($_GET['idpro'])) {
    // Récupérer l'identifiant de la ligne à modifier/supprimer
    $idpro = $_GET['idpro'];

    // Récupérer les informations de la ligne depuis la base de données
    $sql = "SELECT * FROM PRODUCTION WHERE ID_PROD = $idpro";
    $resultat = mysqli_query($conn, $sql);

    if ($resultat && mysqli_num_rows($resultat) > 0) {
        $ligne = mysqli_fetch_assoc($resultat);
        $datee = $ligne['DATE_ENREGIS'];
        $prixk = $ligne['PRIX_KG'];
        $poidst = $ligne['POIDS_TONNE'];
        $idu = $ligne['ID_USER'];
    } else {
        echo 'Aucune ligne correspondante trouvée dans la base de données.';
        exit;
    }
} else {
    echo 'Aucun identifiant de ligne spécifié.';
    exit;
}

// Vérifier si le formulaire a été soumis pour effectuer la modification
if (isset($_POST['modifier'])) {
    // Récupérer les nouvelles valeurs du formulaire
    $nouvelledatee = $_POST['datee'];
    $nouveauprixk = $_POST['prixk'];
    $nouveaupoidst = $_POST['poidst'];
    $nouveauidu = $_POST['idu'];

    // Effectuer la mise à jour des données dans la base de données
    $sql = "UPDATE PRODUCTION SET DATE_ENREGIS = '$nouvelledatee', PRIX_KG = '$nouveauprixk', POIDS_TONNE = '$nouveaupoidst', ID_USER = '$nouveauidu' WHERE ID_PROD = $idpro";
    $resultat = mysqli_query($conn, $sql);

    if ($resultat) {
        $messageM1 = 'Les données ont été modifiées avec succès.';
        // Rediriger vers une autre page après la modification
        header('Location: listePro.php');
        exit;
    } else {
        $messageM2 = 'Erreur lors de la modification des données : ' . mysqli_error($conn);
    }
}

// Vérifier si la suppression a été demandée
if (isset($_POST['supprimer'])) {
    // Supprimer la ligne de la base de données
    $sql = "DELETE FROM PRODUCTION WHERE ID_PROD = $idpro";
    $resultat = mysqli_query($conn, $sql);

    if ($resultat) {
        $messageS1 = 'Les informations ont été supprimée avec succès.';
        // Rediriger vers une autre page après la suppression
        header('Location: listePro.php');
        exit;
    } else {
        $messageS2 = 'Erreur lors de la suppression des informations.';
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
    <header>

        <a href="../../Web/Projet1.html" class="logo">Korhogo<span>Cashew</span></a>

        <a href="../Admin/admin.php" class="list">Accueil</a>

    </header>


   <div class="container">
        <h1>Détal production</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?idpro=' . $idpro; ?>" method="post">

            <div class="form-field">
                <input type="number" name="idpro" value="<?php echo $idpro; ?>" required>
                <label for="idpro">NUMERO DE PRODUCTION</label>
            </div>

            <div class="form-field">
                <input type="date" name="datee" value="<?php echo $datee; ?>" required>
                <label for="datee">DATE D'ENREGISTREMENT</label>
            </div>

            <div class="form-field">
                <input type="number" name="prixk" value="<?php echo $prixk; ?>" required>
                <label for="prixk">PRIX DU KG</label>
            </div>

            <div class="form-field">
                <input type="text" name="poidst" value="<?php echo $poidst; ?>" required>
                <label for="poidsk">POIDS EN TONNE</label>
            </div>

            <div class="form-field">
                <input type="text" name="idu" value="<?php echo $idu; ?>" required>
                <label for="idu">ID DU PLANTEUR</label>
            </div>

            <div class="button-container">
                <input type="submit" value="Modifier" name="modifier" class="submit-button">
                <input type="submit" value="Supprimer" name="supprimer" class="reset-button">
            </div>

            <?php if (isset($messageM1)) { ?>
                <p class="message1"><?php echo $messageM1; ?></p>
            <?php } ?>
            <?php if (isset($messageM2)) { ?>
                <p class="message2"><?php echo $messageM2; ?></p>
            <?php } ?>

            <?php if (isset($messageS1)) { ?>
                <p class="message1"><?php echo $messageS1; ?></p>
            <?php } ?>
            <?php if (isset($messageS2)) { ?>
                <p class="message2"><?php echo $messageS2; ?></p>
            <?php } ?>

        </form>

    </div>

</body>
</html>
