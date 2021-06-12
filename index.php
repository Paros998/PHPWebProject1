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
	<div class="menu" >
		<h1> Menu Główne!</h1>
		<p>
			<b>Wciśnij odpowiedni przycisk aby przejść na kolejną podstronę </b>
		</p>
		
	</div>
    <div class="bar">
        <div class="bar1">
            <p>Podstawowe Operacje</p>
            <a href="create.php" class="przycisk1">CREATE</a>
            <a href="insert.php" class="przycisk1">INSERT</a>
            <a href="update.php" class="przycisk1">UPDATE</a>
            <a href="drop.php" class="przycisk1">DROP</a>
            <a href="delete.php" class="przycisk1">DELETE</a>
        </div>
        <div class="bar2">
            <p>Widoki</p>
         <div>

                <?php
            include_once 'include.php';

			$query= "SELECT view_name FROM USER_VIEWS";

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
                    echo "<form action='views.php' method='post'>";
					echo "<button type='submit' s value=";
					echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
					echo " id='view' name='view' class='przycisk1' '>";
					echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
					echo "</button>";
					echo "</form>";
                }
            }
                ?>
            </div>
        </div></div>	
		<footer class="stopka">
		Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
	</footer>
 
</body>
</html>
