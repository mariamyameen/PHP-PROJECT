<?php
session_start();

include 'db.php';
if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $password_hash = password_hash($_POST['password'],PASSWORD_DEFAULT);


$sql = "INSERT INTO `customer table` (name, email, number, address, Password, role)
        VALUES ('$name', '$email', '$number', '$address', '$password_hash', 'customer')";

     $result = mysqli_query($conn,$sql);

      if (!$result) {
        $error = mysqli_errno($conn);
        if ($error == 1062) {
            echo "<script>alert('This account already exists!'); window.location.href='login.php';</script>";
            exit();
        } else {
            
            echo "Database Error: " . mysqli_error($conn);
            exit();
        }
    } else {
        
       $_SESSION['user_name'] = $name;
       $_SESSION['user_email'] = $email;
       $_SESSION['user_number'] = $number;
       $_SESSION['user_address'] = $address;

        echo "<script>
                alert('Registration successful!'); 
                window.location.href='login.php';
              </script>";
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Pro | Sign Up</title>
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
<body class="min-h-screen flex items-center justify-center p-6 text-white relative">
    
    <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-600/20 blur-[80px] rounded-full"></div>
    <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-purple-600/20 blur-[80px] rounded-full"></div>

    <div class="glass p-10 rounded-[2.5rem] w-full max-w-lg relative z-10 transform transition-all hover:scale-[1.01]">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold tracking-tight mb-2 bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Create Account</h1>
            <p class="text-slate-400 text-sm">Join Courier Pro - Smart Logistics</p>
        </div>

        <?php if(isset($error)): echo "<div class='bg-red-900/50 text-red-300 border border-red-700 p-3 rounded-xl mb-6 text-sm text-center'>$error</div>"; endif; ?>
        <?php if(isset($success)): echo "<div class='bg-green-900/50 text-green-300 border border-green-700 p-3 rounded-xl mb-6 text-sm text-center'>$success</div>"; endif; ?>

        <form action="register.php" method="POST" class="space-y-5">
            <div class="space-y-1">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                <input type="text" name="name" required 
                    class="w-full bg-white/5 border border-white/10 px-5 py-3.5 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                    placeholder="John Doe">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                <input type="email" name="email" required 
                    class="w-full bg-white/5 border border-white/10 px-5 py-3.5 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                    placeholder="you@company.com">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Credentials</label>
                <input type="password" name="password" required 
                    class="w-full bg-white/5 border border-white/10 px-5 py-3.5 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                    placeholder="Create Password">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                    <input type="text" name="number" required 
                        class="w-full bg-white/5 border border-white/10 px-5 py-3.5 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                        placeholder="03XXXXXXXXX">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-widest ml-1">Postal Address</label>
                    <input type="text" name="address" required 
                        class="w-full bg-white/5 border border-white/10 px-5 py-3.5 rounded-2xl outline-none glow-input transition-all placeholder:text-slate-600"
                        placeholder="Karachi, Pakistan">
                </div>
            </div>

            <button type="submit" name="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-900/20 transition-all hover:scale-[1.02] active:scale-95 text-lg mt-5">
                Register to System
            </button>
        </form>

        <div class="mt-10 text-center">
            <p class="text-slate-400 text-sm">
                Already member? 
                <a href="login.php" class="text-blue-400 font-semibold hover:text-blue-300 underline underline-offset-4">Log In Here</a>
            </p>
        </div>
    </div>

</body>
</html>