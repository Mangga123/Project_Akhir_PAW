<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Tagihan Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- HEADER TABEL + TOMBOL TAMBAH -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Tagihan</h3>
                        
                        <!-- TOMBOL DIGANTI JADI BIRU (bg-blue-600) SUPAYA KELIHATAN JELAS -->
                        <a href="{{ route('admin.bills.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                            + Buat Tagihan Baru
                        </a>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left text-gray-600">Unit & Penghuni</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Periode</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Jatuh Tempo</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Total</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Status</th>
                                    <th class="border px-4 py-2 text-center text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bills as $bill)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">
                                            <div class="font-bold text-gray-800">Unit {{ $bill->resident->unit->unit_number ?? '-' }}</div>
                                            <div class="text-sm text-gray-500">{{ $bill->resident->user->name ?? 'User Hapus' }}</div>
                                        </td>
                                        <td class="border px-4 py-2 text-gray-700">{{ $bill->month }}</td>
                                        <td class="border px-4 py-2 text-red-600 text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                                        </td>
                                        <td class="border px-4 py-2 font-bold text-gray-900">
                                            Rp {{ number_format($bill->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if($bill->status == 'Lunas')
                                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Lunas</span>
                                            @elseif($bill->status == 'Menunggu Konfirmasi')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded">Menunggu</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded">Belum Bayar</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" onsubmit="return confirm('Hapus tagihan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border px-4 py-8 text-center text-gray-400 italic">
                                            Belum ada data tagihan. Silakan buat tagihan baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $bills->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>