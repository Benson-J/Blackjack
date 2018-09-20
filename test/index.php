<?php

require('../index.php');

use PHPUnit\Framework\TestCase;


class StackTest extends TestCase {
    const SUIT = ['A' => 11, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, 'J' => 10, 'Q' => 10, 'K' => 10];
    const DECK = ['hearts' => self::SUIT, 'diams' => self::SUIT, 'clubs' => self::SUIT, 'spades' => self::SUIT];

    public function testpickOneCard_success() {
        $card = pickOneCard(self::DECK);
        $this->assertCount(3, $card);
        $this->assertInternalType('string', $card[0]);
        $this->assertInternalType('string', $card[1]);
        $this->assertInternalType('array', $card[2]);
    }

    public function testpickOneCard_failure() {
        $card = pickOneCard([]);
        $this->expectException(InvalidArgumentException::class);
    }
}