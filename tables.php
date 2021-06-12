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
        <h1>Tabela!</h1>
		<p><b>Aktualizacja zawartości tabeli <?php echo $_POST["table"];?>!</b></p>
    </div>
    <div class="bar">
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

                    echo '<table class="table1" border="1">'."\n";
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
                            echo '<td class="td1">';
                            echo $item!==null?htmlspecialchars($item, ENT_QUOTES|ENT_SUBSTITUTE):"&nbsp;";
                            echo "</td>\n";
                        }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";
                ?>
            </div>
        <script type="text/javascript">
            function dodajAND() {
                var div1 = document.createElement('div');
                div1.innerHTML = document.getElementById('KolejnyAnd').innerHTML;
                document.getElementById('NowyAND').appendChild(div1);
            }
        </script>
        <div class="bar2">
            <form action="funkcjaUpdate.php" method="post">
                <?php
                echo "<input type='hidden' name='tablename' id='tablename' class='tablename' value=$table_name>";
                ?>
                <div>
                    <input type="text" name="colname" id="colname" class="przycisk1" placeholder="Nazwa kolumny" />
                    <input type="text" name="oldvalue" id="oldvalue" class="przycisk1" placeholder="Aktualna wartość" />
                    <input type="text" name="newvalue" id="newvalue" class="przycisk1" placeholder="Nowa wartość" />
                </div>
                <div id="NowyAND"></div>
                <div>
                    <a href="javascript:dodajAND()" class="przycisk1">Kliknij aby dodać kolejny warunek</a>
                    <br />
                    <br />
                </div>


                <div id="KolejnyAnd" style="display:none">
                    <div>
                        <br />
                        <span class="przycisk1">AND</span>
                        <input type="text" name="anotherCol[]" class="przycisk1" value="" placeholder="Kolejna Kolumna" />
                        <input type="text" name="anotherVal[]" class="przycisk1" value="" placeholder="Wartość do sprawdzenia" />
                    </div>
                </div>
                <div>
                    <input type="reset" class="przycisk2" value="Resetuj" />
                    <input type="submit" class="przycisk2" value="Wyślij" />
                </div>
            </form>
        </div>
        <div class="bar2">
            <a href='update.php' class='przycisk1'>Powrót do podstrony update!</a><br/><br/>
        </div>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
