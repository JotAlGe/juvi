<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image): RedirectResponse
    {
        //
    }
}
