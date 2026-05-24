<?php
session_start();
include 'db.php';

$selected_number = "";
$selected_id = "";

// 1. Dropdown select hone par number fetch karna
if (isset($_POST['customer_id'])) {
    $selected_id = $_POST['customer_id'];
    $res = mysqli_query($conn, "SELECT Number FROM `customer table` WHERE `Customer Id` = '$selected_id'");
    if ($row = mysqli_fetch_array($res)) {
        $selected_number = $row['Number'];
    }
}

// 2. Final SMS Send logic
if (isset($_POST['send_sms_btn'])) {
    $num = $_POST['receiver_number'];
    $msg = $_POST['sms_text'];
    echo "<script>alert('Message Sent to $num'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send SMS | CourierPro Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2563eb; --dark: #0f172a; }
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; display: flex; flex-direction: column; min-height: 100vh; }
        
        /* Navbar Style */
        .navbar { background: white; border-bottom: 1px solid #e2e8f0; padding: 1rem 2rem; }
        .navbar-brand { font-weight: 800; color: var(--dark) !important; font-size: 1.5rem; }
        .navbar-brand span { color: var(--primary); }
        .nav-link { font-weight: 500; color: #64748b !important; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }

        /* Content Area */
        .content { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 0; }
        .sms-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 100%; max-width: 500px; border: 1px solid #e2e8f0; }
        
        /* Footer Style */
        footer { background: white; border-top: 1px solid #e2e8f0; padding: 20px 0; margin-top: auto; }
        
        .btn-primary { background: var(--primary); border: none; padding: 12px; font-weight: 600; border-radius: 10px; transition: 0.3s; }
        .btn-primary:hover { background: #1d4ed8; transform: translateY(-2px); }
        .form-label { font-weight: 600; color: #475569; font-size: 0.85rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">COURIER<span>PRO</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="view_all_couriers.php">All Shipments</a></li>
                <li class="nav-item"><a class="nav-link active" href="send_sms.php">Send SMS</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="content">
    <div class="sms-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold m-0">SMS Center</h3>
            <p class="text-muted small">Notify your customers instantly</p>
        </div>

        <form method="POST" id="selectForm">
            <div class="mb-3">
                <label class="form-label">SELECT CUSTOMER</label>
                <select name="customer_id" class="form-select" onchange="document.getElementById('selectForm').submit()">
                    <option value="">-- Click to choose --</option>
                    <?php
                    $customers = mysqli_query($conn, "SELECT * FROM `customer table` WHERE role='customer'");
                    while($c = mysqli_fetch_array($customers)) {
                        $sel = ($selected_id == $c['Customer Id']) ? "selected" : "";
                        echo "<option value='".$c['Customer Id']."' $sel>".$c['Name']."</option>";
                    }
                    ?>
                </select>
            </div>
        </form>

        <form method="POST">
            <input type="hidden" name="customer_id" value="<?php echo $selected_id; ?>">
            
            <div class="mb-3">
                <label class="form-label">RECIPIENT NUMBER</label>
                <input type="text" name="receiver_number" class="form-control" value="<?php echo $selected_number; ?>" readonly placeholder="Auto-fills after selection">
            </div>

            <div class="mb-4">
                <label class="form-label">MESSAGE CONTENT</label>
                <textarea name="sms_text" class="form-control" rows="4" placeholder="Hello, your parcel is ready..." required></textarea>
            </div>

            <button type="submit" name="send_sms_btn" class="btn btn-primary w-100">
                DISPATCH SMS 🚀
            </button>
        </form>
    </div>
</div>

<footer>
    <div class="container text-center">
        <p class="text-muted small mb-1">&copy; 2026 CourierPro Logistics Management.</p>
        <div class="small">
            <a href="#" class="text-decoration-none text-muted mx-2">Privacy Policy</a>
            <a href="#" class="text-decoration-none text-muted mx-2">Terms of Service</a>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>