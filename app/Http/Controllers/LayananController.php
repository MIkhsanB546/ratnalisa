<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\KategoriLayanan;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LayananRequest;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoriLayanan = KategoriLayanan::all();

        return view('admin.layanan.create', compact('kategoriLayanan'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(LayananRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Layanan::create($data);

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan): View
    {
        $kategoriLayanan = KategoriLayanan::all();
        return view('admin.layanan.edit', compact('layanan', 'kategoriLayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LayananRequest $request, Layanan $layanan): RedirectResponse
    {
        $data = $request->validated();
        $layanan->update($data);

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan): RedirectResponse
    {
        $layanan->delete();

        return redirect()
            ->route('layanan.index')
            ->with('success', 'Data layanan berhasil dihapus.');
    }
}
