<?php
require_once "db_connection.php";

$errors = [];
$otazka =  '';

#Hlasovani
if (isset($_GET['id'])) {
  $id_hlasovani = addslashes($_GET['id']);
  $query_hlasovani = "UPDATE odpovedi SET pocet_hlasu = pocet_hlasu + 1 WHERE id_odpoved = $id_hlasovani";
  $result_hlasovani = mysqli_query($conn, $query_hlasovani);
  header('Location:quest_answ.php');
}

?>

<?php
#script pro vypis seznamu otazek
$query = "SELECT * FROM otazky";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anketa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <a href="questions.php" class="btn btn-secondary m-5">Anketní otázky = admin</a>
  <div class="container">
    <h1 class="mb-5">Anketa</h1>


    <table class="table">


      <?php

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

      ?>

          <thead>
            <tr>
              <th scope="col"><?php echo $row['otazka']; ?></th>
              <th scope="col">Pocet hlasu</th>
            </tr>
          </thead>

          <tbody>
            <!-- odpovedi k dane otazce -->
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
            <!-- konec vnorene smycky -->

          </tbody>
      <?php }
      } else {
        echo "Zaznam byl smazan";
      }
      ?>

    </table>
  </div>
</body>

</html>