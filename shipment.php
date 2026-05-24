<?php
// Session start karna sab se pehla kaam hai
session_start();
include 'db.php';

// 1. SECURITY CHECK: Agar login nahi hai to wapas login.php par bhej do
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Session se ID uthana (Error fix)
$cust_id = $_SESSION['customer_id'];
$cust_name = $_SESSION['customer_name'] ?? 'Customer';

// 3. Database se sirf is customer ki shipments nikalna
// Column names mein space hai isliye backticks (``) zaroori hain
$sql = "SELECT * FROM shipment WHERE `customer id` = '$cust_id' ORDER BY booking_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shipments | CourierPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #4f46e5; --bg: #f8fafc; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: #1e293b; }
        
        .navbar { background: white; border-bottom: 1px solid #e2e8f0; padding: 1rem 2rem; }
        .navbar-brand { font-weight: 800; color: #0f172a !important; text-decoration: none; }
        .navbar-brand span { color: var(--primary); }

        .welcome-header { 
            background: white; padding: 50px 0; border-bottom: 1px solid #e2e8f0; 
            margin-bottom: 40px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }
        
        .shipment-card {
            background: white; border-radius: 20px; border: 1px solid #e2e8f0;
            padding: 25px; margin-bottom: 25px; transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .shipment-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }

        .status-badge {
            padding: 8px 16px; border-radius: 50px; font-size: 0.7rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .status-delivered { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

        .tracking-label { font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; }
        .tracking-id { font-family: 'Monaco', monospace; color: var(--primary); font-weight: 700; font-size: 1.2rem; }
        
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }
        .info-item i { color: var(--primary); margin-right: 8px; width: 16px; }
        .info-text { font-weight: 600; font-size: 0.95rem; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">COURIER<span>PRO</span></a>
        <div class="dropdown">
            <button class="btn btn-light rounded-pill dropdown-toggle fw-bold" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-2"></i><?php echo $cust_name; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<div class="welcome-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-2">My Shipments</h1>
                <p class="text-muted lead mb-0">Track all your active and past deliveries in one place.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="badge bg-primary px-3 py-2 rounded-pill">
                    Total: <?php echo mysqli_num_rows($result); ?> Shipments
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipment List -->
<div class="container pb-5">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-6">
                    <div class="shipment-card">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                            <div>
                                <p class="tracking-label mb-0">Tracking Number</p>
                                <h4 class="tracking-id mb-0"><?php echo $row['tracking id']; ?></h4>
                            </div>
                            <span class="status-badge <?php echo (strtolower($row['status']) == 'pending') ? 'status-pending' : 'status-delivered'; ?>">
                                <i class="fas fa-circle-dot me-1"></i> <?php echo $row['status']; ?>
                            </span>
                        </div>

                        <div class="info-grid">
                            <div class="info-item">
                                <p class="tracking-label mb-1">Destination</p>
                                <div class="info-text"><i class="fas fa-location-dot"></i> <?php echo $row['destination']; ?></div>
                            </div>
                            <div class="info-item">
                                <p class="tracking-label mb-1">Booking Date</p>
                                <div class="info-text"><i class="fas fa-calendar-day"></i> <?php echo date('d M, Y', strtotime($row['booking_date'])); ?></div>
                            </div>
                            <div class="info-item">
                                <p class="tracking-label mb-1">Receiver Name</p>
                                <div class="info-text"><i class="fas fa-user"></i> <?php echo $row['receiver_name']; ?></div>
                            </div>
                            <div class="info-item">
                                <p class="tracking-label mb-1">Parcel Weight</p>
                                <div class="info-text"><i class="fas fa-weight-hanging"></i> <?php echo $row['parcel_weight']; ?> KG</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <!-- Khali State -->
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-box-open fa-5x text-light-emphasis" style="opacity: 0.3;"></i>
            </div>
            <h3 class="fw-bold">No Shipments Yet</h3>
            <p class="text-muted">Once you book a parcel, it will appear here for tracking.</p>
        </div>
    <?php endif; ?>
</div>

<footer class="text-center py-4 border-top bg-white">
    <p class="text-muted small mb-0">&copy; 2026 CourierPro Logistics Dashboard</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>