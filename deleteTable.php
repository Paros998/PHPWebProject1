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
        <h1> Menu Delete!</h1>
        <p>
            <b>Wybierz typ operacji</b>
        </p>
    </div>
    <div name="bar" id="bar" class="bar">
        <div class="bar1">
            <?php
            include_once 'include.php';
            $table_name = $_POST["table"];
            $query = "SELECT * FROM " .$table_name;

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

            $pk_column;
            $pk_value;
            $column = 1;
            echo "<table class='table1' border='1'>\n";
            $ncols = oci_num_fields($script);
            echo "<tr>\n";
            for ($i = 1; $i <= $ncols; ++$i) {
                if($i == 1){
                    $pk_column = oci_field_name($script, $i);
                }
                $colname = oci_field_name($script, $i);
                echo "  <th class='th1'><b>".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."</b></th>\n";
            }
			echo '<th class="th1"><b>Akcja</b></th>'."\n";
            echo "</tr>\n";
            while (($row = oci_fetch_array($script, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                echo "<tr>\n";
                echo "<form action='handleDeleteRowTable.php' method='post'>";
                foreach ($row as $item) {
                    if($column == 1 )
                    {
                        $pk_value = $item;
                        $column++;
                    }
                    echo "<td class='td1'>";
                    echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
                    echo "</td>\n";
                    $column++;
                }

                echo '<input type="hidden" name="table" value="'.$table_name.'"/>';
                echo '<input type="hidden" name="pk_column" value="'.$pk_column.'"/>';
                echo '<input type="hidden" name="pk_value" value="'.$pk_value.'"/>';

                echo "<td class='td1'>";
                echo "<input type='submit' class='przycisk1' value = 'Usuń rekord'/>";
                echo "</td>\n";
                echo '</form>';
                echo "</tr>\n";
                $column = 1;
            }
            echo "</table>\n";
            ?>
        </div>
        <div class="bar2">
            <form action="handleDeleteTable.php" method="post">
                <input type="hidden" name="table" value="<?php echo $table_name;?>" />
                <input type="submit" class="przycisk1" value="Usuń wszystkie rekordy z tabeli" />
            </form>
        </div>
        <div class="bar2">   
            <a href='delete.php' class='przycisk1'>Powrót do podstrony wyboru tabeli!</a>
        </div>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>



