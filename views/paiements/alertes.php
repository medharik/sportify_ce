<?php
include "../../models/paiement.class.php";
Idao::connect_db();
$paiements = Paiement::last_paie();
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
                    <a href="<?= BASE_URL ?>paiements/_form.php" class="btn btn-sm btn-warning my-1">
                        Nouveau
                    </a>
                </div>
                <h3 class="mt-4 text-center text-primary">Les alertes de paiement </h3>
                <table class="table table-striped">
                    <thead class="bg-dark  text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Abonne id</th>
                            <th scope="col">Date de </th>
                            <th>Date a </th>
                            <th>Nombre de jours</th>
                            <th>Retard? </th>
                            <th>Tarif </th>
                            <th>Remise</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paiements as $p) {

                            $abonne = $p->abonne();
                            $user = $p->user();

                        ?>
                            <?php $duree = Paiement::date_diff(date('Y-m-d'), $p->date_a);
                            $classe = "bg-success";
                            $retard = "il reste  $duree j";
                            if ($duree < 0) {
                                $classe = "bg-danger text-white";
                                $retard = "retard de $duree j";
                            }
                            if ($duree < 0) {
                            ?>
                                <tr>
                                    <td scope="col"><?= $p->id ?></td>
                                    <td scope="col">
                                        <?= $user->login; ?>

                                    </td>
                                    <td scope="col">
                                        <?= $abonne->nom; ?> <?= $abonne->prenom; ?></td>
                                    <td><?= Paiement::date_fr($p->date_de) ?></td>
                                    <td><?= Paiement::date_fr($p->date_a) ?></td>
                                    <td><?php

                                        $n_jours =  Paiement::date_diff($p->date_de, $p->date_a);


                                        $n_mois = (int) ($n_jours / 30); // 3,5 => 3
                                        $reste = $n_jours % 30; // reste de n_jours / 30;
                                        // echo $n_mois;
                                        // echo  ceil($n_mois);
                                        $n_mois_a_payer = ceil(($n_jours / 30)); // 1,22=>2
                                        if ($reste < 7) $n_mois_a_payer -= 1;
                                        echo "$n_mois Mois et $reste jours  <br> A payer :" . $n_mois_a_payer . "Mois";
                                        ?></td>

                                    <td class="<?= $classe ?>">
                                        <?= $retard ?>

                                    </td>
                                    <td><?= $p->tarif_mois ?></td>
                                    <td><?= $p->remise ?></td>
                                    <td><?= ($p->tarif_mois * $n_mois_a_payer) * (1 - $p->remise / 100); ?></td>

                                    <td><a onclick="return confirm('supprimer? ')" href="controller.php?action=delete&id=<?= $p->id ?>" class="btn btn-sm btn-danger">S</a>
                                        <a href="_form.php?id=<?= $p->id ?>" class="btn btn-sm btn-warning">M</a>
                                        <a href="show.php?id=<?= $p->id ?>" class="btn btn-sm btn-info">C</a></td>
                                </tr>
                        <?php }
                        } ?>

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
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        });
    </script>
</body>

</html>