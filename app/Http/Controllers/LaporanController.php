<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Buku;
use App\Models\Category;
use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $category = Category::all();
        $penulis = User::all();
        $penerbit = Penerbit::all();
        return view('laporan.laporan', compact('category', 'penulis', 'penerbit'));
    }


    public function export(Request $request)
    {

        $validate = $request->validate([
            'category' => 'exists:categories,id|nullable',
            'penulis' => 'exists:users,id|nullable',
            'penerbit' => 'exists:penerbits,id|nullable',
        ]);

        $category = $request->category;
        $penulis = $request->penulis;
        $penerbit = $request->penerbit;
        // dd($penulis);
        $buku = Buku::where(function ($query) use ($category, $penulis, $penerbit) {
            // If angkatans has data, check it
            if (!empty($category)) {
                $query->where('category_id', $category);
            }

            // If jurusans has data, check it
            if (!empty($penulis)) {
                $query->where('author', $penulis);
            }

            // If kelas has data, check it
            if (!empty($penerbit)) {
                $query->where('penerbit_id', $penerbit);
            }
        })
            ->get();
        $notBuku = Buku::where(function ($query) use ($category, $penulis, $penerbit) {
            // If angkatans has data, check it
            if (empty($category)) {
                $query->where('category_id', $category);
            }

            // If jurusans has data, check it
            if (empty($penulis)) {
                $query->where('author', $penulis);
            }

            // If kelas has data, check it
            if (empty($penerbit)) {
                $query->where('penerbit_id', $penerbit);
            }
        })
            ->first();

        // dd($buku);
        if ($category != null || $penulis != null || $penerbit != null) {
            $excel = [];
            foreach ($buku as $key => $books) {

                $excel[] = [
                    $key + 1,
                    $books->title,
                    $books->users->name,
                    $books->description,
                    $books->penerbits->name,
                    $books->categories->name,
                    $books->jumlah,
                    number_format($books->price, 2, ',', '.'),
                ];
            }
            return Excel::download(new LaporanExport($excel), 'laporan-buku.xlsx');
        } else {
            return redirect()->back()->with('error', 'Belum ada Buku');
        }
    }
}
