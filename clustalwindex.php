<!DOCTYPE html>
<?php
/* Main form of the ClustalW MSA application
* Marc  Ciruela Jardí 2023
* Application will:
    Read from a set of sequences in FASTA file pasted in a text form
    Read from a set of UniProtIDs
    Read from a file uploaded

Allow several options:
    Output format

    Number of iterations (combined)
    Max guide tree iterations
    max hmm iterations
    distance matrix
    guide tree
    order
    
    Give a HMM to do the alignment?

Clean the input file uploaded or text forms to the suitable format. Send a warning if something was wrong.

Use this to run clustalw locally. When results come up, show these to the user formating the output. This needs to adapt to the outformat given by the user.

*/

// Load global vars
require "globals.inc.php";

// Check if we are reloading the page but there was previous data placed in the form. If there was, we need to keep it, if not, we set defaults and clean the url.
/*
if (isset($_REQUEST['new']) or !isset($_SESSION['queryData'])){
    $_SESSION['queryData'] = [
        'uniprotid' => 'something',
        'seqs' => 'AAAUUC',
        'fasta' => 'kk.fa',
        'outfmt' => 'fasta',
        'maxhmm' => 'NaN',
        'maxguide' => 'NaN',
        'numiter' => 'NaN',
        'hmm' => 'NaN',
        'kimura' => 'kimura'
    ];
}
*/

?>
<link rel="stylesheet" href="css/clustalw.css">
<?php

// end initialization 

// main form
?>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Marc Ciruela" />
        <title>ClustalW</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/terminal-solid.svg"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link rel="stylesheet\" href="css/clustalw.css\">

        <script src="js/clustalw.js"></script>

        <!-- IE 8 Support-->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]--> 
    </head>

<?php
include('html/nav_bar.html');
?>
<div class="container px-5 px-lg-5 gy-5 py-5" id="application">
    <div class="card text-white bg-secondary mb-2 pb-2 mt-2 pt-2 gx-4 gx-lg-5 text-center gy-5 py-5" style="background-color: #D7CA6E !important;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 offset-md-2 align-self-start">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="assets/clustal_transp.png" alt="..." width="100" style="background-color:#D7CA6E;"/>
                </div>
                <div class="col align-self-center">
                    <h1 class="h1">
                        ClustalW
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <form name="init" action="align.php" method="POST" enctype="multipart/form-data">
        <div class="row gx-4 gx-lg-5 align-items-center justify-content-start">
            <div class="col-8 col-sm-6 align-self-start">
                <div class="row-8 row-sm-6 py-2" style="border-bottom: solid 1px">
                    <div class="form-group">
                        <label><b>Uniprot IDs</b></label>
                        <input type="text" name="uniprotid" id="uniprotid"<?php if(isset($_SESSION['queryData']['uniprotid'])){echo " placeholder:".$_SESSION['queryData']['uniprotid'];}?>/>
                        <div class="form-text">
                            Enter several valid Uniprot IDs to perform a MSA of them. Separate each ID with spaces, commas or semicolons.
                        </div>
                    </div>
                </div> 
                <div class="row-8 row-sm-6 py-2" style="border-bottom: solid 1px">
                    <div class="form-group">
                        <label><b> Sequences in FASTA format </b></label>
                        <span class="input-group-text">Introduce multiple sequences</span>
                        <textarea class="form-control" aria-label="With textarea" name="seqs" rows='10' cols='50' <?php if(isset($_SESSION['queryData']['seqs'])){echo "placeholder:".$_SESSION['queryData']['seqs'];}?>></textarea>
                        <div class="form-text">
                           Sequences may be introduced in fasta format, with a ">TITLE" line followed by the sequence.
                           More than one sequence is expected.
                        </div>
                    </div>
                </div>
                <div class="row-8 row-sm-6">
                    <div class="form-group">
                        <label for="script"><b>Upload your own fasta file</b></label>
                        <input type="file" id="script" name="fasta"/>
                        <div class="form-text">
                           Please, upload a file in proper <a href="https://en.wikipedia.org/wiki/FASTA_format">FASTA format</a>
                        </div>
                    </div>
                </div>
            </div> <!-- end of inputs section -->
            <div class="col-6 col-sm-6 align-self-start">    
                <div class="row py-1 my-2" style="margin-right: 0px;margin-left: 0px;"> 
                    <button type="button" id="accordion" class="accordion">
                        <b>Custom options</b>
                    </button>
                    <div class="panel" id="panel">
                        <h5 style="font-style:italic;">
                            Use a Hidden Markov Model profile to do the alignment:
                        </h5>
                        <div class="form-group">
                            <label for="hmm"><p style="font-weight:lighter">Upload your own HMM profile</p></label>
                            <input type="file" id="hmm" name="hmm"  accept="text"/>
                        </div>
                        <br>
                        <br>
                        <h5 style="font-style:italic;">
                            Other options:
                        </h5>
                        <div class="form-group">
                            <input type="checkbox" id="kimura" name="kimura">
                            <label><p style="font-weight:lighter;">Use Kimura distance corrections</p></label>
                        </div>
                        <div class="form-group">
                            <label for="iterrange"><p style="font-weight:lighter;">Number of iterations (combined)</p></label>                
                            <input type="range" class="form-control-range" id="iterrange" name="numiter" max="100" min="0" step="1" onchange='document.getElementById("it_box").value = "Numb. iterations =  " + document.getElementById("iterrange").value;'/>
                            <input type="text" name="bar" id="it_box" value="Numb. iterations = n" disabled />
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="treerange"><p style="font-weight:lighter;">Maximum guide tree iterations</label>
                            <input type="range" class="form-control-range" id="treerange" name="maxguide" max="100" min="0" step="1" onchange='document.getElementById("treerange").value = "Max. iterations for guide tree = " + document.getElementById("treeiter").value;'/>
                            <input type="text" name="bar" id="tree_box" value="Max iterations for guide tree = n " disabled />
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="hmmrange"><p style="font-weight:lighter;"> Maximum HMM iterations</label>
                            <!--<input type="text" name="maxhmm" id="maxhmm"/>-->
                            <input type="range" class="form-control-range" id="hmmrange" name="maxhmm" max="100" min="0" step="1" onchange='document.getElementById("hmm_box").value = "Max. HMM iterations = " + document.getElementById("hmmrange").value;'/>
                            <input type="text" name="bar" id="hmm_box" value="Max HMM iterations = n" disabled />
                        </div>
                        <div class="form-text">
                            Please, refer to 
                                <a href="https://www.ebi.ac.uk/seqdb/confluence/display/JDSAT/Clustal+Omega+Help+and+Documentation">
                                Clustal manual
                                </a> 
                                for more information about customization. 
                        </div>
                    </div> <!-- end of other options panel -->
                </div>
                <div class="row py-1 my-2" style="margin-right: 0px;margin-left: 0px;">
                    <button type="button" id="accordion" class="accordion">
                        <b>Output format</b>
                    </button>
                    <div class="panel" id="panel">
                        <h5 style="font-style:italic;">
                            Output format:
                        </h5 style="font-style:italic;">
                        <select class="custom-select custom-select-sm mb-3" id="outfmt" name="outfmt">
                            <option <?php if(!isset($_SESSION['queryData']) or $_SESSION['queryData']['outfmt'] == 'fasta'){echo "selected";}?> value="fasta">Fasta</option> 
                            <option <?php if(isset($_SESSION['queryData']) and $_SESSION['queryData']['outfmt'] == 'clustal'){echo "selected";}?> value="clustal">Clustal</option>
                            <option <?php if(isset($_SESSION['queryData']) and $_SESSION['queryData']['outfmt'] == 'msf'){echo "selected";}?> value="msf">MSF</option>
                            <option <?php if(isset($_SESSION['queryData']) and $_SESSION['queryData']['outfmt'] == 'phylip'){echo "selected";}?>  value="phylip">Phylip</option>
                            <option <?php if(isset($_SESSION['queryData']) and $_SESSION['queryData']['outfmt'] == 'stockholm'){echo "selected";}?> value="stockholm">Stockholm</option>
                        </select>
                        <br>
                    </div> <!-- end of outputfmt sect --> 
                </div> 
                </div>
            </div> <!-- end of options columns -->
        <hr style="height:5px;color:#333;background-color:#333;"/> <!-- horizontal line -->
        <div class="row gx-4 gx-lg-5 align-items-center" style="margin-top: 20px;">
            <div class="d-grid gap-2 d-md-block">
                <button type='submit' class="btn btn-secondary">Align</button>
                <button type='reset' class="btn btn-secondary">Reset</button>
            </div>
        </div>
        <div class="row gx-4 gx-lg-4 align-items-center my-2">
            <p class="font-weight-light" style="margin-bottom: 5px;font-size: 0.875em;color: var(--bs-secondary-color);">
                Please, note that the application will use your input with this preference:
                <ul class="list-group" style="padding-left: 40px;font-size: 0.875em;color: var(--bs-secondary-color);"> 
                    <li class="list-group"> 1. Uploaded file </li>
                    <li class="list-group"> 2. UniProt ID </li>
                    <li class="list-group"> 3. Sequences introduced in form </li>
                </ul>
            </p>
        </div>
        </div>
    </form> <!-- end form -->
