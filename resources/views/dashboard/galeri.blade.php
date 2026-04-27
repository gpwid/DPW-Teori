@extends('layouts.admin')

@section('title', 'Galeri')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold tracking-tight text-slate-800 lg:text-3xl">Galeri Foto</h2>
        <p class="mt-1 text-sm font-medium text-slate-500">Kelola foto pre-wedding dan momen bahagia lainnya</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 rounded-xl bg-emerald-50 p-4 text-emerald-700">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8 rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
    <h3 class="mb-4 text-lg font-bold text-slate-800">Unggah Foto Baru</h3>
    <form action="{{ route('admin.galeri.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-end gap-4">
        @csrf
        <div class="flex-1 w-full">
            <label class="mb-1.5 block font-bold text-slate-700 text-sm">Pilih Foto</label>
            <input type="file" name="foto" accept="image/*" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
        </div>
        <button type="submit" class="rounded-xl bg-[#d5a995] px-6 py-2.5 text-sm font-bold text-neutral-900 shadow-md transition-colors hover:bg-[#c79782]">
            <i class="fa-solid fa-upload mr-2"></i> Upload
        </button>
    </form>
</div>

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
    
    <div class="group relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm {{ $spanClass }}">
        <img src="{{ asset($gallery->image_path) }}" alt="Gallery Image" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
        <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100 flex items-center justify-center gap-3">
            
            <form action="{{ route('admin.galeri.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="m-0" id="form-edit-{{ $gallery->id }}">
                @csrf
                <label for="edit-{{ $gallery->id }}" class="cursor-pointer h-10 w-10 rounded-full bg-white text-slate-700 hover:text-blue-500 transition-colors shadow-sm flex items-center justify-center" title="Ubah Foto">
                    <i class="fa-solid fa-pen"></i>
                </label>
                <input type="file" id="edit-{{ $gallery->id }}" name="foto" accept="image/*" class="hidden" onchange="document.getElementById('form-edit-{{ $gallery->id }}').submit();" />
            </form>

            <form action="{{ route('admin.galeri.delete', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');" class="m-0">
                @csrf
                <button type="submit" class="h-10 w-10 rounded-full bg-white text-slate-700 hover:text-red-500 transition-colors shadow-sm flex items-center justify-center" title="Hapus Foto">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @endforeach
    
    @if($galleries->isEmpty())
    <div class="col-span-full py-12 text-center text-slate-500">
        Belum ada foto di galeri.
    </div>
    @endif
</div>
@endsection
