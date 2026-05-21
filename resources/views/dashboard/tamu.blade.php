@extends('layouts.admin')

@section('title', 'Manajemen Tamu')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold tracking-tight text-slate-800 lg:text-3xl">Manajemen Tamu</h2>
        <p class="mt-1 text-sm font-medium text-slate-500">Kelola daftar undangan, status RSVP, dan link undangan</p>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm h-full flex flex-col">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-table-list text-[#dcb8a6]"></i>
                <h3 class="text-lg font-bold text-slate-800">Daftar Tamu ({{ $guests->count() }})</h3>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('guests.export') }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-700 hover:bg-slate-50 inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-file-csv text-[#dcb8a6]"></i> Export CSV
                </a>
                <button type="button" onclick="openAddModal()"
                    class="rounded-xl border border-primary/20 bg-primary/10 px-3 py-1.5 text-xs font-bold text-[#c79782] hover:bg-primary/20 transition-colors">
                    Tambah Tamu
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-x-auto">
            <table class="w-full min-w-[500px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                        <th class="pb-3 pl-2">Nama</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Plus One</th>
                        <th class="pb-3 text-center">Link Undangan</th>
                        <th class="pb-3 text-right pr-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 font-medium">
                    @foreach ($guests as $guest)
                        @php
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
                        @endphp
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
                            <td class="py-4 text-slate-500">
                                {{ $guest->plusone > 0 ? "Ya ({$guest->plusone})" : "Tidak" }}
                            </td>
                            <td class="py-4 text-center text-slate-400 text-xs truncate max-w-[120px]">
                                @if (!empty($guest->link_undangan))
                                    <a href="{{ $guest->link_undangan }}" target="_blank"
                                        class="hover:text-primary transition-colors">
                                        {{ substr($guest->link_undangan, 0, 20) }}
                                        {{ strlen($guest->link_undangan) > 20 ? '...' : '' }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-4 pr-2 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button type="button" data-id="{{ $guest->id }}" data-nama="{{ $guest->nama }}"
                                        data-status="{{ $guest->status_hadir }}" data-plusone="{{ $guest->plusone ?? 0 }}"
                                        data-link="{{ $guest->link_undangan }}"
                                        onclick="openEditModal(this.dataset.id, this.dataset.nama, this.dataset.status, this.dataset.plusone, this.dataset.link)"
                                        class="text-slate-400 hover:text-blue-500 transition-colors">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tamu ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if ($guests->isEmpty())
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">Belum ada data tamu.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modals for Add and Edit --}}
    <div id="addModal"
        class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4 transition-all">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Tambah Tamu</h3>
                <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 transition-colors"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('guests.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Nama</label>
                    <input type="text" name="nama" id="add_nama" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Status Hadir</label>
                    <select name="status_hadir" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="PENDING">PENDING</option>
                        <option value="HADIR">HADIR</option>
                        <option value="TIDAK">TIDAK</option>
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Plus One</label>
                    <input type="number" name="plusone" min="0" value="0" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Link Undangan</label>
                    <input type="text" name="link_undangan" id="add_link_undangan"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20"
                        placeholder="https://" />
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit"
                        class="rounded-xl bg-[#d5a995] px-4 py-2 text-sm font-bold text-neutral-900 shadow-md transition-colors hover:bg-[#c79782]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal"
        class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4 transition-all">
        <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Edit Tamu</h3>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition-colors"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="" method="POST" class="flex flex-col gap-4" id="editForm">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Nama</label>
                    <input type="text" name="nama" id="edit_nama" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Status Hadir</label>
                    <select name="status_hadir" id="edit_status_hadir" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="PENDING">PENDING</option>
                        <option value="HADIR">HADIR</option>
                        <option value="TIDAK">TIDAK</option>
                    </select>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Plus One</label>
                    <input type="number" name="plusone" id="edit_plusone" min="0" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20" />
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Link Undangan</label>
                    <input type="text" name="link_undangan" id="edit_link_undangan"
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-800 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20"
                        placeholder="https://" />
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="rounded-xl px-4 py-2 text-sm font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit"
                        class="rounded-xl bg-[#d5a995] px-4 py-2 text-sm font-bold text-neutral-900 shadow-md transition-colors hover:bg-[#c79782]">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addNamaInput = document.getElementById('add_nama');
            const addLinkInput = document.getElementById('add_link_undangan');

            if (addNamaInput && addLinkInput) {
                let linkManuallyEdited = false;

                addLinkInput.addEventListener('input', () => {
                    linkManuallyEdited = addLinkInput.value !== '';
                });

                addNamaInput.addEventListener('input', () => {
                    if (!linkManuallyEdited) {
                        const gabunganNama = addNamaInput.value.trim().replace(/\s+/g, '-').toLowerCase();

                        let basePath = '/';
                        if (window.location.pathname.indexOf('frontend/') !== -1) {
                            basePath = window.location.pathname.substring(0, window.location.pathname.indexOf('frontend/'));
                        }
                        // Adjust to the current project route structure for invitation
                        const baseUrl = window.location.origin + '?to=';

                        addLinkInput.value = gabunganNama ? `${baseUrl}${gabunganNama}` : '';
                    }
                });
            }
        });

        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openEditModal(id, nama, status, plusone, link) {
            const editForm = document.getElementById('editForm');
            editForm.action = `/dashboard/guests/${id}`;

            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_status_hadir').value = status;
            document.getElementById('edit_plusone').value = plusone;
            document.getElementById('edit_link_undangan').value = link;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endpush