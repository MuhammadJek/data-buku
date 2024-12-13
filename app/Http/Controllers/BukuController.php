<?php

namespace App\Http\Controllers;

use App\Http\Requests\BukuRequest;
use App\Http\Requests\BukuUpdateRequest;
use App\Models\Buku;
use App\Models\Category;
use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        $category = Category::all();
        $penerbit = Penerbit::all();
        $penulis = User::where('role', 'writer')->get();

        return view('buku.index', compact('category', 'penerbit', 'penulis'));
    }
    public function dataTable(Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        $buku = Buku::with(['categories', 'penerbits', 'users'])->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($buku)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn =  '<button class="mx-2 my-2 btn btn-success" onclick="showDetailModal(this)" data-id="' . $row->uuid . '">Detail</button>';
                    $btn =  $btn . '<button class="mx-2 btn btn-primary" onclick="showEditModal(this)" data-id="' . $row->uuid . '">Edit</button>';
                    $btn =   $btn . '<button class="mx-2 btn btn-danger " onclick="deleteModal(this)" data-id="' . $row->uuid . '">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request, Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        $validate = $request->validated();

        try {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $request->image->storeAs('uploads/', $filename, 'public');
            $created = Buku::create([
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'title' => $validate['title'],
                'description' => $validate['description'],
                'price' => $validate['price'],
                'jumlah' => $validate['jumlah'],
                'image' => '/storage/uploads/' . $filename,
                'author' => $validate['author'],
                'category_id' => $validate['category_id'],
                'penerbit_id' => $validate['penerbit_id'],
            ]);

            return response()->json(['message' => 'Berhasil Membuat Data']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid, Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        $data = Buku::with(['categories', 'penerbits', 'users'])->where('uuid', $uuid)->firstOrFail();

        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BukuUpdateRequest $request, string $uuid, Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        $validate = $request->validated();
        $data = Buku::where('uuid', $uuid)->firstOrFail();

        try {
            if ($request->file('image')) {
                Storage::disk('public')->delete($data->image);
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $request->image->storeAs('uploads/', $filename, 'public');
                $data->update([
                    'title' => $validate['title'],
                    'description' => $validate['description'],
                    'price' => $validate['price'],
                    'jumlah' => $validate['jumlah'],
                    'image' => '/storage/uploads/' . $filename,
                    'author' => $validate['author'],
                    'category_id' => $validate['category_id'],
                    'penerbit_id' => $validate['penerbit_id'],
                ]);

                return response()->json(['message' => 'Berhasil Mengupdate Data']);
            }
            $data->update([
                'title' => $validate['title'],
                'description' => $validate['description'],
                'price' => $validate['price'],
                'jumlah' => $validate['jumlah'],
                'author' => $validate['author'],
                'category_id' => $validate['category_id'],
                'penerbit_id' => $validate['penerbit_id'],
            ]);

            return response()->json(['message' => 'Berhasil Mengupdate Data']);
        } catch (\Exception $th) {

            return response()->json(['errors' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid, Buku $bukus)
    {
        $this->authorize('admin', $bukus);

        try {
            $data = Buku::where('uuid', $uuid)->firstOrFail();
            $data->delete();
            return response()->json(['message' => 'Berhasil Menghapus Data']);
        } catch (\Exception $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
    }
}
