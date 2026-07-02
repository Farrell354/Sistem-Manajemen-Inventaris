<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna (Pegawai)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('users.create') }}"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Pegawai Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b">Nama Lengkap</th>
                                    <th class="px-6 py-3 border-b">Email</th>
                                    <th class="px-6 py-3 border-b">Jabatan (Role)</th>
                                    <th class="px-6 py-3 border-b text-center">Tgl Terdaftar</th>
                                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            @if ($user->role_id == 1)
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Super
                                                    Admin</span>
                                            @elseif($user->role_id == 2)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Manager</span>
                                            @else
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Staff
                                                    Gudang</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                    Edit
                                                </a>

                                                @if ($user->id !== auth()->id())
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pegawai ini? Data login mereka akan hilang permanen.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <span
                                                        class="text-gray-500 text-xs italic bg-gray-100 px-2 py-1 rounded border">Sedang
                                                        Login</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada data pegawai.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
