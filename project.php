<?php
include("html/head.html");
include("html/nav_bar.html");
?>
<div class="container">
    <div class="row" style="border-bottom: solid 1px">
        <div class="col">
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body">
                    <h1 class="h1">
                        DBW Project: Molecular visualizator script database
                    </h1>
                </div>
            </div>
            <h2 class="font-weight-light">
                By Pau Pujol, Núria Fàbrega & Marc Ciruela. DBW-2023
            </h2>
            <h3 class="font-weight-light">
                First presentation. Project specifications:
            </h3>
        <?php
        echo "<iframe src=\"assets/DBW_20_01_23.pdf\" width=\"1000\" height=\"500\"></iframe>";
        ?>
        </div>
    </div>
    <div class="row" style="border-bottom: solid 1px">
        <div class="col">
            <h3 class="font-weight-light">
                Second presentation. DB specifications:
            </h3>
            <?php
            echo "<iframe src=\"assets/DBW_30_01_23.pdf\" width=\"1000\" height=\"500\"></iframe>";
            ?>
        </div>
    </div>
    <div class="row" style="border-bottom: solid 1px">
        <div class="col">
            <?php
                echo "<h3> Go back to Marc's webpage:</h3>";
                echo ' <a href="index.php"> Homepage</a>';
            ?>
        </div>
    </div>
</div>

<?php
include("html/footer.html");

?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
