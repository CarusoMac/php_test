<?php

require_once "db_connection.php";

#getting the question id
if (isset($_GET['id'])) {

  $id = htmlspecialchars($_GET['id']) ?? null;
  #script pro vypis otazky
} else {
  $id = (int)(htmlspecialchars($_POST['questId']));
}

$query = "SELECT * FROM otazky where id_otazka = $id";
$result = mysqli_query($conn, $query);

# default k formulari
$errors = [];
$odpoved =  '';

#script pro vypis seznamu odpovedi
$query_odpovedi = "SELECT * FROM odpovedi where id_otazka = $id";
$seznam_odpovedi = mysqli_query($conn, $query_odpovedi);

#script pro vkladani odpovedi
if (isset($_POST['odpoved'])) {
  $odpoved =  addslashes($_POST['odpoved']);
  if (!$odpoved) {
    $errors[] = 'Nevlozili jste zadnou odpoved';
  };

  if (empty($errors)) {
    $sql = "INSERT INTO odpovedi (odpoved, id_otazka, pocet_hlasu) 
                          VALUES('$odpoved', '$id', '0')";

    if (mysqli_query($conn, $sql)) {
      echo "odpoved byla uspesne vlozena do DB";
      header("Location:detail.php?id=$id");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}


?>
<!-- *********************************************************************************************** -->
<!-- -------------------------------------------HTML------------------------------------------------ -->
<!-- *********************************************************************************************** -->

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
  <a href="questions.php" class="btn btn-secondary m-5">Anketní otázky = admin</a>
  <a href="quest_answ.php" class="btn btn-secondary m-5">Anketa = user</a>

  <div class="container">

    <!-- print otazky -->
    <h1 class="mb-4">Otazka</h1>
    <table class="table mb-5">
      <tbody>

        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
              <td> <?php echo $row['otazka']; ?> </td>
              <td> <?php echo $row['id_otazka']; ?> </td>
            </tr>

        <?php }
        } else {
          echo "Otazka nenalezena";
        }
        ?>

      </tbody>
    </table>

    <!-- print odpovedi z DB -->

    <h2 class="mb-4">Stavajici odpovedi</h2>
    <table class="table mb-5">
      <tbody>

        <?php
        if (mysqli_num_rows($seznam_odpovedi) > 0) {
          while ($row = mysqli_fetch_assoc($seznam_odpovedi)) {
        ?>
            <tr>
              <td> <?php echo $row['odpoved']; ?> </td>
            </tr>

        <?php }
        } else {
          echo "Zatim bez odpovedi";
        }
        ?>

      </tbody>
    </table>

    <!-- formular -->

    <h2>Vlozeni nove odpovedi</h2>

    <form action="detail.php" method="post">

      <div class="mb-4">
        <textarea name="odpoved" placeholder="Sem vlozte odpoved" rows="4" cols="50"></textarea>
      </div>
      <input type="hidden" name="questId" value=<?php echo "$id" ?>>
      <input type="submit" name="odpoved_sub" class="btn btn-success" value="Vlozit odpoved">

    </form>

  </div>

</body>

</html>