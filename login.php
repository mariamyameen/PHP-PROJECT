
<?php
session_start();
include_once 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `customer table` WHERE email='$email'";
    $result = mysqli_query($conn, $sql);





    $parsedata = mysqli_fetch_assoc($result);

   



    
    if (!password_verify($password, $parsedata['Password'])) {
        echo "<script>alert('Invalid Credentials'); location.href='login.php';</script>";
        exit;
    }

    $_SESSION['user_name'] = $parsedata['name'];
    $_SESSION['user_email'] = $parsedata['email'];
    $_SESSION['role']      = $parsedata['role'];
$_SESSION['customer_id'] = $parsedata['Customer Id'];
$_SESSION['customer_name'] = $parsedata['Name'];

    if ($parsedata['role'] == "admin") {
        echo "<script>alert('Admin Login done'); location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('User Login done'); location.href='shipment.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Pro | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .glow-input:focus {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
            border-color: #3b82f6;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 text-white">

    <div class="glass p-10 rounded-[2.5rem] w-full max-w-md relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-600/20 blur-[80px] rounded-full"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-purple-600/20 blur-[80px] rounded-full"></div>

        <div class="relative z-10 text-center mb-10">
            <div class="w-20 h-20 bg-gradient-to-tr from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl rotate-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold tracking-tight mb-2 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Courier Pro</h1>
            <p class="text-slate-400 text-sm">Secure Logistics Management</p>
        </div>

        <form action="login.php" method="POST" class="relative z-10 space-y-6">
            <div class="space-y-2">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Email</label>
                <input type="email" name="email" required 
                    class="w-full bg-white/5 border border-white/10 px-5 py-4 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                    placeholder="Email Address">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-white/5 border border-white/10 px-5 py-4 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                    placeholder="Password">
            </div>

            <button type="submit" name="login" 
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-900/20 transition-all hover:scale-[1.02] active:scale-95 text-lg">
                Sign In
            </button>
        </form>

        <div class="relative z-10 mt-10 text-center">
            <p class="text-slate-400 text-sm">
                Need access? 
                <a href="register.php" class="text-blue-400 font-semibold hover:text-blue-300 underline underline-offset-4">Create Account</a>
            </p>
        </div>
    </div>

</body>
</html>