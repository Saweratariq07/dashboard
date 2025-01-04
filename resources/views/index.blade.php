<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .sidebar-visible {
            transform: translateX(0);
        }
        .sidebar a {
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover {
            background-color: #1e40af; /* Darker blue */
            color: #ffffff; /* White text */
        }
    </style>
</head>
<body class="bg-white text-gray-900">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-blue-800 text-white min-h-screen sidebar fixed md:relative md:transform-none md:sidebar-visible sidebar-hidden">
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Dashboard</h2>
                    <button id="hideSidebar" class="md:hidden text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <ul>
                    <li class="mb-2"><a href="{{ route('posts.index') }}" class="text-xl hover:underline">Posts</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Toggle Button -->
            <div class="md:hidden p-4">
                <button id="toggleSidebar" class="text-blue-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div class="container mx-auto px-4 py-8">
                <div class="flex justify-between w-full">
                    <h1 class="text-4xl font-bold mb-8 text-center text-blue-800 ">All Posts</h1>     
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('posts.index') }}" class="flex-1">
                        <div class="hidden md:flex justify-end items-center">
                            <input type="text" name="search" placeholder="Search posts..." class="w-2/3 p-2 border border-gray-300 rounded-lg focus:outline-none" value="{{ request('search') }}">
                            <button type="submit" class="ml-2 bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition duration-300">Search</button>
                        </div>
                    </form>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                            <div class="flex items-center mb-4">
                                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2v6h4v-6c0-1.104-.896-2-2-2zm0 0c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2v6h4v-6c0-1.104-.896-2-2-2z"></path>
                                </svg>
                                <a href="{{ route('posts.show', $post->id) }}" class="text-xl font-semibold text-blue-600 hover:underline">
                                    {{ $post->title }}
                                </a>
                            </div>
                            <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 50) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                                <div class="flex items-center">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.5 12s4.5-7.5 10.5-7.5S22.5 12 22.5 12 18 19.5 12 19.5 1.5 12 1.5 12z"></path>
                                            <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $post->id)) }}&text={{ urlencode($post->title) }}" target="_blank" class="text-blue-600 hover:text-blue-800 mr-2">
                                        <svg class="w-6 h-6 text-blue-600" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 6C12.6569 6 14 4.65685 14 3C14 1.34315 12.6569 0 11 0C9.34315 0 8 1.34315 8 3C8 3.22371 8.02449 3.44169 8.07092 3.65143L4.86861 5.65287C4.35599 5.24423 3.70652 5 3 5C1.34315 5 0 6.34315 0 8C0 9.65685 1.34315 11 3 11C3.70652 11 4.35599 10.7558 4.86861 10.3471L8.07092 12.3486C8.02449 12.5583 8 12.7763 8 13C8 14.6569 9.34315 16 11 16C12.6569 16 14 14.6569 14 13C14 11.3431 12.6569 10 11 10C10.2935 10 9.644 10.2442 9.13139 10.6529L5.92908 8.65143C5.97551 8.44169 6 8.22371 6 8C6 7.77629 5.97551 7.55831 5.92908 7.34857L9.13139 5.34713C9.644 5.75577 10.2935 6 11 6Z" stroke="currentColor" fill="none"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-800">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="fixed bottom-8 right-8">
                <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Post
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 768) {
                sidebar.classList.toggle('sidebar-hidden');
                sidebar.classList.toggle('sidebar-visible');
            }
        });

        document.getElementById('hideSidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 768) {
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');
            }
        });

        window.addEventListener('resize', function() {
            var sidebar = document.getElementById('sidebar');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('sidebar-hidden');
                sidebar.classList.add('sidebar-visible');
            } else {
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');
            }
        });

        // Ensure sidebar is visible on page load if screen is large
        if (window.innerWidth >= 768) {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
        }
    </script>
</body>
</html>