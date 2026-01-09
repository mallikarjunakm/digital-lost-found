<?php
include("../config/db.php");

$id = $_POST['claim_id'] ?? '';
$action = $_POST['action'] ?? '';

if ($action === 'approve') {
    $conn->query("UPDATE claims SET status='approved' WHERE claim_id=$id");
    echo json_encode(['success' => true]);
}

