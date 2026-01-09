<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

/* Fetch claim logs in increasing order */
$logs = $conn->query("
    SELECT 
        l.log_id,
        l.action,
        l.timestamp,
        c.claimant_name
    FROM claim_logs l
    JOIN claims c ON l.claim_id = c.claim_id
    ORDER BY l.log_id ASC
");
?>

<?php include "../partials/head.php"; ?>
<?php include "admin-navbar.php"; ?>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4">Audit Logs</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Log ID</th>
                            <th>Claimant</th>
                            <th>Action</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if ($logs && $logs->num_rows > 0) { ?>
                        <?php while ($row = $logs->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['log_id']; ?></td>
                                <td><?php echo $row['claimant_name']; ?></td>
                                <td><?php echo $row['action']; ?></td>
                                <td><?php echo $row['timestamp']; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-muted">
                                No audit logs found
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
