<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">
                        Lista de usuarios
                    </h3>

                    <a href="{{ route('usuarios.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        Nuevo usuario
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border-collapse border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Usuario</th>
                            <th class="border p-2">Rol</th>
                            <th class="border p-2">Estado</th>
                            <th class="border p-2">Empresa</th>
                            <th class="border p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td class="border p-2">{{ $usuario->id_usuario }}</td>
                                <td class="border p-2">{{ $usuario->username }}</td>
                                <td class="border p-2">{{ $usuario->rol }}</td>
                                <td class="border p-2">
                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                </td>
                                <td class="border p-2">{{ $usuario->id_empresa }}</td>

                                <td class="border p-2">
                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                       class="text-blue-600">
                                        Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">
                                    No hay usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $usuarios->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>