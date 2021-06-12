<!DOCTYPE html>
<?php if(!isset($_POST['table']))header('Location: index.php');?>
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
        <div class="bar1">
            <?php
        include_once "include.php";
        $table_name = $_POST['table'];

        $query = "DELETE FROM ".$table_name;
        echo $query."<br>\n";
        $script = oci_parse($conn, $query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt usuwający wszystkie rekordy nie działa!<br><br></div>";
            echo "<div class='bar2'><a href='delete.php' class='przycisk1' >Powrót do podstrony DELETE</a><br/><br/></div>";
        }
        else{
            echo "<br>Usunięto wszystkie rekordy z tabeli ".$table_name." poprawnie!<br><br></div>";
            echo "<div class='bar2'><a href='delete.php' class='przycisk1' >Powrót do podstrony DELETE</a><br/><br/></div>";
        }
            ?>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
