<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realty - High Quality Environment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50">

    <main class="w-full overflow-x-hidden">

        <section class="relative w-full h-screen min-h-[800px]">
            
            <div class="absolute inset-0 w-full h-full">
                <img src="https://images.unsplash.com/photo-1600585152220-90363fe7e115?q=80&w=1920&auto=format&fit=crop" 
                     alt="Background" 
                     class="w-full h-full object-cover">
                
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <nav class="absolute top-0 left-0 w-full z-20 px-12 py-8 flex justify-between items-center">
                <div class="flex items-center gap-2 text-[#A8E6CF] font-bold text-2xl tracking-wide">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Realty
                </div>

                <div class="hidden md:flex space-x-10 text-gray-200 text-sm font-medium">
                    <a href="#" class="hover:text-white transition">Home</a>
                    <a href="#" class="hover:text-white transition">About Us</a>
                    <a href="#" class="hover:text-white transition">Buy</a>
                    <a href="#" class="hover:text-white transition">Contact Us</a>
                </div>
            </nav>

            <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4 pt-10">
                
                <p class="text-white text-xs md:text-sm uppercase tracking-[0.2em] mb-4 opacity-90">
                    Welcome to one of the best real estate agency
                </p>

                <h1 class="text-white text-5xl md:text-7xl font-bold leading-tight mb-12 drop-shadow-lg">
                    HIGH QUALITY<br>ENVIRONMENT
                </h1>

                <div class="bg-white rounded-full w-full max-w-3xl flex items-center p-2 shadow-2xl">
                    
                    <div class="flex-1 border-r border-gray-300 px-6 py-2 relative">
                        <button class="w-full flex items-center justify-between text-gray-600 hover:text-gray-900 text-left font-medium text-sm md:text-base">
                            <span>Buy Apartement</span>
                            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>

                    <div class="flex-1 px-6 py-2 relative">
                        <button class="w-full flex items-center justify-between text-gray-600 hover:text-gray-900 text-left font-medium text-sm md:text-base">
                            <span>Category</span>
                            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>

                    </div>

                <div class="absolute bottom-10 flex gap-4 text-[10px] md:text-xs text-white/70 font-light">
                    <span class="font-bold text-white">Latest Listings:</span>
                    <span class="bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10">Modern Family Home</span>
                    <span class="bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10">Chic Downtown Condo</span>
                    <span class="bg-white/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10 hidden md:inline">Cottage Near the Mountains</span>
                </div>

            </div>
        </section>

        <section class="h-screen bg-white flex items-center justify-center">
            <p class="text-gray-400 text-xl">Bagian 2 akan kita buat di sini...</p>
        </section>

    </main>

</body>
</html>