<?php

class Borrowing {
    private $book;
    private $member;
    private $borrowDate;
    private $dueDate;
    private $returnDate;
    private $isReturned = false;
    private $borrowingId;

    public function __construct($book, $member, $borrowingPeriod = 14) {
        $this->book = $book;
        $this->member = $member;
        $this->borrowDate = new DateTime();
        $this->dueDate = (new DateTime())->add(new DateInterval("P{$borrowingPeriod}D"));
        $this->borrowingId = uniqid('BORROW_');
    }

    // Getters
    public function getBook() {
        return $this->book;
    }
    public function getMember() {
        return $this->member;
    }
    public function getBorrowDate() {
        return $this->borrowDate;
    }
    public function getDueDate() {
        return $this->dueDate;
    }
    public function getReturnDate() {
        return $this->returnDate;
    }
    public function isReturned() {
        return $this->isReturned;
    }
    public function getBorrowingId() {
        return $this->borrowingId;
    }
    // Method to return the item
    public function returnItem() {
        if (!$this->isReturned) {
            $this->returnDate = new DateTime();
            $this->isReturned = true;
            return true;
        }
        return false;
    }
    // Method to check if the borrowing is overdue
    public function isOverdue() {
        if ($this->isReturned) {
            return false;
        }
        $now = new DateTime();
        return $now > $this->dueDate;
    }
    // Method to get days overdue
    public function getDaysOverdue() {
        if ($this->isReturned || !$this->isOverdue()) {
            return 0;
        }
        $now = new DateTime();
        $interval = $now->diff($this->dueDate);
        return $interval->days;
    }
    // Method to get borrowing details
    public function getBorrowingDetails() {
        $details = [
            'borrowingId' => $this->borrowingId,
            'bookTitle' => $this->book->getTitle(),
            'memberName' => $this->member->getName(),
            'memberId' => $this->member->getMemberId(),
            'borrowDate' => $this->borrowDate->format('Y-m-d H:i:s'),
            'dueDate' => $this->dueDate->format('Y-m-d H:i:s'),
            'isReturned' => $this->isReturned,
            'isOverdue' => $this->isOverdue(),
            'daysOverdue' => $this->getDaysOverdue()
        ];
        if ($this->isReturned) {
            $details['returnDate'] = $this->returnDate->format('Y-m-d H:i:s');
        }
        return $details;
    }
    // Method to get borrowing summary
    public function getBorrowingSummary() {
        $details = $this->getBorrowingDetails();
        $status = $this->isReturned ? 'Returned' : ($this->isOverdue() ? 'Overdue' : 'Active');
        return "Borrowing #{$details['borrowingId']}: {$details['bookTitle']} borrowed by {$details['memberName']} - Status: {$status}";
    }
    // Method to calculate fine (if overdue)
    public function calculateFine($dailyRate = 1.00) {
        if ($this->isReturned || !$this->isOverdue()) {
            return 0.00;
        }
        return $this->getDaysOverdue() * $dailyRate;
    }
} 