  <?php
    include("../../models/paiement.class.php");
    Idao::connect_db();
    $id = $_GET['id'];//?id=9
    $paiement = Paiement::find($id);
    $paie=new Paiement($paiement->user_id,$paiement->abonne_id);
    $abonne=$paie->abonne();   
    $user=$paie->user();   
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>consultation</title>
     <!-- Bootstrap core CSS -->
     <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom styles for this template -->
     <link href="../css/simple-sidebar.css" rel="stylesheet" />
 </head>

 <body>
     <div class="d-flex" id="wrapper">
         <!-- Sidebar -->
         <?php include "../_sidebar.php"; ?>
         <!-- /#sidebar-wrapper -->

         <!-- Page Content -->
         <div id="page-content-wrapper">
             <?php include "../_menu.php"; ?>

             <div class="container-fluid">
                 <div class="row mt-5">
                     <div class="col-md-4 text-center">
                         <img src="../abonnes/<?= $abonne->photo?>" class="img-fluid">
                         <br>
                         <h5 class="text-center text-primary"><?=$abonne->nom?> <?=$abonne->prenom?></h5>
                        
                     </div>
                     <div class="col-md-4 text-center">
                        <ul class="text-left list-group">
                        <li class="list-group-item active"> <h6>DETAILS </h6></li>
                        <li class="list-group-item ">Date de :<?=$paiement->date_de?>  </li>
                        <li class="list-group-item ">Date a : <?=$paiement->date_a?> </li>
                        <li class="list-group-item ">Tarif :  <?=$paiement->tarif_mois?>DHS</li>
                        <li class="list-group-item ">Remise  :  <?=$paiement->remise?>%</li>
                        <li class="list-group-item ">Montant  :  <?=$paiement->montant?>DHS</li>
                          
                        </ul>
                     </div>

                 </div>

             </div>
         </div>
         <!-- /#page-content-wrapper -->
     </div>
     <!-- /#wrapper -->

     <!-- Bootstrap core JavaScript -->
     <script src="../vendor/jquery/jquery.min.js"></script>
     <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

     <!-- Menu Toggle Script -->
     <script>
         $("#menu-toggle").click(function(e) {
             e.preventDefault();
             $("#wrapper").toggleClass("toggled");
         });
     </script>
 </body>

 </html>