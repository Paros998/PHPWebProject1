<!DOCTYPE html>
<?php if(!isset($_POST['view']))header('Location: index.php');?>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="index.css" />
    <title>Hurtownia RTV/AGD</title>
</head>
<body>
    <div name="menu" id="menu" class="menu">
        <h1> Przetwarzanie zapytania </h1>

    </div>
    <div name="bar" id="bar" class="bar">
        <?php
        include_once "include.php";
        $view_name = $_POST['view'];

        $query = "DROP VIEW ".$view_name;

        $script = oci_parse($conn,$query);
        $script = oci_parse($conn, $query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt usuwający widok nie działa!<br></div>";
            echo "<div class='bar2'><a href='drop.php' class='przycisk1' >Powrót do podstrony DROP</a><br/><br/></div>";
        }
        else{
            echo "<br>Usunięto widok ".$view_name." poprawnie!<br></div>";
            echo "<div class='bar2'><a href='drop.php' class='przycisk1' >Powrót do podstrony DROP</a><br/><br/></div>";
        }
        ?>
   
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
