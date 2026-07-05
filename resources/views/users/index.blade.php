<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pengguna (Pegawai)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('users.create') }}"
                            class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition-colors">
                            + Tambah Pegawai Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded relative mb-4 transition-colors">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded relative mb-4 transition-colors">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-900/50 border-b dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-3 border-b dark:border-gray-700">Nama Lengkap</th>
                                    <th class="px-6 py-3 border-b dark:border-gray-700">Email</th>
                                    <th class="px-6 py-3 border-b dark:border-gray-700">Jabatan (Role)</th>
                                    <th class="px-6 py-3 border-b dark:border-gray-700 text-center">Tgl Terdaftar</th>
                                    <th class="px-6 py-3 border-b dark:border-gray-700 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            @if ($user->role_id == 1)
                                                <span class="bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400 dark:border-red-800 border text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Super Admin
                                                </span>
                                            @elseif($user->role_id == 2)
                                                <span class="bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-400 dark:border-blue-800 border text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Manager
                                                </span>
                                            @else
                                                <span class="bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400 dark:border-green-800 border text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Staff Gudang
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-bold py-1 px-3 rounded text-xs transition-colors">
                                                    Edit
                                                </a>

                                                @if ($user->id !== auth()->id())
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pegawai ini? Data login mereka akan hilang permanen.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition-colors">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-500 dark:text-gray-400 text-xs italic bg-gray-100 dark:bg-gray-700/50 px-2 py-1 rounded border dark:border-gray-600">
                                                        Sedang Login
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
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
