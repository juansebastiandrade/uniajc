<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar nuevo usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label>Nombre de usuario</label>
                        <input type="text" name="username"
                               value="{{ old('username') }}"
                               class="border rounded w-full p-2" required>
                        @error('username')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Contraseña</label>
                        <input type="password" name="password"
                               class="border rounded w-full p-2" required>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Rol</label>
                        <select name="rol" class="border rounded w-full p-2" required>
                            <option value="">Seleccione un rol</option>
                            <option value="admin">Administrador</option>
                            <option value="vendedor">Vendedor</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Estado</label>
                        <select name="activo" class="border rounded w-full p-2" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>ID Empresa</label>
                        <input type="number" name="id_empresa"
                               class="border rounded w-full p-2">
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Guardar usuario
                    </button>

                    <a href="{{ route('usuarios.index') }}"
                       class="ml-2 text-gray-600">
                        Cancelar
                    </a>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>