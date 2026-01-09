<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include "../partials/head.php"; ?>
<?php include "admin-navbar.php"; ?>

<div class="container my-5">

    <!-- ================= LOST ITEMS ================= -->
    <div class="card shadow mb-5">
        <div class="card-body">

            <h4 class="text-center mb-4">Lost Items</h4>

            <!-- LOST FILTERS -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text"
                           id="lost_item_type"
                           class="form-control"
                           placeholder="Item Type"
                           onkeyup="fetchLostItems()">
                </div>

                <div class="col-md-3">
                    <input type="date"
                           id="lost_date"
                           class="form-control"
                           onchange="fetchLostItems()">
                </div>

                <div class="col-md-3">
                    <select id="lost_status"
                            class="form-select"
                            onchange="fetchLostItems()">
                        <option value="">All Status</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>

            <!-- LOST ITEMS TABLE (AJAX LOAD) -->
            <div id="lost-items-table"></div>

        </div>
    </div>

    <!-- ================= FOUND ITEMS ================= -->
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4">Found Items</h4>

            <!-- FOUND FILTERS -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text"
                           id="found_item_type"
                           class="form-control"
                           placeholder="Item Type"
                           onkeyup="fetchFoundItems()">
                </div>

                <div class="col-md-3">
                    <input type="date"
                           id="found_date"
                           class="form-control"
                           onchange="fetchFoundItems()">
                </div>

                <div class="col-md-3">
                    <select id="found_status"
                            class="form-select"
                            onchange="fetchFoundItems()">
                        <option value="">All Status</option>
                        <option value="unclaimed">Unclaimed</option>
                        <option value="returned">Returned</option>
                    </select>
                </div>
            </div>

            <!-- FOUND ITEMS TABLE (AJAX LOAD) -->
            <div id="found-items-table"></div>

        </div>
    </div>

</div>

<?php include "../partials/footer.php"; ?>

<!-- LOAD AJAX SCRIPT -->
<script src="../assets/js/dashboard-ajax.js"></script>

<!-- INITIAL LOAD -->
<script>
    fetchLostItems();
    fetchFoundItems();
</script>
