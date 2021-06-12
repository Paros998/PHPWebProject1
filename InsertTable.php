<!DOCTYPE html>
<?php if(!isset($_POST['table']))
{
	header('Location: index.php');
	exit();
}?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css"/>
    <title>Hurtownia RTV/AGD</title>
</head>
<body>
    <div name="menu" id="menu" class="menu">
        <h1> Menu Insert!</h1>
        <p>
            <b>Wstaw dane do tabeli <?php echo $_POST["table"];?></b>
        </p>
    </div>
	<div class="bar">
        <div name="bar1" id="bar1" class="bar1">
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
        </div>
        <div class="bar2">
            <form action="handleInsertForm.php" method="post">
                <div>
                    <div>
                        <span class="przycisk1">INSERT INTO</span>
                        <?php
                        echo "<input class='przycisk1'  type='hidden' id='tableName' name='tableName' value='$table_name'/>";
                        echo "<span class='przycisk1' >$table_name</span>";
                        ?>
                        <span class="przycisk1">(</span>
                    </div>
                    <div>
                        <?php
                        echo "<input class='przycisk1'  type='hidden' id='Columns' name='Columns' value='";
                        for ($i = 1; $i <= $ncols; ++$i) {
                            $colname = oci_field_name($script, $i);
                            echo "".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."";
                            if( ($i+1) <= $ncols){
                                echo ",";
                            }
                        }
                        echo "'/>";
                        echo "<span class='przycisk1'>";
                        for ($i = 1; $i <= $ncols; ++$i) {
                            $colname = oci_field_name($script, $i);
                            echo "".htmlspecialchars($colname,ENT_QUOTES|ENT_SUBSTITUTE)."";
                            if( ($i+1) <= $ncols){
                                echo ",";
                            }
                        }
                        echo "</span>";
                        ?>
                    </div>
                    <div>
                        <span class="przycisk1">)</span>
                        <span class="przycisk1">VALUES</span>
                        <span class="przycisk1">(</span>
                    </div>

                    <div id="KolejnaKolumna"></div>
                    <div id="TK" style="display:none;">
                        <span class="przycisk1" id="Columns[]">Wartość do kolejnej kolumny</span>
                        <input type="text" name="Values[]" class="przycisk1" />
                    </div>
                    <script type="text/javascript">
                    function dodajRekordy() {
                        var kolumny = "<?php echo $ncols ?>";
                        var i;

                        for (i = 1; i <= kolumny;i++) {
                            var div1 = document.createElement('div');
                            div1.innerHTML = document.getElementById('TK').innerHTML;
                            document.getElementById('KolejnaKolumna').appendChild(div1);
                        }
                    }
                    dodajRekordy();
                    </script>

                    <span class="przycisk1">);</span>
                    <br />
                    <br />

                </div>
	
                <div>
                    <input type="reset" id="reset" class="przycisk2" value="Resetuj" />
                    <input type="submit" class="przycisk2" id="submit" value="Wyślij" />
                </div>
		    </form>
            <form action="insert.php" method="post">
                <?php
                    echo "<input type='hidden' value='$table_name' name='table'/>";
                ?>
                <button type="submit" class='przycisk1'>Powrót do wyboru tabeli!</button>
                <br />
                <br />
            </form>
        </div>
    </div>                                            
     <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>

</body>
</html>



