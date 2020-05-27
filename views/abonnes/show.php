  <?php
    include("../../models/abonne.class.php");
    Idao::connect_db();
    $id = $_GET['id'];//?id=9
    $abonne = Abonne::find($id);
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
                         <img src="<?= $abonne->photo ?>" class="img-fluid">
                         <br>
                        
                     </div>
                     <div class="col-md-4 text-center">
                        <ul class="text-left list-group">
                        <li class="list-group-item active"> <h3><?= $abonne->nom ?> <?= $abonne->prenom ?></h3></li>
                            <li class="list-group-item">Date de naissance : <?=$abonne->date_naissance?></li>
                            <li class="list-group-item">Profession : <?=$abonne->profession?></li>
                            <li class="list-group-item">Date inscription  : <?=Abonne::date_fr($abonne->created_at)?></li>
                            <li class="list-group-item">Cin  : <?=$abonne->cin?></li>
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