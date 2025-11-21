<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Rincian Tagihan</h3>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Bulan:</span>
                        <span class="font-bold">{{ $bill->month }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Total:</span>
                        <span class="font-bold text-indigo-600">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('resident.payments.store', $bill->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transfer</label>
                        <input type="date" name="payment_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Bukti Transfer (Foto/Screenshot)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition bg-gray-50">
                            <input type="file" name="proof_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" required>
                            <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG. Max: 2MB.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('resident.bills.index') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow-lg transform hover:-translate-y-0.5 transition">
                            Kirim Bukti Bayar 🚀
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>