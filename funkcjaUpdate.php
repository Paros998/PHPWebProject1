<!DOCTYPE html>
<?php if(!isset($_POST['colname']))header('Location: index.php');?>
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
        $table_name = $_POST['tablename'];
        $col_name = $_POST['colname'];
        $oldval = $_POST['oldvalue'];
        $newval = $_POST['newvalue'];
        $queryPartTwo ="";
        if(count($_POST))
        {
            $len = count($_POST['anotherCol']);
            for($i = 0; $i < $len;$i++)
            {
                $tmp1 = $_POST['anotherCol'][$i];
                $tmp2 = $_POST['anotherVal'][$i];
                if($tmp1 == "" || $tmp2 =="")
                {
                    break;
                }
                $queryPartTwo = $queryPartTwo."AND ".$tmp1."='".$tmp2."'";
            }
        }
        $query = "UPDATE ".$table_name." SET ".$col_name."='".$newval."' WHERE ".$col_name."='".$oldval."'"." ".$queryPartTwo;
        echo $query;
        echo ";<br/>";

        $script = oci_parse($conn, $query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br/>Coś się nie zgadza. Nieprawidłowe dane!<br/><br/></div>";
            echo "<div class='bar2'>";
            echo "<form action='tables.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table_name'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony aktualizowania danych tabeli $table_name</button>";
            echo "</form>";
            echo "<br/><br/></div>";
        }
        else{
            echo "<br/>Wszystko się zgadza. Zaktualizowano rekord!<br/><br/></div>";
            echo "<div class='bar2'>";
            echo "<form action='tables.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table_name'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony aktualizowania danych tabeli $table_name</button>";
            echo "</form>";
            echo "<br/><br/></div>";
        }

            ?>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
