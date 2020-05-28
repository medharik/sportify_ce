<?php
include "../../models/paiement.class.php";
Idao::connect_db();
$paiements = Paiement::all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>liste des paiements</title>
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
          <a href="<?=BASE_URL?>paiements/_form.php" class="btn btn-sm btn-warning my-1">
            Nouveau
            </a>
          </div>
                <h3 class="mt-4 text-center text-primary">Liste des paiements </h3>
                <table class="table table-striped">
                    <thead class="bg-dark  text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Abonne id</th>
                            <th scope="col">Date de </th>
                            <th>Date a </th>
                            <th>Tarif </th>
                            <th>Remise</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paiements as $p) { 
                            
                            $paie=new Paiement();
                            $paie->user_id=$p->user_id;
                            $paie->abonne_id=$p->abonne_id;
                            
                            ?>
                            <tr>
                                <td scope="col"><?= $p->id ?></td>
                                <td scope="col">
                                <?= $paie->user()->login; ?>
                                
                             </td>
                                <td scope="col">
                                <?= $paie->abonne()->nom; ?>  <?= $paie->abonne()->prenom; ?></td>
                                <td><?= $p->date_de ?></td>
                                <td><?= $p->date_a ?></td>
                                <td><?= $p->tarif_mois ?></td>
                                <td><?= $p->remise ?></td>
                                <td><?= $p->tarif_mois*2 ?></td>
                                <td><a onclick="return confirm('supprimer? ')" href="controller.php?action=delete&id=<?= $p->id ?>" class="btn btn-sm btn-danger">S</a>
                                    <a href="_form.php?id=<?= $p->id ?>" class="btn btn-sm btn-warning">M</a>
                                    <a href="show.php?id=<?= $p->id ?>" class="btn btn-sm btn-info">C</a></td>
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