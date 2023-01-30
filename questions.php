<?php
require_once "db_connection.php";
?>

<?php
#script pro vkladani otazek
//declaring the variables
$errors = [];
$otazka =  '';

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
  header('Location:questions.php');
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
  <a href="quest_answ.php" class="btn btn-secondary m-5">Otazky a odpovedi</a>
  <div class="container">
    <h1>Anketni otazky</h1>


    <table class="table">
      <thead>
        <tr>

          <th scope="col">Otazka</th>
          <th scope="col">id</th>
          <th scope="col">action</th>

        </tr>
      </thead>
      <tbody>
        <?php

        if (mysqli_num_rows($result) > 0) {
          // Print the list of questions

          while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <tr>
              <td> <?php echo $row['otazka']; ?> </td>
              <td> <?php echo $row['id_otazka']; ?> </td>
              <td><a href="detail.php?id=
              <?php echo $row['id_otazka']
              ?>
              " class="btn btn-outline-primary">Detail otazky</a></td>
            </tr>
        <?php }
        } else {
          echo "No products found in the database.";
        }
        ?>


      </tbody>
    </table>


    <h2>Vlozeni nove otazky do DB</h2>


    <!-- <form action="" method="get"> -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- enctype="multipart/form-data" This value is necessary if the user will upload a file through the form -->

      <div class="mb-4">
        <label>Text otazky</label>
        <textarea name="otazka" placeholder="Sem vlozte text otazky"></textarea>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Vlozit otazku</button>

    </form>

  </div>

</body>

</html>