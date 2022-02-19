<?php

class Cards{

    // An array of ranks 点数
    private const ranks = [2, 3, 4, 5, 6, 7, 8, 9, 10, "Jack", "Queen", "King", "Ace"];
    // An array of suits 花色
    // Hearts:红桃 Diamonds:方片 Clubs:梅花 Spades:黑桃
    private const suits = ["Hearts", "Diamonds", "Clubs", "Spades"];

    // current card info
    private $rank;
    private $suit;


    // methods
    // construction
    public function __construct($rank = 0, $suit = 0){
        // default: 2 of Hearts (rank[0], suit[0])
        $this->rank = $rank;
        $this->suit = $suit;
    }
    // gets
    public function getRank(){
        return Cards::ranks[$this->rank];
    }
    public function getSuit(){
        return Cards::suits[$this->suit];
    }
    // toString
    public function __toString(){
        // to tell PHP the way to desplay this object when print it or echo it
        return "{$this->getRank()} of {$this->getSuit()}\n";
    }

    // judge
    public static function eq(Cards $a, Cards $b){
        if ($a->rank == $b->rank){
            return true;
        }
        else{
            return false;
        }
    }
    public static function gt(Cards $a, Cards $b){
        if ($a->rank > $b->rank){
            return true;
        }
        else {
            return false;
        }
    }
    public static function lt(Cards $a, Cards$b){
        if($a->rank < $b->rank){
            return true;
        }
        else {
            return false;
        }
    }
}

// test 1
// $test = new Cards();
// echo $test;

// test2
// $card1 = new Cards(12, 3);
// $card2 = new Cards(12, 0);

// print $card1."\n";
// print $card2."\n";

// if (Cards::eq($card1, $card2)){
//     echo "$card1 is equal rank to $card2\n";
// }
// else{
//     echo"$card1 is not equal rank to $card2\n";
//     if (Cards::gt($card1, $card2)){
//         echo "$card1 is greater rank than $card2\n";
//     }
//     if (Cards::lt($card1, $card2)){
//         echo "$card1 is less rank than $card2\n";
//     }
// }


class Deck{

    protected $cards = [];

    // create 52 cards
    public function __construct(){
        for($suit = 0; $suit < 4; $suit++){
            for($rank = 0; $rank < 13; $rank++){
                $this->cards[] = new Cards($rank, $suit);
            }
        }
    }

    // deal cards from deck
    public function deal(){
        return array_pop($this->cards);
    }

    // judge if the deck is empty
    public function isEmpty(){
        return count($this->cards) == 0;
    }

    // shuffle the cards in the deck
    public function shuffle(){
        return shuffle($this->cards);
    }

    // print the deck
    public function __toString(){
        $output = "";
        foreach($this->cards as $card){
            $output .= $card ."\n";
        }
        return $output;
    }
}

// test 3
// $deck1 = new Deck();
// print $deck1;
// $deck1->shuffle();
// print $deck1;
// $card1 = $deck1->deal();
// $card2 = $deck1->deal();

// print $card1."\n";
// print $card2;


// The cards held by players
class Hand extends Deck{
    public $label;

    // construct a hand of cards
    public function __construct($label = ''){
        $this->label = $label;
        $this->cards = [];
    }
    // add a card to hand
    public function addCard(Cards $card){
        $this->cards[] = $card;
    }
}


// test 4
// $deck = new Deck();
// $deck->shuffle();
// $hand = new Hand("Joe");
// print "Dealing {$hand->label}'s cards\n";
// for ($x = 0; $x < 3; $x++){
//     $hand->addCard($deck->deal());
// }

// print "{$hand->label}'s hand\n";
// print "{$hand->deal()}";
// print "{$hand->deal()}";
// print "{$hand->deal()}";

?>