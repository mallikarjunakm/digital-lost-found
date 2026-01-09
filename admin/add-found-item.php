<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

$message = "";
$message_type = "";

if (isset($_POST['submit'])) {
    $item_type = $_POST['item_type'];
    $location  = $_POST['found_location'];
    $date      = $_POST['found_date'];
    $desc      = $_POST['description'];

    $sql = "INSERT INTO found_items 
            (item_type, description, found_location, found_date)
            VALUES 
            ('$item_type', '$desc', '$location', '$date')";

    if ($conn->query($sql)) {
        $message = "Found item added successfully.";
        $message_type = "success";
    } else {
        $message = "Error adding found item.";
        $message_type = "danger";
    }
}
?>

<?php include "../partials/head.php"; ?>
<?php include "admin-navbar.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Add Found Item (Admin)</h4>

                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-<?php echo $message_type; ?>">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <input type="text"
                                   name="item_type"
                                   class="form-control"
                                   placeholder="Item Type"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="text"
                                   name="found_location"
                                   class="form-control"
                                   placeholder="Found Location"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="date"
                                   name="found_date"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Visible identifiers (color, brand, etc)"
                                      required></textarea>
                        </div>

                        <button type="submit"
                                name="submit"
                                class="btn btn-primary w-100">
                            Add Item
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../partials/footer.php"; ?>
