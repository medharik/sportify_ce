<?php
spl_autoload_register(function ($class) {
    include("../../models/" . strtolower($class) . ".class.php");
});
Idao::connect_db();


$action = "store";
$titre = "Nouvel paiement";
// $paiement = Paiement::find(7);
// var_dump($paiement);
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id']; //?id=9
    $paiement = Paiement::find($id);
    // var_dump($paiement);
    $action = "update";
    $titre = "Modification des informations du paiement numero  " . $paiement->id;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $titre ?></title>
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
                <h3 class="mt-4 text-center text-primary"> <?= $titre ?> </h3>
                <div class="container px-3">
                    <form action="controller.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">
                        <?php if (isset($paiement)) { ?>
                            <input type="hidden" name="id" value="<?= $paiement->id ?>">
                        <?php } ?>
                        <div class="row bg-light">

                            <div class="col-md-6 mx-auto border">
                                <div class="form-group"><label for="user_id">Utilsateur : </label>
                                    <select type="text" class="form-control" name="user_id" id="user_id" value="<?= (isset($paiement) ? $paiement->user_id : '') ?>">
                                        <?php
                                        $users =  User::all();
                                        foreach ($users as $u) {
                                        ?>
                                            <option <?php
                                                    if ($u->id == $paiement->user_id) echo "selected";

                                                    ?> value="<?= $u->id ?>"><?= $u->login ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group"><label for="abonne_id">Abonne : </label>
                                    <select type="text" class="form-control" name="abonne_id" id="abonne_id">
                                        <?php
                                        $abonnes = Abonne::all();
                                        foreach ($abonnes as $a) {
                                        ?>
                                            <option <?php
                                                    if ($paiement->abonne_id == $a->id) echo "selected";

                                                    ?> value="<?= $a->id ?>"><?= $a->nom ?> <?= $a->prenom ?></option>
                                        <?php }  ?>
                                    </select>

                                </div>
                                <div class="form-group"><label for="date_de">date Debut </label>
                                    <input type="date" class="form-control" name="date_de" id="date_de" value="<?= (isset($paiement) ?
                                                                                                                    $paiement->date_de : '') ?>">
                                </div>
                                <div class="form-group"><label for="date_a">Date Fin</label>
                                    <input type="date" class="form-control" name="date_a" id="date_a" value="<?= (isset($paiement) ? $paiement->date_a : '') ?>">
                                </div>
                                <div class="form-group"><label for="tarif_mois">Tarif par mois</label>
                                    <input type="number" step="0.01" class="form-control" name="tarif_mois" id="tarif_mois" value="<?= (isset($paiement) ? $paiement->tarif_mois : '') ?>">
                                </div>
                                <div class="form-group"><label for="remise">Remise</label>
                                    <input type="number" step="0.01" class="form-control" name="remise" id="remise" value="<?= (isset($paiement) ? $paiement->remise : '') ?>">
                                </div>


                                <div class="form-group"><label for="type_paiement">Mode de paiement</label>
                                    <select type="text" class="form-control" name="type_paiement" id="type_paiement" value="<?= (isset($paiement) ? $paiement->type_paiement : '') ?>">
                                        <option value="cb">CB</option>
                                        <option value="cash">Espece</option>
                                        <option value="cheque">cheque</option>
                                    </select>
                                </div>


                            </div>


                        </div>
                        <button class="btn btn-primary btn-sm d-block  col-md-6 mt-4 mx-auto">Valider</button>
                    </form>
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