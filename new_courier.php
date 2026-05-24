<?php
session_start();
include 'db.php';

if (isset($_POST['add_shipment'])) {
    
    // Form se aayi hui Customer ID
    $customer_id = $_POST['customer_id'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone = $_POST['receiver_phone'];
    $parcel_weight = $_POST['parcel_weight'];
    $destination = $_POST['destination'];
    $tracking_id = "CP-" . rand(100000, 999999);
    $status = "Pending";
    $booking_date = date("Y-m-d"); 

    // SQL Query mein column names ko backticks (``) mein likhna zaroori hai kyunke un mein SPACES hain
    $sql = "INSERT INTO shipment (
        `customer id`, 
        `tracking id`, 
        `receiver_name`, 
        `receiver_phone`, 
        `status`, 
        `parcel_weight`, 
        `destination`, 
        `booking_date`
    ) VALUES (
        '$customer_id', 
        '$tracking_id', 
        '$receiver_name', 
        '$receiver_phone', 
        '$status', 
        '$parcel_weight', 
        '$destination', 
        '$booking_date'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Shipment Booked! Tracking ID: $tracking_id');
            window.location.href = 'dashboard.php';
        </script>";
        exit();
    } else {
        // Agar error aaye toh ye line batayegi ke asal masla kya hai
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Shipment | CourierPro Elite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --accent: #f43f5e;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            background-image: radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%), 
                              radial-gradient(at 100% 0%, rgba(244, 63, 94, 0.05) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand { font-weight: 800; font-size: 1.4rem; letter-spacing: -0.5px; }
        .navbar-brand span { color: var(--primary); }

        .form-container {
            max-width: 850px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .booking-card {
            background: var(--card-bg);
            border-radius: 24px;
            border: 1px solid rgba(226, 232, 240, 1);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            padding: 40px;
            color: white;
            text-align: center;
        }

        .card-body-custom { padding: 40px; }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            margin-top: 10px;
        }

        .section-header i {
            width: 35px;
            height: 35px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-group-text {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
        }

        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .divider {
            height: 1px;
            background: #f1f5f9;
            margin: 30px 0;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-box-open me-2"></i>COURIER<span>PRO</span></a>
        <div class="d-flex">
            <a href="dashboard.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Back to Panel</a>
        </div>
    </div>
</nav>

<div class="form-container">
    <div class="booking-card">
        <div class="card-header-custom">
            <h2 class="fw-bold m-0">Create New Shipment</h2>
            <p class="opacity-75 mt-2 mb-0">Fill in the details below to generate a tracking ID</p>
        </div>

        <div class="card-body-custom">
            <form method="POST">
                
                <!-- Sender Section -->
                <div class="section-header">
                    <i class="fas fa-user-arrow-up"></i>
                    <h5 class="section-title">Sender Details</h5>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Select Registered Customer</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <select name="customer_id" class="form-select" required>
                            <option value="">Search customer by name...</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM `customer table` WHERE role='customer'");
                            while($row = mysqli_fetch_array($res)) {
                                echo "<option value='".$row['Customer Id']."'>".$row['Name']." (ID: ".$row['Customer Id'].")</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Receiver Section -->
                <div class="section-header">
                    <i class="fas fa-user-arrow-down"></i>
                    <h5 class="section-title">Receiver Details</h5>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="receiver_name" class="form-control" placeholder="Enter recipient name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="receiver_phone" class="form-control" placeholder="03XXXXXXXXX" required>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Shipment Details -->
                <div class="section-header">
                    <i class="fas fa-box"></i>
                    <h5 class="section-title">Parcel & Logistics</h5>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Weight (Kilograms)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="parcel_weight" class="form-control" placeholder="0.50" required>
                            <span class="input-group-text">KG</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination City</label>
                        <input type="text" name="destination" class="form-control" placeholder="City name" required>
                    </div>
                </div>

                <button type="submit" name="add_shipment" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> CONFIRM & GENERATE RECEIPT
                </button>
            </form>
        </div>
    </div>
    
    <p class="text-center mt-4 text-muted small">
        &copy; 2026 CourierPro Logistics Dashboard. Secure & Encrypted.
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>