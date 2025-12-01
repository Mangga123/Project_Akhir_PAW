<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Penghuni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.residents.update', $resident->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <h3 class="text-lg font-bold mb-2 text-yellow-800">Informasi Penghuni</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500">Nama Lengkap</span>
                                    <span class="font-bold">{{ $resident->user->name }}</span>
                                </div>
                                <div>
                                    <span class="block text-gray-500">Email</span>
                                    <span class="font-bold">{{ $resident->user->email }}</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-3 italic">*Untuk mengubah nama/email, silakan edit data User secara terpisah.</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Unit Hunian (Pindah Kamar)</label>
                            <select name="unit_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="{{ $resident->unit_id }}" selected>
                                    Unit {{ $resident->unit->unit_number }} (Saat Ini)
                                </option>
                                
                                @foreach($units as $unit)
                                    @if($unit->status == 'Kosong')
                                        <option value="{{ $unit->id }}">
                                            Unit {{ $unit->unit_number }} - {{ $unit->tower }} ({{ $unit->type }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai Huni</label>
                            <input type="date" name="start_date" value="{{ $resident->start_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status Penghuni</label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Aktif" {{ $resident->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ $resident->status == 'Nonaktif' ? 'selected' : '' }}>Non-Aktif (Keluar)</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('admin.residents.index') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">
                                Batal
                            </a>
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Update Data Penghuni
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>