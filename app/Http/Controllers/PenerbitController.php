<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenerbitRequest;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PenerbitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Penerbit $penerbit)
    {
        $this->authorize('admin', $penerbit);
        return view('penerbit.index');
    }
    public function dataTable()
    {
        $penerbit = Penerbit::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($penerbit)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn =  '<button class="mx-2 btn btn-primary" onclick="showEditModal(this)" data-id="' . $row->uuid . '">Edit</button>';
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
    public function store(PenerbitRequest $request, Penerbit $penerbit)
    {
        $this->authorize('admin', $penerbit);

        $validate = $request->validated();

        $random = Str::random(10);
        try {
            $penerbitCreate = Penerbit::create([
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => $validate['name'],
                'code_penerbits' => $random
            ]);
            return response()->json(['message' => 'Berhasil membuat data Penerbit']);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid, Penerbit $penerbit)
    {
        $this->authorize('admin', $penerbit);

        $data = Penerbit::where('uuid', $uuid)->firstOrFail();

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
    public function update(PenerbitRequest $request, string $uuid, Penerbit $penerbit)
    {
        $this->authorize('admin', $penerbit);

        $data = $request->validated();

        try {
            $penerbitUpdate = Penerbit::where('uuid', $uuid)->firstOrFail()->update([
                'name' => $data['name'],
            ]);
            return response()->json(['message' => 'Berhasil mengupdate data penerbit']);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid, Penerbit $penerbit)
    {
        $this->authorize('admin', $penerbit);

        try {
            $penerbit = Penerbit::where('uuid', $uuid)->firstOrFail();
            $penerbit->delete();
            return response()->json(['message' => 'Data Category berhasil di hapus']);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
