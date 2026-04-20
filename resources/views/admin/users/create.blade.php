@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Tambah User Baru</h2>

    @if($errors->any())
    <div class="bg-red-100 text-red-600 p-4 mb-5 rounded-lg border border-red-300 text-sm font-medium">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Username untuk login" 
                class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" placeholder="Minimal 6 karakter"
                class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="role" onchange="toggleRoleFields()" 
                class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
                <option value="" disabled selected>-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
        </div>

        {{-- Field khusus Admin --}}
        <div id="admin-fields" class="hidden bg-purple-50 p-4 rounded-lg border border-purple-200">
            <h4 class="font-semibold text-purple-700 mb-3">Data Admin</h4>
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama lengkap admin" maxlength="20"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
            </div>
        </div>

        {{-- Field khusus Siswa --}}
        <div id="siswa-fields" class="hidden bg-pink-50 p-4 rounded-lg border border-pink-200 space-y-4">
            <h4 class="font-semibold text-pink-700 mb-3">Data Siswa</h4>
            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                <input type="text" name="nis" id="nis" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa" maxlength="10"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition">
            </div>
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL" maxlength="10"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition font-semibold shadow-md">Simpan User</button>
        </div>
    </form>
</div>

<script>
    function toggleRoleFields() {
        const role = document.getElementById('role').value;
        document.getElementById('admin-fields').classList.toggle('hidden', role !== 'admin');
        document.getElementById('siswa-fields').classList.toggle('hidden', role !== 'siswa');
    }
    // Jalankan saat halaman load (untuk handle old() values)
    document.addEventListener('DOMContentLoaded', toggleRoleFields);
</script>
@endsection
