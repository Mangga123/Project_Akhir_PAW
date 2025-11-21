<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tagihan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($bills->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        <p>🎉 Hore! Tidak ada tagihan aktif saat ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bills as $bill)
                            <div class="border rounded-lg p-6 shadow-sm {{ $bill->status == 'Lunas' ? 'bg-green-50 border-green-200' : 'bg-white' }}">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800">{{ $bill->month }}</h3>
                                        <p class="text-sm text-gray-500">Jatuh Tempo: {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        @if($bill->status == 'Lunas')
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">LUNAS</span>
                                        @elseif($bill->status == 'Menunggu Konfirmasi')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded">DIPROSES</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">BELUM BAYAR</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <p class="text-sm text-gray-600">Total Tagihan</p>
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                                </div>

                                <div class="border-t pt-4">
                                    @if($bill->status == 'Belum Dibayar')
                                        <a href="{{ route('resident.payments.create', $bill->id) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                            Bayar Sekarang
                                        </a>
                                    @elseif($bill->status == 'Menunggu Konfirmasi')
                                        <button disabled class="block w-full text-center bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed">
                                            Menunggu Verifikasi
                                        </button>
                                    @else
                                        <button disabled class="block w-full text-center bg-green-600 text-white font-bold py-2 px-4 rounded cursor-default">
                                            Pembayaran Diterima
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>