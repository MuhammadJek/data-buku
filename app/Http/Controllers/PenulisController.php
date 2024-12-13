<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenulisRequest;
use App\Http\Requests\PenulisUpdateRequest;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PenulisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Buku $buku)
    {
        $this->authorize('admin', $buku);
        return view('penulis.index');
    }

    public function dataTable()
    {
        $penulis = User::where('role', 'writer')->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($penulis)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn =  '<button class="mx-2 btn btn-primary" onclick="showEditModal(this)" data-id="' . $row->uuid . '">Edit</button>';
                    $btn =   $btn . '<button class="mx-2 my-2 btn btn-success" onclick="showDetailModal(this)" data-id="' . $row->uuid . '">Detail</button>';
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
    public function store(PenulisRequest $request, Buku $buku)
    {
        $this->authorize('admin', $buku);


        $validate = $request->validated();
        try {
            $user = User::create([
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => $validate['name'],
                'email' => $validate['email'],
                'role' => 'writer',
                'password' => Hash::make($validate['password']),
                // 'password_confirm' => $request->[''],
            ]);

            return response()->json(['message' => 'Berhasil membuat data Penulis']);
        } catch (\Exception $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid, Buku $buku)
    {
        $this->authorize('admin', $buku);


        $data = User::where('uuid', $uuid)->firstOrFail();

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
    public function update(PenulisUpdateRequest $request, string $uuid, Buku $buku)
    {
        $this->authorize('admin', $buku);


        // $request->setId($uuid);
        $validate = $request->validated();

        try {
            $penulisData = User::where('uuid', $uuid)->firstOrFail();


            $penulisUpdate = $penulisData->update([
                'name' => $validate['name'],
                'email' => $validate['email'],
                // 'password' => Hash::make($validate['password']),
            ]);
            return response()->json(['message' => 'Berhasil mengupdate data']);
        } catch (\Exception $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid, Buku $buku)
    {
        try {
            $data = User::where('uuid', $uuid)->firstOrFail();
            $data->delete();
            return response()->json(['message' => 'Berhasil Menghapus Data']);
        } catch (\Exception $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
    }
}
