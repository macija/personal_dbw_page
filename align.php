<?php

require "globals.inc.php";
$title = 'error';
// Start checking what the user has send
// if empty data, go back to origin
if (isset($_POST)){
    $_SESSION['queryData'] = $_POST;
}

if (!isset($_SESSION['queryData'])) {
    header('Location: clustalwindex.php');
}

// Checking input
if ($_FILES['fasta']['name'] or $_REQUEST['seqs']) {
    if ($_FILES['fasta']['tmp_name']) {
        //The user has send a file. Put the info in seqs variable.
        $sequences = file_get_contents($_FILES['fasta']['tmp_name']);
        $gt = substr($sequences, 0, 1);
        if ($gt != ">") {
            echo '<script type="text/javascript">'; 
            echo 'alert("WARNING. You need to upload a valid FASTA file. Please, check your imput. (Error:1");';
            echo 'window.location.href = "clustalwindex.php";';
            echo '</script>';
        }
    }else{
        if (!strpos($_SESSION['queryData']['seqs'], '>')){
            if (strpos($_SESSION['queryData']['seqs'], '>') == 0){
                $sequences = $_SESSION['queryData']['seqs'];
            }else{
                echo '<script type="text/javascript">'; 
                echo 'alert("WARNING. Sequences need to be in FASTA format. See: <a href="https://en.wikipedia.org/wiki/FASTA_format">Fasta format</a> for more info. (Error:2)");';
                echo 'window.location.href = "clustalwindex.php";';
                echo '</script>';
            }
        }else{
            echo '<script type="text/javascript">'; 
            echo 'alert("WARNING. Sequences need to be in FASTA format. See: <a href="https://en.wikipedia.org/wiki/FASTA_format">Fasta format</a> for more info. (Error:3)");';
            echo 'window.location.href = "clustalwindex.php";';
            echo '</script>';;
        }
    }
}else{ //the user has not send neither a file or sequences. expecting UniprotIDs.
    if(!isset($_SESSION['queryData']['uniprotid']) or empty($_SESSION['queryData']['uniprotid'])){
        echo '<script type="text/javascript">'; 
        echo 'alert("WARNING. You need to set a valid Uniprot ID, sequences or sequence file to proceed.(Error:4)");';
        echo 'window.location.href = "clustalwindex.php";';
        echo '</script>';
    }else{
        //The user has send a uniprot id.
        //Convert to array
        $ids =explode(';',str_replace(array(' ',',','-', '\n'),';',trim($_SESSION['queryData']['uniprotid'], '>')));
        $ids = array_filter($ids);
        if(count($ids) <= 1){
            if(!isset($_SESSION['queryData']['hmm']) or empty($_SESSION['queryData']['hmm'])){
                echo '<script type="text/javascript">'; 
                echo 'alert("WARNING. You send just 1 sequence and no HMM profile. Please, send more than one sequence or a HMM profile to perform the alignment. (Error:5)");';
                echo 'window.location.href = "clustalwindex.php";';
                echo '</script>';
            }
        }
        $seq_arr = [];
        foreach($ids as $id){
            $seq = file('https://www.uniprot.org/uniprot/'.$id.'.fasta');
            if(empty($seq)){
                echo '<script type="text/javascript">'; 
                echo 'alert("WARNING. One of the IDs you introduced is not a valid UniProt ID.(Error:6)");';
                echo 'window.location.href = "clustalwindex.php";';
                echo '</script>';
                //echo '<a href="clustalw.php">Go back</a>';
            }else{
                if(in_array('Error',$seq)){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("WARNING. One of the IDs you introduced is not a valid UniProt ID.(Error:7)");';
                    echo 'window.location.href = "clustalwindex.php";';
                    echo '</script>';
                }else{
                $seq_arr[] = $seq;
                }
            }
        }
        //$sequences = implode('\n', $seq_arr);
        $sequences = implode('', array_map(function($i){return implode('',$i);}, $seq_arr));
    }
}


/***************SANITIZING INPUT**********************************/
//Read the $sequences and find if it contains strange characters
$protein_dict = ['g', 'a', 'l', 'm', 'f', 'w', 'k', 'q', 'e', 's', 'p', 'v', 'i', 'c', 'y', 'h', 'r', 'n', 'd', 't', 'x'];
$dna_dict = ['a', 't', 'g', 'u', 'c'];
$search_arr = array_merge($protein_dict, $dna_dict);
$sqs = preg_split('/(?=>)/', $sequences);
if (count($sqs) > 1){
    foreach ($sqs as $sq){ //for each sequence
        $lines = preg_split('/\n|\r|\r\n/', $sq); // for each line of the sequence
        foreach ($lines as $line){
            $line = trim($line);
            /*if($line == null){
                echo '<script type="text/javascript">'; 
                echo 'alert("WARNING. The FASTA file you uploaded is corrupted. Please check your input.(Error:8)");';
                echo 'window.location.href = "clustalwindex.php";';
                echo '</script>';
            }else{*/
                if(!preg_match('/^>/', $line)){
                    foreach (str_split(strtolower($line)) as $i) {
                        if (!in_array($i, $search_arr)){
                            echo '<script type="text/javascript">'; 
                            echo 'alert("WARNING. The FASTA file you uploaded is corrupted. Please check your input.(Error:9)");';
                            echo 'window.location.href = "clustalwindex.php";';
                            echo '</script>';
                        }
                    }
                }
            
        }
    }
}else{
    echo '<script type="text/javascript">'; 
    echo 'alert("WARNING. The FASTA file you uploaded does not contain enough sequences. Please check your input. (Error:10)");';
    echo 'window.location.href = "clustalwindex.php";';
    echo '</script>';
}


