<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Órdenes de Servicio</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 25px;
        }

        h1 {
            color: #263238;
        }

        .contenedor {
            background: white;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #263b55;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .boton {
            display: inline-block;
            padding: 9px 14px;
            background: #1769aa;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .editar {
            background: #e5a000;
            color: black;
        }

        .mensaje {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <h1>Órdenes de Servicio</h1>

    <div class="contenedor">

        @if(session('success'))
            <p class="mensaje">{{ session('success') }}</p>
        @endif

        <a href="{{ route('ordenes.create') }}" class="boton">
            + Crear nueva orden
        </a>

        <br><br>

        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Código orden</th>
                    <th>Descripción</th>
                    <th>Tipo servicio</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha cierre</th>
                    <th>Fecha creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($ordenes as $orden)
                    <tr>
                        <td>
                            {{ $orden->cliente_id }} -
                            {{ optional($orden->cliente)->nombre }}
                            {{ optional($orden->cliente)->apellido }}
                        </td>

                        <td>
                            {{ $orden->usuario_id }} -
                            {{ optional($orden->usuario)->username }}
                        </td>

                        <td>{{ $orden->codigo_orden }}</td>

                        <td>{{ $orden->descripcion }}</td>

                        <td>{{ $orden->tipo_servicio }}</td>

                        <td>{{ $orden->prioridad }}</td>

                        <td>{{ $orden->estado }}</td>

                        <td>
                            {{ $orden->fecha_cierre_estimada
                                ? $orden->fecha_cierre_estimada->format('d/m/Y')
                                : 'Sin fecha' }}
                        </td>

                        <td>
                            {{ $orden->created_at
                                ? $orden->created_at->format('d/m/Y')
                                : 'Sin fecha' }}
                        </td>

                        <td>
                            <a href="{{ route('ordenes.edit', $orden->id) }}"
                               class="boton editar">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            No hay órdenes de servicio registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>
</html>