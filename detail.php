<?php

require_once "db_connection.php";

#getting the id
$id = htmlspecialchars($_GET['id']) ?? null;

#script pro vypis otazky
//declaring the variables

$query = "SELECT * FROM otazky where id_otazka = $id";

$result = mysqli_query($conn, $query);

#script pro vkladani odpovedi
$errors = [];
$odpoved =  '';

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['submit']))) {
  $odpoved =  addslashes($_POST['odpoved']);

  if (!$odpoved) {
    $errors[] = 'Zadani odpovedi je povinna polozka';
  };


  if (empty($errors)) {
    $sql = "INSERT INTO odpovedi (id_otazka, odpoved) 
    VALUES('$id', '$odpoved')";

    if (mysqli_query($conn, $sql)) {
      echo "Odpoved byla uspesne vlozena do DB";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
}

#script pro vypis odpovedi

#script pro vypis seznamu otazek
//declaring the variables

$query_odpovedi = "SELECT * FROM odpovedi where id_otazka = $id";
$seznam_odpovedi = mysqli_query($conn, $query_odpovedi);

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
  <a href="questions.php" class="btn btn-secondary m-5">Zpet na vypis</a>
  <div class="container">

    <h1 class="mb-4">Otazka</h1>


    <table class="table mb-5">


      <tbody>
        <?php

        if (mysqli_num_rows($result) > 0) {
          // Print the list of questions

          while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <tr>
              <td> <?php echo $row['otazka']; ?> </td>
              <td> <?php echo $row['id_otazka']; ?> </td>

            </tr>
        <?php }
        } else {
          echo "V databazi nebyla zadana zadna otazka";
        }
        ?>


      </tbody>
    </table>
    <h2 class="mb-4">Stavajici odpovedi</h2>


    <table class="table mb-5">

      <tbody>
        <?php

        if (mysqli_num_rows($seznam_odpovedi) > 0) {
          // Print the list of questions

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

    <h2>Vlozeni nove odpovedi</h2>


    <form action="" method="post">


      <div class="mb-4">
        <textarea name="odpoved" placeholder="Sem vlozte odpoved"></textarea>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Vlozit odpoved</button>

    </form>


  </div>

</body>

</html>