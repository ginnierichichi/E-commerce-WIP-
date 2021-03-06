<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductDownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function show(Request $request, Product $product)
    {
        //will change this to livewire
        throw_unless(
            $request->user()->orders->pluck('product')->flatten()->contains('id', $product->id),
            ModelNotFoundException::class,
        );

        return Storage::disk('local')->download($product->file_path);
    }
}
