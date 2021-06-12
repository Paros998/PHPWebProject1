<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="index.css" />
    <title>Hurtownia RTV/AGD</title>
</head>
<body>
    <div class="menu">
        <h1> Menu Update!</h1>
        <p>
            <b>Wybierz tabelę do edycji! </b>
        </p>

    </div>
    <div class="bar" >
        <div class="bar1">
        <p>Tabele</p>
            <?php
        include_once 'include.php';

		$query= "SELECT table_name FROM USER_TABLES";

		$script = oci_parse($conn,$query);
		if (!$script) {
             $message = oci_error($conn);
             trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
        }

		$row = oci_execute($script);
        if (!$row) {
            $message = oci_error($script);
            trigger_error('Could not execute statement: '. $message['message'], E_USER_ERROR);
        }

		while(($row = oci_fetch_array($script,OCI_ASSOC+OCI_RETURN_NULLS)) != false)
        {
            foreach($row as $item){
                echo "<form action='tables.php' method='post'>";
			    echo '<input type="submit" value="';
				echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
				echo '" id="table" name="table" class="przycisk2">';
				echo "</form>";
            }
        }
            ?>
        </div>
        <br />
	    <div class="bar2">
            <a href='index.php' class='przycisk1'>Powrót do głównego menu!</a>
        </div>
    </div>    
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
