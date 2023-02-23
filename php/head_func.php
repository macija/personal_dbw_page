<?php

// Header function

function headerDBW($title){
    return '
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Marc Ciruela" />
        <title>'.$title.'</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/terminal-solid.svg"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link rel=\"stylesheet\" href=\"css/clustalw.css\">

        <script src=\"js/clustalw.js\"></script>

        <!-- IE 8 Support-->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]--> 
    </head>
';
}

function errorPage($title, $text) {
    return headerDBW($title) . $text;
}

/*
<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">  
*/

?>