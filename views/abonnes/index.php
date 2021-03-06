<?php
include "../../models/abonne.class.php";
Idao::connect_db();
$abonnes = Abonne::all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>liste des abonnés</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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
          <div class="text-right">
          <a href="<?=BASE_URL?>abonnes/_form.php" class="btn btn-sm btn-warning my-1">
            Nouveau
            </a>
          </div>
                <h3 class="mt-4 text-center text-primary">Liste des abonnés </h3>
                <table class="table table-striped">
                    <thead class="bg-dark  text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom/Prenom</th>
                            <th scope="col">Cin</th>
                            <th>Profession</th>
                            <th>Paiements</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($abonnes as $a) { ?>
                            <tr>
                                <td scope="col"><?= $a->id ?></td>
                                <td scope="col"><img src="<?= $a->photo ?>" class="img-fluid rounded img-thumbnal" width="150"></td>
                                <td scope="col"><?= $a->nom ?> <?= $a->prenom ?></td>
                                <td scope="col"><?= $a->cin ?></td>
                                <td><?= $a->profession ?></td>
                                <td><?php 
                                $abonne=new Abonne();
                                $abonne->id=$a->id;
                                $p=$abonne->paiements();
                                if(count($p)>0)
                                echo "Doit payer le  ".$p[0]->date_a;
                                else echo "Aucun paiement";
                                
                                ?></td>
                                <td><a onclick="return confirm('supprimer? ')" href="controller.php?action=delete&id=<?= $a->id ?>" class="btn btn-sm btn-danger">S</a>
                                    <a href="_form.php?id=<?= $a->id ?>" class="btn btn-sm btn-warning">M</a>
                                    <a href="show.php?id=<?= $a->id ?>" class="btn btn-sm btn-info">C</a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
    $(document).ready( function () {
    $('.table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
    } );
} );
    </script>
</body>

</html>