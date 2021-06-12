<!DOCTYPE html>
<?php if(!isset($_POST['tableName']))header('Location: index.php');?>
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
        $table = $_POST['tableName'];

        $kolumny = $_POST['Columns'];
        $queryPartTwo ="";
        if(count($_POST))
        {
            $len = count($_POST['Values']);
            for($i = 0; $i < $len-1;$i++)
            {
                if($i+1 < $len-1)
                {
                    $queryPartTwo = $queryPartTwo."'".$_POST['Values'][$i]."',";
                }
                else
                {
                    $queryPartTwo = $queryPartTwo."'".$_POST['Values'][$i]."'";
                }
            }
        }

        $query = "INSERT INTO ".$table." (".$kolumny.") VALUES (".$queryPartTwo.")";
        echo $query;
        echo "<br>";
        $script = oci_parse($conn,$query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt wstawiający rekord do tabeli jest niepoprawny<br><br></div>";
            echo "<div class='bar2'>";
            echo "<form action='insertTable.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony wstawiania danych</button>";
            echo "</form>";
            echo "<br/><br/></div>";
        }
        else{
            echo "<br>Wstawiono rekord poprawnie do tabeli!<br><br></div>";
            echo "<div class='bar2'>";
            echo "<form action='insertTable.php' method='post'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<button type='submit' class='przycisk1' >Powrót do podstrony wstawiania danych</button>";
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
