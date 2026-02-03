<?php
include '../config/database.php';
include '../includes/header.php';
?>

<h2>Search Donations</h2>

<form method="post">
    <input type="text" name="name" placeholder="Search by donor name">
    <input type="email" name="email" placeholder="Search by email">
    <input type="text" name="location" placeholder="Search by location">
    <button name="search">Search</button>
</form>

<?php
if (isset($_POST['search'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $location = $_POST['location'] ?? '';
    
    // Build the WHERE clause dynamically
    $where = "1=1";
    
    if (!empty($name)) {
        $name = $conn->real_escape_string($name);
        $where .= " AND donors.name LIKE '%$name%'";
    }
    
    if (!empty($email)) {
        $email = $conn->real_escape_string($email);
        $where .= " AND donors.email LIKE '%$email%'";
    }
    
    if (!empty($location)) {
        $location = $conn->real_escape_string($location);
        $where .= " AND donors.location LIKE '%$location%'";
    }
    
    // If no search criteria entered, show message
    if (empty($name) && empty($email) && empty($location)) {
        echo '<p style="color: red;">Please enter at least one search criteria</p>';
    } else {
        $query = "SELECT DISTINCT donors.id, donors.name, donors.email, donors.location, 
                  SUM(donations.amount) as total_donated, COUNT(donations.id) as donation_count
                  FROM donors 
                  LEFT JOIN donations ON donors.id = donations.donor_id
                  WHERE $where
                  GROUP BY donors.id
                  ORDER BY total_donated DESC";
        
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            echo '<table border="1" cellpadding="10" style="margin-top: 20px;">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Total Donated</th>
                    <th>Donation Count</th>
                  </tr>';
            
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                      <td>' . htmlspecialchars($row['name']) . '</td>
                      <td>' . htmlspecialchars($row['email']) . '</td>
                      <td>' . htmlspecialchars($row['location']) . '</td>
                      <td>$' . number_format($row['total_donated'] ?? 0, 2) . '</td>
                      <td>' . ($row['donation_count'] ?? 0) . '</td>
                      </tr>';
            }
            
            echo '</table>';
        } else {
            echo '<p style="color: orange; margin-top: 20px;">No results found</p>';
        }
    }
}
?>

<?php include '../includes/footer.php'; ?>
