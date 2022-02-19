<?
require("cards.php");
$deck = new Deck();
$deck->shuffle();
$lastCard = $deck->deal();
print $lastCard;

$snaps = 0;
while (!$deck->isEmpty()){
    $thisCard = $deck->deal();
    print $thisCard;
    if($lastCard->getRank() == $thisCard->getRank()){
        print("SNAP!!!\n");
        $snaps++;
    }
    $lastCard = $thisCard;
}
printf("We had %s snaps\n", $snaps);
?>