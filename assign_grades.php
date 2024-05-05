<?php
include "db_conn.php";

// Vérifiez si l'ID de l'étudiant est passé en paramètre
if (isset($_GET["id"])) {
    $student_id = $_GET["id"];

    // Récupérez les informations de l'étudiant
    $student_sql = "SELECT * FROM crud WHERE id = $student_id";
    $student_result = mysqli_query($conn, $student_sql);
    $student = mysqli_fetch_assoc($student_result);

    // Récupérez les matières pour la filière de l'étudiant
    $filiere_id = $student["id_filiere"];
    $matieres_sql = "SELECT * FROM matieres WHERE id_filiere = $filiere_id";
    $matieres_result = mysqli_query($conn, $matieres_sql);
} else {
    // Rediriger si l'ID de l'étudiant n'est pas passé
    header("Location: index.php");
    exit();
}
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

    <title>Assign Grades - <?php echo $student['first_name'] . ' ' . $student['last_name']; ?></title>
</head>

<body>

<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        Grade Management Application
    </nav>


    <div class="container">


    <div class="text-center mb-4">
            <h3>Assign Grades</h3>
        </div>


    <h1><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></h1>


    <div class="container d-flex justify-content-center">
    <form action="process_grades.php" method="POST" style="width:50vw; min-width:300px;">

        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($matieres_result)) : ?>
                    <tr>
                        <td><?php echo $row['nom']; ?></td>
                        <td><input type="number" name="grades[<?php echo $row['id']; ?>]" min="0" max="20"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Save Grades</button>
    </form>
                </div>
                </div>
            
</body>

</html>