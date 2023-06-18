<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Productions</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
    <?php 
        // Connexion à la base de donnée et ouverture d'une session
        require('../dbconnect.php');
        session_start();
    ?>


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
        .contenue{
            margin-top: 80px;
        }

        .contenue form{
            margin: 0px 0px 20px 350px;
            display: flex;
            align-items: center;
        }
        .search-input{
            padding: 5px 300px 5px 5px;
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
            background: white;
        }
        .search-button button:hover{
            color: #08d80f;
        }

        .tableproduction{
            margin-left: 80px
        }

        table{
            border-collapse: collapse;
            margin: 10px 0;
            padding: 5px;
            font-size: 0.9em;
            font-family: sans-serif;
            box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5), 0 -10px 10px -10px rgba(0, 0, 0, 0.5);
        }
        td, th{
            padding: 10px 40px;
            text-align: center;
        }
        thead{
            padding: 30px;
        }
        tbody tr{
            border-bottom: 1px solid #dddddd;
        }
        thead tr{
            background-color: #08d80f;
            color: #ffffff;
            text-align: center;
        }
        tbody tr.active-row{
            font-weight: bold;
            color: #009879;
        }
        tbody tr:nth-of-type(even){
            background-color: #eeeeee;
        }

        tr a{
            padding: 5px;
            margin: 5px;
            border-radius: 3px;
        }
        tr .planteur{
            background-color: #08d80f;
            color: white;
            font-weight: 500;
            transition: ease .40s;
        }
        tr .detail{
            background-color: #ffffff;
            border: 1.5px solid black;
            color: black;
            font-weight: 500;
            transition: ease .40s;
        }
        tr .detail:hover{
            background-color: #08d80f;
            color: white;
            font-weight: 500;
            border: transparent;
        }
        tr .planteur:hover{
            background-color: white;
            color: black;
            font-weight: 500;
            border: 1.5px solid black;
        }
        table h3{
            font-size: 25px;
            text-transform: capitalize;
        }
        table span{
            color: #08d80f;
        }
    </style>

    <header>

        <a href="../../Web/Projet1.html" class="logo">Korhogo<span>Cashew</span></a>

        <a href="http://localhost/Projet/Php-Mysql/Admin/admin.php" class="list">Accueil</a>

    </header>

    <div class="contenue">

        <div class="search">
            <form action="searchPro.php" method="post">
                <div class="">
                    <input type="text" name="search-input" placeholder="recherche" class="search-input" required>
                </div>
                <div class="search-button">
                    <button name="valider" ><i class='bx bx-search-alt-2'></i></button>
                </div>
            </form>
        </div>

        <div class="tableproduction">

            <table>

                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Date d'enregistrement</th>
                        <th>Prix du KG</th>
                        <th>Poids en tonne</th>
                        <th>ID Planteur</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        // Variable de recherche
                        $search = $_POST['search-input'];

                        // Requête SQL avec LIKE
                        $query = "SELECT * FROM PRODUCTION 
                        WHERE ID_PROD LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' 
                        OR DATE_ENREGIS LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' 
                        OR PRIX_KG LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'
                        OR ID_USER LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' 
                        OR POIDS_TONNE LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";

                        // Exécution de la requête
                        $result = mysqli_query($conn, $query);
                        $_SESSION['resultat'] = $result;

                        // Vérification des résultats
                        if ($result) {
                        // Parcourir les résultats
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                    <tr>
                        <th>$row[ID_PROD]</th>
                        <td>$row[DATE_ENREGIS]</td>
                        <td>$row[PRIX_KG]</td>
                        <td>$row[POIDS_TONNE]</td>
                        <td>$row[ID_USER]</td>
                        <td>
                                          <a class='detail' href='modsupPro.php?idpro=$row[ID_PROD]'>Détail</a>
                                          <a href='../Planteurs/PlanPro.php?iduser=$row[ID_USER]' class='planteur'>Planteur</a>
                                        </td>
                    </tr>
                        ";
                        }
                        } else {
                        // Gérer l'erreur de la requête
                        echo "Erreur de requête : " . mysqli_error($conn);
                        }

                        // Fermer la connexion à la base de données
                        mysqli_close($conn);
                    ?>

                </tbody>

                <tfoot>
                        <tr>
                            <td colspan="6">
                                <caption>
                                    <h3>Resul<span>tats</span></h3>
                                </caption>

                            </td>
                        </tr>
                    </tfoot>

            </table>
            <?php
                $result = $_SESSION['resultat'];
                if ($result->num_rows == 0) {
                    echo "0 correspondances pour votre recherche";
                }

                // Libérer la mémoire du résultat
                mysqli_free_result($result);
            ?>

        </div>
    </div>

    

    
</body>
</html>