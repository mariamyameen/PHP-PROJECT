<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | CourierPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: white;
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>

    <nav class="p-6 flex justify-between items-center max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold tracking-tight">Courier<span class="text-blue-500">Pro</span></h1>
        <div class="space-x-6 text-sm font-medium text-slate-400">
            <a href="index.php" class="hover:text-white transition">Home</a>
            <a href="about.php" class="hover:text-white transition">About</a>
            <a href="login.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition">Login</a>
        </div>
    </nav>

    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Get In <span class="text-blue-500">Touch</span></h2>
            <p class="text-slate-400">Ask Any Queries</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <div class="space-y-8">
                <div class="glass-card p-8 rounded-3xl flex items-start space-x-4">
                    <div class="bg-blue-500/20 p-3 rounded-2xl text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Email Us</h4>
                        <p class="text-slate-400">support@courierpro.com</p>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-3xl flex items-start space-x-4">
                    <div class="bg-indigo-500/20 p-3 rounded-2xl text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg">Our Office</h4>
                        <p class="text-slate-400">Tech Park, Karachi, Pakistan</p>
                    </div>
                </div>
            </div>

            <div class="glass-card p-8 rounded-[2rem]">
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Full Name</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl input-glass" placeholder="Name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Email Address</label>
                        <input type="email" class="w-full px-4 py-3 rounded-xl input-glass" placeholder="example@mail.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Message</label>
                        <textarea rows="4" class="w-full px-4 py-3 rounded-xl input-glass" placeholder="Any Queries?"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl transition duration-300 shadow-lg shadow-blue-600/20">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </section>

    <footer class="py-12 text-center text-slate-500 text-sm">
        <p>&copy; 2026 CourierPro Logistics Inc.</p>
    </footer>

</body>
</html>