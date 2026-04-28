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

    <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 text-sm">
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
            <div class="group relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm h-64 w-48 mt-2 border border-slate-200">
                @if(!empty($settings['foto_pria']))
                    <img src="{{ asset($settings['foto_pria']) }}" id="preview_foto_pria" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_pria" class="hidden flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @else
                    <img src="" id="preview_foto_pria" class="hidden h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_pria" class="flex flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100 flex items-center justify-center">
                    <label for="foto_pria_input" class="cursor-pointer h-10 w-10 rounded-full bg-white text-slate-700 hover:text-blue-500 transition-colors shadow-sm flex items-center justify-center" title="Ubah Foto">
                        <i class="fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="foto_pria_input" name="foto_pria" accept="image/*" class="hidden" onchange="previewImage(this, 'preview_foto_pria', 'placeholder_foto_pria')" />
                </div>
            </div>
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
            <div class="group relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm h-64 w-48 mt-2 border border-slate-200">
                @if(!empty($settings['foto_wanita']))
                    <img src="{{ asset($settings['foto_wanita']) }}" id="preview_foto_wanita" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_wanita" class="hidden flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @else
                    <img src="" id="preview_foto_wanita" class="hidden h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_wanita" class="flex flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100 flex items-center justify-center">
                    <label for="foto_wanita_input" class="cursor-pointer h-10 w-10 rounded-full bg-white text-slate-700 hover:text-blue-500 transition-colors shadow-sm flex items-center justify-center" title="Ubah Foto">
                        <i class="fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="foto_wanita_input" name="foto_wanita" accept="image/*" class="hidden" onchange="previewImage(this, 'preview_foto_wanita', 'placeholder_foto_wanita')" />
                </div>
            </div>
        </div>

        <hr class="my-2 border-slate-100">

        <div>
            <label class="mb-1.5 block font-bold text-slate-700">Foto Cover / Latar Belakang</label>
            <div class="group relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm h-64 w-full mt-2 border border-slate-200">
                @if(!empty($settings['foto_cover']))
                    <img src="{{ asset($settings['foto_cover']) }}" id="preview_foto_cover" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_cover" class="hidden flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @else
                    <img src="" id="preview_foto_cover" class="hidden h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div id="placeholder_foto_cover" class="flex flex-col items-center justify-center h-full w-full text-slate-400 bg-slate-50 gap-2">
                        <i class="fa-regular fa-image text-3xl"></i>
                        <span class="text-xs font-medium">Pilih Foto</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100 flex items-center justify-center">
                    <label for="foto_cover_input" class="cursor-pointer h-10 w-10 rounded-full bg-white text-slate-700 hover:text-blue-500 transition-colors shadow-sm flex items-center justify-center" title="Ubah Foto">
                        <i class="fa-solid fa-pen"></i>
                    </label>
                    <input type="file" id="foto_cover_input" name="foto_cover" accept="image/*" class="hidden" onchange="previewImage(this, 'preview_foto_cover', 'placeholder_foto_cover')" />
                </div>
            </div>
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

@push('scripts')
<script>
    function previewImage(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                
                if (placeholderId) {
                    var placeholder = document.getElementById(placeholderId);
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
