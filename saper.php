<html>
<head>
    <link rel="stylesheet" href="saper.css">
</head>
<body>
<form method="get" action="">
    Podaj szerokość: <input type="number" name="x"><br/>
    Podaj wysokość: <input type="number" name="y"><br/>
    Podaj ilość bomb: <input type="number" name="bomby"><br/>
    <input type="submit" value="Stwórz">
</form>
<p id="wynik"></p>


</body>
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
        echo '<table>';
        for($i=0 ; $i<$this->x ; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $this->y; $j++) {
                echo '<td><button id="'.$m.'" onclick="sprawdz('.$m.')" value="'.$plansza[$i][$j].'">'.$plansza[$i][$j].'</button></td>';
                $m++;
            }
            echo '</tr>';
        }
        echo '</table>';
    }
//    public function czy_bomba($l)
//    {
//        if($l=='*')
//            {
//                $g='bomba';
//                return $g;
//            }
//        else{
//        $g='pole';
//        return $g;
//        }
//
//    }


}

$xy=new Plansza($_GET['x'],$_GET['y'],$_GET['bomby']);
$xy->build();



?>
<script>
    function sprawdz(l)
    {

        var d=document.getElementById(l).value;
        if(d=='*')
        {
            document.getElementById('wynik').innerHTML='Trafiłeś Bombe! Koniec gry.';
        }
        else{
            document.getElementById(l).innerHTML='p';
        }


    }

</script>
</html>