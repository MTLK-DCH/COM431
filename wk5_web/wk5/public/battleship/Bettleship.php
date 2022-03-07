<?php
// start session
session_start();

// define the size and the number of attempt
const BOARDSIZE = 5;
const Guess = 5;

// This function calculates a random position
function random_pos()
{
    return rand(0, BOARDSIZE - 1);
}

// This function checks a postion is valid
function on_board($row, $col): bool
{
    if (($row < 0) || ($row >= BOARDSIZE) ||
        ($col < 0) || ($col >= BOARDSIZE) ||
        ($col == NULL) || ($row == NULL)
    ) {
        return false;
    } else {
        return true;
    }
}

// receive user input and parse it
parse_str($_POST["data"], $guess);

if (!isset($_SESSION['game_data'])) {
    // stating up the game
    // initialise board
    // define the data structure of game

    $game_data = [
        'board' => array_fill(0, BOARDSIZE, array_fill(0, BOARDSIZE, "🌫️")),
        'ship_row' => random_pos(),
        'ship_col' => random_pos(),
        'turn' => 0,
        'message' => "Try to sink my ship! Choose some coordinates.",
        'status' => 'play',
        'name' => $guess["userName"],
    ];
    $_SESSION['game_data'] = $game_data;
} else {
    // The game has started previously
    // Now, recover the game data from the superglobal as we have an ongoing game

    $game_data = $_SESSION['game_data'];
    // updata turn
    $game_data['turn']++;

    // Validation
    if (!on_board($guess['row'], $guess['col'])) {
        $game_data['message'] = "Oops, that's not even in the ocean.";
    } else if (($guess['col']) == ($game_data['col']) && ($guess['row'] == $game_data['row'])) {
        $game_data['board'][$guess['row']][$guess['col']] = '💥';
        $game_data['status'] = "won";
        $game_data['message'] = "Congratulations! You sank my ship!";
    } else if ($game_data['board'][$guess['row']][$guess['col']] == '🌊') {
        $game_data['message'] = "You guessed that one already.";
        // is it the last tuen?
        if ($game_data['turn'] == GUESSES) {
            $game_data['status'] = 'lost';
        }
    } else {
        $game_data['message'] = "You missed my bettleship!";
        $game_data['board'][$guess['row']][$guess['col']] = '🌊';
        // Is it the last turn?
        if ($game_data['turn'] == GUESSES) {
            $game_data['status'] = "lost";
            $game_data['message'] .= "Game Over!";
            $game_data['board'][$game_data['ship_row']][$game_data['ship_col']] = '⛴️';
        }
    }
    // Prepare for next turn
    $game_data['message'] = "This was turn " . $game_data['turn'] . "of" . GUESSES;
    // Is it the last turn?
    if($game_data['turn']==GUESSES){
        $game_data['status']='lost';
    }
    $_SESSION['game_data']=$game_data;
}

// return the game state to front end, the UI for update
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
echo json_encode($game_data);

// In the end, destroy the session
if($game_data['status']!='play'){
    $_SESSION=[];
    session_destroy();
}

