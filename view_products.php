<?php
$page_title = 'View Products';
include('includes/header.html');
echo '<div class="page-header"><h1>Registered Products</h1></div>';
require('../mysqli_connect.php');

$q = "SELECT p.name, p.category, p.stock, p.description, s.supplier_id, u.username
      FROM products AS p, suppliers AS s, users AS u
      WHERE p.supplier_id=s.supplier_id AND s.user_id = u.user_id;";
$r = @mysqli_query($dbc, $q);
$num = mysqli_num_rows($r);
if ($num > 0) {
    echo '<p>There are currently ' . $num . ' registered products.</p><br>';
    echo '<table width="60%">
        <thead>
        <tr>
            <th align="left">Name</th>
            <th align="left">Category</th>
            <th align="left">Description</th>
            <th align="left">Stock</th>
            <th align="left">Supplier</th>
            <th align="left">Supplier ID</th>
        </tr>
        </thead>
        <tbody>';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<tr>
            <td align="left">' . $row['name'] . '</td>
            <td align="left">' . $row['category'] . '</td>
            <td align="left">' . $row['description'] . '</td>
            <td align="left">' . $row['stock'] . '</td>
            <td align="left">' . $row['username'] . '</td>
            <td align="left">' . $row['supplier_id'] . '</td>
            </tr>';
    }
    echo '</tbody></table>';
    mysqli_free_result($r);
}
else {
    echo '<p class="error">There are currently no registered products.</p>';
}

mysqli_close($dbc);
include('includes/footer.html');
?>