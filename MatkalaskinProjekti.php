<!DOCTYPE html>


<?php
require_once('db_config1.php');
$query = "SELECT * FROM kilometrikorvaustiedot";
$results = $db_connection->query($query);
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Matkalaskuri</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    

        <nav class="navbar navbar-expand-sm  bg-primary mb-4">
                    <div class="container-fluid">

                        <span class="navbar-text text-white">Matkalaskuri</span>


                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="uusiKorvaus.php" >Syötä KM korvaus</a>
                            </li>
                        </ul>

                    </div>
        </nav>     




        <div class="container-fluid">

            <form method="POST">

                <div class="row ">
                


                    <div class="col-2"></div>

                    <div class="col-8"> 

                        <label for="fname" class="form-label">Kilometrit matkan alussa</label>
                        <input type="text" class="form-control" placeholder="10200" id="lname" name="matkaAlussa">

                    </div>

                    <div class="col-2"></div>




                    <div class="col-2"></div>

                    <div class="col-8"> 

                        <label for="fname" class="form-label">Kilometrit matkan lopussa</label>
                        <input type="text" class="form-control" placeholder="10800" id="lname" name="matkaLopussa">

                    </div>

                    <div class="col-2"></div>





                    <div class="col-2"></div>

                    <div class="col-8"> 

                        <label for="fname" class="form-label">Matka alkoi (tunnit : minuutit)</label>
                        <input type="text" class="form-control" placeholder="8:00" id="fname" name="matkaAikaAlussa">

                    </div>

                    <div class="col-2"></div>




                    <div class="col-2"></div>

                    <div class="col-8"> 

                        <label for="fname" class="form-label">Matka päättyi (tunnit : minuutit)</label>
                        <input type="text" class="form-control" placeholder="15:30" id="lname" name="matkaAikaLopussa">

                    </div>

                    <div class="col-2"></div>

                    
                       

                   

                    <div class="col-2"></div>

                    <div class="col-8"> 

                        <label for="korvausVuosi" class="form-label">Kilometrikorvauksen perustevuosi:</label>
                        <select name="vuosiKorvaus" class="form-select" id="cars">
                            
                            <?php
                                
                                $stmt = $db_connection->query('SELECT * FROM kilometrikorvaustiedot ');
                                
                                foreach ($stmt as $row)
                                {
                                    
                                    echo "<option value='" . $row['Korvaus'] . "'>" . $row['Vuosi'] . "</option>";
                                }
                            ?>                                                                                                                                                                                                                                                              
       
                        
                        </select>

                    </div>

                    <div class="col-2"></div>
                    
    
                    <div class="d-flex justify-content-center  mt-3 mb-3">

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>

                </div>

            </form>    
                

                <div class="d-flex justify-content-left bg-primary text-white" >


                <div>
                    
                   

                    

                </div>            
                  


            </div>



        </div>
        
        
        

    <?php




        if(isset($_POST['matkaAlussa'])){

            $number1 = $_POST['matkaAlussa'];
            $number1 = intval($number1); 


        }

        if(isset($_POST['matkaLopussa'])){

            $number2 = $_POST['matkaLopussa'];
            $number2 = intval($number2); 


        }

        if(isset($_POST['matkaAikaAlussa'])){

            $number3 = $_POST['matkaAikaAlussa'];
           

        }

        if(isset($_POST['matkaAikaLopussa'])){

            $number4 = $_POST['matkaAikaLopussa'];
            

        }

        if(isset($_POST['vuosiKorvaus'])){

            $number5 = $_POST['vuosiKorvaus'];
            $number5 = floatval($number5); 


        }


        
       if(isset($_POST['matkaAikaAlussa'])){
            
            $delimiter = ":";
            $splitStrings = explode($delimiter, $number3);
    
            $alkuAika1 = $splitStrings[0];
            $alkuAika2 = $splitStrings[1];
    
            
            $splitStrings = explode($delimiter, $number4);
    
            $loppuAika1 = $splitStrings[0];
            $loppuAika2 = $splitStrings[1];
    
    
            $kilometrit = $number2 - $number1;
            $kilometriKorvaus = $kilometrit * $number5;

            $loppuAika1 = intval($loppuAika1);
            $alkuAika2 = intval( $alkuAika2);

            $alkuAika1 = intval( $alkuAika1);
            $loppuAika2 = intval($loppuAika2);

            $alkuAikaVastaus = $alkuAika1 * 60 + $alkuAika2;
            $loppuAikaVastaus = $loppuAika1 * 60 + $loppuAika2;
    
            
            $aikaYh =  $loppuAikaVastaus - $alkuAikaVastaus;
            
            $matkanKesto = $aikaYh / 60;
            $matkanKesto = floatval($matkanKesto);

            
            $tunnit = floor($matkanKesto);
            $minuutit = round(($matkanKesto -  $tunnit) * 60);
            $MatkanKestoLopussa = sprintf("%2d:%02d", $tunnit, $minuutit);
            

                       
            $matkaKorvaus = $kilometriKorvaus;

            $paivaRaha = 0;
           if ($aikaYh > 4){
                $paivaRaha = 12;
                $matkaKorvaus += $paivaRaha;


            } else {
                $paivaRaha = 4.5;
                $matkaKorvaus += $paivaRaha;    


            }

           
        }
       

        include_once("db_config1.php");
        $stmt = $db_connection->query('SELECT Korvaus FROM kilometrikorvaustiedot LIMIT 1');
        $result = $stmt->fetch();
        $korvaus = $result['Korvaus'];

       
        
        
        
           

    ?>  




        <div class="container-fluid">


            <div class="d-flex justify-content-left bg-primary text-white" >


                <div>
                    
                
                <?php        
                if(isset($_POST['matkaAlussa'])){ 
                    ?>     
                <h2>Matkakulukorvaus</h2><br>
                <?php echo "Matkan kilometrit: ". $kilometrit. " ja kilometrikorvaus ". $number5. " € = ". $kilometriKorvaus. " €" ;?>
                
                <h3>Kilometrikorvaus</h3><br>
                <?php echo "Matkan kesto ". $MatkanKestoLopussa. " tuntia.". " Päiväraha on ". $paivaRaha. " €";?>
                
                <h3>Yhteensä</h3>
                <?php echo $kilometriKorvaus. " + ". $paivaRaha. " = ". $matkaKorvaus. " €";?>
                <?php
                }
                ?>
                    

                </div> 



        
    

            

                

            </div>
       
        </div>    
    </body>
</html>