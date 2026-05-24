<?php
session_start();
include 'db.php';

// SQL Join: Shipment table ko Customer table se link kar rahe hain
// Taake Customer ID ki jagah uska Naam (Sender Name) dikh sake
$sql = "SELECT shipment.*, `customer table`.Name as sender_name 
        FROM shipment 
        LEFT JOIN `customer table` ON shipment.`customer id` = `customer table`.`Customer Id`
        ORDER BY shipment.booking_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Couriers | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2563eb; --bg: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: #1e293b; }
        
        .navbar { background: white; border-bottom: 1px solid #e2e8f0; padding: 1rem 2rem; }
        .navbar-brand { font-weight: 800; color: #0f172a !important; text-decoration: none; }
        .navbar-brand span { color: var(--primary); }

        .container { margin-top: 40px; }
        
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }

        .data-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table { margin-bottom: 0; }
        .table thead { background: #f1f5f9; }
        .table thead th { 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.05em; 
            font-weight: 700; 
            color: #64748b; 
            padding: 15px;
            border: none;
        }

        .table tbody td { 
            padding: 15px; 
            vertical-align: middle; 
            font-size: 0.9rem; 
            border-bottom: 1px solid #f1f5f9;
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-delivered { background: #dcfce7; color: #166534; }

        .tracking-id { font-family: 'Courier New', monospace; font-weight: 700; color: var(--primary); }
        
        .btn-edit { 
            font-size: 0.8rem; 
            padding: 5px 12px; 
            border-radius: 6px; 
            text-decoration: none;
            border: 1px solid #e2e8f0;
            color: #475569;
            transition: 0.2s;
        }
        .btn-edit:hover { background: #f1f5f9; color: var(--primary); }
    </style>
</head>
<body>

<nav class="navbar">
    <a class="navbar-brand" href="dashboard.php">COURIER<span>PRO</span></a>
    <div class="d-flex">
        <a href="new_courier.php" class="btn btn-primary btn-sm rounded-pill px-3">+ Add New Shipment</a>
    </div>
</nav>

<div class="container">
    <div class="page-header">
        <h2 class="fw-bold m-0">All Courier Details</h2>
        <div class="text-muted small">Showing all active and past shipments</div>
    </div>

    <div class="data-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Sender (Customer)</th>
                        <th>Receiver Info</th>
                        <th>Destination</th>
                        <th>Weight</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><span class="tracking-id"><?php echo $row['tracking id']; ?></span></td>
                        <td>
                            <div class="fw-bold"><?php echo $row['sender_name'] ?? 'Walk-in Customer'; ?></div>
                            <small class="text-muted">ID: #<?php echo $row['customer id']; ?></small>
                        </td>
                        <td>
                            <div><?php echo $row['receiver_name']; ?></div>
                            <small class="text-muted"><?php echo $row['receiver_phone']; ?></small>
                        </td>
                        <td><?php echo $row['destination']; ?></td>
                        <td><?php echo $row['parcel_weight']; ?> kg</td>
                        <td><?php echo date('d M, Y', strtotime($row['booking_date'])); ?></td>
                        <td>
                            <span class="status-pill <?php echo ($row['status'] == 'Pending') ? 'status-pending' : 'status-delivered'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit_shipment.php?id=<?php echo $row['shipment id']; ?>" class="btn-edit">Update Status</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center py-5 text-muted'>No shipments found in record.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center py-5 text-muted small">
    &copy; 2026 CourierPro Management System | Admin Access Only
</footer>

</body>
</html>