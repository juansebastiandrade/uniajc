<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Órdenes de servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Órdenes de servicio</h3>
        <a href="{{ route('ordenes.create') }}" class="btn btn-primary">Nueva orden</a>
    </div>

    @if(session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Cierre estimado</th>
                    <th>Creación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</td>
                        <td>{{ $orden->usuario->username }}</td>
                        <td>{{ $orden->codigo_orden }}</td>
                        <td>{{ $orden->descripcion }}</td>
                        <td>{{ $orden->tipo_servicio }}</td>
                        <td>{{ $orden->prioridad }}</td>
                        <td>{{ $orden->estado }}</td>
                        <td>{{ $orden->fecha_cierre_estimada }}</td>
                        <td>{{ $orden->created_at?->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No hay órdenes todavía</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>