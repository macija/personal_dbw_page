<?php
include("html/head.html");
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
<div class="row gx-4 gx-lg-5 align-items-center my-5" id="db_model">
    <div class="col">
        <h3> Database design </h3>
        <br>
        <p> Design of a database for a bioinformatics suport service to manage data from proteomics analysis that includes: a) Sample and user detals, b) Experimental protocols used, c) Protein sequences found, d) Identified proteins from sequences, 5) References. 
        </p>
        <br>
        <img class="img-fluid rounded mb-4 mb-lg-0" style="display:block; margin:auto;" src="assets/db_exercise_1.svg" alt="...Sorry..." width="900"/>
    </div>
</div>



<?php
    include("html/footer.html");
?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script type="text/javascript" src="js/grid-gallery.js"></script>

</body>
</html>
