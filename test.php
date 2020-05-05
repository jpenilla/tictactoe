<?php
$TheBoard=array(9);

//Initializing the board
for ($i=0;$i<9;$i++) $TheBoard[$i]='_';

printf("Welcome to TIC-TAC-TOE EXTREME Lite\r\n");
printf ("Player Turn...\r\n");

print_board();


$step = readline();
$TheBoard[intval($step)]='X';
$TheBoard[4]='O';
print_board();



printf ("Player Turn...\r\n");
$step = readline();
$TheBoard[intval($step)]='X';
$TheBoard[8]='O';
print_board();

printf ("Player Turn...\r\n");
$step = readline();
$TheBoard[intval($step)]='X';
print_board();
printf("\r\nWINNER!!");

function print_board()
{
  global $TheBoard;

  printf("%s %s %s", $TheBoard[0], $TheBoard[1], $TheBoard[2]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[3], $TheBoard[4], $TheBoard[5]);
  printf("\r\n");
  printf("%s %s %s", $TheBoard[6], $TheBoard[7], $TheBoard[8]);
  printf("\r\n");
}     
                        
?>

