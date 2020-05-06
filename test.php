<?php

//Initializing the board
$TheBoard=array(9);
for ($i=0;$i<9;$i++) $TheBoard[$i]='_';

//Initialize some global variables
$isWon = false;
$winner = "";
$isTie = false;
$multiplayer = false;
$pl = array ("", "");

printf("Welcome to TIC-TAC-TOE EXTREME Lite\r\n");

//Ask multiplayer or vs bot
printf("\r\n");
printf ("Play vs bot or a second player? (b/p)");
printf("\r\n");
if (readline() == "p") {
  $multiplayer = true;
}

//Ask who goes first and set variable (n=bot first, anything else=player first)
printf("\r\n");
printf ("Would you like to go first? (y/n)");
printf("\r\n");
$whosMove = readline();

//Ask X/O
printf("\r\n");
printf ("Would you like X or O?");
printf("\r\n");
while($pl[0] == "") {
  $z = readline();
  if($z == "X") {
    $pl[0] = "X";
    $pl[1] = "O";
  } else if ($z == "O") {
    $pl[0] = "O";
    $pl[1] = "X";
  }
}

//Print the blank board
print_board();

//Main while loop
while(!$isWon) {
//possible improvement: choose X/O

  move();
  print_board();

  checkWin();
  if($isWon) {
    winMessage();
  }
}

//Send the winner or tie message based on winner and isTie and multiplayer
function winMessage() {
  global $winner;
  global $isTie;
  global $multiplayer;
  global $pl;

  printf("\r\n");
  if($isTie) {
    printf ("Tie!");
  }
  else {
    if($multiplayer) {
      if($winner == $pl[0]) {
        printf ("Player 1 Wins!");
      } else {
        printf ("Player 2 Wins!");
      }
    } else {
      if($winner == $pl[0]) {
        printf ("Player Wins!");
      } else {
        printf ("Bot Wins!");
      }
    }
  }
  printf("\r\n");
}

//move function - switches between player and bot move starting with bot if they said n
function move() {
  global $whosMove;
  global $multiplayer;
  if ($whosMove == "n") {
    if ($multiplayer) {
      playerMove(1);
    } else {
      botMove();
    }
    $whosMove = "y";
  }
  else {
    playerMove(0);
    $whosMove = "n";
  }
}

//Player move function
function playerMove($p) {
  global $pl;
  global $TheBoard;

  //Ask for selection, store as $step, subtracting one so that the user chooses 1-9 not 0-8
  printf("\r\n");
  printf ("Player " . ($p + 1) . " Turn... (Enter a number 1-9)\r\n");
  $step = intval(readline()) - 1;

  //If the selected tile is empty
  if ($TheBoard[$step] == "_") {
    //set user selected tile
    $TheBoard[$step]=$pl[$p];
  }
  else {
    //restart (select another tile that is blank)
    playerMove($p);
  }
}

//Bot move function
function botMove() {
  global $TheBoard;
  global $pl;
  
  //this is set to true when the bot has decided on an empty spot to choose
  $done = false;

  printf("\r\n");
  printf ("Bot Turn...\r\n");

  //loop until done is true
  while (!$done) {
    //set the random spot to try if the middle is taken
    $r = rand(0,8);

    //if the middle is open take it
    if ($TheBoard[4] == "_") {
      //set r as it's used to print the bot's choice
      $r = 4;
      $TheBoard[$r] = $pl[1];
      //end loop
      $done = true;
    }
    else {
      //if the middle is full and the randomly chosen spot is open set it
      if ($TheBoard[$r] == "_") {
        $TheBoard[$r] = $pl[1];
        //end loop
        $done = true;
      }
    }
  }

  printf ($r + 1);
  printf("\r\n");
}

//Update the isWon winner and isTie variables based on TheBoard and winconditions
function checkWin() {
  global $isWon;
  global $winner;
  global $TheBoard;
  global $isTie;

  //this array contains the possible win conditions as strings of the 3 #s of TheBoard that must be all X or all O for a win
  $winConditions = array("012", "345", "678", "036", "147", "258", "048", "246");
  
  //for each winConditions run this loop, value being the string in winConditions we are currently on
  foreach ($winConditions as $value) {
    //Create an array $split which has 3 values, which are each one of the numbers of the three for the win condition ie "3" "4" "5" for $winConditions[2]
    $split = str_split($value);
    //create an array $values which holds the current value of the board for each of the three spots for the wincondition ie "X" "X" "X" or "X" "O" "_"
    $values = array($TheBoard[$split[0]], $TheBoard[$split[1]], $TheBoard[$split[2]]);
    //if $values has 3 of the same value and is not all _ then we have a winner
    if(($values[0] != "_") && ($values[0] == $values[1]) && $values[2] == $values[0]) {
      $isWon = true;
      //set winner based on what non-_ character filled all 3 of the wincondition spots
      $winner = $values[0];
    }
  }
  //If the whole board is full (no _) and there is no winner, set the game as "won" to end the main loop, and set as a tie for the announcer
  if (!in_array('_', $TheBoard) && !$isWon) {
    $isWon = true;
    $isTie = true;
  }
}

//Print the current board
function print_board()
{
  global $TheBoard;

  printf("\r\n");
  printf("%s %s %s", $TheBoard[0], $TheBoard[1], $TheBoard[2]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[3], $TheBoard[4], $TheBoard[5]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[6], $TheBoard[7], $TheBoard[8]);
  printf("\r\n");
}
                        
?>