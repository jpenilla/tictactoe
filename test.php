<?php
$TheBoard=array(9);
$isWon = false;

//Initializing the board
for ($i=0;$i<9;$i++) $TheBoard[$i]='_';

printf("Welcome to TIC-TAC-TOE EXTREME Lite\r\n");

print_board();

playerMove();

botMove();

print_board();

playerMove();

botMove();

print_board();

playerMove();

print_board();
printf("\r\nWINNER!!");

function playerMove() {
  global $TheBoard;

  printf ("Player Turn...\r\n");

  $step = intval(readline());

  if ($TheBoard[$step] == "_")
    //set user selected tile to X
    $TheBoard[$step]='X';
  else
    playerMove();
}

function botMove() {
  global $TheBoard;
  $done = false;
  while (!$done) {
    $r = rand(0,8);
    if ($TheBoard[$r] == "_")
      $TheBoard[$r] = 'O';
      $done = true;
  } 
}

function print_board()
{
  global $TheBoard;
  global $isWon;

  printf("%s %s %s", $TheBoard[0], $TheBoard[1], $TheBoard[2]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[3], $TheBoard[4], $TheBoard[5]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[6], $TheBoard[7], $TheBoard[8]);
  printf("\r\n");
  printf($isWon);
}
                        
?>

