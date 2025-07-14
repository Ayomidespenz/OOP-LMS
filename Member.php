<?php

class Member {
    public function getId() {
        return $this->getMemberId();
    }
    private $memberId;
    private $name;
    private $email;
    private $borrowedBooks = [];
    private $maxBooksAllowed = 5;
    private $registrationDate;

    public function __construct($memberId, $name, $email) {
        $this->memberId = $memberId;
        $this->name = $name;
        $this->email = $email;
        $this->registrationDate = new DateTime();
    }

    // Getters
    public function getMemberId() {
        return $this->memberId;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getBorrowedBooks() {
        return $this->borrowedBooks;
    }
    public function getMaxBooksAllowed() {
        return $this->maxBooksAllowed;
    }
    public function getRegistrationDate() {
        return $this->registrationDate;
    }
    // Setters
    public function setName($name) {
        $this->name = $name;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setMaxBooksAllowed($maxBooks) {
        if ($maxBooks >= 0) {
            $this->maxBooksAllowed = $maxBooks;
        }
    }
    // Methods for managing borrowed books
    public function addBorrowedBook($book) {
        if (!in_array($book, $this->borrowedBooks)) {
            $this->borrowedBooks[] = $book;
            return true;
        }
        return false;
    }
    public function removeBorrowedBook($book) {
        $key = array_search($book, $this->borrowedBooks);
        if ($key !== false) {
            unset($this->borrowedBooks[$key]);
            $this->borrowedBooks = array_values($this->borrowedBooks); // Reindex array
            return true;
        }
        return false;
    }
    public function hasBorrowedBook($book) {
        return in_array($book, $this->borrowedBooks);
    }
    public function canBorrow() {
        return count($this->borrowedBooks) < $this->maxBooksAllowed;
    }
    public function getBorrowedBooksCount() {
        return count($this->borrowedBooks);
    }
    public function getMemberInfo() {
        return [
            'memberId' => $this->memberId,
            'name' => $this->name,
            'email' => $this->email,
            'borrowedBooksCount' => $this->getBorrowedBooksCount(),
            'maxBooksAllowed' => $this->maxBooksAllowed,
            'registrationDate' => $this->registrationDate->format('Y-m-d H:i:s')
        ];
    }
    public function getBorrowedBooksList() {
        $booksList = [];
        foreach ($this->borrowedBooks as $book) {
            if ($book instanceof Book) {
                $booksList[] = $book->getBookInfo();
            } elseif ($book instanceof Magazine) {
                $booksList[] = $book->getMagazineInfo();
            }
        }
        return $booksList;
    }
    // Method to check if member has overdue books
    public function hasOverdueBooks() {
        $now = new DateTime();
        foreach ($this->borrowedBooks as $book) {
            // Check if any borrowed book is overdue (assuming 14 days borrowing period)
            // This would need to be implemented with actual borrowing dates
            // For now, we'll return false as a placeholder
        }
        return false;
    }
} 