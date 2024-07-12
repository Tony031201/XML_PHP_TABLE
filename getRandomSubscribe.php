<?php
// Link to the PostgreSQL database
$conn = pg_connect("host=localhost dbname=tropicalbackend user=tony password=mypassword");
if (!$conn) {
  exit('Could not connect to PostgreSQL database');
}

$q = $_GET['q'];
if (!is_numeric($q) || $q <= 0) {
  exit('Invalid input');
}

$q = (int)$q;

// search
$result = pg_query($conn, "SELECT name, email FROM subscribe ORDER BY RANDOM() LIMIT $1",array($q));

if (!$result) {
  echo "An error occurred.\n";
  exit;
}

// output
echo "<table border='1'>";
echo "<tr><th>Name</th><th>Email</th></tr>";
while ($row = pg_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
  echo "<td>" . htmlspecialchars($row['email']) . "</td>";
  echo "</tr>";
}
echo "</table>";

// close access
pg_close($conn);
?>
