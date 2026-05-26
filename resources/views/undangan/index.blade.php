<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pernikahan Gusti & Azwa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/') }}/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

<body class="bg-gray-100 min-h-screen pt-4 pb-16 md:pt-8 overflow-hidden">

    <audio id="bgm" loop>
        <source src="{{ asset('assets/') }}/lagu.mp3" type="audio/mpeg">
    </audio>

    <div id="invitation-cover"
        class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-neutral-900 transition-all duration-[1200ms] ease-in-out">
        <div class="pointer-events-none absolute inset-0 z-0 text-center">
            <img src="{{ asset($settings['foto_cover'] ?? 'assets/herobg.jpg') }}" alt="Background Texture"
                class="h-full w-full object-cover opacity-50 brightness-50">
        </div>

        <div class="relative z-10 flex w-full flex-col items-center text-center px-4">
            <div
                class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-primary/20 backdrop-blur-sm animate-bounce shadow-[0_0_20px_rgba(220,184,166,0.2)]">
                <i class="fa-regular fa-envelope text-4xl text-primary"></i>
            </div>

            <h2 class="text-sm md:text-base font-semibold tracking-[0.2em] text-gray-300 uppercase mb-4">
                {{ $judul }}
            </h2>
            <p class="mx-auto mb-6 max-w-xl text-sm leading-relaxed text-gray-200 md:text-base">{{ $settings['landing_page_subtitle'] ?? 'Semua informasi pernikahan lengkap dalam satu halaman undangan digital untuk para tamu.' }}</p>
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-8">{{ explode(' ', $settings['nama_mempelai_pria'] ?? 'Gusti')[0] }} & {{ explode(' ', $settings['nama_mempelai_wanita'] ?? 'Azwa')[0] }}</h1>

            <div class="relative mb-12 flex w-full max-w-md justify-center">
                <div
                    class="relative z-10 rounded-2xl border border-white/5 bg-[#161616cc] px-6 py-3 shadow-[0_8px_30px_rgb(0,0,0,0.3)] backdrop-blur-md">
                    <p class="text-sm text-gray-300 md:text-base">
                        Kepada Yth. Bpk/Ibu <span class="ml-1 font-semibold text-white">{{ $nama_tamu }}</span>
                    </p>
                </div>
            </div>

            <button id="open-invitation"
                class="relative z-20 flex items-center gap-2.5 rounded-2xl bg-primary px-8 py-3.5 font-semibold text-neutral-900 shadow-xl shadow-primary/30 transition-all duration-300 hover:scale-105 hover:bg-primaryDark">
                <i class="fa-solid fa-envelope-open-text text-[20px] opacity-80"></i>
                Buka Surat
            </button>
        </div>
    </div>

    <div class="mx-auto mt-20 w-full max-w-[1024px] px-4">

        <div data-aos="fade-down" class="mb-12 flex flex-col items-center justify-center">
            <i class="fa-regular fa-heart mb-2 text-3xl text-primary"></i>
            <h2 class="border-b-4 border-primary pb-1 text-3xl font-bold tracking-tight text-slate-800 md:text-4xl">
                Lovebirds
            </h2>
        </div>

        <div class="flex flex-col items-center justify-around gap-12 md:flex-row md:gap-8">


            <div data-aos="fade-right" data-aos-delay="200" class="flex flex-col items-center text-center">
                <div
                    class="mb-6 h-48 w-48 overflow-hidden rounded-full border-4 border-white shadow-xl md:h-56 md:w-56">
                    <img src="{{ asset($settings['foto_pria'] ?? 'assets/gustiportrait.jpeg') }}" alt="{{ $settings['nama_mempelai_pria'] ?? 'Gusti Panji Widodo' }}" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-1 text-2xl font-bold text-slate-800">{{ $settings['nama_mempelai_pria'] ?? 'Gusti Panji Widodo' }}</h3>
                <p class="text-sm text-primaryDark md:text-base">{{ $settings['ortu_pria'] ?? 'Putra dari Bpk. Joko & Ibu Titik' }}</p>
            </div>

            <div data-aos="fade-left" data-aos-delay="400" class="flex flex-col items-center text-center">
                <div
                    class="mb-6 h-48 w-48 overflow-hidden rounded-full border-4 border-white shadow-xl md:h-56 md:w-56">
                    <img src="{{ asset($settings['foto_wanita'] ?? 'assets/azwaportrait.jpeg') }}" alt="{{ $settings['nama_mempelai_wanita'] ?? 'Azwa Zahira' }}" class="h-full w-full object-cover">
                </div>
                <h3 class="mb-1 text-2xl font-bold text-slate-800">{{ $settings['nama_mempelai_wanita'] ?? 'Azwa Zahira' }}</h3>
                <p class="text-sm text-primaryDark md:text-base">{{ $settings['ortu_wanita'] ?? 'Putri dari Bpk. Rusnaldi & Ibu Verawati' }}</p>
            </div>

        </div>

    </div>

    <div class="mx-auto mt-16 mb-12 w-full max-w-[1024px] px-4">
        <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-xl">
            <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-primaryDark">Landing Page</p>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">{{ $settings['landing_page_title'] ?? 'The Wedding Of' }}</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-600">{{ $settings['landing_page_subtitle'] ?? 'Semua informasi pernikahan lengkap dalam satu halaman undangan digital untuk para tamu.' }}</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="#kisah-cinta" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">Kisah Cinta</a>
                    <a href="#countdown" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">Countdown</a>
                    <a href="#acara" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">Acara</a>
                    <a href="#lokasi" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">Lokasi</a>
                    <a href="#galeri" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">Galeri</a>
                    <a href="#rsvp" class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-primary/10">RSVP</a>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-2">
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h3 class="mb-4 text-lg font-bold text-slate-800">Detail Acara</h3>
                    <div class="space-y-4 text-slate-600">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Akad</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $settings['tanggal_akad'] ?? "Jum'at, 11 Juli 2026" }}</p>
                            <p>{{ $settings['waktu_akad'] ?? '08:00 - 15:00 WIB' }}</p>
                            <p>{{ $settings['tempat_akad'] ?? 'Masjid Al-Ikhlas' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Resepsi</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $settings['tanggal_resepsi'] ?? 'Minggu, 13 Juli 2026' }}</p>
                            <p>{{ $settings['waktu_resepsi'] ?? '09:00 - 16:00 WIB' }}</p>
                            <p>{{ $settings['tempat_resepsi'] ?? 'Grand Central Hotel Pekanbaru' }}</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h3 class="mb-4 text-lg font-bold text-slate-800">Lokasi dan Akses</h3>
                    <p class="text-sm leading-relaxed text-slate-600">{{ $settings['alamat_resepsi'] ?? 'Jl. Jend. Sudirman No.1, Tengkerang Utara, Kec. Bukit Raya, Kota Pekanbaru, Riau' }}</p>
                    <a href="{{ $settings['map_link'] ?? 'https://www.google.com/maps/search/?api=1&query=Grand+Central+Hotel+Pekanbaru' }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-neutral-900 shadow-lg shadow-primary/20 transition hover:bg-primaryDark">Buka Google Maps</a>
                </div>
            </div>
        </div>
    </div>

    <div id="kisah-cinta" data-aos="fade-up" class="mx-auto mt-28 mb-12 w-full max-w-[1024px] px-4">
        <h2 class="mb-16 text-center text-2xl font-bold text-slate-800 md:text-3xl">{{ ($settings['kisah_section_title'] ?? '') ?: 'Kisah Cinta Kami' }}</h2>

        <div class="relative mx-auto w-full max-w-3xl">
            <div class="absolute bottom-0 left-[24px] top-2 w-0.5 -translate-x-1/2 bg-primary/40 md:left-1/2"></div>

            <div data-aos="fade-right" data-aos-delay="100"
                class="relative mb-16 flex w-full items-start justify-between md:items-center">
                <div class="hidden w-5/12 md:block"></div>
                <div
                    class="absolute left-[24px] top-1 z-10 flex h-5 w-5 -translate-x-1/2 rounded-full bg-primary shadow-[0_0_0_4px_rgba(220,184,166,0.3)] md:static md:top-auto md:translate-x-0">
                </div>
                <div class="w-full pl-16 md:order-first md:w-5/12 md:pl-0 md:pr-10 md:text-right">
                    <h3 class="font-bold text-primaryDark md:text-lg">{{ ($settings['kisah_cinta_title_1'] ?? '') ?: 'Pertemuan Pertama' }}</h3>
                    <p class="mb-3 mt-1 text-sm font-medium tracking-wide text-slate-400">{{ ($settings['kisah_cinta_date_1'] ?? '') ?: 'Januari 2020' }}</p>
                    <p class="text-sm leading-relaxed text-slate-600">{{ ($settings['kisah_cinta_description_1'] ?? '') ?: 'Mata saling bertatap di sebuah acara kampus yang ramai. Obrolan kecil menjadi pembuka jalan untuk saling mengenal lebih dalam dan berbagi cerita.' }}</p>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-delay="200"
                class="relative mb-16 flex w-full items-start justify-between md:items-center">
                <div class="hidden w-5/12 md:block"></div>
                <div
                    class="absolute left-[24px] top-1 z-10 flex h-5 w-5 -translate-x-1/2 rounded-full bg-primary shadow-[0_0_0_4px_rgba(220,184,166,0.3)] md:static md:top-auto md:translate-x-0">
                </div>
                <div class="w-full pl-16 text-left md:w-5/12 md:pl-10">
                    <h3 class="font-bold text-primaryDark md:text-lg">{{ ($settings['kisah_cinta_title_2'] ?? '') ?: 'Menjalin Hubungan' }}</h3>
                    <p class="mb-3 mt-1 text-sm font-medium tracking-wide text-slate-400">{{ ($settings['kisah_cinta_date_2'] ?? '') ?: 'Februari 2021' }}</p>
                    <p class="text-sm leading-relaxed text-slate-600">{{ ($settings['kisah_cinta_description_2'] ?? '') ?: 'Setelah satu tahun berbagi tawa dan air mata, kami memantapkan hari untuk merajut kasih, berjanji berjalan berdampingan menghadapi masa depan.' }}</p>
                </div>
            </div>

            <div data-aos="fade-right" data-aos-delay="300"
                class="relative flex w-full items-start justify-between md:items-center">
                <div class="hidden w-5/12 md:block"></div>
                <div
                    class="absolute left-[24px] top-1 z-10 flex h-5 w-5 -translate-x-1/2 rounded-full bg-primary shadow-[0_0_0_4px_rgba(220,184,166,0.3)] md:static md:top-auto md:translate-x-0">
                </div>
                <div class="w-full pl-16 md:order-first md:w-5/12 md:pl-0 md:pr-10 md:text-right">
                    <h3 class="font-bold text-primaryDark md:text-lg">{{ ($settings['kisah_cinta_title_3'] ?? '') ?: 'Lamaran' }}</h3>
                    <p class="mb-3 mt-1 text-sm font-medium tracking-wide text-slate-400">{{ ($settings['kisah_cinta_date_3'] ?? '') ?: 'Oktober 2025' }}</p>
                    <p class="text-sm leading-relaxed text-slate-600">{{ ($settings['kisah_cinta_description_3'] ?? '') ?: 'Dengan restu dari kedua keluarga tercinta, seuntai cincin tersemat sebagai tanda keseriusan dan janji suci ke jenjang pernikahan.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="countdown" data-aos="fade-up" data-aos-easing="ease-out" data-aos-duration="1000"
        class="mx-auto mt-20 w-full max-w-[1024px] px-4 text-center">
        <h2 class="mb-10 text-2xl font-bold text-slate-800 md:text-3xl">Menghitung Hari Bahagia</h2>

        <div class="flex flex-wrap justify-center gap-6 md:gap-12">
            <div class="flex flex-col items-center">
                <span id="days" class="text-4xl font-bold text-primary md:text-5xl">12</span>
                <span class="mt-2 text-sm font-medium text-slate-600 md:text-base">Hari</span>
            </div>

            <div class="flex flex-col items-center">
                <span id="hours" class="text-4xl font-bold text-primary md:text-5xl">05</span>
                <span class="mt-2 text-sm font-medium text-slate-600 md:text-base">Jam</span>
            </div>

            <div class="flex flex-col items-center">
                <span id="minutes" class="text-4xl font-bold text-primary md:text-5xl">43</span>
                <span class="mt-2 text-sm font-medium text-slate-600 md:text-base">Menit</span>
            </div>

            <div class="flex flex-col items-center">
                <span id="seconds" class="text-4xl font-bold text-primary md:text-5xl">21</span>
                <span class="mt-2 text-sm font-medium text-slate-600 md:text-base">Detik</span>
            </div>
        </div>
    </div>

    <div id="acara" data-aos="fade-up" class="mx-auto mt-24 mb-16 w-full max-w-[1024px] px-4 text-center">
        <h2 class="mb-2 text-2xl font-bold text-slate-800 md:text-3xl">Acara Pernikahan</h2>
        <p class="mx-auto mb-16 max-w-lg text-sm text-slate-500 md:text-base">
            Dengan memohon ridho Allah SWT, kami mengundang Bapak/Ibu ke acara kami
        </p>

        <div class="flex flex-col items-center justify-center gap-12 md:flex-row md:items-start md:gap-24">
            <div data-aos="zoom-in" data-aos-delay="200" class="flex flex-1 flex-col items-center">
                <i class="fa-solid fa-wand-magic-sparkles mb-6 text-3xl text-primary md:text-4xl"></i>
                <h3 class="mb-4 text-xl font-bold tracking-wide text-slate-800">AKAD NIKAH</h3>
                <p class="mb-1 text-sm font-medium text-slate-500 md:text-base">{{ $settings['tanggal_akad'] ?? "Jum'at, 11 Juli 2026" }}</p>
                <p class="mb-6 text-sm font-medium text-slate-500 md:text-base">{{ $settings['waktu_akad'] ?? '08:00 - 15:00 WIB' }}</p>
                <h4 class="mb-2 text-lg font-bold text-slate-800">{{ $settings['tempat_akad'] ?? 'Masjid Al-Ikhlas' }}</h4>
                <p class="text-sm leading-relaxed text-slate-500 md:text-base">
                    {{ $settings['alamat_akad'] ?? 'Jl. Suka Karya, Kel. Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau' }}
                </p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="400" class="flex flex-1 flex-col items-center">
                <i class="fa-solid fa-champagne-glasses mb-6 text-3xl text-primary md:text-4xl"></i>
                <h3 class="mb-4 text-xl font-bold tracking-wide text-slate-800">RESEPSI</h3>
                <p class="mb-1 text-sm font-medium text-slate-500 md:text-base">{{ $settings['tanggal_resepsi'] ?? 'Minggu, 13 Juli 2026' }}</p>
                <p class="mb-6 text-sm font-medium text-slate-500 md:text-base">{{ $settings['waktu_resepsi'] ?? '09:00 - 16:00 WIB' }}</p>
                <h4 class="mb-2 text-lg font-bold text-slate-800">{{ $settings['tempat_resepsi'] ?? 'Grand Central Hotel Pekanbaru' }}</h4>
                <p class="text-sm leading-relaxed text-slate-500 md:text-base">
                    {{ $settings['alamat_resepsi'] ?? 'Jl. Jend. Sudirman No.1, Tengkerang Utara, Kec. Bukit Raya, Kota Pekanbaru, Riau' }}
                </p>
            </div>
        </div>
    </div>

    <div id="lokasi" class="mx-auto mb-24 w-full max-w-[1024px] px-4 text-center">
        <div data-aos="flip-up"
            class="flex w-full flex-col items-center justify-center rounded-[2.5rem] bg-primary/20 p-6 shadow-sm md:p-12">
            <i class="fa-solid fa-location-dot mb-4 text-4xl text-primaryDark md:text-5xl"></i>
            <h3 class="mb-2 text-xl font-bold tracking-wide text-slate-800 md:text-2xl">Lokasi Acara</h3>
            <p class="mb-8 font-medium text-slate-600">{{ $settings['tempat_resepsi'] ?? 'Grand Central Hotel Pekanbaru' }}</p>

            <div class="mb-8 w-full overflow-hidden rounded-3xl border-[6px] border-white shadow-lg">
                <iframe
                    src="{!! $settings['map_iframe'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15958.625700547745!2d101.4398322619087!3d0.505504746404761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aea9f300c14f%3A0x2ad1b12b5952d708!2sGrand%20Central%20Hotel%20Pekanbaru!5e0!3m2!1sid!2sid!4v1711718000000!5m2!1sid!2sid' !!}"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <a href="{!! $settings['map_link'] ?? 'https://www.google.com/maps/search/?api=1&query=Grand+Central+Hotel+Pekanbaru' !!}" target="_blank"
                rel="noopener noreferrer"
                class="flex items-center gap-3 rounded-2xl bg-primary px-8 py-3.5 font-bold tracking-wide text-neutral-800 shadow-xl shadow-primary/30 transition-all duration-300 hover:scale-105 hover:bg-primaryDark">
                <i class="fa-solid fa-map-location-dot"></i>
                Buka via Google Maps
            </a>
        </div>
    </div>

    <div id="galeri" data-aos="fade-up" class="mx-auto mt-28 mb-12 w-full max-w-[1024px] px-4">
        <h2 class="mb-4 text-center text-2xl font-bold text-slate-800 md:text-3xl">{{ ($settings['gallery_section_title'] ?? '') ?: 'Galeri Foto' }}</h2>
        @if(!empty($settings['gallery_section_subtitle'] ?? null))
            <p class="mx-auto mb-12 max-w-lg text-sm text-slate-500 md:text-base">{{ $settings['gallery_section_subtitle'] ?? '' }}</p>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 grid-flow-row-dense auto-rows-[150px] md:auto-rows-[250px] gap-4">
            @foreach($galleries as $gallery)
            @php
                // Pola irregular berulang setiap 6 foto
                $mod = $loop->index % 6;
                $spanClass = 'col-span-1 row-span-1'; // default kecil
                
                if ($mod === 0) {
                    $spanClass = 'col-span-2 row-span-2'; // besar utama
                } elseif ($mod === 3) {
                    $spanClass = 'col-span-2 row-span-1'; // lebar horizontal
                } elseif ($mod === 4) {
                    $spanClass = 'col-span-1 row-span-2'; // panjang vertikal
                }
            @endphp
            
            <div data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 100 }}" class="group relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm {{ $spanClass }}">
                <img src="{{ asset($gallery->image_path) }}" alt="Galeri {{ $loop->iteration }}"
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
            </div>
            @endforeach
            
            @if($galleries->isEmpty())
                <p class="col-span-full py-10 text-center text-slate-500">Galeri foto belum ditambahkan.</p>
            @endif
        </div>
    </div>


    <div id="rsvp" class="mx-auto mt-24 mb-24 w-full max-w-[1024px] px-4">
        <div data-aos="zoom-out-up"
            class="mx-auto w-full max-w-lg rounded-[2.5rem] border-4 border-primary/30 bg-white p-8 shadow-2xl md:p-12">

            <div id="rsvp-form-view">
                <div class="mb-10 text-center text-slate-800">
                    <i class="fa-regular fa-paper-plane mb-3 text-3xl text-primaryDark"></i>
                    <h2 class="mb-2 text-2xl font-bold md:text-3xl">Buku Tamu</h2>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Konfirmasi kehadiran anda
                    </p>
                </div>

                <form id="guestbook-form" class="grid gap-5">
                    @csrf
                    @if($guest)
                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                    @endif
                    <div>
                        <label for="nama" class="mb-2 block text-sm font-bold text-gray-700">Nama Lengkap</label>
                        @if($guest)
                            <input type="text" id="nama" name="nama" value="{{ $guest->nama }}" readonly required
                                class="w-full rounded-2xl border border-gray-200 bg-gray-100 p-3 outline-none cursor-not-allowed text-gray-500 font-semibold" />
                        @else
                            <input type="text" id="nama" name="nama" required placeholder="Masukkan nama anda"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-3 outline-none transition focus:border-primary focus:bg-white" />
                        @endif
                    </div>

                    <div>
                        <label for="hadir" class="mb-2 block text-sm font-bold text-gray-700">Kehadiran</label>
                        <div class="relative">
                            <select id="hadir" name="hadir"
                                class="w-full appearance-none rounded-2xl border border-gray-200 bg-gray-50 p-3 outline-none transition focus:border-primary focus:bg-white">
                                <option value="HADIR" {{ $guest && $guest->status_hadir === 'HADIR' ? 'selected' : '' }}>Hadir</option>
                                <option value="TIDAK" {{ $guest && $guest->status_hadir === 'TIDAK' ? 'selected' : '' }}>Tidak Hadir</option>
                                <option value="PENDING" {{ $guest && $guest->status_hadir === 'PENDING' ? 'selected' : '' }}>Masih Ragu</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="plusone" class="mb-2 block text-sm font-bold text-gray-700">Jumlah Tambahan Tamu (Plus One)</label>
                        <input type="number" id="plusone" name="plusone" min="0" required
                            value="{{ $guest ? $guest->plusone : 0 }}"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-3 outline-none transition focus:border-primary focus:bg-white" />
                    </div>

                    <div>
                        <label for="ucapan" class="mb-2 block text-sm font-bold text-gray-700">Ucapan & Doa</label>
                        <textarea id="ucapan" name="ucapan" rows="4" required
                            placeholder="Tuliskan ucapan untuk kedua mempelai"
                            class="w-full resize-none rounded-2xl border border-gray-200 bg-gray-50 p-3 outline-none transition focus:border-primary focus:bg-white">{{ $guest ? $guest->ucapan : '' }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl bg-primary p-4 font-bold shadow-lg transition hover:scale-105 hover:bg-primaryDark">
                        Kirim Ucapan
                    </button>
                </form>
            </div>

            <div id="rsvp-success-view"
                class="hidden flex-col items-center justify-center py-10 text-center animate-[fadeIn_0.5s_ease-in-out]">
                <div class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-primary/20">
                    <i class="fa-regular fa-envelope-open text-5xl text-primaryDark"></i>
                </div>
                <h3 class="mb-3 text-2xl font-bold text-slate-800">Halo <span id="guest-name"
                        class="text-primaryDark"></span>!</h3>
                <p class="text-sm leading-relaxed text-slate-600">Terima kasih atas ucapan manis dan konfirmasi
                    kehadiran Anda. Sampai jumpa di hari bahagia nanti!</p>
            </div>

        </div>
    </div>

    <footer class="mt-20 w-full pb-10 text-center">
        <h2 class="mb-3 text-lg font-bold tracking-wide text-slate-800 md:text-xl">{{ explode(' ', $settings['nama_mempelai_pria'] ?? 'Gusti')[0] }} & {{ explode(' ', $settings['nama_mempelai_wanita'] ?? 'Azwa')[0] }}</h2>
        <p class="mx-auto mb-6 max-w-md px-4 text-xs font-medium leading-relaxed text-slate-500 md:text-sm">
            Terima kasih atas segala doa dan restu yang telah diberikan kepada kami.
        </p>
        <div class="flex items-center justify-center gap-3 text-primaryDark opacity-80">
            <i class="fa-regular fa-heart text-lg"></i>
            <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
            <i class="fa-regular fa-heart text-lg"></i>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Kirim tanggal acara dari database ke javascript
        var eventDate = new Date("{{ $settings['hari_acara'] ?? '2026-07-11' }}T00:00:00").getTime();

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('guestbook-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerText = 'Mengirim...';
                    }

                    const formData = new FormData(form);

                    fetch('{{ route("undangan.rsvp") }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('guest-name').innerText = data.nama;
                            document.getElementById('rsvp-form-view').style.display = 'none';
                            
                            const successView = document.getElementById('rsvp-success-view');
                            if (successView) {
                                successView.classList.remove('hidden');
                                successView.classList.add('flex');
                            }
                        } else {
                            alert('Terjadi kesalahan, silakan coba lagi.');
                            if (submitButton) {
                                submitButton.disabled = false;
                                submitButton.innerText = 'Kirim Ucapan';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan koneksi, silakan coba lagi.');
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.innerText = 'Kirim Ucapan';
                        }
                    });
                });
            }
        });
    </script>
    <script src="{{ asset('main.js') }}"></script>
</body>

</html>