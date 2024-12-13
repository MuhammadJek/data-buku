@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pages Laporan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">This is Page Report</h2>
                <p class="section-lead">Di sini letak Page Report.</p>
                <div class="card">

                    <div class="card-body">
                        <div class="py-2 table-responsive">

                            <form action="{{ route('laporan.export') }}" method="GET">
                                @csrf
                                @method('GET')
                                <label for="" class="mb-2">Pilih Laporan untuk dicetak :</label>
                                <div class="space-x-4 d-flex ">
                                    <select name="penulis" id="penulis" class="form-control">
                                        <option value="">--Cetak Berdasarkan Penulis--</option>
                                        @foreach ($penulis as $penulises)
                                            <option value="{{ $penulises->id }}">{{ $penulises->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('penulis')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <select name="category" id="category" class="ml-3 form-control">
                                        <option value="">--Cetak Berdasarkan Category--</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <select name="penerbit" id="penerbit" class="ml-3 form-control">
                                        <option value="">--Cetak Berdasarkan Penerbit--</option>
                                        @foreach ($penerbit as $penerbites)
                                            <option value="{{ $penerbites->id }}">{{ $penerbites->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('penerbit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="px-5 mt-3 d-flex align-items-center justify-content-around btn btn-primary col-md-2">
                                    Cetak
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        This is card footer
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- @include('category.modal-form') --}}
    @include('layouts.footer')

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
            integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}")
            @elseif (Session::has('error'))
                toastr.error('{{ Session::get('error') }}')
            @endif
        </script>
    @endpush
@endsection
