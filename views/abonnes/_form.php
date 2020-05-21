<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>titre</title>
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
                <h1 class="mt-4">Titre </h1>
                <div class="container px-3">
                    <form action="controller.php?action=store" method="post" enctype="multipart/form-data">
                        <div class="row bg-light">

                            <div class="col-md-6 mx-auto border">
                                <div class="form-group"><label for="nom">nom</label>
                                    <input type="text" class="form-control" name="nom" id="nom">
                                </div>
                                <div class="form-group"><label for="prenom">prenom</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom">
                                </div>
                                <div class="form-group"><label for="date_naissance">date naissance</label>
                                    <input type="date" class="form-control" name="date_naissance" id="date_naissance">
                                </div>
                                <div class="form-group"><label for="profession">profession</label>
                                    <input type="text" class="form-control" name="profession" id="profession">
                                </div>


                            </div>
                            <div class="col-md-6 mx-auto border">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="homme" value="homme" name="sexe">
                                    <label class="form-check-label" for="homme">Homme</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="femme" value="femme" name="sexe">
                                    <label class="form-check-label" for="femme">Femme</label>
                                </div>
                                <div class="form-group"><label for="cin">cin</label>
                                    <input type="text" class="form-control" name="cin" id="cin" pattern="[a-zA-Z]{1,2}[0-9]{6}">
                                    <span class="text-muted">Exemple : Bj897867</span>
                                </div>
                                <div class="form-group"><label for="photo">photo</label>
                                    <input type="file" class="form-control" name="photo" id="photo">
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