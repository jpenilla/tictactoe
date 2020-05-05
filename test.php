<?php
$TheBoard=array(9);
$isWon = false;
$winner = "";
$isTie = false;

//Initializing the board
for ($i=0;$i<9;$i++) $TheBoard[$i]='_';

printf("Welcome to TIC-TAC-TOE EXTREME Lite\r\n");

printf("\r\n");
printf ("Would you like to go first? (y/n)");

$whoFirst = readline();

print_board();

while(!$isWon) {
  if ($whoFirst == "y") {
    playerMove();
    print_board();
  }
  else {
    botMove();
    print_board();
  }

  checkWin();
  if($isWon) {
    winMessage();
  }
  else {
    if ($whoFirst == "y") {
      botMove();
      print_board();
    }
    else {
      playerMove();
      print_board();
    }
    
    checkWin();
    if($isWon) {
      winMessage();
    }
  }
}

function winMessage() {
  global $winner;
  global $isTie;

  printf("\r\n");
  if($isTie) {
    printf ("Tie!");
  }
  else {
    if($winner == "X") {
      printf ("Player Wins!");
    } else {
      printf ("Bot Wins!");
    }
  }
  printf("\r\n");
}

function playerMove() {
  global $TheBoard;

  printf("\r\n");
  printf ("Player Turn...\r\n");

  $step = intval(readline()) - 1;

  if ($TheBoard[$step] == "_")
    //set user selected tile to X
    $TheBoard[$step]='X';
  else
    playerMove();
}

function botMove() {
  global $TheBoard;
  $done = false;

  printf("\r\n");
  printf ("Bot Turn...\r\n");

  while (!$done) {
    $r = rand(0,8);
    if ($TheBoard[4] == "_") {
      $r = 4;
      $TheBoard[$r] = 'O';
      $done = true;
    }
    else {
      if ($TheBoard[$r] == "_") {
        $TheBoard[$r] = 'O';
        $done = true;
      }
    }
  }

  printf ($r + 1);
  printf("\r\n");
}

function checkWin() {
  global $isWon;
  global $winner;
  global $TheBoard;
  global $isTie;

  $winConditions = array("012", "345", "678", "036", "147", "258", "048", "246");
  
  foreach ($winConditions as $value) {
    $split = str_split($value);
    $values = array($TheBoard[$split[0]], $TheBoard[$split[1]], $TheBoard[$split[2]]);
    if(($values[0] != "_") && ($values[0] == $values[1]) && $values[2] == $values[0]) {
      $isWon = true;
      $winner = $values[0];
    }
  }
  if (!in_array('_', $TheBoard) && !$isWon) {
    $isWon = true;
    $isTie = true;
  }
}

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

