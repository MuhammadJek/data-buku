@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Penerbit</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Penerbit</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">This is List Daftar Penerbit</h2>
                <p class="section-lead">Di sini letak daftar semua Penerbit.</p>
                <div class="card">
                    <div class="card-header justify-content-between d-flex">
                        <h4>List Penerbit</h4>
                        <button class="btn btn-info" href="javascript:void(0)" onclick="showCreateModal()"> Add New
                            Penerbit</button>

                    </div>
                    <div class="card-body">
                        <div class="py-2 table-responsive">
                            <div class="pl-3 mb-3 row">
                                <div class="col-md-3">
                                    {{-- <input type="text" id="kode_suppliers" placeholder="Search Column" data-column="2"> --}}
                                    {{-- <span class="text-sm">Filter Category</span> --}}
                                    {{-- <select name="" id="" class="form-control filter-select"
                                        data-column="2">
                                        <option value="">--Filter Supplier--</option>
                                        @foreach ($supplier as $suppliers)
                                            <option value="{{ $suppliers->kode_supplier }}">{{ $suppliers->nama_supplier }}
                                                - {{ $suppliers->kode_supplier }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <table class="table my-1 table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nama Penerbit</th>
                                        <th>Code Penerbit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        This is card footer
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('penerbit.modal-form')
    @include('layouts.footer')

    @push('scripts')
        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
        {!! JsValidator::formRequest('App\Http\Requests\PenerbitRequest', '#penerbitForm') !!}
        <script src="/pageJs/penerbit.js"></script>
    @endpush
@endsection
