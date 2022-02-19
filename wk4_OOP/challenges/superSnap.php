<?
require("../Cards/cards.php");
$deck = new Deck();
$deck->shuffle();
$lastCard = $deck->deal();
print $lastCard;

$snaps = 0;
// add a mark of superSnap
$supersnaps = 0;

while (!$deck->isEmpty()){
    $thisCard = $deck->deal();
    print $thisCard;
    if($lastCard->getRank() == $thisCard->getRank()){
        // add a additional if statement to judge if supersnap
        // The supersnap is 2 same color snap cards
        // suits = ["Hearts", "Diamonds", "Clubs", "Spades"]
        if ($lastCard->getSuit() == "Hearts" && ($thisCard->getSuit() == "Hearts" || $thisCard->getSuit() == "Diamonds")){
            print("SUPERSNAP!!!");
            $snaps++;
            $supersnaps++;
        }
        elseif ($lastCard->getSuit() == "Diamonds" && ($thisCard->getSuit() == "Hearts" || $thisCard->getSuit() == "Diamonds")){
            print("SUPERSNAP!!!");
            $snaps++;
            $supersnaps++;
        }
        elseif ($lastCard->getSuit() == "Clubs" && ($thisCard->getSuit() == "Clubs" || $thisCard->getSuit() == "Spades")){
            print("SUPERSNAP!!!");
            $snaps++;
            $supersnaps++;
        }elseif ($lastCard->getSuit() == "Spades" && ($thisCard->getSuit() == "Spades" || $thisCard->getSuit() == "Clubs")){
            print("SUPERSNAP!!!");
            $snaps++;
            $supersnaps++;
        }
        else{
            print("SNAP!!!\n");
            $snaps++;
        }
        
    }
    $lastCard = $thisCard;
    
}
printf("We had %s snaps including %s supersnaps\n", $snaps, $supersnaps);
?>