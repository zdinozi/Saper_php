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
        echo '<table>';
        for($i=0 ; $i<$this->x ; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $this->y; $j++) {
                echo '<td>'.$plansza[$i][$j].'</td>';
            }
            echo '</tr>';
        }
        echo '<table/>';
    }


}

$xy=new Plansza($_GET['x'],$_GET['y'],$_GET['bomby']);
$xy->build();



?></html>