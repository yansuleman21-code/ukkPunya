@extends('layouts.app')

@section('content')
<div>
    <div class="flex justify-between items-center border-b pb-3 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen User</h2>
        <a href="{{ route('users.create') }}" class="bg-pink-600 text-white font-semibold px-5 py-2 rounded-lg shadow hover:bg-pink-700 transition duration-300">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 mb-5 rounded-lg border border-green-300 font-medium">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-600 p-4 mb-5 rounded-lg border border-red-300 font-medium">
        {{ session('error') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
            <thead class="bg-gray-100 border-b border-gray-300 text-gray-700 text-left">
                <tr>
                    <th class="p-4 w-16 text-center">No</th>
                    <th class="p-4">Username</th>
                    <th class="p-4 text-center">Role</th>
                    <th class="p-4">Detail</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($users as $index => $u)
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4 text-center">{{ $index + 1 }}</td>
                    <td class="p-4 font-semibold text-gray-800">{{ $u->username }}</td>
                    <td class="p-4 text-center">
                        @if($u->admin)
                            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Admin</span>
                        @elseif($u->siswa)
                            <span class="bg-pink-100 text-pink-700 text-xs font-bold px-3 py-1 rounded-full">Siswa</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full">-</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm">
                        @if($u->admin)
                            Nama: <span class="font-medium">{{ $u->admin->nama }}</span>
                        @elseif($u->siswa)
                            NIS: <span class="font-medium">{{ $u->siswa->nis }}</span> | Kelas: <span class="font-medium">{{ $u->siswa->kelas }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('users.edit', $u->id) }}" class="bg-yellow-400 font-semibold px-3 py-1 rounded shadow text-white hover:bg-yellow-500 transition text-sm">
                                Edit
                            </a>
                            @if($u->id !== auth()->id())
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 font-semibold px-3 py-1 rounded shadow text-white hover:bg-red-600 transition text-sm">
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach

                @if($users->count() == 0)
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-400 italic">Belum ada data user.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
