<html>
<head>
    <link rel="stylesheet" href="saper.css">
</head>
<body>

    <header>
        <h1 style="text-align: center; font-size:70px;">SAPER</h1>
    </header>
    <div id="row">
    <div id="saper-info">
        <input type="button" onclick="pokaz()" value="Informacje" id="saper-info-btn" style="cursor: pointer;">
    </div>
    <div id="saper-text">
        <p id='info' style="visibility: hidden;">
        Witaj w kopii gry saper mojej produkcji. Największa możliwa plansza do stworzenia posiada wymiary 50x50.<br/>
        Dostępne ustawienia orginalnej gry:<br/>
        * Początkujący – plansza 8×8 pól, 10 min, ryzyko trafienia na minę: 15,625% <a href="saper.php?x=8&y=8&bomby=10"><input type="button" value="Zagraj" style="cursor: pointer;"></a><br/>
        * Zaawansowany – plansza 16×16 pól, 40 min, ryzyko trafienia na minę: 15,625% <a href="saper.php?x=16&y=16&bomby=40"><input type="button" value="Zagraj" style="cursor: pointer;"></a><br/>
        * Ekspert – plansza 30×16 pól, 99 min, ryzyko trafienia na minę: 20,625% <a href="saper.php?x=16&y=30&bomby=99"><input type="button" value="Zagraj" style="cursor: pointer;"></a>
        </p>
    </div>
<br/>
    <div id="formy">
    <form method="get" action="">
        <table class="tabela1">
        <tr class="forma1">
            <td class="pole">Podaj wysokość:</td><td class="pole"><input type="number" class="h" name="x" value="0"></td>
        </tr>
            <tr class="forma1"><td class="pole">Podaj szerokość:</td><td class="pole"><input type="number" class='h' name="y" value="0"></td><tr/>
            <tr class="forma1"><td class="pole">Podaj ilość bomb:</td><td class="pole"><input type="number" class='h' name="bomby" value="0"></td><tr/>
        <tr class="forma1"><td class="pole"></td><td class="pole"><input type="submit" value="Stwórz" id="saper-submit"></td></tr>
        </table>
    </form></div></div>


<?php


