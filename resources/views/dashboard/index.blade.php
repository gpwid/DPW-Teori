@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold tracking-tight text-slate-800 lg:text-3xl">Dashboard Overview</h2>
        <p class="mt-1 text-sm font-medium text-slate-500">Manajemen detail pernikahan dan monitoring real-time</p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Tamu</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ $total_tamu }}</h3>
                </div>
                <div class="text-[#dcb8a6]">
                    <i class="fa-solid fa-user-group text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">RSVP Dikirim</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ $rsvp_dikirim }}</h3>
                </div>
                <div class="text-[#dcb8a6]">
                    <i class="fa-regular fa-circle-check text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Undangan Pending</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ $undangan_pending }}</h3>
                </div>
                <div class="text-[#dcb8a6]">
                    <i class="fa-solid fa-hourglass-half text-lg"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Hari ke Acara</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">72</h3>
                    <p class="mt-1 text-xs font-medium text-slate-500">Jum'at, 11 Juli 2026</p>
                </div>
                <div class="text-[#dcb8a6]">
                    <i class="fa-regular fa-calendar text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-[#dcb8a6]"></i>
                <h3 class="text-lg font-bold text-slate-800">Tamu Terbaru</h3>
            </div>
            <a href="{{ route('guests.index') }}"
                class="rounded-xl border border-primary/20 bg-primary/10 px-3 py-1.5 text-xs font-bold text-[#c79782] hover:bg-primary/20 transition-colors">
                Lihat Semua Tamu
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[400px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                        <th class="pb-3 pl-2">Nama</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right pr-2">Plus One</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 font-medium">
                    @foreach ($recent_guests as $guest)
                                    <?php
                        $initials = strtoupper(substr($guest->nama, 0, 2));
                        $colorClass = 'bg-slate-100 text-slate-700';

                        $statusClass = 'bg-slate-100 text-slate-600';
                        $statusText = 'PENDING';
                        if ($guest->status_hadir === 'HADIR') {
                            $statusClass = 'bg-emerald-100 text-emerald-600';
                            $statusText = 'HADIR';
                        } elseif ($guest->status_hadir === 'TIDAK') {
                            $statusClass = 'bg-rose-100 text-rose-600';
                            $statusText = 'TIDAK';
                        } elseif ($guest->status_hadir === 'PENDING') {
                            $statusClass = 'bg-amber-100 text-amber-600';
                            $statusText = 'PENDING';
                        }
                                        ?>
                                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                                        <td class="py-4 pl-2">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-full {{ $colorClass }} text-xs font-bold shadow-sm">
                                                    {{ $initials }}
                                                </div>
                                                <span>{{ $guest->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <span class="rounded-full {{ $statusClass }} px-2.5 py-1 text-[10px] font-black uppercase">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="py-4 text-right pr-2 text-slate-500">
                                            {{ $guest->plusone > 0 ? "Ya ({$guest->plusone})" : "Tidak" }}
                                        </td>
                                    </tr>
                    @endforeach
                    @if ($recent_guests->isEmpty())
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-500">Belum ada data tamu.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection