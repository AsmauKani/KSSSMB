<?php
// Define staff members
$staff = array(
    "John Doe",
    "Jane Smith",
    "Michael Johnson",
    "Emily Brown"
);

// Display staff members as options
foreach ($staff as $member) {
    echo "<option value='$member'>$member</option>";
}
?>
