<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Dashboard Undangan</title>

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
</head>

<body class="flex min-h-screen items-center justify-center bg-slate-50 p-4">

    <div
        class="w-full max-w-[400px] rounded-2xl border border-slate-200 bg-white p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:p-10">

        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-slate-800">Admin Login</h1>
            <p class="text-sm text-slate-500 mt-2">Gunakan admin@gmail.com / admin123</p>
        </div>

        @if(session('error'))
            <div class="mb-4 rounded-xl bg-red-50 p-3 text-center text-sm font-medium text-red-600 border border-red-100">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.process') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div>
                <label for="email" class="mb-2 block text-xs font-bold text-slate-700">Email/Username</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <input type="email" name="email" id="email" required placeholder="admin@gmail.com"
                        class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 text-sm text-slate-800 transition-colors focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" />
                </div>
            </div>

            <div>
                <div class="mb-2 flex items-center justify-between">
                    <label for="password" class="block text-xs font-bold text-slate-700">Password</label>
                </div>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 text-lg tracking-widest text-slate-800 transition-colors focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400 placeholder:tracking-normal placeholder:text-sm" />
                </div>
            </div>

            <button type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#d5a995] px-4 py-3.5 text-sm font-bold text-neutral-900 shadow-md transition-all hover:bg-[#c79782] mt-4">
                Masuk ke Dashboard
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>

        </form>
    </div>

</body>

</html>