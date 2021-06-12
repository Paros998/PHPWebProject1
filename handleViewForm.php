<!DOCTYPE html>
<?php if(!isset($_POST['ViewName']))header('Location: index.php');?>
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
        $view = $_POST['ViewName'];
        $kolumny = "";
        $tabele = "";
        $joiny = "";
        $warunki = "";
        $query = "CREATE OR REPLACE VIEW ".$view." AS SELECT ";

        if(count($_POST))
        {
            $len = count($_POST['Columns']);
            for($i = 0; $i < $len;$i++)
            {
                $tmp1 = $_POST['Columns'][$i];
                if($i+1 < $len-1)
                {
                    $kolumny = $kolumny.$tmp1.", ";
                }
                else{
                    $kolumny = $kolumny.$tmp1."";
                }
            }

            $len = count($_POST['Tables']);
            for($i = 0; $i < $len;$i++)
            {
                $tmp1 = $_POST['Tables'][$i];
                if($i+1 < $len-1)
                {
                    $tabele = $tabele.$tmp1.", ";
                }
                else{
                    $tabele = $tabele.$tmp1."";
                }
            }

            $len = count($_POST['JoinTables']);

            for($i = 0; $i < $len-1;$i++)
            {
                $tmp1 = $_POST['JoinTables'][$i];
                $tmp2 = $_POST['ReferenceTables1'][$i];
                $tmp3 = $_POST['ReferenceValues1'][$i];
                $tmp4 = $_POST['ReferenceTables2'][$i];
                $tmp5 = $_POST['ReferenceValues2'][$i];

                $joiny = $joiny."JOIN ".$tmp1." ON ".$tmp2.".".$tmp3."=".$tmp4.".".$tmp5." ";
            }

            $len = count($_POST['CondCol']);

            for($i = 0; $i < $len-3;$i++)
            {
                $tmp1 = $_POST['CondCol'][$i];
                $tmp2 = $_POST['CondVal'][$i];
                $tmp3 = $_POST['Type'][$i];

                $warunki = $warunki.$tmp3." ".$tmp1."='".$tmp2."' ";
            }
        }

        $query = $query.$kolumny." FROM ".$tabele;

        if($joiny != ""){
            $query = $query." ".$joiny;
        }

        if($warunki != "")
        {
            $query = $query.$warunki;
        }
        echo $query;
        echo "<br>";
        $script = oci_parse($conn,$query);
        if (!$script) {
            $message = oci_error($conn);
            trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

        if (!oci_execute($script)) {
            echo "<br>Niestety skrypt tworzący widok jest niepoprawny<br><br></div>";
            echo "<div class='bar2'><a href='createView.php' class='przycisk1' >Powrót do podstrony tworzenia widoku</a><br/><br/></div>";
        }
        else{
            echo "<br>Utworzono widok poprawnie!<br><br></div>";
            echo "<div class='bar2'><a href='createView.php' class='przycisk1' >Powrót do podstrony tworzenia widoku</a><br/><br/></div>";
        }
            ?>
    </div>
     <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>