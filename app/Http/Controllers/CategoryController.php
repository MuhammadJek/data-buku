<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $this->authorize('admin', $category);

        return view('category.index');
    }
    public function dataTable()
    {
        $category = Category::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($category)
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
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $this->authorize('admin', $category);

        $data = $request->validated();

        try {
            $categoryCreate = Category::create([
                'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'name' => $data['name'],
            ]);
            return response()->json(['message' => 'Berhasil membuat data']);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid, Category $category)
    {
        $this->authorize('admin', $category);

        $category = Category::where('uuid', $uuid)->firstOrFail();

        return response()->json(['data' => $category]);
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
    public function update(CategoryRequest $request, string $uuid, Category $category)
    {
        $this->authorize('admin', $category);

        $data = $request->validated();

        try {
            $categoryUpdate = Category::where('uuid', $uuid)->firstOrFail()->update([
                'name' => $data['name'],
            ]);
            return response()->json(['message' => 'Berhasil membuat data']);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid, Category $category)
    {
        $this->authorize('admin', $category);

        try {
            //code...
            $category = Category::where('uuid', $uuid)->firstOrFail();

            $category->delete();
            return response()->json(['message' => 'Data Category berhasil di hapus']);
        } catch (\Exception $th) {
            return response()->json(['Error' => $th->getMessage()]);
        }
    }
}
