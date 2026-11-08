<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva orden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 700px;">

    <h3 class="mb-3">Nueva orden de servicio</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordenes.store') }}" method="POST" class="card card-body">
        @csrf

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" @selected(old('cliente_id') == $cliente->id_cliente)>
                        {{ $cliente->nombre }} {{ $cliente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <select name="usuario_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" @selected(old('usuario_id') == $usuario->id_usuario)>
                        {{ $usuario->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Código de la orden</label>
            <input type="text" name="codigo_orden" class="form-control" value="{{ old('codigo_orden') }}" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de servicio</label>
            <input type="text" name="tipo_servicio" class="form-control" value="{{ old('tipo_servicio') }}" placeholder="Instalación, Reparación, Mantenimiento..." maxlength="50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioridad</label>
            <select name="prioridad" class="form-select" required>
                @foreach(['Baja', 'Media', 'Alta', 'Urgente'] as $p)
                    <option value="{{ $p }}" @selected(old('prioridad', 'Media') == $p)>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

</div>
</body>
</html>