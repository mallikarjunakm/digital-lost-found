<?php
include("../config/db.php");

$type   = $_POST['item_type'] ?? '';
$date   = $_POST['date'] ?? '';
$status = $_POST['status'] ?? '';

$sql = "SELECT * FROM lost_items WHERE 1";

if ($type !== '') {
    $sql .= " AND item_type LIKE '%$type%'";
}
if ($date !== '') {
    $sql .= " AND lost_date = '$date'";
}
if ($status !== '') {
    $sql .= " AND status = '$status'";
}

$result = $conn->query($sql);
?>

<table class="table table-bordered table-hover text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Location</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['lost_id'] ?></td>
            <td><?= htmlspecialchars($row['item_type']) ?></td>
            <td><?= htmlspecialchars($row['lost_location']) ?></td>
            <td><?= $row['lost_date'] ?></td>
            <td>
                <span class="badge <?= ($row['status']=='open')?'bg-warning':'bg-success' ?>">
                    <?= $row['status'] ?>
                </span>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
