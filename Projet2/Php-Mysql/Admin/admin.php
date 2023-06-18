<?php
// Connexion à la base de données
require('../dbconnect.php');
session_start();

// Requête pour compter le nombre de planteurs dans la table USER
$sql = "SELECT COUNT(*) AS total FROM USER";
$resultat = mysqli_query($conn, $sql);

if ($resultat) {
    $ligne = mysqli_fetch_assoc($resultat);
    $totalPlanteurs = $ligne['total'];
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
}


// Requête pour faire la somme des PRIX DE PRODUCTION de tous les utilisateurs
$sql1 = "SELECT SUM(PRIX_KG * 1000 * POIDS_TONNE) AS total FROM PRODUCTION";
$resultat = mysqli_query($conn, $sql1);

if ($resultat) {
    $ligne = mysqli_fetch_assoc($resultat);
    $totalPrixProduction = $ligne['total'];
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Page Admin</title>
</head>
<body>


    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
        *{
         margin: 0;
         padding: 0;
         outline: none;
         border: none;
         text-decoration: none;
         box-sizing: border-box;
         font-family: "Poppins", sans-serif;
        }


        body{
            background-color: #e1e1e1;
        }

        header{
            position: absolute;
            width: 100%;
            height: 40px;
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



        .contener{
         position: absolute;
         display: flex;
         margin: 33px 0px 0px 0px;
        }


        nav{
         position: relative;
         top: 0;
         left: 0;
         bottom: 0;
         height: 100vh;
         background: #fff;
         width: 280px;
         overflow: hidden;
         box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }
        nav li a{
         display: flex;
         flex-direction: column;
        }
        nav img{
            height: 100px;
            width: 100px;
            margin: 20px 0px 0px 95px;
            border-radius: 50%;
        }


        .logo1{
         display: flex;
         flex-direction: column;
         text-align: center;
         margin-bottom: 30px;
        }
        .logo1{
            color: black;
        }
        .logo1 h3{
            font-size: 25px
        }
        .logo1 span{
            color: #08d80f;
        }
        .logo1 p{
            color: #7C7C7C;
            font-size: 11px;
        }


        .element{
         display: flex;
         flex-direction: column;
         align-items: center;
        }
        .element a{
         font-weight: bold;
         position: relative;
         color: rgb(85, 83, 83);
         font-size: 14px;
         display: flex;
         flex-direction: column;
         align-items: center;
         width: 230px;
         padding: 3px;
        }
        .element a:hover{
         background: #eee;
         border-radius: 10px;
        }
        .element h3 span{
            color: #08d80f;
        }

  

        .entete{
            display: flex;
            align-items: center;
        }
        .contener .element{
            margin: 10px;
        }

        .element h3{
            margin-left: 5px;
        }
       


        .logout{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
            color: black;
        }
        .logout a div{
            display: flex;
            align-items: center;
            color: black;
        }


        .section1 form{
            margin: 30Px 0 30px 280px;
            display: flex;
            align-items: center;
        }

        .section1 span{
            color: #08d80f;
        }
        .search-input{
            padding: 5px 200px 5px 5px;
            font-size: 15px;
            margin-right: 5px;
            border: 2px solid #7C7C7C;
            border-radius: 3px;
        }
        .search-button button{
            background-color: transparent;
            color: black;
            font-size: 30px;
            cursor: pointer;
        }
        .search-button{
            margin-top: 5px;
        }
        .search-button button:hover{
            color: #08d80f;
        }
        

        .start{
           display: flex;
           margin-top: 20px;
           margin-left: 70px;
        }
        .start .card{
           width: 50%;
           margin-right: 20px;
           background: #fff;
           text-align: center;
           border-radius: 20px;
           padding: 30px;
           box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }
        .start .card h3{
           margin: 10px;
           text-transform: capitalize;
        }
        .start .card p{
           font-size: 12px;
        }
        .start .card i{
           font-size: 22px;
           padding: 10px;
        }


        .section2{
            margin-left: 37px;
            margin-bottom: 10px;
        }
        .recent h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .h3{
            margin-left: 50px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
            border: 2px solid transparent;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            padding-left: 30px;
            padding-right: 30px;

        }

       .footer {
            text-align: right;
            margin-top: 10px;
        }

        .footer a {
            padding: 5px 20px;
            background-color: #08d80f;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .footer a:hover {
            background-color: transparent;
            color: black;
        }



    </style>

    <header>

        <a href="../../Web/Projet1.html" class="logo">Korhogo<span>Cashew</span></a>

        <a href="#" class="list">Accueil</a>

    </header>


    <div class="contener">


        <nav>
            <ul>

                <li>
                    <a href="#" class="logo1">
                      <img src="../../Web/Images/img38.jpg" alt="">
                      <h3 class="nav-item">Admin <span>Jean</span></h3>
                      <p>jeanadmin@gmail.com</p>
                    </a>
                </li>

                <li>
                    <div class="element">
                        <div class="entete">
                            <i class='bx bx-user'></i>
                            <h3>Plan<span>teur</span></h3>
                        </div>
                       <div class="contenue">
                           <a href="../Planteurs/listePlan.php">
                               <span>Liste</span>
                           </a>
                           <a href="../Planteurs/enregistrerPlan.php">
                               <span>Enregistrer</span>
                           </a>
                           <a href="../Planteurs/modifierPlanV.php">
                               <span>Modification</span>
                           <a href="../Planteurs/supprimerPlanV.php">
                               <span>Supprimer</span>
                           </a>
                           </a>
                       </div>
                    </div>
                </li>

                <li>
                    <div class="element">
                        <div class="entete">
                           <i class='bx bx-store-alt'></i>
                           <h3>Produc<span>tion</span></h3>
                        </div>
                        <div class="contenue">
                           <a href="../Produits/listePro.php">
                               <span>Liste</span>
                           </a>
                           <a href="../Produits/enregistrerPro.php">
                               <span>Enregistrer</span>
                           </a>
                           <a href="../Produits/modifierProV.php">
                               <span>Modification</span>
                           <a href="../Produits/supprimerProV.php">
                               <span>Supprimer</span>
                           </a>
                           </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="logout" >
                       <a href="../../Web/Projet1.html">
                          <div>
                              <i class="fas fa-sign-out-alt"></i>
                              <span class="nav-item">Logout</span>
                          </div>
                       </a>
                    </div>
                </li>
            </ul>
       </nav>

            <section class="section1">
                
                <div class="search">
                    <form action="../Planteurs/searchPlan.php" method="post">
                        <div class="">
                           <input type="text" name="search-input" placeholder="recherche" class="search-input" required>
                        </div>
                        <div class="search-button">
                            <button name="valider" ><i class='bx bx-search-alt-2'></i></button>
                        </div>
                    </form>
                </div>

                <div class="start">
                    <div class="card">
                        <i class='bx bx-user'></i>
                        <h3><?php echo $totalPlanteurs; ?> <span>Planteurs</span></h3>
                        <p>dans la Coopérative</p>
                    </div>
                    <div class="card">
                        <i class='bx bxs-bank'></i>
                        <h3><?php echo $totalPrixProduction; ?></h3>
                        <p>de dollars <span>de chiffre d'affaire</span></p>
                    </div>
                    <div class="card">
                        <i class='bx bx-happy'></i>
                        <h3>95% de nos <span>client</span></h3>
                        <p>sont satisfait de nos services.</p>
                    </div>
                </div>

                <section class="section2">

                    <div class="recent">
                        <?php
                            require('../dbconnect.php');

                            // Récupérer les productions depuis la base de données
                            $sqlProductions = "SELECT * FROM PRODUCTION ORDER BY ID_PROD DESC LIMIT 4";
                            $resultatProductions = mysqli_query($conn, $sqlProductions);

                            if ($resultatProductions && mysqli_num_rows($resultatProductions) > 0) {
                                echo '<h3 class="h3">Récemment <span>enregistré</span></h3>';
                                echo '<table>';
                                echo '<thead><tr><th>ID</th><th>Date d\'enregistrement</th><th>Prix en kilogramme</th><th>Poids en tonne</th><th>Poids en tonne</th></tr></thead>';
                                echo '<tbody>';

                                while ($row=$resultatProductions->fetch_assoc()) {
                                    $idProduction = $row["ID_PROD"];
                                    $dateEnregistrement = $row['DATE_ENREGIS'];
                                    $prixKg = $row['PRIX_KG'];
                                    $poidsTonne = $row['POIDS_TONNE'];

                                    $idu = $row["ID_USER"];

                                    echo '<tr><td>' . $idProduction . '</td><td>' . $dateEnregistrement . '</td><td>' . $prixKg . '</td><td>' . $poidsTonne . '</td><td>' . $idu . '</td></tr>';

                                }

                                echo '</tbody>';
                                echo '</table>';

                            } else {
                                echo '<p>Aucune production enregistrée.</p>';
                            }

                            mysqli_close($conn);
                        ?>

                    </div>

                    <div class="footer">
                        <a href="../Produits/listePro.php">Plus</a>
                    </div>

                </section>


            </section>


    </div>

</body>

</html>