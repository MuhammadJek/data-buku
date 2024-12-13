<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class WriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::all();
        return view('writer.index', compact('category'));
    }

    public function dataTable()
    {
        $user = Auth::user();
        $buku = Buku::with(['categories', 'penerbits', 'users'])->where('author', $user->id)->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($buku)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn =  '<button class="mx-2 my-2 btn btn-success" onclick="showDetailModal(this)" data-id="' . $row->uuid . '">Detail</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show(string $uuid)
    {

        $data = Buku::with(['categories', 'penerbits', 'users'])->where('uuid', $uuid)->firstOrFail();

        return response()->json(['data' => $data]);
    }
}
