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
    <title>Page de connexion</title>
</head>
<body>
  <style>
    *{
      font-family: 'Poppins' sans serif;
    }
    body{
      background-image: url(../Web/Images/img43.jpg);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
    }
    .box{
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 90vh;
    }
    form{
      width: 350px;
      display: flex;
      flex-direction: column;
      padding: 0 15 0 15px;
    }
    header{
      color: #fff;
      font-size: 30px;
      display: flex;
      justify-content: center;
      padding: 10px 0 10px 0;
    }

    .input{
      display: flex;
      flex-direction: column;
    }
    .input1{
      height: 45px;
      width: 87%;
      border: none;
      outline: none;
      border-radius: 30px;
      color: #fff;
      padding: 0 0 0 45px;
      background: rgba(255, 255, 255, 0.3);
    }
    i{
      position: relative;
      top: -55px;
      left: 17px;
      color: #fff;
      font-size: 25px;
      font-weight: 700;
    }
    ::-webkit-input-placeholder{
      color: white;
      font-size: 15px;
    }

    .top-header1{
      color: #fff;
      font-size: 20px;
    }
    
    .submit{
      border: none;
      border-radius: 30px;
      font-weight: bold;
      font-size: 15px;
      height: 45px;
      outline: none;
      width: 100%;
      background: rgba(255, 255, 255, 0.9);
      cursor: pointer;
      transition: .3s;
    }
    .submit:hover{
      background-color: transparent;
      color: white;
      font-weight: bold;
    }

  </style>
  <?php
  require('dbconnect.php');
  session_start();
  


  if ($_SERVER["REQUEST_METHOD"] == "POST"){

     // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $_SESSION['user'] = $user;

     // Exécuter une requête SQL pour vérifier les informations saisies
      $sql = "SELECT * FROM USER WHERE (NOM_USER='$user' OR MAIL_USER='$user') AND MP_USER='$password'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
       // Informations correctes, récupérer le niveau de l'utilisateur
        $row = $result->fetch_assoc();
        $niveau = $row['NIVEAU'];
        $idPlanteur = $row['ID_USER'];
        $_SESSION['vali_connexion'] = $idPlanteur;

       // Redirection en fonction du niveau
        if ($niveau == 1) {
            header("Location: Admin/admin.php");
            exit();
        } elseif ($niveau == 2) {
            header('Location: Planteurs/user.php?id='.$idPlanteur);
            exit();
        }
      } else{
        $erreur = "Le nom d'utilisateur ou le mot de passe est incorrect.<br>Veillez vous rapprocher de l'administrateur, jeanadmin@gmail.com, pour vous faire enregistrer.";
       }
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>

  <div class="box">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="top-header">
          <header>Bienvenue</header>
        </div>
        <div class="top-header1">
          <?php if (isset($erreur)) { ?>
          <p class="errorMessage"><?php echo $erreur; ?></p>
          <?php } ?>
        </div>
          <div class="input">
            <input type="text" name="user" placeholder="Entrez votre nom ou votre mail" class="input1" require><br>
            <i class='bx bx-user'></i>
          </div>
          <div class="input">
            <input type="password" name="password" placeholder=" Entrez votre Mot de passe" class="input1" require><br>
            <i class=" bx bx-lock-alt"></i>
          </div>
          <div class="input">
            <input type="submit" value="Connexion " name="submit" class="submit" >
          </div>
      </form>

  </div>
</body>
</html>