class Plansza
{
    public $x;
    public $y;
    public $bomby;
    function __construct($x,$y,$bomby)
    {
        $this->x=$x;
        $this->y=$y;
        $this->bomby=$bomby;
    }
    function build()
    {
        //            Tablica mieszczaca pole do gry
        $plansza=array(
                array($this->x),
                array($this->y)
        );

        //            Zmienna x,y,bomby w input hiddenie aby przeslac te wartosci do js
        echo '<input type="hidden" value="'.$this->x.'" id="xhidden">';
        echo '<input type="hidden" value="'.$this->y.'" id="yhidden">';
        echo '<input type="hidden" value="'.$this->bomby.'" id="bombyhidden">';

        //            Zapisanie wszystkich pól jako '?'
        for($i=0 ; $i<$this->x ; $i++) {
            for ($j = 0; $j < $this->y; $j++) {
                $plansza[$i][$j] = '?';
            }
        }
        // Losowe przypisanie polom bomb
        for($c=0 ; $c<$this->bomby ; $c++)
        {
            $randx=rand(0, ($this->x)-1);
            $randy=rand(0, ($this->y)-1);
            if($plansza[$randx][$randy]=='*') {
                while($plansza[$randx][$randy]=='*')
                {
                    $randx=rand(0, ($this->x)-1);
                    $randy=rand(0, ($this->y)-1);
                }
                $plansza[$randx][$randy]='*';
            }
            else
            {
                $plansza[$randx][$randy]='*';
            }
        }
        // Przypisanie polom wartosci w zaleznosci od ulozenia bomb
        for($i=0 ; $i<$this->x ; $i++) {
            for ($j = 0; $j < $this->y; $j++) {
                if ($plansza[$i][$j] != '*') {
                    if ($i == 0 && $j == 0) {
                        $c = 0;
                        if ($plansza[$i + 1][$j] == '*') {
                            $c++;
                        }
                        if ($plansza[$i][$j + 1] == '*') {
                            $c++;
                        }
                        if ($plansza[$i + 1][$j + 1] == '*') {
                            $c++;
                        }
                        if ($c != 0) {
                            $plansza[$i][$j] = $c;
                        }
                    } else {
                        $c = 0;
                        if (empty($plansza[$i - 1][$j - 1]) != 1 && $plansza[$i - 1][$j - 1] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i - 1][$j]) != 1 && $plansza[$i - 1][$j] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i - 1][$j + 1]) != 1 && $plansza[$i - 1][$j + 1] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i][$j - 1]) != 1 && $plansza[$i][$j - 1] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i][$j + 1]) != 1 && $plansza[$i][$j + 1] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i + 1][$j - 1]) != 1 && $plansza[$i + 1][$j - 1] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i + 1][$j]) != 1 && $plansza[$i + 1][$j] == '*') {
                            $c++;
                        }
                        if (empty($plansza[$i + 1][$j + 1]) != 1 && $plansza[$i + 1][$j + 1] == '*') {
                            $c++;
                        }
                        if ($c != 0) {
                            $plansza[$i][$j] = $c;
                        }
                    }
                }
            }
        }

        $m=0;
        echo '<center><div id="gra"><table id="table_gra" class="gra">';
        for($i=0 ; $i<$this->x ; $i++) {
            echo '<tr class="rzad_gra">';
            for ($j = 0; $j < $this->y; $j++) {
                echo '<td class="pole_gra"><input type="hidden" value="'.$plansza[$i][$j].'" id="'.$m.'h"><p id="'.$m.'m" value="'.$plansza[$i][$j].'"><button class="td" id="'.$m.'" onmousedown="WhichButton(event,'.$m.')" value="'.$plansza[$i][$j].'">'.''.'</button></p></td>';
                $m++;
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}

if (!empty($_GET['x']) && !empty($_GET['y']) && !empty($_GET['bomby'])) {
    if($_GET['x']<=50 && $_GET['y']<=50 && $_GET['y']>1 && $_GET['x']>1) {
        if ($_GET['bomby'] < ($_GET['x'] * $_GET['y'])) {
                $xy = new Plansza($_GET['x'], $_GET['y'], $_GET['bomby']);
                $xy->build();


        } else {
            echo '<center>Liczba bomb powinna być mniejsza niż liczba pól.</center>';
        }
    }
    else{
        echo '<p style="text-align: center;">Plansza musi mieć wymiary z zakresu 2-50.</p>';
    }
} else {
    echo '<p style="text-align: center;">Proszę wpisać dane.</p>';
    $_GET['x']='0';
    $_GET['y']='0';
    $_GET['bomby']='0';

}
echo '<p style="text-align: center;"><a href="saper.php?x=' . $_GET['x'] . '&y=' . $_GET['y'] . '&bomby=' . $_GET['bomby'] . '" style="text-decoration: none;font-weight: bold; color:#703232;">Zagraj ponownie!</a></p>';
    ?>
    <p id="wynik" style="text-align: center">Ruchy: 0</p>
    <p id="wynik1" style="text-align: center">Ilość bomb na mapie: 0</p>
    <p id="bombyz" style="text-align: center">Ilość zaznaczonych bomb: 0</p>
</div></center>
<footer>
    <a href="https://github.com/zdinozi" target="_blank"><img src="github-ww.png" style="width: 50px; height: 50px;"></a>&nbsp;&nbsp;
    <a href="https://www.linkedin.com/in/wiktor-banasiak-672425222/" target="_blank"><img src="linkedin.png" style="width: 50px; height: 50px;"></a>


</footer>
</body>
    <script>
        var click=0;
        var bombyz=0;
        function czy_koniec(ruchy)
        {
            javascript:void(document.oncontextmenu=null);
            // pobranie wartosci gry
            x=document.getElementById('xhidden').value;
            y=document.getElementById('yhidden').value;
            bomby=document.getElementById('bombyhidden').value;
            // sprawdzenie czy warunek zwycieztwa zostal spelniony
            if(ruchy==(x*y)-bomby)
            {
                document.getElementById('wynik').innerHTML='Udało się wygrałeś! Ruchy: '+ruchy;
                var ilosc=(x*y)-1;
                for (i = 0; i <= ilosc; i++) {
                    if(document.getElementById(i+'h').value=='?')
                    {
                    komentarz=' ';
                    document.getElementById(i + 'm').innerHTML = komentarz;
                    }
                    else
                    {
                        document.getElementById(i + 'm').innerHTML = document.getElementById(i + 'h').value;
                    }

                }
                }
            else
            {
                document.getElementById('wynik').innerHTML='Ruch: '+ruchy;
                document.getElementById('wynik1').innerHTML='Ilość bomb na mapie: '+bomby;
            }

        }
        function sprawdz(l)
        {
            // pobranie id wcisnietego elementu
            var d=document.getElementById(l).value;
            // jezeli wcisniety element jest *, koniec gry
            if(d=='*')
            {
                // wypisanie ilosci punktow
                document.getElementById('wynik').innerHTML='Trafiłeś Bombe! Koniec gry. Ilość udanych ruchów: '+click;
                document.getElementById('wynik1').innerHTML='';


                x=document.getElementById('xhidden').value;
                y=document.getElementById('yhidden').value;
                var ilosc=(x*y)-1;
                var i;
                for (i = 0; i <= ilosc; i++) {
                    // document.getElementById(i + 'm').innerHTML = document.getElementById(i + 'h').value;
                    if(document.getElementById(i+'h').value=='?')
                    {
                        komentarz=' ';
                        document.getElementById(i + 'm').innerHTML = komentarz;
                    }
                    else
                    {
                        document.getElementById(i + 'm').innerHTML = document.getElementById(i + 'h').value;
                    }
                }
            }
            else {
                click++;

                if (document.getElementById(l).value != '?')
                {
                    document.getElementById(l).style.display='none';
                    document.getElementById(l+'m').innerHTML=document.getElementById(l).value;
                }
                else{
                    document.getElementById(l).style.display='none';
                    document.getElementById(l+'m').innerHTML=' ';
                }
                czy_koniec(click);
            }



        }

        function WhichButton(event, l) {
            var k=l;
            if(event.button==0) {
                sprawdz(k);
            }
            if(event.button==2) {
                document.addEventListener('contextmenu', event => event.preventDefault());
                if(document.getElementById(l).innerHTML=='') {
                    document.getElementById(l).innerHTML = '*';
                    bombyz++;
                    document.getElementById('bombyz').innerHTML='Ilość zaznaczonych bomb: '+bombyz;
                }
                else if(document.getElementById(l).innerHTML=='*')
                {
                    document.getElementById(l).innerHTML='?';
                    bombyz--;
                    document.getElementById('bombyz').innerHTML='Ilość zaznaczonych bomb: '+bombyz;
                }
                else if(document.getElementById(l).innerHTML=='?')
                {
                    document.getElementById(l).innerHTML='';
                }
            }
        }
        function pokaz()
        {
            if(document.getElementById('info').style.visibility=='visible')
            {
                d = document.getElementById('info');
                d.style.visibility = 'hidden';
            }
            else {
                d = document.getElementById('info');
                d.style.visibility = 'visible';
            }
        }

    </script>
</html>