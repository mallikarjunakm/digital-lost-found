<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

$username = $_SESSION['username'];

/* Fetch user's lost items */
$lost_items = $conn->query(
    "SELECT * FROM lost_items WHERE reported_by='$username'"
);

/* Fetch user's claims */
$claims = $conn->query(
    "SELECT 
        c.claim_id, 
        c.status, 
        f.item_type, 
        f.found_location
     FROM claims c
     JOIN found_items f ON c.found_id = f.found_id
     WHERE c.claimed_by='$username'"
);
?>

<?php include "../partials/head.php"; ?>
<?php include "user-navbar.php"; ?>

<div class="container my-5">

    <h4 class="mb-4">
        Welcome, <?php echo htmlspecialchars($username); ?>
    </h4>

    <!-- ================= LOST ITEMS ================= -->
    <div class="card shadow mb-5">
        <div class="card-body">

            <h5 class="mb-3">Your Lost Item Reports</h5>

            <div class="table-responsive">
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
                    <?php if ($lost_items && $lost_items->num_rows > 0) { ?>
                        <?php while ($row = $lost_items->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['lost_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['item_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['lost_location']); ?></td>
                                <td><?php echo $row['lost_date']; ?></td>
                                <td>
                                    <span class="badge 
                                        <?php echo ($row['status']=='open') ? 'bg-warning' : 'bg-success'; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-muted">
                                No lost items reported yet
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- ================= CLAIMED ITEMS ================= -->
    <div class="card shadow">
        <div class="card-body">

            <h5 class="mb-3">Your Claimed Items</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Claim ID</th>
                            <th>Item</th>
                            <th>Found Location</th>
                            <th>Claim Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($claims && $claims->num_rows > 0) { ?>
                        <?php while ($row = $claims->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['claim_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['item_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['found_location']); ?></td>
                                <td>
                                    <span class="badge 
                                        <?php
                                            echo ($row['status']=='pending')
                                                ? 'bg-warning'
                                                : (($row['status']=='approved')
                                                    ? 'bg-success'
                                                    : 'bg-danger');
                                        ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-muted">
                                No claims submitted yet
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
