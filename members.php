<?php
require_once 'Member.php';

// Sample members (same as in demo.php)
$members = [
    new Member("M001", "Quadri", "quadriyusuff@email.com"),
    new Member("M002", "Test", "test@email.com"),
    new Member("M003", "Bob marley", "bobmarley@email.com"),
];

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Library Members - Profile</title>';
echo '<style>
body { font-family: "Segoe UI", Arial, sans-serif; background: #f6f8fa; color: #222; margin: 0; padding: 0; }
.dashboard-header { background: #2d6cdf; color: #fff; padding: 1.5em 2em; border-radius: 0 0 16px 16px; box-shadow: 0 2px 8px #0001; display: flex; align-items: center; justify-content: space-between; }
.dashboard-header h1 { margin: 0; font-size: 2em; letter-spacing: 1px; }
.dashboard-nav { display: flex; gap: 1.5em; }
.dashboard-nav a { color: #fff; text-decoration: none; font-weight: 500; font-size: 1.1em; transition: color 0.2s; }
.dashboard-nav a:hover { color: #ffd700; }
.container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px #0001; padding: 32px 40px; }
h2 { color: #2d6cdf; border-bottom: 2px solid #eaeaea; padding-bottom: 0.2em; margin-top: 0; }
.member-list { display: flex; flex-direction: column; gap: 1.5em; margin-top: 2em; }
.member-card { background: #f3f7fb; border-radius: 8px; box-shadow: 0 1px 4px #0001; padding: 1.2em 1.5em; display: flex; align-items: center; gap: 1.5em; }
.member-avatar { width: 56px; height: 56px; border-radius: 50%; background: #2d6cdf22; display: flex; align-items: center; justify-content: center; font-size: 2em; color: #2d6cdf; font-weight: bold; }
.member-info { flex: 1; }
.member-info h3 { margin: 0 0 0.2em 0; color: #2d6cdf; font-size: 1.2em; }
.member-info p { margin: 0.1em 0; color: #444; }
</style>';
echo '</head>';
echo '<body>';
echo '<div class="dashboard-header">';
echo '<h1>Library Members</h1>';
echo '<nav class="dashboard-nav">';
echo '<a href="demo.php">Dashboard</a>';
echo '<a href="members.php">Members</a>';
echo '</nav>';
echo '</div>';
echo '<div class="container">';
echo '<h2>Registered Members</h2>';
echo '<div class="member-list">';
foreach ($members as $member) {
    $initial = strtoupper($member->getName()[0]);
    echo '<div class="member-card">';
    echo '<div class="member-avatar">' . $initial . '</div>';
    echo '<div class="member-info">';
    echo '<h3>' . htmlspecialchars($member->getName()) . '</h3>';
    echo '<p><b>ID:</b> ' . htmlspecialchars($member->getMemberId()) . '</p>';
    echo '<p><b>Email:</b> ' . htmlspecialchars($member->getEmail()) . '</p>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</body></html>'; 