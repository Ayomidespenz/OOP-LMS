<?php

require_once 'LibraryItem.php';
require_once 'Borrowable.php';

class Book extends LibraryItem implements Borrowable {
    private $author;
    private $publisher;
    private $publicationYear;
    private $borrowingHistory = [];

    public function __construct($title, $author, $isbn, $publisher, $publicationYear, $totalCopies = 1) {
        parent::__construct($title, $isbn, $totalCopies);
        $this->author = $author;
        $this->publisher = $publisher;
        $this->publicationYear = $publicationYear;
    }

    // Getters
    public function getAuthor() {
        return $this->author;
    }
    public function getPublisher() {
        return $this->publisher;
    }
    public function getPublicationYear() {
        return $this->publicationYear;
    }
    // Setters
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }
    public function setPublicationYear($publicationYear) {
        $this->publicationYear = $publicationYear;
    }
    // Implementation of abstract method from LibraryItem
    public function getDetails() {
        return [
            'type' => 'Book',
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'publisher' => $this->publisher,
            'publicationYear' => $this->publicationYear,
            'availableCopies' => $this->availableCopies,
            'totalCopies' => $this->totalCopies,
            'dateAdded' => $this->dateAdded->format('Y-m-d H:i:s')
        ];
    }
    // Implementation of Borrowable interface methods
    public function borrowItem($member) {
        if ($this->isAvailable() && $member->canBorrow()) {
            if ($this->borrowCopy()) {
                $borrowing = new Borrowing($this, $member);
                $this->borrowingHistory[] = $borrowing;
                $member->addBorrowedBook($this);
                return $borrowing;
            }
        }
        return false;
    }
    public function returnItem($member) {
        if ($member->hasBorrowedBook($this)) {
            if ($this->returnCopy()) {
                // Find and mark the borrowing as returned
                foreach ($this->borrowingHistory as $borrowing) {
                    if ($borrowing->getMember() === $member && !$borrowing->isReturned()) {
                        $borrowing->returnItem();
                        $member->removeBorrowedBook($this);
                        return true;
                    }
                }
            }
        }
        return false;
    }
    public function getBorrowingHistory() {
        return $this->borrowingHistory;
    }
    // Additional method for book-specific functionality
    public function getBookInfo() {
        $details = $this->getDetails();
        return "Book: {$details['title']} by {$details['author']} ({$details['publicationYear']}) - ISBN: {$details['isbn']}";
    }
} 