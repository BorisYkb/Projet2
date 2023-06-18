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
    <title>Enregistrement de production</title>
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
      height: 30px;
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
      width: 400px;
      margin: 70px auto 0 auto;
      padding: 15px 40px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 50px;
    }

    .form-field {
      position: relative;
      margin-bottom: 25px;
    }

    input {
      width: 100%;
      padding: 10px;
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

    .submit-button {
      text-align: center;
      width: 90%;
      padding: 10px;
      margin: 10px 0 0 20px;
      font-size: 16px;
      color: #fff;
      background-color: #08d80f;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit-button:hover{
    background-color: green;
  }

  .message1{
    margin: 5px 60px;
    color: #08d80f;
  }

  .message2{
    margin: 5px 65px;
    color: red;
  }


  </style>

    <header>

      <a href="../../Web/Projet1.html" class="logo">Korhogo<span>Cashew</span></a>

      <a href="../Admin/admin.php" class="list">Accueil</a>

    </header>
 <?php
  require('../dbconnect.php');
  session_start(); 

  // Vérifier si le formulaire est soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $dateeng = $_POST['dateeng'];
      $prixk = $_POST['prixk'];
      $poidst = $_POST['poidst'];
      $iduser = $_POST['iduser'];


    // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
    
    $prixk = mysqli_real_escape_string($conn, $prixk);
    $poidst = mysqli_real_escape_string($conn, $poidst);
    $iduser = mysqli_real_escape_string($conn, $iduser);

    // Exécuter la requête d'insertion
    $sql = "INSERT INTO PRODUCTION (DATE_ENREGIS, PRIX_KG, POIDS_TONNE, ID_USER) VALUES ('$dateeng', '$prixk', '$poidst', '$iduser')";
    if ($conn->query($sql) === TRUE) {
        $message1= "Données enregistrées avec succès.";
    } else {
        $message2= "Erreur d'enregistrement des données : " . $conn->error;
    }
 }

   // Fermer la connexion à la base de données
   $conn->close(); 
  ?>

  <div class="container">

    <h1>Enregistrement de production</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <div class="form-field">
        <input type="date" name="dateeng" require>
        <label for="dateeng">DATE D'ENREGISTREMENT</label>
      </div>

      <div class="form-field">
      <input type="text" name="prixk" require>
        <label for="prixk">PRIX DU KG</label>
      </div>
      
      <div class="form-field">
        <input type="text" name="poidst" require>
        <label for="poidst">POIDS(EN TONNE)</label>
      </div>

      <div class="form-field">
      <input type="texte" name="iduser" require>
          <label for="iduser">NOM DU PLANTEUR</label>
      </div>
          
      <div>
        <input type="submit" value="Enregistrer" name="submit" class="submit-button"> 
      </div>

      <?php if (isset($message1)) { ?>
        <p class="message1"><?php echo $message1; ?></p>
      <?php } ?>
      <?php if (isset($message2)) { ?>
        <p class="message2"><?php echo $message2; ?></p>
      <?php } ?>

    </form>

  </div>




</body>
</html>