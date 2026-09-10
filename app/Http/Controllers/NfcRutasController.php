<?php

namespace App\Http\Controllers;

use App\Models\NfcRutas;
use Illuminate\Http\Request;

class NfcRutasController extends Controller
{
    public function index()
    {
        $registros = NfcRutas::withCount('visitas')->orderBy('titulo')->get();

        return view('nfcrutas.index', compact('registros'));
    }

    public function create()
    {
        return view('nfcrutas.create');
    }

    public function store(Request $request)
    {
        NfcRutas::create($this->validarRuta($request));

        return redirect()->route('nfcrutas.index')
            ->with('success', 'Insertado correctamente');
    }

    public function edit(NfcRutas $nfcruta)
    {
        return view('nfcrutas.edit', compact('nfcruta'));
    }

    public function update(Request $request, NfcRutas $nfcruta)
    {
        $nfcruta->update($this->validarRuta($request, $nfcruta));

        return redirect()->route('nfcrutas.index')
            ->with('success', 'Actualizado correctamente');
    }

    public function destroy(NfcRutas $nfcruta)
    {
        $nfcruta->delete();

        return redirect()->route('nfcrutas.index')
            ->with('success', 'Borrado correctamente');
    }

    public function redirect(Request $request, $codigo)
    {
        $ruta = NfcRutas::where('codigo', $codigo)->where('activo', true)->firstOrFail();

        $ruta->visitas()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
            'accept_language' => $request->headers->get('accept-language'),
            'request_headers' => [
                'sec_ch_ua' => $request->headers->get('sec-ch-ua'),
                'sec_ch_ua_mobile' => $request->headers->get('sec-ch-ua-mobile'),
                'sec_ch_ua_platform' => $request->headers->get('sec-ch-ua-platform'),
                'viewport_width' => $request->headers->get('viewport-width'),
            ],
        ]);

        return redirect()->away($ruta->url);
    }

    private function validarRuta(Request $request, NfcRutas $nfcruta = null)
    {
        $validado = $request->validate([
            'titulo' => [
                'required',
                'string',
                'max:150',
            ],
            'url' => 'required|url',
            'activo' => 'nullable|boolean',
        ], [], [
            'titulo' => 'Título',
            'url' => 'URL',
            'activo' => 'Activo',
        ]);

        $validado['activo'] = $request->boolean('activo');

        return $validado;
    }
}
