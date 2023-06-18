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
    <title>Enregistrement de planteur</title>
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
      padding: 0 40px 0 30px;
      margin-left: 30px;
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
      width: 450px;
      margin: 60px auto 0 auto;
      padding: 15px 40px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      width: 100%;
    }

    .form-field {
      position: relative;
      margin-bottom: 20px;
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

    .submit-button {
      text-align: center;
      width: 90%;
      padding: 10px;
      margin: 10px 0 0 20px;
      font-size: 16px;
      color: #fff;
      margin-left: 30px;
      background-color: #08d80f;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit-button:hover{
      background-color: green;
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

    <header>

      <a href="../../Web/Projet1.html" class="logo">Korhogo<span>Cashew</span></a>

      <a href="../Admin/admin.php" class="list">Accueil</a>

    </header>
 <?php
  require('../dbconnect.php');
  session_start(); 

  // Vérifier si le formulaire est soumis
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $iduser = $_POST['iduser'];
      $username = $_POST['username'];
      $numuser = $_POST['numuser'];
      $mail = $_POST['mail'];
      $password = $_POST['password'];
      $niveau = $_POST['niveau'];


    // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
    $iduser = mysqli_real_escape_string($conn, $iduser);
    $username = mysqli_real_escape_string($conn, $username);
    $numuser = mysqli_real_escape_string($conn, $numuser);
    $mail = mysqli_real_escape_string($conn, $mail);
    $password = mysqli_real_escape_string($conn, $password);
    $niveau = mysqli_real_escape_string($conn, $niveau);

    // Exécuter la requête d'insertion
    $sql = "INSERT INTO USER(ID_USER, NOM_USER, NUM_USER, MAIL_USER, MP_USER, NIVEAU) VALUES ('$iduser', '$username', '$numuser', '$mail', '$password', '$niveau')";
    if ($conn->query($sql) === TRUE) {
        $message1= "Planteur enregistré avec succès.";
    } else {
        $message2= "Erreur d'enregistrement.";
    }
 }

   // Fermer la connexion à la base de données
   $conn->close(); 
  ?>

  <div class="container">

    <h1>Nouveau planteur</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <div class="form-field">
        <input type="text" name="iduser" require>
        <label for="iduser">ID</label>
      </div>

      <div class="form-field">
        <input type="text" name="username" require>
        <label for="username">NOM COMPLET</label>
      </div>

      <div class="form-field">
        <input type="number" name="numuser" require>
        <label for="numuser">NUMERO</label>
      </div>

      <div class="form-field">
        <input type="mail" name="mail" require>
        <label for="mail">MAIL</label>
      </div>

      <div class="form-field">
        <input type="password" name="password" require>
        <label for="password">MOT DE PASSE</label>
      </div>

      <div class="form-field">
        <input type="texte" name="niveau" require>
        <label for="">NIVEAU</label>
      </div>

      <div class="submit_box">
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