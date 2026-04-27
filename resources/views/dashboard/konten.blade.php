@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold tracking-tight text-slate-800 lg:text-3xl">Edit Konten</h2>
    <p class="mt-1 text-sm font-medium text-slate-500">Ubah detail acara pernikahan</p>
</div>

<div class="max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="mb-6 flex items-center gap-2">
        <i class="fa-regular fa-pen-to-square text-[#dcb8a6]"></i>
        <h3 class="text-lg font-bold text-slate-800">Detail Acara</h3>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl bg-emerald-50 p-4 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.konten.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 text-sm">
        @csrf
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Nama Mempelai Pria</label>
            <input type="text" name="nama_mempelai_pria" value="{{ $settings['nama_mempelai_pria'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Orang Tua Pria</label>
            <input type="text" name="ortu_pria" value="{{ $settings['ortu_pria'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Foto Mempelai Pria</label>
            <input type="file" name="foto_pria" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <p class="mt-1 text-xs text-slate-500">Saat ini: {{ $settings['foto_pria'] ?? 'Belum ada' }}</p>
        </div>

        <hr class="my-2 border-slate-100">

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Nama Mempelai Wanita</label>
            <input type="text" name="nama_mempelai_wanita" value="{{ $settings['nama_mempelai_wanita'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Orang Tua Wanita</label>
            <input type="text" name="ortu_wanita" value="{{ $settings['ortu_wanita'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Foto Mempelai Wanita</label>
            <input type="file" name="foto_wanita" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <p class="mt-1 text-xs text-slate-500">Saat ini: {{ $settings['foto_wanita'] ?? 'Belum ada' }}</p>
        </div>

        <hr class="my-2 border-slate-100">

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Foto Cover / Latar Belakang</label>
            <input type="file" name="foto_cover" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <p class="mt-1 text-xs text-slate-500">Saat ini: {{ $settings['foto_cover'] ?? 'Belum ada' }}</p>
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Hari ke Acara (Untuk Hitung Mundur)</label>
            <input type="date" name="hari_acara" value="{{ $settings['hari_acara'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <hr class="my-2 border-slate-100">

        <h4 class="font-bold text-slate-800 text-md mt-2">Detail Akad</h4>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Tanggal Akad</label>
            <input type="text" name="tanggal_akad" value="{{ $settings['tanggal_akad'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Waktu Akad</label>
            <input type="text" name="waktu_akad" value="{{ $settings['waktu_akad'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Tempat Akad</label>
            <input type="text" name="tempat_akad" value="{{ $settings['tempat_akad'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Alamat Akad</label>
            <input type="text" name="alamat_akad" value="{{ $settings['alamat_akad'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <hr class="my-2 border-slate-100">

        <h4 class="font-bold text-slate-800 text-md mt-2">Detail Resepsi</h4>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Tanggal Resepsi</label>
            <input type="text" name="tanggal_resepsi" value="{{ $settings['tanggal_resepsi'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Waktu Resepsi</label>
            <input type="text" name="waktu_resepsi" value="{{ $settings['waktu_resepsi'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Tempat Resepsi</label>
            <input type="text" name="tempat_resepsi" value="{{ $settings['tempat_resepsi'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Alamat Resepsi</label>
            <input type="text" name="alamat_resepsi" value="{{ $settings['alamat_resepsi'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>

        <hr class="my-2 border-slate-100">

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Google Maps Iframe URL (src)</label>
            <input type="text" name="map_iframe" value="{{ $settings['map_iframe'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <p class="text-xs text-slate-500 mt-1">Copy URL dari "src" saat embed peta Google Maps</p>
        </div>

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Google Maps Link Tujuan</label>
            <input type="text" name="map_link" value="{{ $settings['map_link'] ?? '' }}"
                class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <p class="text-xs text-slate-500 mt-1">URL untuk tombol "Buka via Google Maps"</p>
        </div>

        <button type="submit"
            class="mt-4 w-full rounded-xl bg-[#d5a995] px-4 py-3 font-bold text-neutral-900 shadow-md transition-colors hover:bg-[#c79782]">
            Update Detail
        </button>
    </form>
</div>
@endsection
