<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Gusti & Azwa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/') }}/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#dcb8a6',
                        primaryDark: '#c79f8c',
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #e2e8f0;
            border-radius: 20px;
        }

        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-[#fafafa] font-sans text-slate-800 antialiased">

    <div
        class="fixed top-0 z-40 flex w-full items-center justify-between border-b border-slate-200 bg-white px-4 py-4 lg:hidden">
        <div class="flex items-center gap-3">
            <button id="mobile-menu-btn" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 focus:outline-none">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-slate-800">Admin Nikah</h1>
        </div>
        <div class="h-8 w-8 overflow-hidden rounded-full bg-slate-200">
            <i class="fa-solid fa-user mt-2 w-full text-center text-slate-400"></i>
        </div>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-900/50 lg:hidden"></div>

    <aside id="sidebar"
        class="sidebar-transition fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-slate-200 bg-white lg:translate-x-0">

        <div class="flex h-16 items-center px-8 lg:mt-6 lg:mb-2 lg:h-auto">
            <h1 class="text-xl font-bold tracking-tight text-slate-800 lg:text-2xl">Admin Nikah</h1>
            <button id="close-sidebar" class="ml-auto rounded p-2 text-slate-500 lg:hidden">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <nav class="mt-8 flex flex-1 flex-col gap-2 px-4">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#d5a995] text-neutral-900 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} transition-colors">
                <i class="fa-solid fa-table-cells-large w-5 text-center"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.konten') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.konten') ? 'bg-[#d5a995] text-neutral-900 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} transition-colors">
                <i class="fa-solid fa-pen-to-square w-5 text-center"></i>
                Edit Konten
            </a>
            <a href="{{ route('admin.tamu') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.tamu') ? 'bg-[#d5a995] text-neutral-900 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} transition-colors">
                <i class="fa-solid fa-user-group w-5 text-center"></i>
                Manajemen Tamu
            </a>
            <a href="{{ route('admin.galeri') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.galeri') ? 'bg-[#d5a995] text-neutral-900 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} transition-colors">
                <i class="fa-regular fa-image w-5 text-center"></i>
                Galeri
            </a>
        </nav>

        <div class="border-t border-slate-100 p-4">
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center gap-3 rounded-xl p-2 transition-colors hover:bg-slate-50">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-slate-800">{{ session('admin_name', 'Admin') }}</span>
                    <span class="text-xs font-medium text-slate-500 hover:text-red-500 transition-colors">Log out</span>
                </div>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <main class="min-h-screen pt-20 transition-all duration-300 lg:ml-64 lg:pt-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12">
            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            btn.addEventListener('click', toggleSidebar);
            closeBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        });
    </script>
    @stack('scripts')
</body>

</html>
