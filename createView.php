
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
        <h1> Menu Create View!</h1>
        <p>
            <b>Uzupełnij formularz</b>
        </p>
    </div>
    <script type="text/javascript">

        function DodajKolumne() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateKolumna').innerHTML;
            document.getElementById('NowaKolumna').appendChild(div1);
        }

        function DodajTabele() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateTabela').innerHTML;
            document.getElementById('NowaTabela').appendChild(div1);
        }

        function DodajJoin() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateJoin').innerHTML;
            document.getElementById('NowyJoin').appendChild(div1);
        }

        function DodajWarunek() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateWhere').innerHTML;
            document.getElementById('NowyWarunek').appendChild(div1);
            document.getElementById('Where').style.display = "none";
            document.getElementById('Or').style.display = "inline-block";
            document.getElementById('And').style.display = "inline-block";
        }
        function DodajOr() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateOr').innerHTML;
            document.getElementById('NowyWarunek').appendChild(div1);
        }
        function DodajAnd() {
            var div1 = document.createElement('div');
            div1.innerHTML = document.getElementById('TemplateAnd').innerHTML;
            document.getElementById('NowyWarunek').appendChild(div1);
        }
    </script>
    <div class="bar">
	<br/>
        <form  action="handleViewForm.php" method="post">
            <div class="bar1">
			    <div>
                    <span class="przycisk1">CREATE OR REPLACE VIEW</span>
			        <input type="text" class="przycisk1"  id="ViewName" name="ViewName" placeholder="Nazwa widoku"/>
                </div>

                <div>
                    <span class="przycisk1">AS SELECT</span><br/>
                </div>

                <div id="NowaKolumna">

                </div>
                <div id="TemplateKolumna" style="display:none">
                    <label class="przycisk1">Nazwa Kolumny</label>
                    <input type="text" name="Columns[]" class="przycisk1"/>
                </div>
                <div>
                    <a href="Javascript:DodajKolumne()" class="przycisk1">Dodaj Kolumnę!</a>
                </div>

                <div>
                    <span class="przycisk1">FROM</span>
                </div>

			    <div id="NowaTabela" >

                </div>
                <div id="TemplateTabela" style="display:none">
                    <label class="przycisk1">Nazwa Tabeli</label>
                    <input type="text" name="Tables[]" class="przycisk1"/>
                </div>
                <div>
                    <a href="Javascript:DodajTabele()" class="przycisk1">Dodaj Tabelę!</a>
                </div>

                <div id="NowyJoin" >

                </div>
                <div id="TemplateJoin" style="display:none;width:100%">
                    <label class="przycisk1">JOIN</label>
                    <input type="text" class="przycisk1" name="JoinTables[]"/>
                    <label class="przycisk1">ON</label>
                    <input class="przycisk1" type="text" name="ReferenceTables1[]"/>
                    <label class="przycisk1">.</label>
                    <input class="przycisk1" type="text" name="ReferenceValues1[]"/>
                    <label class="przycisk1">=</label>
                    <input class="przycisk1" type="text" name="ReferenceTables2[]"/>
                    <label class="przycisk1">.</label>
                    <input class="przycisk1" type="text" name="ReferenceValues2[]"/>
                </div>
                <div>
                    <a href="Javascript:DodajJoin()" class="przycisk1">Dodaj Joina!</a>
                </div>
                <div id="NowyWarunek">

                    
                </div>
                <div id="TemplateWhere" style="display:none">
                    <label class="przycisk1">WHERE</label>
                    <input type="text" name="CondCol[]" class="przycisk1" value="" placeholder="Kolejna Kolumna" />
                    <input type="text" name="CondVal[]" class="przycisk1" value="" placeholder="Wartość do sprawdzenia" />
                    <input type="hidden" name="Type[]" value="WHERE"/>
                </div>
                <div id="TemplateOr" style="display:none">
                    <label class="przycisk1">OR</label>
                    <input type="text" name="CondCol[]" class="przycisk1" value="" placeholder="Kolejna Kolumna" />
                    <input type="text" name="CondVal[]" class="przycisk1" value="" placeholder="Wartość do sprawdzenia" />
                    <input type="hidden" name="Type[]" value="OR"/>
                </div>
                <div id="TemplateAnd" style="display:none">
                    <label class="przycisk1">AND</label>
                    <input type="text" name="CondCol[]" class="przycisk1" value="" placeholder="Kolejna Kolumna" />
                    <input type="text" name="CondVal[]" class="przycisk1" value="" placeholder="Wartość do sprawdzenia" />
                    <input type="hidden" name="Type[]" value="AND"/>
                </div>
                <div >
                    <a href="Javascript:DodajWarunek()" id="Where" class="przycisk1">Dodaj WHERE!</a>
                    <a href="Javascript:DodajOr()" id="Or" class="przycisk1" style="display:none">Dodaj OR!</a>
                    <a href="Javascript:DodajAnd()" id="And" class="przycisk1" style="display:none">Dodaj AND!</a>
                </div>
                <div>
                    <span class="przycisk1">;</span>
                </div>
            </div>
	        <div class="bar2">
			<br/>
	            <input type="reset" id="reset" class="przycisk2" value="Resetuj"/>
                <input type="submit" class="przycisk2" id="submit" value="Wyślij"/><br/>
            </div>
        </form>
        <div>
            <a href='create.php' class='przycisk1' >Powrót do podstrony create!!</a><br/><br/>
        </div>
	</div>
    <footer name="stopka" class="stopka">
        Utworzone przez 2ID12B - Patryk Grzywacz - Dominik Grudzień - Patryk Jaworski - Jakub Jach
    </footer>
</body>
</html>
