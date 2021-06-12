
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
    <div name="menu" id="menu" class="menu">
        <h1> Menu Create Table!</h1>
        <p>
            <b>Uzupełnij formularz</b>
        </p>
    </div>
    <script type="text/javascript">
         function dodajKolumne() {
                var div1 = document.createElement('div');
                div1.innerHTML = document.getElementById('TemplateNowaKolumna').innerHTML;
                document.getElementById('NowaKolumna').appendChild(div1);
            }
    </script>
    <div class="bar">
        <form action="handleTableForm.php" method="post" >
	        <div class="bar1">
                <div>
			    <br/>
                    <span class="przycisk1">CREATE TABLE</span>
                    <input class="przycisk1" type="text" id="tableName" name="tableName" placeholder="Nazwa tabeli"/>
                    <span class="przycisk1">(</span><br />
                </div>
                <div id="NowaKolumna">

                </div>
                <div>
                    <div>
                        <label class="przycisk1">Dodatkowe Pole na Referencje etc</label>
                        <textarea type="text" name="RefAdd" class="przycisk1"></textarea>
                    </div>
                </div>
                <div id="TemplateNowaKolumna" style="display:none;">
                        <label class="przycisk1">Nazwa Kolumny</label>
                        <input type="text" name="Columns[]" class="przycisk1"/>
                        <label class="przycisk1">Typ Danych</label>
                        <input type="text" name="Types[]"  class="przycisk1"/>
                        <label class="przycisk1">Dodatkowe Constrainty etc</label>
					    <textarea type="text" name="Additional[]" class="przycisk1"></textarea>
                </div>
                <div>
                    <span class="przycisk1">);</span><br/>
				    <a href="javascript:dodajKolumne()" class="przycisk1">Kliknij aby dodać kolejnę kolumnę!</a>
                
                </div>
                <div>
                </div>
        
 	        </div>
	        <div class="bar2">
				    <input type="reset" id="reset" class="przycisk2" value="Resetuj"/>
                    <input type="submit" class="przycisk2" id="submit" value="Wyślij"/><br/>
                    
	        </div>
	    </form>
        
        <div>
                <a href='create.php'  class="przycisk1" >Powrót do podstrony create!</a><br/><br/>
        </div>
    </div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>