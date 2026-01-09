<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

/* Fetch pending claims */
$sql = "
SELECT 
    c.claim_id,
    c.claimant_name,
    c.verification_notes,
    c.status AS claim_status,
    l.lost_id,
    l.item_type,
    l.lost_location,
    l.lost_date,
    f.found_id,
    f.found_location,
    f.found_date
FROM claims c
JOIN lost_items l ON c.lost_id = l.lost_id
JOIN found_items f ON c.found_id = f.found_id
WHERE c.status = 'pending'
";

$claims = $conn->query($sql);

/* Handle approve */
if (isset($_POST['approve'])) {
    $claim_id = $_POST['claim_id'];
    $lost_id  = $_POST['lost_id'];
    $found_id = $_POST['found_id'];

    $conn->query("UPDATE claims SET status='approved' WHERE claim_id=$claim_id");
    $conn->query("UPDATE lost_items SET status='closed' WHERE lost_id=$lost_id");
    $conn->query("UPDATE found_items SET status='returned' WHERE found_id=$found_id");

    $conn->query(
        "INSERT INTO claim_logs (claim_id, action)
         VALUES ($claim_id, 'Claim approved')"
    );

    header("Location: verify-claims.php");
    exit;
}

/* Handle reject */
if (isset($_POST['reject'])) {
    $claim_id = $_POST['claim_id'];

    $conn->query("UPDATE claims SET status='rejected' WHERE claim_id=$claim_id");

    $conn->query(
        "INSERT INTO claim_logs (claim_id, action)
         VALUES ($claim_id, 'Claim rejected')"
    );

    header("Location: verify-claims.php");
    exit;
}
?>

<?php include "../partials/head.php"; ?>
<?php include "admin-navbar.php"; ?>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4">Pending Claims</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Claim ID</th>
                            <th>Claimant</th>
                            <th>Item</th>
                            <th>Lost Details</th>
                            <th>Found Details</th>
                            <th>Proof</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if ($claims && $claims->num_rows > 0) { ?>
                        <?php while ($row = $claims->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['claim_id']; ?></td>
                                <td><?php echo $row['claimant_name']; ?></td>
                                <td><?php echo $row['item_type']; ?></td>
                                <td>
                                    <?php echo $row['lost_location']; ?><br>
                                    <small class="text-muted"><?php echo $row['lost_date']; ?></small>
                                </td>
                                <td>
                                    <?php echo $row['found_location']; ?><br>
                                    <small class="text-muted"><?php echo $row['found_date']; ?></small>
                                </td>
                                <td><?php echo $row['verification_notes']; ?></td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="claim_id" value="<?php echo $row['claim_id']; ?>">
                                        <input type="hidden" name="lost_id" value="<?php echo $row['lost_id']; ?>">
                                        <input type="hidden" name="found_id" value="<?php echo $row['found_id']; ?>">
                                        <button type="submit" name="approve" class="btn btn-success btn-sm">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="claim_id" value="<?php echo $row['claim_id']; ?>">
                                        <button type="submit" name="reject" class="btn btn-danger btn-sm">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-muted">
                                No pending claims found
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
