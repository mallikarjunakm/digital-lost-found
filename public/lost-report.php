<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");

$message = "";
$message_type = "";

if (isset($_POST['submit'])) {
    $item_type = $_POST['item_type'];
    $location  = $_POST['lost_location'];
    $date      = $_POST['lost_date'];
    $desc      = $_POST['description'];
    $username  = $_SESSION['username'];

    $sql = "INSERT INTO lost_items
            (item_type, description, lost_location, lost_date, reported_by)
            VALUES
            ('$item_type', '$desc', '$location', '$date', '$username')";

    if ($conn->query($sql)) {
        $message = "Lost item reported successfully.";
        $message_type = "success";
    } else {
        $message = "Error submitting report.";
        $message_type = "danger";
    }
}
?>

<?php include "../partials/head.php"; ?>
<?php include "user-navbar.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Report Lost Item</h4>

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
                                   name="lost_location"
                                   class="form-control"
                                   placeholder="Lost Location"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="date"
                                   name="lost_date"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Describe identifying features"
                                      required></textarea>
                        </div>

                        <button type="submit"
                                name="submit"
                                class="btn btn-primary w-100">
                            Submit Report
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../partials/footer.php"; ?>