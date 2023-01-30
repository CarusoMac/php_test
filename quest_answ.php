<?php
require_once "db_connection.php";
?>

<?php
#script pro vkladani otazek
//declaring the variables
$errors = [];
$otazka =  '';


#Hlasovani
if (isset($_GET['id'])) {
  $id_hlasovani = htmlspecialchars($_GET['id']);
  $query_hlasovani = "UPDATE odpovedi SET pocet_hlasu = pocet_hlasu + 1 WHERE id_odpoved = $id_hlasovani";
  $result_hlasovani = mysqli_query($conn, $query_hlasovani);
  header('Location:quest_answ.php');
}


if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit']))) {
  $otazka =  addslashes($_POST['otazka']);

  if (!$otazka) {
    $errors[] = 'Zadani otazky je povinna polozka';
  };


  if (empty($errors)) {
    $sql = "INSERT INTO otazky (otazka) 
    VALUES('$otazka')";

    if (mysqli_query($conn, $sql)) {
      echo "Otazka byla uspesne vlozena do DB";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}


?>

<?php
#script pro vypis seznamu otazek
//declaring the variables

$query = "SELECT * FROM otazky";
$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pridavani</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <a href="questions.php" class="btn btn-secondary m-5">Otázky</a>
  <div class="container">
    <h1 class="mb-5">Anketa</h1>


    <table class="table">


      <?php

      if (mysqli_num_rows($result) > 0) {
        // Print the list of questions

        while ($row = mysqli_fetch_assoc($result)) {

      ?>

          <thead>
            <tr>

              <th scope="col"><?php echo $row['otazka']; ?></th>
              <th scope="col">Pocet hlasu</th>

            </tr>
          </thead>
          <tbody>



            <!-- start -->
            <?php
            $id_otazka = $row['id_otazka'];
            $query2 = "SELECT * FROM odpovedi WHERE id_otazka = $id_otazka";
            $result2 = mysqli_query($conn, $query2);
            while ($row2 = mysqli_fetch_assoc($result2)) { ?>
              <tr>
                <td><?php echo $row2['odpoved']; ?></td>
                <td><a href="quest_answ.php?id=
              <?php echo $row2['id_odpoved']
              ?>
              " class="btn btn-outline-primary"><?php echo $row2['pocet_hlasu']; ?></a></td>
              </tr>
            <?php }
            ?>
            <!-- konec -->

          </tbody>


      <?php }
      } else {
        echo "No products found in the database.";
      }
      ?>



    </table>



  </div>

</body>

</html>