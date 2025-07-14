<?php

require_once 'Borrowable.php';
require_once 'LibraryItem.php';
require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Member.php';
require_once 'Library.php';
require_once 'Borrowing.php';

// Initialize library and demo data (in-memory for demo)

$library = new Library();
$books = [
    new Book("Things Fall Apart", "Chinue Achebe", "B001", "Heinemann", 1958, 3),
    new Book("Broken", "Fatimah Balla", "B002", "Cassava Republic", 2015, 2),
    new Book("Half of a Yellow Sun", "Chimamanda Ngozi Adichie", "B003", "Knopf", 2006, 4),
    new Book("The Alchemist", "Paulo Coelho", "B004", "HarperCollins", 1988, 5),
    new Book("Purple Hibiscus", "Chimamanda Ngozi Adichie", "B005", "Algonquin Books", 2003, 2),
    new Book("The Great Gatsby", "F. Scott Fitzgerald", "B006", "Scribner", 1925, 3)
];
foreach ($books as $b) $library->addBook($b);
$magazines = [
    new Magazine("Khloe takes New York", "M001", "001", "Editor A", "July 2025", 2),
    new Magazine("Science Today", "M002", "002", "Editor B", "August 2025", 2),
    new Magazine("Tech World", "M003", "003", "Editor C", "September 2025", 2),
    new Magazine("Art Monthly", "M004", "004", "Editor D", "October 2025", 2),
    new Magazine("History Digest", "M005", "005", "Editor E", "November 2025", 2)
];
foreach ($magazines as $m) $library->addMagazine($m);
$members = [
    new Member("M001", "Quadri", "quadri@example.com"),
    new Member("M002", "Ayomide", "ayomide@example.com"),
    new Member("M003", "Buhari", "buhari@example.com")
];
foreach ($members as $mem) $library->registerMember($mem);

// Borrowings (demo)
$borrowings = [];
$books[0]->borrowItem($members[0]); $borrowings[] = new Borrowing($books[0], $members[0]);
$books[1]->borrowItem($members[1]); $borrowings[] = new Borrowing($books[1], $members[1]);
$books[2]->borrowItem($members[2]); $borrowings[] = new Borrowing($books[2], $members[2]);
$magazines[0]->borrowItem($members[0]); $borrowings[] = new Borrowing($magazines[0], $members[0]);
$magazines[1]->borrowItem($members[1]); $borrowings[] = new Borrowing($magazines[1], $members[1]);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <!-- Registration Modal -->
    <div id="registerModal" class="modal" style="display:none;position:fixed;z-index:1000;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.4);align-items:center;justify-content:center;">
        <div style="background:#fff;padding:32px 24px;border-radius:8px;max-width:400px;width:90%;box-shadow:0 4px 24px rgba(0,0,0,0.12);position:relative;">
            <h2 style="margin-top:0;">Register New Member</h2>
            <form id="registerForm" method="post" action="">
                <label for="memberId">Member ID</label>
                <input type="text" id="memberId" name="memberId" required>
                <label for="memberName">Name</label>
                <input type="text" id="memberName" name="memberName" required>
                <label for="memberEmail">Email</label>
                <input type="email" id="memberEmail" name="memberEmail" required>
                <div style="margin-top:18px;display:flex;gap:10px;">
                    <button type="submit">Register</button>
                    <button type="button" onclick="closeModal()" style="background:#ccc;color:#222;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <h1>📚 Library Management System</h1>
    <hr>
    <div class="library-section">
        <h2>Books</h2>
        <table class="table">
            <tr><th>Title</th><th>Author</th><th>Available</th><th>Total</th><th>Status</th></tr>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                <td><?= $book->getAvailableCopies() ?></td>
                <td><?= $book->getTotalCopies() ?></td>
                <td class="<?= $book->isAvailable() ? 'status-available' : 'status-unavailable' ?>">
                    <?= $book->isAvailable() ? 'Available' : 'Unavailable' ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="library-section">
        <h2>Magazines</h2>
        <table class="table">
            <tr><th>Title</th><th>Editor</th><th>Issue #</th><th>Publication Date</th><th>Available</th><th>Total</th><th>Status</th></tr>
            <?php foreach ($magazines as $mag): ?>
            <tr>
                <td><?= htmlspecialchars($mag->getTitle()) ?></td>
                <td><?= htmlspecialchars($mag->getEditor()) ?></td>
                <td><?= htmlspecialchars($mag->getIssueNumber()) ?></td>
                <td><?= htmlspecialchars($mag->getPublicationDate()) ?></td>
                <td><?= $mag->getAvailableCopies() ?></td>
                <td><?= $mag->getTotalCopies() ?></td>
                <td class="<?= $mag->isAvailable() ? 'status-available' : 'status-unavailable' ?>">
                    <?= $mag->isAvailable() ? 'Available' : 'Unavailable' ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="library-section">
        <h2 style="display:flex;align-items:center;justify-content:space-between;">
            <span>Members</span>
            <button onclick="openModal()" style="font-size:0.95rem;padding:7px 18px;">+ Register Member</button>
        </h2>
        <table class="table">
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
            <?php foreach ($members as $mem): ?>
            <tr>
                <td><?= htmlspecialchars($mem->getId()) ?></td>
                <td><?= htmlspecialchars($mem->getName()) ?></td>
                <td><?= htmlspecialchars($mem->getEmail()) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="library-section">
        <h2>Borrowed Items Report</h2>
        <table class="table">
            <tr><th>Member</th><th>Item</th><th>Borrow Date</th></tr>
            <?php foreach ($borrowings as $borrowing): ?>
            <tr>
                <td><?= htmlspecialchars($borrowing->getMember()->getName()) ?></td>
                <td><?= htmlspecialchars($borrowing->getBook()->getTitle()) ?></td>
                <td><?= htmlspecialchars($borrowing->getBorrowDate()->format('Y-m-d')) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <!-- Optionally, add a summary or statistics section here if you implement such a method in Library class -->
</div>
</body>
<script>
function openModal() {
    document.getElementById('registerModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('registerModal').style.display = 'none';
}
// Optional: Close modal on outside click
window.onclick = function(event) {
    var modal = document.getElementById('registerModal');
    if (event.target === modal) { modal.style.display = 'none'; }
}
</script>
</html>