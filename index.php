<?php

    if(isset($_POST["submission"])){

        $game = new Game();
        $game->position[0] = $_POST["box0"];
        $game->position[1] = $_POST["box1"];
        $game->position[2] = $_POST["box2"];
        $game->position[3] = $_POST["box3"];
        $game->position[4] = $_POST["box4"];
        $game->position[5] = $_POST["box5"];
        $game->position[6] = $_POST["box6"];
        $game->position[7] = $_POST["box7"];
        $game->position[8] = $_POST["box8"];

        //check for blank space
        $blank = false;
        for($i=0;$i<9;$i++){
            if($game->position[$i] == ''){
                $blank = true;
            }
        }

        //generate a random number b/w 0-8 that is empty
        if($blank == true && $over !== true){
            $i = rand() % 8;
            while($game->position[$i] !== ''){
                $i = rand() % 8;
            }
            $game->position[$i] = 'o';
        }

        $over = false;
        if ($game->winner('x')) {
            $over = true;
            echo 'x won!';
        } else if ($game->winner('o')){
            $over = true;
            echo 'o won!';
        } else if($blank == true){
            echo 'No winner yet';
        } else {
            $over = true;
            echo 'Tie game';
        }



    }

class Game{
    var $position = array('','','','','','','','','','');

    function __construct(){
    }

    function winner($token)
    {
        for ($row = 0; $row < 3; $row++) {
            if (($this->position[3 * $row] == $token) &&
                ($this->position[3 * $row + 1] == $token) &&
                ($this->position[3 * $row + 2] == $token)
            ) {
                return true;
            }
        }
        for ($col = 0; $col < 3; $col++) {
            if (($this->position[$col] == $token) &&
                ($this->position[$col + 3] == $token) &&
                ($this->position[$col + 6] == $token)
            ) {
                return true;
            }
        }
        if (($this->position[0] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[8] == $token)
        ) {
            return true;
        }
        if (($this->position[2] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[6] == $token)
        ) {
            return true;
        }
    }
}
?>

<html>
    <head>
        <title>
            TicTacToe
        </title>
    </head>
    <body>
        <form name="tictactoe" method="post" action="index.php">
            <?php
                //Draw the 3x3 grid
                for($i=0;$i<9;$i++){
                    printf('<input type="text" name="box%s" value="%s">',$i,$game->position[$i]);
                    if(($i % 3) == 2){
                        print('<br>');
                    }
                }
                if($over != true){
                    print('<input type="submit" name="submission" value="Make Move">');
                } else {
                    print('<input type="button" name="newgame" value="Play Again" onclick="window.location.href=\'index.php\'">');
                }
            ?>
        </form>
    </body>


</html>