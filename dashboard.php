<?php
session_start();
include 'db.php'; 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}




$q1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM shipment");
$res1 = mysqli_fetch_array($q1);
$total_couriers = $res1['total'];


$q2 = mysqli_query($conn, "SELECT COUNT(*) as transit FROM shipment WHERE status = 'Pending'");
$res2 = mysqli_fetch_array($q2);
$total_transit = $res2['transit'];


$q3 = mysqli_query($conn, "SELECT COUNT(*) as ok FROM shipment WHERE status = 'Delivered'");
$res3 = mysqli_fetch_array($q3);
$total_delivered = $res3['ok'];


$q4 = mysqli_query($conn, "SELECT COUNT(*) as agents FROM `customer table` WHERE role = 'agent'");
$res4 = mysqli_fetch_array($q4);
$total_agents = $res4['agents'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | CourierPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
            --primary-blue: #3b82f6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: white;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
            min-height: 100vh;
            padding-top: 20px;
            position: fixed;
            width: 260px;
        }

        .nav-link {
            color: #94a3b8 !important;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 5px 15px;
            transition: 0.3s;
            text-decoration: none;
            display: block;
        }

        .nav-link:hover, .active-link {
            background: var(--primary-blue);
            color: white !important;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.2);
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .stat-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .table-dark {
            background: transparent !important;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-4">
        <h4 class="fw-bold">COURIER<span class="text-primary">PRO</span></h4>
        <small class="text-secondary">Admin Panel</small>
    </div>
    <nav>
        <a href="dashboard.php" class="nav-link active-link">🏠 Dashboard</a>
        <a href="new_courier.php" class="nav-link">📦 New Courier</a>
        <a href= "add_customer.php" class= "nav-link"> Add Customer</a>
        <a href="details.php" class="nav-link">📜 View All Details</a>
        <a href="send_sms.php" class="nav-link">📱 Send SMS</a>
        <a href="manage_agents.php" class="nav-link">🕵️ Manage Agents</a>
        <a href="customers.php" class="nav-link">👥 Customers</a>
        <a href="reports.php" class="nav-link">📄 Download Reports</a>
        <hr class="mx-3 text-secondary">
        <a href="logout.php" class="nav-link text-danger">🚪 Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold">Welcome, Admin!</h2>
            <p class="text-secondary small">System status looks good today.</p>
        </div>
        <div class="glass-card py-2 px-4 rounded-pill mb-0">
            <span class="small text-primary">● Live System</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="glass-card">
                <div class="stat-icon">📦</div>
                <h6 class="text-secondary small">Total Courier</h6>
                <h3 class="fw-bold"><?php echo $total_couriers; ?></h3> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="glass-card">
                <div class="stat-icon text-warning">🚚</div>
                <h6 class="text-secondary small">In Transit</h6>
                <h3 class="fw-bold text-warning"><?php echo $total_transit; ?></h3> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="glass-card">
                <div class="stat-icon text-success">✅</div>
                <h6 class="text-secondary small">Delivered</h6>
                <h3 class="fw-bold text-success"><?php echo $total_delivered; ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="glass-card">
                <div class="stat-icon text-info">👤</div>
                <h6 class="text-secondary small">Active Agents</h6>
                <h3 class="fw-bold"><?php echo $total_agents; ?></h3>
            </div>
        </div>
    </div>

    <div class="glass-card mt-4">
        <div class="d-flex justify-content-between mb-4">
            <h5 class="fw-bold">Recent Shipments</h5>
            <a href="reports.php" class="btn btn-sm btn-outline-primary px-3 rounded-pill">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr class="text-secondary small">
                        <th>Tracking ID</th>
                        <th>Customer ID</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
// Displaying the latest 5 shipments
// NOTE: Agar aapke table mein auto-increment key 'id' nahi hai, toh hum 'booking_date' se order kar rahe hain
$table_query = mysqli_query($conn, "SELECT * FROM `shipment` ORDER BY `booking_date` DESC LIMIT 5");

// Agar ab bhi query fail ho, toh yeh line bata degi ke database mein kaunsa column miss hai
if (!$table_query) {
    die("Table Query Fail! reason: " . mysqli_error($conn));
}

while($row = mysqli_fetch_array($table_query)) {
    echo "<tr>";
    
    // Agar 'id' naam ka column nahi hai, toh yahan aap tracking id bhi dikha sakti hain: $row['tracking id']
    // Hum yahan safe side ke liye check kar rahe hain, aap isay tracking id se replace kar sakti hain
    $display_id = isset($row['id']) ? $row['id'] : $row['tracking id'];
    echo "<td><span class='text-primary fw-bold'>" . $display_id . "</span></td>";
    
    // Customer ID dikhana (is column mein space hai isliye single quotes mein 'customer id' sahi hai)
    echo "<td>" . $row['customer id'] . "</td>";
    
    // Status color logic (Pending par Warning/Yellow, Delivered par Success/Green)
    $color = (strtolower($row['status']) == 'delivered') ? 'success' : 'warning';
    echo "<td><span class='badge bg-$color bg-opacity-10 text-$color px-3'>" . $row['status'] . "</span></td>";
    
    // Edit link ke liye bhi sahi ID variable use karna
    echo "<td><a href='edit.php?id=" . $display_id . "' class='btn btn-sm btn-link text-primary'>Edit</a></td>";
    echo "</tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>