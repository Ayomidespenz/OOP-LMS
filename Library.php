<?php

require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Member.php';
require_once 'Borrowing.php';

class Library {
    private $books = [];
    private $magazines = [];
    private $members = [];
    private $borrowings = [];
    private $libraryName;

    public function __construct($libraryName = "Central Library") {
        $this->libraryName = $libraryName;
    }

    // Getters
    public function getLibraryName() {
        return $this->libraryName;
    }
    public function getBooks() {
        return $this->books;
    }
    public function getMagazines() {
        return $this->magazines;
    }
    public function getMembers() {
        return $this->members;
    }
    public function getBorrowings() {
        return $this->borrowings;
    }
    // Book management methods
    public function addBook($book) {
        if ($book instanceof Book) {
            $this->books[] = $book;
            return true;
        }
        return false;
    }
    public function removeBook($book) {
        $key = array_search($book, $this->books);
        if ($key !== false) {
            unset($this->books[$key]);
            $this->books = array_values($this->books);
            return true;
        }
        return false;
    }
    public function findBookByIsbn($isbn) {
        foreach ($this->books as $book) {
            if ($book->getIsbn() === $isbn) {
                return $book;
            }
        }
        return null;
    }
    public function findBookByTitle($title) {
        foreach ($this->books as $book) {
            if (stripos($book->getTitle(), $title) !== false) {
                return $book;
            }
        }
        return null;
    }
    // Magazine management methods
    public function addMagazine($magazine) {
        if ($magazine instanceof Magazine) {
            $this->magazines[] = $magazine;
            return true;
        }
        return false;
    }
    public function removeMagazine($magazine) {
        $key = array_search($magazine, $this->magazines);
        if ($key !== false) {
            unset($this->magazines[$key]);
            $this->magazines = array_values($this->magazines);
            return true;
        }
        return false;
    }
    public function findMagazineByIsbn($isbn) {
        foreach ($this->magazines as $magazine) {
            if ($magazine->getIsbn() === $isbn) {
                return $magazine;
            }
        }
        return null;
    }
    // Member management methods
    public function registerMember($member) {
        if ($member instanceof Member) {
            $this->members[] = $member;
            return true;
        }
        return false;
    }
    public function unregisterMember($member) {
        $key = array_search($member, $this->members);
        if ($key !== false) {
            unset($this->members[$key]);
            $this->members = array_values($this->members);
            return true;
        }
        return false;
    }
    public function findMemberById($memberId) {
        foreach ($this->members as $member) {
            if ($member->getMemberId() === $memberId) {
                return $member;
            }
        }
        return null;
    }
    public function findMemberByEmail($email) {
        foreach ($this->members as $member) {
            if ($member->getEmail() === $email) {
                return $member;
            }
        }
        return null;
    }
    // Borrowing management methods
    public function borrowItem($item, $member) {
        if (($item instanceof Book || $item instanceof Magazine) && $member instanceof Member) {
            $borrowing = $item->borrowItem($member);
            if ($borrowing) {
                $this->borrowings[] = $borrowing;
                return $borrowing;
            }
        }
        return false;
    }
    public function returnItem($item, $member) {
        if (($item instanceof Book || $item instanceof Magazine) && $member instanceof Member) {
            return $item->returnItem($member);
        }
        return false;
    }
    // Reporting methods
    public function getLibraryReport() {
        $report = [
            'libraryName' => $this->libraryName,
            'totalBooks' => count($this->books),
            'totalMagazines' => count($this->magazines),
            'totalMembers' => count($this->members),
            'totalBorrowings' => count($this->borrowings),
            'activeBorrowings' => 0,
            'overdueBorrowings' => 0
        ];
        foreach ($this->borrowings as $borrowing) {
            if (!$borrowing->isReturned()) {
                $report['activeBorrowings']++;
                if ($borrowing->isOverdue()) {
                    $report['overdueBorrowings']++;
                }
            }
        }
        return $report;
    }
    public function getBorrowedItemsReport() {
        $report = [];
        foreach ($this->borrowings as $borrowing) {
            if (!$borrowing->isReturned()) {
                $report[] = $borrowing->getBorrowingDetails();
            }
        }
        return $report;
    }
    public function getOverdueItemsReport() {
        $report = [];
        foreach ($this->borrowings as $borrowing) {
            if (!$borrowing->isReturned() && $borrowing->isOverdue()) {
                $details = $borrowing->getBorrowingDetails();
                $details['fine'] = $borrowing->calculateFine();
                $report[] = $details;
            }
        }
        return $report;
    }
    public function getMemberReport($memberId) {
        $member = $this->findMemberById($memberId);
        if (!$member) {
            return null;
        }
        $report = [
            'memberInfo' => $member->getMemberInfo(),
            'borrowedItems' => $member->getBorrowedBooksList(),
            'borrowingHistory' => []
        ];
        foreach ($this->borrowings as $borrowing) {
            if ($borrowing->getMember() === $member) {
                $report['borrowingHistory'][] = $borrowing->getBorrowingDetails();
            }
        }
        return $report;
    }
    // Search methods
    public function searchItems($query) {
        $results = [];
        // Search in books
        foreach ($this->books as $book) {
            if (stripos($book->getTitle(), $query) !== false || 
                stripos($book->getAuthor(), $query) !== false ||
                stripos($book->getIsbn(), $query) !== false) {
                $results[] = $book->getDetails();
            }
        }
        // Search in magazines
        foreach ($this->magazines as $magazine) {
            if (stripos($magazine->getTitle(), $query) !== false || 
                stripos($magazine->getIsbn(), $query) !== false) {
                $results[] = $magazine->getDetails();
            }
        }
        return $results;
    }
    // Validation methods
    public function validateBookData($title, $author, $isbn, $publisher, $publicationYear) {
        $errors = [];
        if (empty($title)) {
            $errors[] = "Title is required";
        }
        if (empty($author)) {
            $errors[] = "Author is required";
        }
        if (empty($isbn)) {
            $errors[] = "ISBN is required";
        }
        if (empty($publisher)) {
            $errors[] = "Publisher is required";
        }
        if (!is_numeric($publicationYear) || $publicationYear < 1800 || $publicationYear > date('Y')) {
            $errors[] = "Invalid publication year";
        }
        return $errors;
    }
    public function validateMemberData($memberId, $name, $email) {
        $errors = [];
        if (empty($memberId)) {
            $errors[] = "Member ID is required";
        }
        if (empty($name)) {
            $errors[] = "Name is required";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required";
        }
        return $errors;
    }
} 