</div>

<!----------------------- START PRINTING ALIGNMENT RESULTS ----------------------------------------------------->
<?php 
if(isset($_SESSION['result'])){
//Print the results here
    if(empty($_SESSION['result']['alignment']) or empty($_SESSION['result']['file'])){
        echo '<script type="text/javascript">'; 
        echo 'alert("Some error has occurred with your alignment and the result was empty.(Error:12)");';
        echo '</script>';
    }else{
        ?>
            <hr style="height:5px;color:#333;background-color:#333;"/> <!-- horizontal line -->
            <div class="container-fluid px-5 px-lg-5 gy-5 py-5" id="results">
            <div class="output_seq">
            <div class="row gx-4 gx-lg-5 align-items-center justify-content-start">
                <h2 style="text-align: center;">
                    <b>Resulting alignment: </b>
                </h2>
                <p style="text-align:right;">
                <?php echo $_SESSION['result']['file'].".out"?>
                    <button class="btn btn-primary">
                        <a href='<?php echo $_SESSION['result']['file'].".out"?>' download=<?php echo "my_clustalo_alignment.".$_SESSION['queryData']['outfmt']?>>
                            <p style="color: white"><img src="assets/download_button.png" alt="download_button" style="width: 30px;">
                                Download your results.
                            </p>
                        </a>
                    </button>
                </p>
            </div>
            <div class="row gx-4 gx-lg-5 align-items-center justify-content-center">
            <div class="col">
        <?php
        print_r($_SESSION['debug']);
        echo '<pre style="margin-left: 20px;;">';
        foreach($_SESSION['result']['alignment'] as $line){
            echo $line;
        }
        echo '</pre>';
    }
}
?>
                </div></div>
            </div> <!-- Ends row of sequences -->
<?php

session_destroy();
?>

</div> <!-- ends container -->


<?php
readfile('html/footer.html');

?>

<script src="js/clustalw.js"></script>
</body>
</html>