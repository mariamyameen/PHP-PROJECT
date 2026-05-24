<?php
session_start();
include 'db.php';


if (isset($_POST['register_btn'])) {
    
    $n = $_POST['name'];
    $e = $_POST['email'];
    $a = $_POST['address'];
    $num = $_POST['Number'];   
    $pass = $_POST['Password']; 
    $r = "customer";

    
    $sql = "INSERT INTO `customer table` (Name, Email, Address, Number, Password, role) 
            VALUES ('$n', '$e', '$a', '$num', '$pass', '$r')";

    if (mysqli_query($conn, $sql)) {
        
        $sms_body = "Welcome $n! Your CourierPro account is active. PW: $pass";
        
        echo "<script>
            alert('Customer Registered Successfully!');
            alert(' SMS SENT TO $num:\\n\"$sms_body\"');
            window.location.href = 'new_courier.php';
        </script>";
        exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer | CourierPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2563eb; --bg: #f8fafc; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: #1e293b; min-height: 100vh; display: flex; flex-direction: column; }
        
        .navbar { background: white; border-bottom: 1px solid #e2e8f0; padding: 15px 30px; }
        .navbar-brand { font-weight: 800; font-size: 1.4rem; color: #0f172a !important; }
        .navbar-brand span { color: var(--primary); }

        .main-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        
        .white-card { 
            background: white; 
            border: 1px solid #e2e8f0; 
            border-radius: 20px; 
            padding: 40px; 
            width: 100%; 
            max-width: 500px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.04); 
        }

        .form-label { font-size: 0.75rem; font-weight: 700; color: #64748b; letter-spacing: 0.5px; margin-bottom: 8px; }
        .form-control { 
            background: #f1f5f9; 
            border: 1px solid #e2e8f0; 
            border-radius: 10px; 
            padding: 12px; 
            margin-bottom: 20px; 
            font-size: 0.95rem;
        }
        .form-control:focus { background: white; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

        .btn-register { 
            background: var(--primary); 
            color: white; 
            border: none; 
            padding: 14px; 
            border-radius: 10px; 
            font-weight: 700; 
            width: 100%; 
            transition: 0.3s; 
        }
        .btn-register:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2); }

        footer { background: white; border-top: 1px solid #e2e8f0; padding: 20px; text-align: center; font-size: 0.8rem; color: #94a3b8; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">COURIER<span>PRO</span></a>
    </div>
</nav>

<div class="main-container">
    <div class="white-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Register Customer</h3>
            <p class="text-muted small">Fill the form to send login credentials via SMS</p>
        </div>

        <form method="POST">
            <label class="form-label text-uppercase">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="John Doe" required>

            <label class="form-label text-uppercase">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>

            <div class="row">
                <div class="col-6">
                    <label class="form-label text-uppercase">Phone Number</label>
                    <input type="text" name="Number" class="form-control" placeholder="03XXXXXXXXX" required>
                </div>
                <div class="col-6">
                    <label class="form-label text-uppercase">Set Password</label>
                    <input type="password" name="Password" class="form-control" placeholder="••••" required>
                </div>
            </div>

            <label class="form-label text-uppercase">Address</label>
            <textarea name="address" class="form-control" rows="2" placeholder="Street, City, Country" required></textarea>

            <button type="submit" name="register_btn" class="btn-register">REGISTER & SEND SMS</button>
        </form>
    </div>
</div>

<footer>
    &copy; 2026 CourierPro Admin Portal | All Rights Reserved
</footer>

</body>
</html>