<!DOCTYPE html>
<?php if(!isset($_POST['view']))header('Location: index.php');?>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="index.css"/>
    <title>Hurtownia RTV/AGD</title>
</head>
<body>
    <div name="menu" id="menu" class="menu">
        <h1> Widok!</h1>
			<p><b><?php echo $_POST['view'];?></b></p>
    </div>
    <div name="bar" id="bar" class="bar">
        <?php
            include_once 'include.php';
            $view_name = $_POST["view"];
            $query = "SELECT * FROM " .$view_name;

            $script = oci_parse($conn, $query);
            if (!$script) {
                $message = oci_error($conn);
                trigger_error('Could not parse statement: '. $message['message'], E_USER_ERROR);
            }

            $row = oci_execute($script);
            if (!$row) {
                $message = oci_error($script);
                trigger_error('Could not execute statement: '. $message['message'], E_USER_ERROR);
            }

            echo "<table class='table1' border='1'>\n";
            $ncols = oci_num_fields($script);
            echo "<tr>\n";
            for ($i = 1; $i <= $ncols; ++$i) {
                $colname = oci_field_name($script, $i);
                echo "  <th class='th1'><b>".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."</b></th>\n";
            }
            echo "</tr>\n";

            while (($row = oci_fetch_array($script, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "<td class='td1'>";
                    echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        ?>   
	<div class="bar2">
		<a href='index.php' class='przycisk1'>Powrót do głównego menu!</a><br/><br/>
	</div> 
    </div>
	
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>