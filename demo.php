<?php

require_once 'LibraryItem.php';
require_once 'Borrowable.php';
require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Member.php';
require_once 'Borrowing.php';
require_once 'Library.php';

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>PHP OOP Library Management System - Demo</title>';
echo '<style>
body { font-family: "Segoe UI", Arial, sans-serif; background: #f6f8fa; color: #222; margin: 0; padding: 0; }
/* Dashboard layout */
.dashboard-header { background: #2d6cdf; color: #fff; padding: 1.5em 2em; border-radius: 0 0 16px 16px; box-shadow: 0 2px 8px #0001; display: flex; align-items: center; justify-content: space-between; }
.dashboard-header h1 { margin: 0; font-size: 2em; letter-spacing: 1px; }
.dashboard-nav { display: flex; gap: 1.5em; }
.dashboard-nav a { color: #fff; text-decoration: none; font-weight: 500; font-size: 1.1em; transition: color 0.2s; }
.dashboard-nav a:hover { color: #ffd700; }
.container { max-width: 1000px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px #0001; padding: 32px 40px; }
.dashboard-section { margin-bottom: 2.5em; }
h2 { color: #2d6cdf; border-bottom: 2px solid #eaeaea; padding-bottom: 0.2em; margin-top: 2em; }
h3 { color: #444; margin-top: 1.5em; }
ul { padding-left: 1.5em; }
li { margin-bottom: 0.3em; }
p, li { font-size: 1.08em; }
.success { color: #1a7f37; font-weight: bold; }
.error { color: #d73a49; font-weight: bold; }
hr { border: none; border-top: 1px solid #eaeaea; margin: 2em 0; }
.card { background: #f3f7fb; border-radius: 8px; padding: 1em 1.5em; margin-bottom: 1.5em; box-shadow: 0 1px 4px #0001; }
code { background: #f6f8fa; color: #d6336c; padding: 2px 6px; border-radius: 4px; font-size: 0.98em; }
/* Modal styles */
.modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(44, 62, 80, 0.35); z-index: 1000; justify-content: center; align-items: center; }
.modal-overlay.active { display: flex; }
.modal { background: #fff; border-radius: 10px; box-shadow: 0 4px 32px #0002; padding: 2em 2.5em; min-width: 320px; max-width: 95vw; position: relative; }
.modal h2 { margin-top: 0; color: #2d6cdf; border: none; }
.modal label { display: block; margin: 1em 0 0.3em; font-weight: 500; }
.modal input[type="text"], .modal input[type="email"] { width: 100%; padding: 0.6em; border: 1px solid #eaeaea; border-radius: 5px; font-size: 1em; }
.modal .modal-actions { margin-top: 1.5em; text-align: right; }
.modal button { background: #2d6cdf; color: #fff; border: none; border-radius: 5px; padding: 0.6em 1.2em; font-size: 1em; cursor: pointer; margin-left: 0.5em; }
.modal button.cancel { background: #eaeaea; color: #444; }
.modal .close { position: absolute; top: 12px; right: 16px; font-size: 1.3em; color: #aaa; background: none; border: none; cursor: pointer; }
.modal .close:hover { color: #d73a49; }
</style>';
echo '</head>';
echo '<body>';
echo '<div class="dashboard-header">';
echo '<h1>Library Management Profile</h1>';
echo '<nav class="dashboard-nav">';
echo '<a href="demo.php">Dashboard</a>';
echo '<a href="members.php">Members</a>';
echo '</nav>';
echo '</div>';
echo '<div class="container">';

echo "<h1>PHP OOP Library Management System - Demonstration</h1>\n";
echo "<hr>\n";

// Create a library instance
$library = new Library("Central University Library");

echo "<section class='dashboard-section'><h2>1. Creating Library Items (Inheritance & Abstraction)</h2>\n";

// Create 3 books
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", "978-0743273565", "Scribner", 1925, 2);
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", "978-0446310789", "Grand Central", 1960, 3);
$book3 = new Book("1984", "George Orwell", "978-0451524935", "Signet", 1949, 1);

// Create 3 magazines
$magazine1 = new Magazine("National Geographic", "978-1234567890", "March 2024", "Susan Goldberg", "2024-03-01", 5);
$magazine2 = new Magazine("Time Magazine", "978-0987654321", "April 2024", "Edward Felsenthal", "2024-04-01", 3);
$magazine3 = new Magazine("Scientific American", "978-1122334455", "May 2024", "Laura Helmuth", "2024-05-01", 2);

echo "<h3>Books Created:</h3>\n<ul>\n";
echo "<li>" . $book1->getBookInfo() . "</li>\n";
echo "<li>" . $book2->getBookInfo() . "</li>\n";
echo "<li>" . $book3->getBookInfo() . "</li>\n";
echo "</ul>\n";

echo "<h3>Magazines Created:</h3>\n<ul>\n";
echo "<li>" . $magazine1->getMagazineInfo() . "</li>\n";
echo "<li>" . $magazine2->getMagazineInfo() . "</li>\n";
echo "<li>" . $magazine3->getMagazineInfo() . "</li>\n";
echo "</ul></section>\n";

echo "<section class='dashboard-section'><h2>2. Creating Members (Encapsulation)</h2>\n";
$member1 = new Member("M001", "Quadri", "quadriyusuff@email.com");
$member2 = new Member("M002", "Test", "test@email.com");
$member3 = new Member("M003", "Bob marley", "bobmarley@email.com");

echo "<h3>Members Registered:</h3>\n";
echo '<p>See <a href="members.php">Members</a> for the full list of registered members.</p>';

echo "<section class='dashboard-section'><h2>3. Adding Items to Library</h2>\n";
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);
$library->addMagazine($magazine1);
$library->addMagazine($magazine2);
$library->addMagazine($magazine3);
$library->registerMember($member1);
$library->registerMember($member2);
$library->registerMember($member3);
echo "<p>Added <b>" . count($library->getBooks()) . " books</b> and <b>" . count($library->getMagazines()) . " magazines</b> to the library.</p>\n";
echo "<p>Registered <b>" . count($library->getMembers()) . " members</b>.</p></section>\n";

echo "<section class='dashboard-section'><h2>4. Demonstrating Polymorphism (Borrowable Interface)</h2>\n";

// Demonstrate borrowing books and magazines
echo "<h3>Borrowing Activities:</h3>\n";

// Member 1 borrows a book and a magazine
$borrowing1 = $library->borrowItem($book1, $member1);
$borrowing2 = $library->borrowItem($magazine1, $member1);

if ($borrowing1) {
    echo "<p>✓ " . $member1->getName() . " borrowed: " . $book1->getTitle() . "</p>\n";
}
if ($borrowing2) {
    echo "<p>✓ " . $member1->getName() . " borrowed: " . $magazine1->getTitle() . "</p>\n";
}

// Member 2 borrows a book
$borrowing3 = $library->borrowItem($book2, $member2);
if ($borrowing3) {
    echo "<p>✓ " . $member2->getName() . " borrowed: " . $book2->getTitle() . "</p>\n";
}

// Member 3 borrows a magazine
$borrowing4 = $library->borrowItem($magazine2, $member3);
if ($borrowing4) {
    echo "<p>✓ " . $member3->getName() . " borrowed: " . $magazine2->getTitle() . "</p>\n";
}

echo "<section class='dashboard-section'><h2>5. Demonstrating Composition (Borrowing Class)</h2>\n";

echo "<h3>Borrowing Details:</h3>\n";
echo "<ul>\n";
if ($borrowing1) {
    $details = $borrowing1->getBorrowingDetails();
    echo "<li>Borrowing ID: " . $details['borrowingId'] . "</li>\n";
    echo "<li>Book: " . $details['bookTitle'] . "</li>\n";
    echo "<li>Member: " . $details['memberName'] . "</li>\n";
    echo "<li>Borrow Date: " . $details['borrowDate'] . "</li>\n";
    echo "<li>Due Date: " . $details['dueDate'] . "</li>\n";
    echo "<li>Status: " . ($details['isReturned'] ? 'Returned' : 'Active') . "</li>\n";
}
echo "</ul>\n";

echo "<section class='dashboard-section'><h2>6. Demonstrating Encapsulation</h2>\n";

echo "<h3>Member Information (using getters):</h3>\n";
$memberInfo = $member1->getMemberInfo();
echo "<p>Member ID: " . $memberInfo['memberId'] . "</p>\n";
echo "<p>Name: " . $memberInfo['name'] . "</p>\n";
echo "<p>Email: " . $memberInfo['email'] . "</p>\n";
echo "<p>Books Borrowed: " . $memberInfo['borrowedBooksCount'] . "/" . $memberInfo['maxBooksAllowed'] . "</p>\n";

echo "<h3>Book Details (using getters):</h3>\n";
$bookDetails = $book1->getDetails();
echo "<p>Title: " . $bookDetails['title'] . "</p>\n";
echo "<p>Author: " . $bookDetails['author'] . "</p>\n";
echo "<p>ISBN: " . $bookDetails['isbn'] . "</p>\n";
echo "<p>Available Copies: " . $bookDetails['availableCopies'] . "/" . $bookDetails['totalCopies'] . "</p>\n";

echo "<section class='dashboard-section'><h2>7. Demonstrating Input Validation</h2>\n";

// Test validation methods
$bookErrors = $library->validateBookData("", "", "", "", 2025);
$memberErrors = $library->validateMemberData("", "", "invalid-email");

echo "<h3>Book Validation Errors:</h3>\n";
if (!empty($bookErrors)) {
    echo "<ul>\n";
    foreach ($bookErrors as $error) {
        echo "<li>" . $error . "</li>\n";
    }
    echo "</ul>\n";
}

echo "<h3>Member Validation Errors:</h3>\n";
if (!empty($memberErrors)) {
    echo "<ul>\n";
    foreach ($memberErrors as $error) {
        echo "<li>" . $error . "</li>\n";
    }
    echo "</ul>\n";
}

echo "<section class='dashboard-section'><h2>8. Demonstrating Returning Items</h2>\n";

// Return a book
$returnResult = $library->returnItem($book1, $member1);
if ($returnResult) {
    echo "<p>✓ " . $member1->getName() . " returned: " . $book1->getTitle() . "</p>\n";
}

echo "<section class='dashboard-section'><h2>9. Generating Reports</h2>\n";

// Library report
$libraryReport = $library->getLibraryReport();
echo "<h3>Library Report:</h3>\n";
echo "<ul>\n";
echo "<li>Library Name: " . $libraryReport['libraryName'] . "</li>\n";
echo "<li>Total Books: " . $libraryReport['totalBooks'] . "</li>\n";
echo "<li>Total Magazines: " . $libraryReport['totalMagazines'] . "</li>\n";
echo "<li>Total Members: " . $libraryReport['totalMembers'] . "</li>\n";
echo "<li>Total Borrowings: " . $libraryReport['totalBorrowings'] . "</li>\n";
echo "<li>Active Borrowings: " . $libraryReport['activeBorrowings'] . "</li>\n";
echo "<li>Overdue Borrowings: " . $libraryReport['overdueBorrowings'] . "</li>\n";
echo "</ul>\n";

// Borrowed items report
$borrowedReport = $library->getBorrowedItemsReport();
echo "<h3>Currently Borrowed Items:</h3>\n";
if (!empty($borrowedReport)) {
    echo "<ul>\n";
    foreach ($borrowedReport as $item) {
        echo "<li>" . $item['bookTitle'] . " - Borrowed by: " . $item['memberName'] . " (Due: " . $item['dueDate'] . ")</li>\n";
    }
    echo "</ul>\n";
} else {
    echo "<p>No items are currently borrowed.</p>\n";
}

// Member report
$memberReport = $library->getMemberReport("M001");
echo "<h3>Member Report for " . $memberReport['memberInfo']['name'] . ":</h3>\n";
echo "<ul>\n";
echo "<li>Member ID: " . $memberReport['memberInfo']['memberId'] . "</li>\n";
echo "<li>Email: " . $memberReport['memberInfo']['email'] . "</li>\n";
echo "<li>Books Borrowed: " . $memberReport['memberInfo']['borrowedBooksCount'] . "</li>\n";
echo "</ul>\n";

echo "<section class='dashboard-section'><h2>10. Demonstrating Search Functionality</h2>\n";

// Search for items
$searchResults = $library->searchItems("Gatsby");
echo "<h3>Search Results for 'Gatsby':</h3>\n";
if (!empty($searchResults)) {
    echo "<ul>\n";
    foreach ($searchResults as $result) {
        echo "<li>" . $result['title'] . " (" . $result['type'] . ")</li>\n";
    }
    echo "</ul>\n";
} else {
    echo "<p>No items found.</p>\n";
}

echo "<section class='dashboard-section'><h2>11. Demonstrating Error Handling</h2>\n";

// Try to borrow a book that's already borrowed
$borrowing5 = $library->borrowItem($book2, $member1);
if (!$borrowing5) {
    echo "<p>✗ Cannot borrow " . $book2->getTitle() . " - already borrowed by " . $member2->getName() . "</p>\n";
}

// Try to borrow when member has reached limit
$member1->setMaxBooksAllowed(1);
$borrowing6 = $library->borrowItem($book3, $member1);
if (!$borrowing6) {
    echo "<p>✗ " . $member1->getName() . " cannot borrow more books - limit reached</p>\n";
}

echo "<section class='dashboard-section'><h2>12. OOP Principles Summary</h2>\n";
echo "<h3>Inheritance:</h3>\n";
echo "<ul>\n";
echo "<li>Book and Magazine inherit from abstract LibraryItem class</li>\n";
echo "<li>Both implement the abstract getDetails() method</li>\n";
echo "</ul>\n";

echo "<h3>Polymorphism:</h3>\n";
echo "<ul>\n";
echo "<li>Book and Magazine both implement the Borrowable interface</li>\n";
echo "<li>Both can be used interchangeably in borrowing operations</li>\n";
echo "</ul>\n";

echo "<h3>Encapsulation:</h3>\n";
echo "<ul>\n";
echo "<li>Private properties with public getter/setter methods</li>\n";
echo "<li>Controlled access to sensitive data like availableCopies</li>\n";
echo "</ul>\n";

echo "<h3>Abstraction:</h3>\n";
echo "<ul>\n";
echo "<li>LibraryItem abstract class defines common structure</li>\n";
echo "<li>Borrowable interface defines borrowing contract</li>\n";
echo "</ul>\n";

echo "<h3>Composition:</h3>\n";
echo "<ul>\n";
echo "<li>Borrowing class contains references to Book and Member</li>\n";
echo "<li>Library class manages collections of different object types</li>\n";
echo "</ul>\n";

echo "<hr>\n";
echo "<h2>Demonstration Complete!</h2>\n";
echo "<p>This demonstration showcases all the required OOP principles:</p>\n";
echo "<ul>\n";
echo "<li>✓ Classes and Objects</li>\n";
echo "<li>✓ Inheritance (LibraryItem → Book/Magazine)</li>\n";
echo "<li>✓ Encapsulation (private properties, public methods)</li>\n";
echo "<li>✓ Polymorphism (Borrowable interface)</li>\n";
echo "<li>✓ Abstraction (abstract class and interface)</li>\n";
echo "<li>✓ Composition (Borrowing with Book/Member references)</li>\n";
echo "<li>✓ Input validation</li>\n";
echo "<li>✓ Date handling with DateTime</li>\n";
echo "<li>✓ Reporting functionality</li>\n";
echo "<li>✓ At least 3 examples of each class</li>\n";
echo "</ul>\n";
?>
<button id="openRegisterModal" style="float:right; margin-bottom: 1em; background: #2d6cdf; color: #fff; border: none; border-radius: 6px; padding: 0.7em 1.4em; font-size: 1em; cursor: pointer;">Register Member</button>
<div class="modal-overlay" id="registerModalOverlay">
  <div class="modal">
    <button class="close" id="closeRegisterModal" title="Close">&times;</button>
    <h2>Register New Member</h2>
    <form id="registerMemberForm" autocomplete="off" onsubmit="return false;">
      <label for="memberId">Member ID</label>
      <input type="text" id="memberId" name="memberId" required placeholder="e.g. M004">
      <label for="memberName">Name</label>
      <input type="text" id="memberName" name="memberName" required placeholder="Full Name">
      <label for="memberEmail">Email</label>
      <input type="email" id="memberEmail" name="memberEmail" required placeholder="email@example.com">
      <div class="modal-actions">
        <button type="button" class="cancel" id="cancelRegisterModal">Cancel</button>
        <button type="submit">Register</button>
      </div>
    </form>
    <div id="registerSuccessMsg" style="display:none; margin-top:1em; color:#1a7f37; font-weight:bold;">Member registered! (Demo only)</div>
  </div>
</div>
<script>
// Modal open/close logic
const openBtn = document.getElementById("openRegisterModal");
const overlay = document.getElementById("registerModalOverlay");
const closeBtn = document.getElementById("closeRegisterModal");
const cancelBtn = document.getElementById("cancelRegisterModal");
const form = document.getElementById("registerMemberForm");
const successMsg = document.getElementById("registerSuccessMsg");

openBtn.onclick = () => { overlay.classList.add("active"); successMsg.style.display = "none"; form.reset(); };
closeBtn.onclick = cancelBtn.onclick = () => { overlay.classList.remove("active"); };
overlay.onclick = (e) => { if (e.target === overlay) overlay.classList.remove("active"); };
form.onsubmit = () => {
  successMsg.style.display = "block";
  setTimeout(() => { overlay.classList.remove("active"); }, 1200);
  return false;
};
</script>