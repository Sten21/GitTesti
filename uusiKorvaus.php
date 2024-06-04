<?php

require_once('db_config1.php');
if(isset($_POST['addRecord'])){

  
  $vuosi = filter_var($_POST['vuosi'], FILTER_UNSAFE_RAW);
  $korvaus = filter_var($_POST['korvaus'], FILTER_UNSAFE_RAW);
  
  $query = "INSERT INTO kilometrikorvaustiedot (Vuosi, Korvaus)
            VALUES (:Vuosi, :Korvaus)";
  $result = $db_connection->prepare($query);
  $result->execute([
          'Vuosi'           =>  $vuosi,
          'Korvaus'         =>  $korvaus
  ]);
  /*if ($db_connection->prepare($query)){
    echo "success";
  }  else {
    echo "failure";
  }*/

}


?>

<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Add a Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>

  <body>

    <br>
    <div class='container'>
      <form method="post" action="uusiKorvaus.php">
        <div class="form-group row">
          <label for="id" class="col-sm-2 col-form-label">Vuosi</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="vuosi" name="vuosi" value = "">
          </div>
        </div>
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">Korvaus</label>
          <div class="col-sm-10">
            <input type="number" step=".01" class="form-control" id="korvaus" name="korvaus" value = "">
          </div>
        </div>

        <button type="submit" name="addRecord" class="btn btn-success">Lisää uusi tieto</button>
        <input type="reset" value="Tyhjennä" class="btn btn-success">

      </form>
    </div>
    <?php
           /*if(isset($_POST['addRecord'])){
            if ($db_connection->prepare($query)){
                echo "success";
              }  else {
                echo "failure";
            }


        }         */
    ?>
  </body>


  </html>