<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Marc Ciruela" />
        <title>My personal web</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/terminal-solid.svg"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
    </head>
<body>
<?php
    include("html/nav_bar.html");

?>

<!-- Page content-->
<div class="container px-4 px-lg-5" id="assignments">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="card text-white bg-secondary my-5 py-4 text-center">
            <div class="card-body">
                <h1 class="h1">
                    DBW Assignments
                </h1>
            </div>
        </div>
<div class="row gx-4 gx-lg-5 align-items-center my-5" id="clustalw">
    <div class="col-lg-4 offset-md-2">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="assets/clustal.jpg" alt="..." width="200"/>
    </div>
    <div class="col">
        <h3>
            CLUSTALW
        </h3>
        <p>
            Small application where one can submit several sequences and perform a multiple sequence alignment using ClustalW.
        </p>
        <a class="btn btn-secondary" href="clustalwindex.php" role="button">Go to the application</a>
    </div>
</div>
<div class="row gx-4 gx-lg-5 align-items-center my-5">
    <div class="col">
        
    </div>
</div>

    <?php
    readfile("html/content_row.html");

    include("html/footer.html");
?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