// Set temporary file name to a unique value to protect from concurrent runs
$files_id = uniqId('clust');
$tempFile = $tmpDir . "/" . $files_id;

// Open temporary file and store query FASTA
$res = preg_match('/\n(.*)\n/', $sequences, $matches);
/////
// 16-2-23 THIS is still not properly working, it seems as it is writing \n\n but in the string we do not have this
$writing_arr = preg_split('/\n|\r|\r\n/', $sequences);
$writing_arr = array_filter($writing_arr);
$ff = fopen($tempFile . ".query.fasta", 'wb');
foreach($writing_arr as $line){
    fwrite($ff, $line."\n");
}
fclose($ff);


/*******************Decide command line to execute************/

// check if a hmm profile was given
if ($_FILES['hmm']['name']) {
    if (($_FILES['hmm']['tmp_name'])) {
        //The user has send a file. Put the info in hmm variable.
        $hmm = file_get_contents($_FILES['hmm']['tmp_name']);
        //save the model in disk
        $ff = fopen($tempFile.".hmm", 'wt');
        fwrite($ff, $hmm);
        fclose($ff);
        $clustalcmdline .= " --hmm-in=".$tempFile.".hmm";
    }
}
// number iteration and max iterations
if(isset($_SESSION['queryData']['numiter'])){
    $iterations = intval($_SESSION['queryData']['numiter']);
    if($iterations > 0){
        $clustalcmdline .= " --iter=$iterations";
    }
}
if(isset($_SESSION['queryData']['maxhmm'])){
    $iterations = intval($_SESSION['queryData']['maxhmm']);
    if($iterations > 10000){
        $clustalcmdline .= " --max-hmm-iterations=$iterations";
    }
}
if(isset($_SESSION['queryData']['maxguide'])){
    $iterations = intval($_SESSION['queryData']['maxguide']);
    if($iterations > 0){
        $clustalcmdline .= " --max-guidetree-iterations=$iterations";
    }
}
//Use kimura
if($_SESSION['queryData']['kimura'] == true){
    $clustalcmdline .= ' --use-kimura';
}

// Now add the input
$clustalcmdline .= ' -i '.$tempFile.".query.fasta";

// Out format
if($_SESSION['queryData']['outfmt'] == 'fasta'){
    $clustalcmdline .= ' -outfmt=fa';
}elseif($_SESSION['queryData']['outfmt'] == 'clustal'){
    $clustalcmdline .= ' --outfmt=clu';
}elseif($_SESSION['queryData']['outfmt'] == 'msf'){
    $clustalcmdline .= ' --outfmt=msf';
}elseif($_SESSION['queryData']['outfmt'] == 'phylip'){
    $clustalcmdline .= ' --outfmt=phy';
}elseif($_SESSION['queryData']['outfmt'] == 'stockholm'){
    $clustalcmdline .= ' --outfmt=st';
}

// define the output
$clustalcmdline .= ' -o '.$tempFile.".out";
$_SESSION['debug']['cmd'] = $clustalcmdline;
echo $clustalcmdline;
// execute clustalw, command line prefix set in globals.inc.php
exec($clustalHome.$clustalcmdline);


// Read results file and parse hits onto $result[]
$result = file($tempFile . ".out");
if (!count($result)) {
    echo '<script type="text/javascript">'; 
    echo 'alert("Some error has occurred with your alignment and the result was empty.(Error:11)");';
    echo 'window.location.href = "clustalwindex.php";';
    echo '</script>';
    exit();
}

/* Cannot destroy all temporary files like this because the user will not be able to download them
* Pau has suggested checking files that are older than 12hrs and just delete those ones.
// Cleaning temporary files
if (file_exists($tempFile . ".query.fasta")) {
    unlink($tempFile . ".query.fasta");
}
if (file_exists($tempFile .".out")) {
    unlink($tempFile . ".out");
}
if (file_exists($tempFile.".hmm")){
    unlink($tempFile.".hmm");
}
*/
//Finish this script
$_SESSION['result']['alignment'] = $result;
$_SESSION['result']['file'] = "tmp/$files_id";
header("Location: clustalwindex.php"); //goes back to the frontend with the results.
die();


/********************* Print results *********************************************** */
/* This is how in blast we printed the output.
$records = [];
foreach (array_values($result) as $rr) { 
    if (strlen($rr) > 1) {
        $data = explode ("\t",$rr);
        preg_match('/(....)_(.) mol:([^ ]*) length:([0-9]*) *(.*)/', $data[1], $hits);
        list ($r, $idCode, $sub, $tip, $l, $desc)= $hits;
        // get compound from entry table
        $sql = "SELECT compound from entry WHERE idCode = '$idCode'";
        $rs = mysqli_query($mysqli,$sql) or print mysqli_error($mysqli);
        $rsf = mysqli_fetch_assoc($rs);
        $records[] = ['idCode'=> $idCode, 'sub' => $sub, 'tip' => $tip, 'desc' => $desc, 'compound' => $rsf['compound'], 'ev' => $data[2]];
        
    }
}

print_r($result);


*/

?>
