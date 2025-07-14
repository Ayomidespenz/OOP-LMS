<?php

interface Borrowable {
    public function borrowItem($member);
    public function returnItem($member);
    public function getBorrowingHistory();
} 