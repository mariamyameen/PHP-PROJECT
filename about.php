<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | CourierPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: white;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .accent-gradient {
            background: linear-gradient(to r, #3b82f6, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen">

    <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold tracking-tight">Courier<span class="text-blue-500">Pro</span></h1>
        <div class="space-x-6 text-sm font-medium text-slate-400">
            <a href="index.php" class="hover:text-white transition">Home</a>
            <a href="login.php" class="hover:text-white transition">Login</a>
            <a href="register.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition">Get Started</a>
        </div>
    </nav>

    <section class="max-w-5xl mx-auto px-6 py-20 text-center">
        <h2 class="text-5xl font-bold mb-6 italic">Fastest Delivery, <br><span class="accent-gradient">Zero Compromise.</span></h2>
        <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-12">
            CourierPro is a modern logistics management system built to handle your shipments with precision, speed, and absolute transparency.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
            <div class="glass-card p-8 rounded-3xl">
                <h3 class="text-4xl font-bold text-blue-500 mb-2">10k+</h3>
                <p class="text-slate-400 uppercase text-xs tracking-widest">Active Shipments</p>
            </div>
            <div class="glass-card p-8 rounded-3xl">
                <h3 class="text-4xl font-bold text-indigo-500 mb-2">99%</h3>
                <p class="text-slate-400 uppercase text-xs tracking-widest">On-time Delivery</p>
            </div>
            <div class="glass-card p-8 rounded-3xl">
                <h3 class="text-4xl font-bold text-purple-500 mb-2">24/7</h3>
                <p class="text-slate-400 uppercase text-xs tracking-widest">Live Support</p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h3 class="text-3xl font-bold">Why Choose <span class="text-blue-500">CourierPro</span>?</h3>
                <p class="text-slate-400 leading-relaxed">
                    Humara maqsad logistics ko simple aur digital banana hai. Whether you are a small business owner or a large corporation, humari advanced tracking aur database management system aapki har delivery ko mehfooz banati hai.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <span class="text-slate-300">Secure Database Management</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-indigo-500/20 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                        </div>
                        <span class="text-slate-300">Real-time Courier Status Updates</span>
                    </li>
                </ul>
            </div>
            <div class="glass-card h-80 rounded-[3rem] relative overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/10 to-transparent"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-blue-500/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </div>
    </section>

    <footer class="py-12 border-t border-white/5 text-center text-slate-500 text-sm">
        <p>&copy; 2026 CourierPro Logistics Inc. All rights reserved.</p>
    </footer>

</body>
</html>