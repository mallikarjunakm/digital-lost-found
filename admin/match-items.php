<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

$sql = "
SELECT 
    l.lost_id,
    l.item_type,
    l.lost_location,
    l.lost_date,
    f.found_id,
    f.found_location,
    f.found_date
FROM lost_items l
JOIN found_items f
    ON l.item_type = f.item_type
WHERE 
    l.status = 'open'
    AND f.status = 'unclaimed'
    AND ABS(DATEDIFF(l.lost_date, f.found_date)) <= 3
";

$matches = $conn->query($sql);
?>

<?php include "../partials/head.php"; ?>
<?php include "admin-navbar.php"; ?>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4">Match Suggestions</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Lost ID</th>
                            <th>Item Type</th>
                            <th>Lost Location</th>
                            <th>Lost Date</th>
                            <th>Found ID</th>
                            <th>Found Location</th>
                            <th>Found Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($matches && $matches->num_rows > 0) { ?>
                            <?php while ($row = $matches->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['lost_id']; ?></td>
                                    <td><?php echo $row['item_type']; ?></td>
                                    <td><?php echo $row['lost_location']; ?></td>
                                    <td><?php echo $row['lost_date']; ?></td>
                                    <td><?php echo $row['found_id']; ?></td>
                                    <td><?php echo $row['found_location']; ?></td>
                                    <td><?php echo $row['found_date']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="text-muted">
                                    No matching records found
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include "../partials/footer.php"; ?>
