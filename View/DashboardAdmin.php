<?php
$titre = 'warProg - Apprendre en Ligne';
$CSS = 'Style/Acceuil.css'; // Assurez-vous que ce chemin est correct
$lienQcm = 'View/Qcm.php';
$lienCntct = 'View/Contact.php';
session_start();

require_once('../Controller/ControlleurCours.php');
$conn = new ControlleurCours();
if (isset($_GET['id_cours'])) {
    $videos = $conn->getVideos($_GET['id_cours']);
}

if (isset($_GET['id_cours_pdf'])) {
    $pdfs = $conn->getPdfs($_GET['id_cours_pdf']);
}


function getV($id)
{
    $conn = new ControlleurCours();
    $videos = $conn->getVideos($id);
}

ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../Style/DashboardAdmin.css">
    <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">

    <title><?php echo $titre; ?></title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="../Media/file (3).png">
                    <h2>war<span class="danger">Prog</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#" class="active" id="dashboard">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Tableau de bord</h3>
                </a>
                <a href="DashboardAdminE.php" id="users">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Étudiants</h3>
                </a>
                <a href="DashboardAdminC.php" id="cours">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Cours</h3>
                </a>
                <!-- <a href="#" class="active" id="dashboard">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a> -->
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Tickets</h3>
                    <span class="message-count">27</span>
                </a> -->
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Sale List</h3>
                </a> -->
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Reports</h3>
                </a> -->
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a> -->
                <a href="DashboardAdminQ.php" id="qcm">
                    <span class="material-icons-sharp">
                        quiz
                    </span>
                    <h3>Qcm</h3>
                </a>
                <a href="#" id="dcnx">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Déconnexion</h3>
                </a>
            </div>
        </aside>
        <?php
        echo "<script>";
        echo "let dcnx = document.getElementById('dcnx');";
        echo "dcnx.addEventListener('click', () => {
                    document.location.href = '../index.php?action=deconnexion';
                });";
        echo "</script>";
        ?>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Analytique</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Nombre d'étudiants</h3>
                            <h1><?php
                                echo count($_SESSION['users']);
                                ?>
                            </h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+7%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Nombre de cours</h3>
                            <h1><?php
                                echo count($_SESSION['cours']);
                                ?></h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>-48%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Nombre de Qcm</h3>
                            <h1><?php
                                echo count($_SESSION['qcm']);
                                ?></h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users user3">
                <h2>Derniers étudiants inscrits</h2>
                <div class="user-list ">
                    <?php
                    // Inclure le contrôleur pour récupérer les utilisateurs

                    // Affichage des utilisateurs
                    if (isset($_SESSION['users'])) {
                        // Affichage des utilisateurs à partir de la session
                        for ($i = 0; $i <= 2; $i++) {
                            $user = $_SESSION['users'][$i];
                            echo '<div class="user">';
                            echo "<a href='User.php?id={$user["id"]}' >";
                            echo "<img src='../{$user['photo']}' / >";
                            echo '</a>';
                            echo "<h2>" . $user['prenom'] . "</h2>";
                            echo '</div>';
                        }
                    } else {
                        echo "<tr><td colspan='3'>Aucun étudiant trouvé.</td></tr>";
                    }
                    ?>
                    <div class="user">
                        <img src="../Media/plus.png" onclick="ajoutUser()">
                        <h2>Plus</h2>
                        <p>Nouveau étudiant</p>
                    </div>
                </div>
            </div>

            <div class="new-users user18" hidden>
                <h2>Étudiants</h2>
                <div class="user-list">
                    <?php
                    // Inclure le contrôleur pour récupérer les utilisateurs

                    // Affichage des utilisateurs
                    if (isset($_SESSION['users'])) {
                        // Affichage des utilisateurs à partir de la session
                        foreach ($_SESSION['users'] as $user) {
                            echo '<div class="user">';
                            echo "<a href='User.php?id={$user["id"]}' >";
                            echo "<img src='../{$user['photo']}' / >";
                            echo '</a>';
                            echo "<h2>" . $user['prenom'] . "</h2>";
                            echo '</div>';
                        }
                    } else {
                        echo "<tr><td colspan='3'>Aucun étudiant trouvé.</td></tr>";
                    }
                    ?>
                    <div class="user">
                        <img src="../Media/plus.png" onclick="ajoutUser()">
                        <h2>More</h2>
                        <p>New User</p>
                    </div>
                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class=" recent-orders cours4">
                <h2>Cours Recents</h2>
                <table>
                    <thead>
                        <tr>
                            <!-- <th class="hide-on-small">Nombre</th> -->
                            <th>Nom</th>
                            <th class="hide-on-small">Catégorie</th>
                            <th>Prix</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($_SESSION['cours'])) {
                            // Affichage des utilisateurs à partir de la session
                            for ($i = 0; $i <= 2 && $i < count($_SESSION['cours']); $i++) {
                                $cour = $_SESSION['cours'][$i];
                                echo "<tr>";
                                // echo "<td class='hide-on-small'>" . $cour['id'] . "</td>";
                                echo "<td>" . $cour['titre'] . "</td>";
                                echo "<td class='hide-on-small'>" . $cour['categorie'] . "</td>";
                                echo "<td>" . $cour['prix'] . "€</td>";
                                echo "<td><a href='DashboardAdmin.php?id_cours=" . $cour['id'] . "' >
                                <span class='material-icons-sharp'>
                                    videocam
                                </span>
                            </a></td>";
                                echo "<td><a href='DashboardAdmin.php?id_cours_pdf=" . $cour['id'] . "'>
                                <span class='material-icons-sharp'>
                                    picture_as_pdf
                                </span>
                            </a></td>";
                                echo "<td><a href='CoursEdit.php?id={$cour["id"]}' >
                                <span class='material-icons-sharp'>
                                    edit
                                </span>
                            </a></td>";
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun cours trouvé.</td></tr>";
                        }
                        ?>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="Cours.php">Ajoutez un cours</a>
            </div>
            <div class="recent-orders coursAll" hidden>
                <h2>Cours</h2>
                <table>
                    <thead>
                        <tr>
                            <!-- <th class="hide-on-small">Nombre</th> -->
                            <th>Nom</th>
                            <th class="hide-on-small">Catégorie</th>
                            <th>Prix</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($_SESSION['cours'])) {
                            // Affichage des utilisateurs à partir de la session
                            foreach ($_SESSION['cours'] as $cour) {
                                echo "<tr >";
                                // echo "<td class='hide-on-small'>" . $cour['id'] . "</td>";
                                echo "<td>" . $cour['titre'] . "</td>";
                                echo "<td class='hide-on-small'>" . $cour['categorie'] . "</td>";
                                echo "<td>" . $cour['prix'] . "€</td>";
                                //     echo "<td ><a href='DashboardAdmin.php?id_cours=" . $cour['id'] . "' >
                                //     <span class='material-icons-sharp'>
                                //         videocam
                                //     </span>
                                // </a></td>";
                                echo "<td><a onclick=\"onVideoClickAll({$cour['id']})\">
                                <span class='material-icons-sharp'>
                                    videocam
                                </span>
                            </a></td>";
                                echo "<td><a href='DashboardAdmin.php?id_cours_pdf=" . $cour['id'] . "'>
                                <span class='material-icons-sharp'>
                                    picture_as_pdf
                                </span>
                            </a></td>";
                                echo "<td><a href='CoursEdit.php?id={$cour["id"]}' >
                                <span class='material-icons-sharp'>
                                    edit
                                </span>
                            </a></td>";
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun cours trouvé.</td></tr>";
                        }
                        ?>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="Cours.php">Ajoutez un cours</a>
            </div>
            <!-- End of Recent Orders -->
            <div class="recent-qcm qcm4">
                <h2>Qcm Recents</h2>
                <table>
                    <thead>
                        <tr>
                            <th class="hide-on-small">Nombre</th>
                            <th>Titre</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($_SESSION['qcm']) && !empty($_SESSION['qcm'])) {
                            // Affichage des utilisateurs à partir de la session
                            for ($i = 0; $i <= 2; $i++) {
                                $qcm = $_SESSION['qcm'][$i];
                                echo '<tr>';
                                echo "<td class='hide-on-small'>" . $qcm['id'] . "</td>";
                                echo "<td>" . $qcm['titre'] . "</td>";
                                // echo "<td class='hide-on-small'>" . $cour['categorie'] . "</td>";
                                // echo "<td>" . $cour['prix'] . "€</td>";
                                echo "<td><a href='../" . $qcm['path'] . "' >
                                <span class='material-icons-sharp'>
                                    visibility
                                </span>
                            </a></td>";
                                echo "<td><a href='editQcm.php?id={$qcm["id"]}' >
                                <span class='material-icons-sharp'>
                                    edit
                                </span>
                            </a></td>";
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun qcm trouvé.</td></tr>";
                        }
                        ?>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="ajoutQcm.php">Ajoutez un qcm</a>
            </div>
            <div class="recent-qcm qcmAll" hidden>
                <h2>Qcm</h2>
                <table>
                    <thead>
                        <tr>
                            <th class="hide-on-small">Nombre</th>
                            <th>Titre</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($_SESSION['qcm']) && !empty($_SESSION['qcm'])) {
                            // Affichage des utilisateurs à partir de la session
                            foreach ($_SESSION['qcm'] as $qcm) {
                                // $qcm = $_SESSION['qcm'][$i];
                                echo '<tr>';
                                echo "<td class='hide-on-small'>" . $qcm['id'] . "</td>";
                                echo "<td>" . $qcm['titre'] . "</td>";
                                // echo "<td class='hide-on-small'>" . $cour['categorie'] . "</td>";
                                // echo "<td>" . $cour['prix'] . "€</td>";
                                echo "<td><a href='../" . $qcm['path'] . "' >
                                <span class='material-icons-sharp'>
                                    visibility
                                </span>
                            </a></td>";
                                echo "<td><a href='editQcm.php?id={$qcm["id"]}' >
                                <span class='material-icons-sharp'>
                                    edit
                                </span>
                            </a></td>";
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun qcm trouvé.</td></tr>";
                        }
                        ?>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="ajoutQcm.php">Ajoutez un qcm</a>
            </div>

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp ">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php
                                    echo "" . $_SESSION['prenom'] . "";
                                    ?>
                            </b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="../<?php echo $_SESSION['photo'] ?>">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->


            <?php
            if (isset($_GET['id_cours'])) {
            ?>
                <div class=" user-profile">
                    <div class="logo">
                        <!-- <img src="../Media/file (3).png"> -->
                        <video src="../<?php echo $videos[0]['path'] ?>" id="video" type="video/mp4" controls onpause=""></video>
                        <h2 id="vidTitle"></h2>
                    </div>
                </div>

                <div class="reminders">
                    <div class="header">
                        <h2>Vidéos</h2>
                        <span class="material-icons-sharp">
                            videocam
                        </span>
                    </div>
                    <?php
                    foreach ($videos as $video) {
                    ?>
                        <div class="notification" onclick="changeVideo('../<?php echo $video['path'] ?>','<?php echo $video['titre'] ?>' ,this)">
                            <div class="icon">
                                <span class="material-icons-sharp">
                                    play_circle
                                </span>
                            </div>
                            <div class="content">
                                <div class="info">
                                    <h3><?php echo $video['titre'] ?></h3>
                                    <!-- <small class="text_muted">
                                        08:00 AM - 12:00 PM
                                    </small> -->
                                </div>
                                <span class="material-icons-sharp" onclick="modifVideo(<?php echo $video['id'] ?>)">
                                    edit
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="notification add-reminder" onclick="ajoutVideo(<?php echo $_GET['id_cours'] ?>)">
                        <div>
                            <span class="material-icons-sharp">
                                add
                            </span>
                            <h3>Ajoutez une vidéo</h3>
                        </div>
                    </div>

                </div>
            <?php

            } elseif (isset($_GET['id_cours_pdf'])) {

            ?>
                <div class=" user-profile">
                    <div class="logo">
                        <img src="../Media/file (3).png">
                        <h2>warProg</h2>
                        <p>Fullstack Web Developers</p>
                    </div>
                </div>
                <div class="reminders">

                    <div class="header">
                        <h2>PDF</h2>
                        <span class="material-icons-sharp">
                            picture_as_pdf
                        </span>
                    </div>
                    <?php
                    foreach ($pdfs as $key => $pdf) {
                    ?>
                        <div class="notification " onclick="afficherPdf('<?php echo $pdf['path'] ?>')">
                            <!-- <div class="icon">
                                <span class="material-symbols-outlined">
                                    draft
                                </span>
                            </div> -->
                            <div class="content">
                                <div class="info">
                                    <h3><?php echo $pdf['titre'] ?></h3>
                                    <!-- <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small> -->
                                </div>
                                <span class="material-icons-sharp" onclick="modifPdf(<?php echo $pdf['id'] ?>)">
                                    edit
                                </span>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- <div class=" notification deactive">
                                    <div class="icon">
                                        <span class="material-icons-sharp">
                                            edit
                                        </span>
                                    </div>
                                    <div class="content">
                                        <div class="info">
                                            <h3>Workshop</h3>
                                            <small class="text_muted">
                                                08:00 AM - 12:00 PM
                                            </small>
                                        </div>
                                        <span class="material-icons-sharp">
                                            more_vert
                                        </span>
                                    </div>
                            </div> -->

                    <div class="notification add-reminder" onclick="ajoutPdf(<?php echo $_GET['id_cours_pdf'] ?>)">
                        <div>
                            <span class="material-icons-sharp">
                                add
                            </span>
                            <h3>Ajouter un PDF</h3>
                        </div>
                    </div>

                </div>
            <?php
            } else {
            ?>


                <div class=" user-profile">
                    <div class="logo">
                        <img src="../Media/file (3).png">
                        <h2>warProg</h2>
                        <p>Fullstack Web Developers</p>
                    </div>
                </div>

                <!-- <div class="reminders">
                    <div class="header">
                        <h2>Reminders</h2>
                        <span class="material-icons-sharp">
                            notifications_none
                        </span>
                    </div>

                    <div class="notification ">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                volume_up
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Workshop</h3>
                                <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span class="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>

                    <div class="notification deactive">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                edit
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Workshop</h3>
                                <small class="text_muted">
                                    08:00 AM - 12:00 PM
                                </small>
                            </div>
                            <span class="material-icons-sharp">
                                more_vert
                            </span>
                        </div>
                    </div>

                    <div class="notification add-reminder">
                        <div>
                            <span class="material-icons-sharp">
                                add
                            </span>
                            <h3>Add Reminder</h3>
                        </div>
                    </div>

                </div> -->
            <?php  } ?>
        </div>


    </div>
    <script src="../Assets/js/index.js"></script>
    <script src="../Assets/js/orders.js"></script>
</body>

</html>
<?php
$contenu = ob_get_clean();
echo $contenu;
?>