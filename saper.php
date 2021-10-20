<html>
<head>
    <link rel="stylesheet" href="saper.css">
</head>
<body>

<div id="stronka">

    <h1 style="text-align: center; font-size:70px;">SAPER</h1>

    <div id="formy">
    <form method="get" action="">
        <table class="tabela1">
        <tr class="forma1">
            <td class="pole">Podaj szerokość:</td><td class="pole"><input type="number" name="x" value="0"></td>
        </tr>
            <tr class="forma1"><td class="pole">Podaj wysokość:</td><td class="pole"><input type="number" name="y" value="0"></td><tr/>
            <tr class="forma1"><td class="pole">Podaj ilość bomb:</td><td class="pole"><input type="number" name="bomby" value="0"></td><tr/>
        <tr class="forma1"><td class="pole"></td><td class="pole"><input type="submit" value="Stwórz"></td></tr>
        </table>
    </form>
    </div>


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
                echo '<td class="pole_gra"><input type="hidden" value="'.$plansza[$i][$j].'" id="'.$m.'h"><p id="'.$m.'m" value="'.$plansza[$i][$j].'"><button class="td" id="'.$m.'" onclick="sprawdz('.$m.')" value="'.$plansza[$i][$j].'">'.''.'</button></p></td>';
                $m++;
            }
            echo '</tr>';
        }
        echo '</table></div></center>';
    }
}

$xy = new Plansza($_GET['x'], $_GET['y'], $_GET['bomby']);
$xy->build();

?>
    <p id="wynik" style="text-align: center"></p>
    <p id="wynik1" style="text-align: center"></p>
</div>
</body>
    <script>
        var click=0;
        function czy_koniec(ruchy)
        {
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


    </script>
</html>