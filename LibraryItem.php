<?php

abstract class LibraryItem {
    protected $title;
    protected $isbn;
    protected $availableCopies;
    protected $totalCopies;
    protected $dateAdded;

    public function __construct($title, $isbn, $totalCopies = 1) {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->totalCopies = $totalCopies;
        $this->availableCopies = $totalCopies;
        $this->dateAdded = new DateTime();
    }

    // Getters
    public function getTitle() {
        return $this->title;
    }
    public function getIsbn() {
        return $this->isbn;
    }
    public function getAvailableCopies() {
        return $this->availableCopies;
    }
    public function getTotalCopies() {
        return $this->totalCopies;
    }
    public function getDateAdded() {
        return $this->dateAdded;
    }
    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }
    public function setTotalCopies($totalCopies) {
        if ($totalCopies >= 0) {
            $this->totalCopies = $totalCopies;
            $this->availableCopies = $totalCopies;
        }
    }
    // Abstract method that must be implemented by child classes
    abstract public function getDetails();
    // Method to check if item is available for borrowing
    public function isAvailable() {
        return $this->availableCopies > 0;
    }
    // Method to decrease available copies (when borrowing)
    public function borrowCopy() {
        if ($this->availableCopies > 0) {
            $this->availableCopies--;
            return true;
        }
        return false;
    }
    // Method to increase available copies (when returning)
    public function returnCopy() {
        if ($this->availableCopies < $this->totalCopies) {
            $this->availableCopies++;
            return true;
        }
        return false;
    }
} 