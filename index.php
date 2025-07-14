
require_once 'Borrowable.php';
require_once 'LibraryItem.php';
require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Member.php';
require_once 'Library.php';
require_once 'Borrowing.php';

use LibrarySystem\Entities\Book;
use LibrarySystem\Entities\Magazine;
use LibrarySystem\Entities\Member;
use LibrarySystem\Entities\Library;
use LibrarySystem\Actions\Borrowing;

// Create library
$library = new Library();

// Create and add books
$book1 = new Book("Things Fall Apart", "Chinue Achebe", 3);
$book2 = new Book("Broken", "Fatimah Balla", 2);
$book3 = new Book("Half of a Yellow Sun", "Chimamanda Ngozi Adichie", 4);
$book4 = new Book("The Alchemist", "Paulo Coelho", 5);
$book5 = new Book("Purple Hibiscus", "Chimamanda Ngozi Adichie", 2);
$book6 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 3);
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);
$library->addBook($book4);
$library->addBook($book5);
$library->addBook($book6);

// Create and add magazines
$mag1 = new Magazine("Khloe takes New York", "Editor A", "July 2025");
$mag2 = new Magazine("Science Today", "Editor B", "August 2025");
$mag3 = new Magazine("Tech World", "Editor C", "September 2025");
$mag4 = new Magazine("Art Monthly", "Editor D", "October 2025");
$mag5 = new Magazine("History Digest", "Editor E", "November 2025");
$library->addMagazine($mag1);
$library->addMagazine($mag2);
$library->addMagazine($mag3);
$library->addMagazine($mag4);
$library->addMagazine($mag5);

// Register members
$member1 = new Member("Quadri");
$member2 = new Member("Ayomide");
$member3 = new Member("Buhari");
$library->registerMember($member1);
$library->registerMember($member2);
$library->registerMember($member3);

// Borrow items
$borrowings = [];
$book1->borrowItem($member1);
$borrowings[] = new Borrowing($member1, $book1);
$book2->borrowItem($member2);
$borrowings[] = new Borrowing($member2, $book2);
$book3->borrowItem($member3);
$borrowings[] = new Borrowing($member3, $book3);
$mag1->borrowItem($member1);
$borrowings[] = new Borrowing($member1, $mag1);
$mag2->borrowItem($member2);
$borrowings[] = new Borrowing($member2, $mag2);

// Display all borrowings
echo "<h3>Borrowed Items Report:</h3>";
foreach ($borrowings as $borrowing) {
    echo $borrowing->getInfo() . "<br>";
}

// Iterate over books
echo "<h3>Books in Library:</h3>";
foreach ($library as $book) {
    echo $book->getDetails() . "<br>";
}

// Static method
echo "<h3>Total Library Items: " . Library::getTotalItems() . "</h3>";