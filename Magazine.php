    public function getIsbn() {
        return $this->isbn;
    }
<?php

require_once 'LibraryItem.php';
require_once 'Borrowable.php';

class Magazine extends LibraryItem implements Borrowable {
    private $issueNumber;
    private $editor;
    private $publicationDate;
    private $borrowingHistory = [];

    public function __construct($title, $isbn, $issueNumber, $editor, $publicationDate, $totalCopies = 1) {
        parent::__construct($title, $isbn, $totalCopies);
        $this->issueNumber = $issueNumber;
        $this->editor = $editor;
        $this->publicationDate = $publicationDate;
    }

    // Getters
    public function getIssueNumber() {
        return $this->issueNumber;
    }
    public function getEditor() {
        return $this->editor;
    }
    public function getPublicationDate() {
        return $this->publicationDate;
    }
    // Setters
    public function setIssueNumber($issueNumber) {
        $this->issueNumber = $issueNumber;
    }
    public function setEditor($editor) {
        $this->editor = $editor;
    }
    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;
    }
    // Implementation of abstract method from LibraryItem
    public function getDetails() {
        return [
            'type' => 'Magazine',
            'title' => $this->title,
          
            'issueNumber' => $this->issueNumber,
            'editor' => $this->editor,
            'publicationDate' => $this->publicationDate,
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
    // Additional method for magazine-specific functionality
    public function getMagazineInfo() {
        $details = $this->getDetails();
        return "Magazine: {$details['title']} - Issue #{$details['issueNumber']} ({$details['publicationDate']}) - Editor: {$details['editor']}";
    }
} 