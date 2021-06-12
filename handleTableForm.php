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
        <h1 > Przetwarzanie zapytania </h1>
        
    </div>
    <div name="bar" id="bar" class="bar">
    <div class="bar1">
        <?php
        include_once "include.php";
        $table = $_POST['tableName'];
        $dodatkoweDane = $_POST['RefAdd'];
        $kolumny = "";
        if(count($_POST))
        {
            $len = count($_POST['Columns']);
            for($i = 0; $i < $len;$i++)
            {
                $tmp1 = $_POST['Columns'][$i];
                $tmp2 = $_POST['Types'][$i];
                $tmp3 = $_POST['Additional'][$i];
                if($i+1 < $len-1)
                {
                    $kolumny = $kolumny.$tmp1." ".$tmp2." ".$tmp3.", ";
                }
                else{
                    $kolumny = $kolumny.$tmp1." ".$tmp2." ".$tmp3."";
                }
            }
        }
        if($dodatkoweDane == "")
        {
            $query = "CREATE TABLE ".$table." (".$kolumny." ".$dodatkoweDane.")";
        }
        else{
            $query = "CREATE TABLE ".$table." (".$kolumny." ,".$dodatkoweDane.")";
        }
        echo $query;
        echo "<br>";
        $script = oci_parse($conn,$query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt tworzący tabelę jest niepoprawny<br><br></div>";
            echo "<div class='bar2'><a href='createTable.php' class='przycisk1' >Powrót do podstrony tworzenia tabeli</a><br/><br/></div>";
        }
        else{
            echo "<br>Utworzono tabelę poprawnie!<br><br></div>";
            echo "<div class='bar2'><a href='createTable.php' class='przycisk1' >Powrót do podstrony tworzenia tabeli</a><br/><br/></div>";
        }
        ?>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>