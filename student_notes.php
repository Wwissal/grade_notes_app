<?php
include "db_conn.php";

// Récupérer l'ID de l'étudiant depuis l'URL
$student_id = $_GET["id"];

// Récupérer les informations de l'étudiant
$sql_student = "SELECT * FROM crud WHERE id = $student_id";
$result_student = mysqli_query($conn, $sql_student);
$student = mysqli_fetch_assoc($result_student);

// Récupérer les notes de l'étudiant
$sql_notes = "SELECT matieres.nom AS matiere, notes.note FROM notes JOIN matieres ON notes.id_matiere = matieres.id WHERE id_etudiant = $student_id";
$result_notes = mysqli_query($conn, $sql_notes);

// Calculer la note globale
$total_notes = 0;
$total_matieres = 0;

while ($row = mysqli_fetch_assoc($result_notes)) {
    $total_notes += $row['note'];
    $total_matieres++;
}

$average_note = $total_notes / $total_matieres;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $student['first_name'] . ' ' . $student['last_name']; ?>Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Grade Management Application
   </nav>
    <h1><?php echo $student['first_name'] . ' ' . $student['last_name']; ?>Grade</h1>
    <h2>Global Grade: <?php echo number_format($average_note, 2); ?></h2>
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Réinitialiser le pointeur de résultat pour répéter la boucle et afficher les notes
            mysqli_data_seek($result_notes, 0);
            while ($row = mysqli_fetch_assoc($result_notes)) : ?>
                <tr>
                    <td><?php echo $row['matiere']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h2>Result: <?php echo ($average_note >= 10) ? "Admis" : "Non admis"; ?></h2>
</body>

</html>
