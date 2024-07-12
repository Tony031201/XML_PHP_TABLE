<?php
$mysqli = new mysqli("tropicalisland", "tony", "password", "tropicalbackend");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT name, description, price
FROM meals WHERE price < ?";

$stmt = $mysqli->prepare($sql);

// verify the input tpye is right
$q = $_GET['q'];
if (!is_numeric($q)) {
  exit('Invalid input');
}

$stmt->bind_param("s", $q);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $description, $price);

echo "<table>";
echo "<tr>";
echo "<th>Menu</th>";
echo "</tr>";

while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($name) . "</td>";
    echo "<td>" . htmlspecialchars($description) . "</td>";
    echo "<td>" . htmlspecialchars($price) . "</td>";
    echo "</tr>";
  }

echo "</table>";

$stmt->close();
$mysqli->close();

?>