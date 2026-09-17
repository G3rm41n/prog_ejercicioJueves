@extends('layouts.app')

@section('title', 'Auditoría de Inicios de Sesión')
@section('header_title', 'Auditoría de Inicios de Sesión')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800">Registro de Accesos al Sistema</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Dirección IP</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha y Hora</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($audits as $audit)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                            {{ $audit->user->name ?? 'Desconocido' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $audit->user->email ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            <span class="font-mono text-xs">{{ $audit->ip_address }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($audit->logged_in_at)->translatedFormat('d M Y, H:i:s') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">
                            No hay registros de auditoría de sesión disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($audits->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $audits->links() }}
        </div>
    @endif
</div>
@endsection
