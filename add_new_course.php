<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
    // Vérifiez si le champ de nom de matière est vide
    if (!empty($_POST['subject_name'])) {
        $subject_name = $_POST['subject_name'];
        
        // Vérifiez si une filière a été sélectionnée
        if (isset($_POST['filiere']) && !empty($_POST['filiere'])) {
            $filiere_id = $_POST['filiere'];
            
            // Insérez la nouvelle matière dans la base de données avec l'ID de la filière
            $sql = "INSERT INTO matieres (`nom`, `id_filiere`) VALUES ('$subject_name', '$filiere_id')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: courses.php?msg=New record created successfully");
                exit(); // Assurez-vous de sortir du script après la redirection
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        } else {
            echo "Veuillez sélectionner une filière.";
        }
    } else {
        echo "Veuillez saisir un nom de matière.";
    }
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

   <title>Grade Application</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Grade Management Application
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Course</h3>
         <p class="text-muted">Complete the form below to add a new Course</p>
      </div>
      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
               <label class="form-label">Course Name</label>
                <input type="text" class="form-control" name="subject_name" placeholder="Subject Name">
               </div>

               <div class="mb-3">
    <label class="form-label">Field:</label>
    <select class="form-select" name="filiere">
        <option value="">Choice a Field</option>
        <!-- Code PHP pour récupérer la liste des filières depuis la base de données -->
        <?php
        $filiere_sql = "SELECT * FROM filieres";
        $filiere_result = mysqli_query($conn, $filiere_sql);
        while ($filiere = mysqli_fetch_assoc($filiere_result)) {
            echo '<option value="' . $filiere["id"] . '">' . $filiere["nom"] . '</option>';
        }
        ?>
    </select>
</div>


               
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="courses.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>