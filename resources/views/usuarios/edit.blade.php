<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Nombre de usuario</label>
                        <input type="text" name="username"
                               value="{{ old('username', $usuario->username) }}"
                               class="border rounded w-full p-2" required>
                        @error('username')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Nueva contraseña (opcional)</label>
                        <input type="password" name="password"
                               class="border rounded w-full p-2">
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Rol</label>
                        <select name="rol" class="border rounded w-full p-2" required>
                            <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="vendedor" {{ $usuario->rol == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                            <option value="supervisor" {{ $usuario->rol == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Estado</label>
                        <select name="activo" class="border rounded w-full p-2" required>
                            <option value="1" {{ $usuario->activo == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $usuario->activo == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>ID Empresa</label>
                        <input type="number" name="id_empresa"
                               value="{{ old('id_empresa', $usuario->id_empresa) }}"
                               class="border rounded w-full p-2">
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar usuario
                    </button>

                    <a href="{{ route('usuarios.index') }}" class="ml-2 text-gray-600">
                        Cancelar
                    </a>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>