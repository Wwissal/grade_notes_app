<?php
include "db_conn.php";

// Vérifiez si des données de notes ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["student_id"]) && isset($_POST["grades"])) {
    $student_id = $_POST["student_id"];
    $grades = $_POST["grades"];

    // Parcourez les données de notes pour chaque matière
    foreach ($grades as $matiere_id => $note) {
        // Assurez-vous que la note est valide (entre 0 et 20 par exemple)
        if ($note >= 0 && $note <= 20) {
            // Insérez ou mettez à jour la note dans la table des notes
            $sql = "REPLACE INTO notes (id_etudiant, id_matiere, note) VALUES ($student_id, $matiere_id, $note)";
            mysqli_query($conn, $sql);
        }
    }

    // Redirigez l'utilisateur vers la page de consultation des étudiants avec un message de succès
    header("Location: index.php?msg=Notes attribuées avec succès");
    exit();
} else {
    // Redirigez l'utilisateur vers la page d'accueil si les données sont incorrectes ou manquantes
    header("Location: index.php");
    exit();
}
?>
