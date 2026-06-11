<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KategoriLayananRequest;

class KategoriLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kategoriLayanan = KategoriLayanan::all();
        return view('admin.kategori-layanan.index', compact('kategoriLayanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.kategori-layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriLayananRequest $request): RedirectResponse
    {
        $data = $request->validated();
        KategoriLayanan::create($data);

        return redirect()
            ->route('kategori-layanan.index')
            ->with('success', 'Data kategori layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriLayanan $kategoriLayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriLayanan $kategoriLayanan): View
    {
        return view('admin.kategori-layanan.edit', compact('kategoriLayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriLayananRequest $request, KategoriLayanan $kategoriLayanan): RedirectResponse
    {
        $data = $request->validated();
        $kategoriLayanan->update($data);

        return redirect()
            ->route('kategori-layanan.index')
            ->with('success', 'Data kategori layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriLayanan $kategoriLayanan)
    {
        $kategoriLayanan->delete();

        return redirect()
            ->route('kategori-layanan.index')
            ->with('success', 'Data kategori layanan berhasil dihapus.');
    }
}
