<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar orden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 700px;">

    <h3 class="mb-3">Editar orden {{ $orden->codigo_orden }}</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordenes.update', $orden) }}" method="POST" class="card card-body">
        @csrf
        @method('PUT')

        {{-- Campos que solo se muestran --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" value="{{ $orden->usuario->username }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Código de la orden</label>
            <input type="text" class="form-control" value="{{ $orden->codigo_orden }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" rows="3" disabled>{{ $orden->descripcion }}</textarea>
        </div>

        {{-- Campos editables --}}
        <div class="mb-3">
            <label class="form-label">Tipo de servicio</label>
            <input type="text" name="tipo_servicio" class="form-control" value="{{ old('tipo_servicio', $orden->tipo_servicio) }}" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioridad</label>
            <select name="prioridad" class="form-select" required>
                @foreach(['Baja', 'Media', 'Alta', 'Urgente'] as $p)
                    <option value="{{ $p }}" @selected(old('prioridad', $orden->prioridad) == $p)>{{ $p }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                @foreach(['Pendiente', 'En Proceso', 'Cerrada', 'Cancelada'] as $e)
                    <option value="{{ $e }}" @selected(old('estado', $orden->estado) == $e)>{{ $e }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de cierre estimada</label>
            <input type="date" name="fecha_cierre_estimada" class="form-control"
                   value="{{ old('fecha_cierre_estimada', $orden->fecha_cierre_estimada) }}">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

</div>
</body>
</html>