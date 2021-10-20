<html>
<head>
    <link rel="stylesheet" href="saper.css">
</head>
<body>
<div id="stronka">
    <div id="formy">
    <form method="get" action="">
        <table class="forma">
        <tr class="forma">
            <td class="forma">Podaj szerokość:</td><td class="forma"><input type="number" name="x"></td>
        </tr>
            <tr class="forma"><td class="forma">Podaj wysokość:</td><td class="forma"><input type="number" name="y"></td><tr/>
            <tr class="forma"><td class="forma">Podaj ilość bomb:</td><td class="forma"><input type="number" name="bomby"></td><tr/>
        <tr class="forma"><td class="forma"></td><td class="forma"><input type="submit" value="Stwórz"></td></tr>
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
        //        function czy_bomba($pole)
        //        {
        //            l=0;
        //            if($pole=)
        //
        //        }
        function build()
        {
            //            Tablica mieszczaca pole do gry
            $plansza=array(
                    array($this->x),
                    array($this->y)
            );
            //            Zapisanie wszystkich pól jako '?'
            for($i=0 ; $i<$this->x ; $i++) {
                for ($j = 0; $j < $this->y; $j++) {
                    $plansza[$i][$j] = '?';
                }
            }
            //            Losowe przypisanie polom bomb
            echo $this->bomby;
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
            //            Przypisanie polom wartosci w zaleznosci od ulozenia bomb
            for($i=0 ; $i<$this->x ; $i++) {
                echo '<br>';
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
                    echo $plansza[$i][$j];
}

                    //                    $c=0;
                    //                    if($i==0 && $j==0)
                    //                    {
                    //                        if($plansza([$i]+1)[$j]=='*')
                    //                        {
                    //                            echo $plansza([$i]+1)[$j];
                    //                            $c++;
                    //                        }
                    //                        if($plansza([$i]+1)([$j]+1)=='*')
                    //                        {
                    //                            $c++;
                    //                        }
                    //                        if($plansza[$i]([$j+1])=='*')
                    //                        {
                    //                            $c++;
                    //                        }
                    //                    }
                    //                    if($i==0 && $j>0 && $j<($this->y)-1){
                    //                        echo 'szyszki';
                    //
                    //                    }
                    //                    if($i>0&& $i<($this->x)-1 && $j==0){
                    //                        echo 'szyszki';
                    //
                    //                    }
                    //                    if($i>0 && $i<($this->x)-1 && $j>0 && $j<($this->y)-1)
                    //                    {
                    //                        echo 'szyszki';
                    //
                    //                    }
                    //                    if($c!=0)
                    //                    {
                    //                        $plansza[i][j]=$c;
                    //                    }


                }

            $m=0;
            echo '<center><div id="gra"><table id="plansza" class="gra">';
            for($i=0 ; $i<$this->x ; $i++) {
                echo '<tr class="gra">';
                for ($j = 0; $j < $this->y; $j++) {
                    echo '<td class="ddd gra"><button class="td" id="'.$m.'" onclick="sprawdz('.$m.')" value="'.$plansza[$i][$j].'">'.''.'</button></td>';
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
</div>
</body>
    <script>
        var click=0;
        function sprawdz(l)
        {
            click++;
            var d=document.getElementById(l).value;
            if(d=='*')
            {
                document.getElementById('wynik').innerHTML='Trafiłeś Bombe! Koniec gry. Ruchy: '+click;
                document.getElementById(l).innerHTML='*';
                // document.getElementById('plansza').style.display='none';
                var x = document.getElementById("gra");
                var y = x.getElementsByClassName("td");
                var i;
                for (i = 0; i < y.length; i++) {
                     document.getElementsByClassName('td')[i].style.display='none';
                }
                document.getElementById(l).style.display='block';
                document.getElementsByClassName('ddd')[l].innerHTML='*';
                // document.getElementsByClassName("td").attribute("onclick","click()");
                // document.getElementById('gra').style.display='none';
            }
            else {
                if (document.getElementById(l).value != '?')
                {
                    document.getElementById(l).innerHTML = document.getElementById(l).value;
                }
                else{
                    document.getElementById(l).style.display='none';
                }
                // document.getElementById(l).innerHTML='x';
                // document.getElementById(l).style.display='none';
            }


        }


    </script>
</html>