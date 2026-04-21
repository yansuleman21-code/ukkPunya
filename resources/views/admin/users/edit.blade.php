@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Edit User: {{ $user->username }}</h2>

    @if($errors->any())
    <div class="bg-red-100 text-red-600 p-4 mb-5 rounded-lg border border-red-300 text-sm font-medium">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru <span class="text-gray-400 font-normal">(kosongkan jika tidak ingin mengubah)</span></label>
            <input type="password" name="password" id="password" placeholder="Minimal 6 karakter"
                class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition">
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-sm font-semibold text-gray-600 mb-1">Role:</p>
            @if($user->admin)
                <span class="bg-purple-100 text-purple-700 text-sm font-bold px-3 py-1 rounded-full">Admin</span>
            @elseif($user->siswa)
                <span class="bg-pink-100 text-pink-700 text-sm font-bold px-3 py-1 rounded-full">Siswa</span>
            @endif
        </div>

        {{-- Field khusus Admin --}}
        @if($user->admin)
        <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
            <h4 class="font-semibold text-purple-700 mb-3">Data Admin</h4>
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $user->admin->nama) }}" maxlength="20"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition" required>
            </div>
        </div>
        @endif

        {{-- Field khusus Siswa --}}
        @if($user->siswa)
        <div class="bg-pink-50 p-4 rounded-lg border border-pink-200 space-y-4">
            <h4 class="font-semibold text-pink-700 mb-3">Data Siswa</h4>
            <div>
                <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                <input type="text" name="nis" id="nis" value="{{ old('nis', $user->siswa->nis) }}" maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" inputmode="numeric"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
            </div>
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $user->siswa->kelas) }}" maxlength="10"
                    class="w-full border border-gray-300 rounded-md p-2.5 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none transition" required>
            </div>
        </div>
        @endif

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition font-medium">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition font-semibold shadow-md">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
