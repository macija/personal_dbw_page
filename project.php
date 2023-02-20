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
<div class="card text-white bg-secondary my-5 py-4 text-center">
            <div class="card-body">
                <h1 class="h1">
                DBW Project: Molecular visualizator script database
                </h1>
            </div>
        </div>

        <h1 class="font-weight-light">By Pau Pujol, Núria Fàbrega & Marc Ciruela. DBW-2023</h1>
            <h2 class="font-weight-light">
            First presentation. Project specifications:
            </h2>


<!--<object data=
"assets/DBW_20_01_23.pdf" 
                width="16000" 
                height="10000"> 
        </object>
    -->
<?php

echo "<iframe src=\"assets/DBW_20_01_23.pdf\" width=\"1000\" height=\"500\"></iframe>";
?>

<h2 class="font-weight-light">
Second presentation. DB specifications:
</h2>
<?php
echo "<iframe src=\"assets/DBW_30_01_23.pdf\" width=\"1000\" height=\"500\"></iframe>";


echo "<h3> Go back to Marc's webpage:</h3>";
echo ' <a href="index.php"> Homepage</a>';


include("html/footer.html");

?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
