<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginAudit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginAuditController extends Controller
{
    /**
     * Muestra el listado de auditoría de inicios de sesión.
     */
    public function index(): View
    {
        // Obtenemos los registros ordenados del más reciente al más antiguo
        // y cargamos la relación 'user' para evitar el problema N+1 queries.
        $audits = LoginAudit::with('user')
            ->orderBy('logged_in_at', 'desc')
            ->paginate(20);

        return view('admin.login-audits.index', compact('audits'));
    }
}
