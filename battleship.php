
<?php
const BOARDSIZE = 5; 
const GUESSES = 5; 
$board = array_fill(0,BOARDSIZE,array_fill(0,BOARDSIZE,"🌫")); 

print ("Let's play Battleships!\n"); 
print($board); 

function print_board($board){ 

foreach($board as $row){ 

    foreach($row as $element){ 

        print("$element"); 

    } 

    print("\n"); 

} 

} 

print_board($board); 

function random_pos(){ 

return rand(0, BOARDSIZE-1); 

} 
 

$ship_row = random_pos(); 

$ship_col = random_pos(); 

printf ("Battleship at (%s,%s)\n",$ship_row,$ship_col); 

$guess_row = readline("Guess a row: "); 

$guess_col = readline("Guess a column: "); 

if(($guess_row == $ship_row)&&($guess_col == $ship_col)){ 

    print ("Congratulations! You sunk my battleship!\n"); 

} 

else { 

    print ("You missed my battleship!\n"); 

    $board[$guess_row][$guess_col] = "🌊"; 

} 

print_board($board); 


for($turn=1; $turn <= GUESSES; $turn++){ 

$guess_row = readline("Guess a row: "); 

$guess_col = readline("Guess a column: "); 

if(($guess_row == $ship_row)&&($guess_col == $ship_col)){ 

    print ("Congratulations! You sunk my battleship!\n"); 

    break; 

} 

else { 

    print ("You missed my battleship!\n"); 

    $board[$guess_row][$guess_col] = "🌊"; 

} 

printf ("After guess %s of %s\n",$turn,GUESSES); 

print_board($board); 

} 

print "Game Over"; 

for($turn=1; $turn <= GUESSES; $turn++){ 

$guess_row = readline("Guess a row: "); 

$guess_col = readline("Guess a column: "); 

if(($guess_row =="") || ($guess_col == "") || 

   ($guess_row < 0) || ($guess_col < 0) || 

   ($guess_row >= BOARDSIZE) || ($guess_col >= BOARDSIZE)) 

{ 

    print("Oops, that's not even in the ocean. \n"); 

} else 

if(($guess_row == $ship_row)&&($guess_col == $ship_col)){ 

    print ("Congratulations! You sunk my battleship!\n"); 

    $board[$guess_row][$guess_col] = " 💥"; 

    break; 

} 

else 

if ($board[$guess_row][$guess_col] == "🌊") { 

    print("You guesses that one already. \n"); 

} 

else 

{ 

    print ("You missed my battleship!\n"); 

    $board[$guess_row][$guess_col] = "🌊"; 

    if ($turn == GUESSES){ 

        print("Game over!\n"); 

        $board[$ship_row][$ship_col] = "⛴"; 

    } 

} 

printf ("This was turn %s of %s\n",$turn,GUESSES); 

print_board($board); 

} 
?>