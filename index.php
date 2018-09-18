<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<?php

$suit = ['A' => 11, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 'J' => 10, 'Q' => 10, 'K' => 10];
$deck = ['hearts' => $suit, 'diamonds' => $suit, 'clubs' => $suit, 'spades' => $suit];

/*
 * Chooses a random card from the deck & removes it
 *
 * @param array $deck is the deck
 *
 * return array is card value, card suit, & the new deck
 */
function pickOneCard(array $deck) : array {
    $suit = array_rand($deck);
    $card = array_rand($deck[$suit]);
    unset($deck[$suit][$card]);
    return [$card, $suit, $deck];
}

/*
 * Draws 2 card & adds scores, plus a third if score below 14
 *
 * @param int $playerNo is the player number
 * @param array $deck is the deck you draw from
 *
 * return array is the score, & the new deck
 */
function deal(int $playerNo, array $deck) : array {
    echo '<h2>Player ' . $playerNo . '</h2><section>';

    $card1 = pickOneCard($deck);
    echo '<div class="card card1 ' . ' ' . $card1[1] . '">' . $card1[0] . '<br></div>';
    $score = $deck[$card1[1]][$card1[0]];
    $deck = $card1[2];
    $hand[] = $card1;

    $card2 = pickOneCard($deck);
    echo '<div class="card card2 ' . ' ' . $card2[1] . '">' . $card2[0] . '<br></div>';
    $score += $deck[$card2[1]][$card2[0]];
    $deck = $card2[2];
    $hand[] = $card2;
    $score = revalueAces($hand, $score);

    if ($score < 14) {
        $card3 = pickOneCard($deck);
        echo '<div class="card card3 ' . ' ' . $card3[1] . '">' . $card3[0] . '<br></div>';
        $score += $deck[$card3[1]][$card3[0]];
        $deck = $card3[2];
        $hand[] = $card3;
        $score = revalueAces($hand, $score);
    }

    echo '</section><h2>' . $score . '</h2>';
    if ($score > 21) {
        $score = 0;
    }
    return [$score, $deck];
}

/*
 * Reduces ace score by 10 if over 21
 *
 * @param array $hand is the currently drawn cards
 * @param int $score is the current score
 *
 * return int is the new score
 */
function revalueAces(array $hand, int $score) : int {
    foreach ($hand as $x) {
        if ($x[0] == 'A' && $score > 21) {
            $score -= 10;
        }
    }
    return $score;
}

$play1 = deal(1, $deck);
$score1 = $play1[0];
$deck = $play1[1];

$play2 = deal(2, $deck);
$score2 = $play2[0];
$deck = $play2[1];


if ($score1 > $score2) {
    echo '<h2>Player 1 wins!</h2>';
} elseif ($score1 < $score2) {
    echo '<h2>Player 2 wins!</h2>';
} else {
    echo '<h2>No-one wins!</h2>';
}
?>
</body>
