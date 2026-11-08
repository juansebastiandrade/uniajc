<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdenDeServicio;
use App\Models\User;
use Illuminate\Http\Request;

class OrdenDeServicioController extends Controller
{
    public function index()
    {
        $ordenes = OrdenDeServicio::with(['cliente', 'usuario'])
            ->latest()
            ->get();

        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = User::all();

        return view('ordenes.create', compact('clientes', 'usuarios'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'cliente_id'    => 'required|exists:cliente,id_cliente',
            'usuario_id'    => 'required|exists:usuario,id_usuario',
            'codigo_orden'  => 'required|max:50|unique:orden_de_servicio,codigo_orden',
            'descripcion'   => 'required',
            'tipo_servicio' => 'required|max:50',
            'prioridad'     => 'required|in:Baja,Media,Alta,Urgente',
        ]);

        OrdenDeServicio::create($datos);

        return redirect()->route('ordenes.index')
            ->with('ok', 'Orden creada correctamente');
    }

    public function edit(OrdenDeServicio $orden)
    {
        $orden->load(['cliente', 'usuario']);

        return view('ordenes.edit', compact('orden'));
    }

    public function update(Request $request, OrdenDeServicio $orden)
    {
        $datos = $request->validate([
            'tipo_servicio'         => 'required|max:50',
            'prioridad'             => 'required|in:Baja,Media,Alta,Urgente',
            'estado'                => 'required|in:Pendiente,En Proceso,Cerrada,Cancelada',
            'fecha_cierre_estimada' => 'nullable|date',
        ]);

        $orden->update($datos);

        return redirect()->route('ordenes.index')
            ->with('ok', 'Orden actualizada correctamente');
    }
}