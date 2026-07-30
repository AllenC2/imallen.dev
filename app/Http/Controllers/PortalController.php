<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $expedientes = $user->expedientes()
            ->with(['movimientos' => function ($q) {
                $q->orderBy('fecha', 'desc');
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('portal.index', ['user' => $user, 'expedientes' => $expedientes]);
    }

    public function show(Request $request, string $id)
    {
        $user = $request->user();

        $expediente = $user->expedientes()
            ->with(['movimientos' => function ($q) {
                $q->orderBy('fecha', 'desc');
            }])
            ->findOrFail($id);

        return view('portal.show', ['user' => $user, 'expediente' => $expediente]);
    }
}
