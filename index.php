<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourierPro | Smart Logistics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --primary-blue: #3b82f6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Glassmorphism Effect    
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
        }

        /* Navbar Styling */
        .navbar {
            margin-top: 20px;
            padding: 15px 0;
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 10px 30px;
        }

        .nav-link {
            color: #94a3b8 !important;
            margin: 0 10px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: white !important;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #60a5fa, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .btn-track {
            background: var(--primary-blue);
            color: white;
            padding: 15px 40px;
            border-radius: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-track:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(59, 130, 246, 0.4);
            color: white;
        }

        /* Footer */
        footer {
            padding: 40px 0;
            border-top: 1px solid var(--glass-border);
            margin-top: 50px;
        }

        .admin-link {
            font-size: 0.7rem;
            color: #334155;
            text-decoration: none;
        }

        .admin-link:hover {
            color: var(--primary-blue);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="nav-glass d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand text-white fw-bold" href="#">COURIER<span class="text-primary">PRO</span></a>
                 <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-none d-md-flex">
                        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>
                
                
              

                    <?php if(isset($_SESSION['fname'])): ?>
                        <div class="ms-3 d-flex align-items-center">
                            <span class="me-3 small text-secondary">Hi, <?php echo $_SESSION['user_name']; ?></span>
                            <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-pill">Logout</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary rounded-pill px-4 ms-3">Track Shipment</a>
                        
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container hero-section">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 border border-primary border-opacity-20">2026 LOGISTICS TECH</span>
                <h1 class="hero-title">Track Your Happiness In Real-Time</h1>
                <p class="text-secondary mb-5 fs-5">Fastest courier service with end-to-end encryption and live GPS tracking for every parcel.</p>
                
                <?php if(!isset($_SESSION['fname'])): ?>
                    <a href="login.php" class="btn-track">Click to Track Your Order</a>
                <?php else: ?>
                    <div class="glass-card p-4 d-inline-block w-100 max-width-500">
                        <h5 class="mb-3">Enter Tracking ID</h5>
                        <form action="tracking.php" method="GET" class="d-flex gap-2">
                            <input type="text" class="form-control bg-transparent border-secondary text-white" placeholder="e.g. CP-99821">
                            <button class="btn btn-primary">Track</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="container text-center">
        <p class="small text-secondary mb-1">&copy; 2026 CourierPro Logistics Network.</p>
        <a href="login.php" class="admin-link">Staff Portal Access</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>