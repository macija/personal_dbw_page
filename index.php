<?php
    include("html/head.html");
    include("html/nav_bar.html");
?>

<!-- Page content-->
<div class="container px-5 px-lg-5 gy-5 py-5" id="home">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center gy-5 py-5" id="">
        <div class="col-lg-4 offset-md-2"> 
            <img class="img-fluid rounded mb-4 mb-lg-0" src="assets/photo_me.png" alt="..." width="200"/>
        </div>
        <div class="col">
            <h1 class="font-weight-light">
                Hi! Welcome to my personal webpage
            </h1>
            <h2 class="font-weight-light">
                My name is Marc Ciruela
            </h2>
        </div>
    </div>
    <div class="row gx-4 gx-lg-5 gy-5 py-5 align-items-center">
        <h1 class="font-weight-light text-center">
            Current projects:
        </h1>
    </div>
    <?php
    readfile("html/content_row.html");
    ?>

    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="card text-white bg-secondary mb-4 pb-4 mt-4 pt-4 text-center">
            <div class="card-body">
                <h1 class="h1">
                    About me
                </h1>
            </div>
        </div>
    </div>
    <div class="row-md2 gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6 offset-md-3">
        <h3>Education<br></h3>
            <h5>
                <ul class="list-group">
                    <li class="list-item"><p><b>Msc Bioinformatics for Health Sciencies</b>
                        (2022- Currently)
                    
                        Universitat Pompeu Fabra - Universitat de Barcelona</p>
                    </li>
                    <li class="list-item"><p><b>Bsc Biochemistry</b>
                        (2018-2022)
                    
                        Universitat de Barcelona</p>
                    </li>
                    <li class="list-item"><p><b>Baccalaureate in science</b>
                        (2016-2018)
                    
                        Institut d'Alella</p>
                    </li>        
                </ul>
            </h5>    
        <h3>
            Languages
            <br>
        </h3>
        <h5>
            <ul class="list-group">
                <li class="list-item">
                    <p>English (C1)</p>
                </li>
                <li class="list-item">
                    <p>Spanish (native)</p>
                </li>
                <li class="list-item">
                    <p>Catalan (native)</p>
                </li>
                <li class="list-item">
                    <p>French (basic)</P>
                </li>
            </ul>
            <br>
        </h5>
        <h3>
            Other personal experience
            <br>
        </h3>
        <h5>
            <p>Private tutor experience since 2016 teaching high-school level Chemistry, Physics, Mathematics, Biology and English.</p>
            <p>Cathecist at Parròquia de Sant Feliu d'Alella with high-school teenagers.</p>
            <p>Summer camp counselor during 2019 summer (Parròquia Santa Maria de Gràcia, Barcelona)</p>
            <br>
        </h5>
        <h3>
            Conferences I have attended
            <br>
        </h3>
        <h5>
                8th RSC-BMCS Fragment-based Drug Discovery Meeting (Cambridge, UK) - March 2022
                Allosterism and Drug Discovery Conference (Barcelona, Spain) - June 2022
                <br>
                <br>
                <br>
        </h5>
        <h3>
            Do you want to know more about me? 
            <br>
            <br>
        </h3>   
        <h4>
            Find me on: 
            <a href="https://github.com/macija"><img class="img-fluid rounded mb-2 mx-4 mb-lg-0" src="assets/github-mark/github-mark.svg" alt="..." width="30"/></a>

            <a href="https://www.linkedin.com/in/marc-ciruela-jard%C3%AD-54522a237"><img class="img-fluid rounded mx-2 mb-4 mb-lg-0" src="assets/LinkedIn-Logos/LI-In-Bug.png" alt="..." width="30"/></a>
            <br>
            <br>
            Or write me:    <a class="btn btn-secondary" href="mailto:mcirueja16@alumnes.ub.edu?Subject=Contact%20From%20Webpage0" role="button">Contact</a>            
        <h4>
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
