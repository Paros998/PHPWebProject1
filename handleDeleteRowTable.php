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
        <?php
        include_once "include.php";
        $table_name = $_POST['table'];
        $pk_column = $_POST['pk_column'];
        $pk_value = $_POST['pk_value'];
        $query = "DELETE FROM ".$table_name ." WHERE ".$pk_column."=".$pk_value;
        echo "<div class='bar1'><br>";
        echo $query;
		echo'<br>';
        $script = oci_parse($conn, $query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt usuwający rekord nie działa!<br></div>";
            echo "<div class='bar2'>";
            echo "<form action='deleteTable.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table_name'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony usuwania danych z tabeli $table_name</button>";
            echo "</form>";
            echo "</div>";
        }
        else{
            echo "<br>Usunięto rekord z tabeli $table_name poprawnie!<br><br></div>";
            echo "<div class='bar2'>";
            echo "<form action='deleteTable.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table_name'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony usuwania danych z tabeli $table_name</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>


