<?
/*
Use the class defined in cards.php to implement an additional game, Blackjack! A player is initially dealt two cards and is informed of the sum of the value of their rank.  Numbered cards (2,3,4,..) have value equal to their rank, while Jack, Queen and King have a value of 10 and Ace has a value of 11.  For example the Queen of Hearts and the 9 of spades would give a total of 18.  The objective of the game is to keep accepting cards until their total value is as close as possible to 21, without exceeding 21.  The game can be won in 3 ways: 

Receiving the King and Ace of Spades in the initial deal (Blackjack!). 

Accepting 5 cards without exceeding the total value of 21 

Having a score of 21 or lower which is higher than the score of the dealer. 

If the players “stands” (refuses the next card) while on a legal score, then the dealer is assigned a random number between 16 and 21 (inclusive).  If the player score is higher than the dealer’s, the player wins, otherwise the player loses. 
*/

// Defination: Ace is 11

require("../Cards/cards.php");

// Prepare the deck
$deck = new Deck();
$deck->shuffle();

// mark the num of players
$numOfPlayers = 0;
// input the num of players
do{
    echo "Please input the num of players";
    $numOfPlayers = fgets(STDIN);
}
while(is_numeric($numOfPlayers) && $numOfPlayers > 0);

// class of player
class Player extends Hand{
    private $stand = false;
    // This is the sum of the ranks of cards
    private $sum = 0;
    private $lost = false;

    // Asking for stand
    public function Stand(){
        // If the sum of dealer's card is less than 16, then the dealer cannot stand
        if ($this->label != "dealer" || $this->sum >= 16){
            do{
            echo "Are you willing to stand? (Y/N)";
            $choice = fgetc(STDIN);
            if ($choice == 'Y'){
                $this->stand = true;
            }
        }
        while($choice == 'Y' || $choice == 'N');
        }

    }

    // Judge if player is lost before the game terminate
    public function Lost(){
        foreach($this->cards as $card){
            if($card->getRank() < 9){
                $this->sum += ($card->getRank() + 2);
            }
            elseif($card->getRank() < 12){
                $this->sum += 10;
            }
            else{
                $this->sum += 11;
            }
        }
        if($this->sum > 21){
            $this->lost = true;
            echo "Bust ". $this->label. " is lost.";
        }
    }
    public function isStand(){
        return $this->stand;
    }
    public function isLost(){
        return $this->lost;
    }
}

// players (hands)
$dealer = new Hand("dealer");
$players = [];
$plarers[] = $dealer;
for ($i = 0; $i < $numOfPlayers; $i++){
    echo "Please input the name of player". ($i + 1);
    $name = fgets(STDIN);
    $players[] = new Player($name);
}


// First Deal
foreach($players as $player){
    $player->addCard($deck->deal());
    $player->addCard($deck->deal());
    $player->Lost();
}

// This is the mark of endding of the game
$end = false;

// BlackJack
foreach($plarers as $player){
    if($player->sum == 21){
        echo "BlackJack!!!\n". $player->label. " is WINNER!";
        $end = true;
    }
}


// Start
// 'i' is the mark of turn
$i = 0;
while($end == false && $i < 5){
    // Play
    foreach($players as $player){
        if ($player->lost == false && $player->stand == false){
            echo "Is ". $player->label. "'s turn.";
            $player->Stand();
            $player->addCard($deck->deal());
            $player->Lost();
            if ($player->label == "dealer" && $player->isLost()){
                $end = true;
                echo "Dealer bust, all players win.";
                break;
            }
        }
    }

    // Judge if the game is terminate before deal 5 cards
    // $j = 0;
    // foreach($players as $player){
    //     if($player->)
    // }
    $i++;
}


?>