@extends('mh.templates.index')

@section('page-mh')
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white p-6 rounded shadow-md">
        <h3 class="text-xl font-semibold mb-4">Tambah User</h3>
        <form method="POST" action="{{ route('doadduser') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required autofocus
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Email field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Password field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Password confirmation field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" required placeholder="Enter Jabatan"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="hidden">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <input type="text" id="role" name="role" value="hrd" readonly
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah</button>
            </div>
        </form>
    </div>
    <div class="bg-white p-6 rounded shadow-md mt-8">
        <h3 class="text-xl font-semibold mb-4">User List</h3>
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Jabatan</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->jabatan }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('delete.user', $user->id) }}" class="text-red-600">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
