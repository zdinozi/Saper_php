<html>
<head>
    <link rel="stylesheet" href="saper.css">
</head>
<body>
<div id="stronka">
    <div id="formy">
    <form method="get" action="">
        <table>
        <tr>
            <td>Podaj szerokość:</td><td><input type="number" name="x"></td>
        </tr>
            <tr><td>Podaj wysokość:</td><td><input type="number" name="y"></td><tr/>
            <tr><td>Podaj ilość bomb:</td><td><input type="number" name="bomby"></td><tr/>
        <tr><td></td><td><input type="submit" value="Stwórz"></td></tr>
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
            $plansza=array(
                    array($this->x),
                    array($this->y)
            );
            $bomby=array(
                array($this->x),
                array($this->y)
            );
            for($i=0 ; $i<$this->x ; $i++) {
                for ($j = 0; $j < $this->y; $j++) {
                    $plansza[$i][$j] = '?';
                }
            }
            for($c=0 ; $c<$this->bomby ; $c++)
            {
                $randx=rand(0, ($this->x)-1);
                $randy=rand(0, ($this->y)-1);
                if($plansza[$randx][$randy]=='*')
                {
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

    $xy=new Plansza($_GET['x'],$_GET['y'],$_GET['bomby']);
    $xy->build();

    ?>
    <p id="wynik" style="text-align: center"></p>
</div>
</body>
    <script>
        function sprawdz(l)
        {
            var d=document.getElementById(l).value;
            if(d=='*')
            {
                document.getElementById('wynik').innerHTML='Trafiłeś Bombe! Koniec gry.';
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
            else{
                document.getElementById(l).innerHTML='x';
            }


        }
        function click()
        {

        }

    </script>
</html>