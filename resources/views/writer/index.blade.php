@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Buku</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Buku</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">This is List Daftar Buku Anda</h2>
                <p class="section-lead">Di sini letak daftar semua Buku Anda.</p>
                <div class="card">
                    <div class="card-header justify-content-between d-flex">
                        <h4>List Buku Anda</h4>
                    </div>
                    <div class="card-body">
                        <div class="py-2 table-responsive">
                            <div class="pl-3 mb-3 row">
                                <div class="col-md-3">
                                    {{-- <input type="text" id="kode_suppliers" placeholder="Search Column" data-column="2"> --}}
                                    <span class="text-sm">Filter Category</span>
                                    <select name="" id="" class="form-control filter-select"
                                        data-column="5">
                                        <option value="">--Filter Category--</option>
                                        @foreach ($category as $categorys)
                                            <option value="{{ $categorys->name }}">{{ $categorys->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table my-1 table-bordered" id="data-table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Image Cover</th>
                                        <th class="">Penerbit</th>
                                        <th class="">Category</th>
                                        <th class="text-center">Harga</th>
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

    @include('writer.modal-detail')

    @include('layouts.footer')

    @push('scripts')
        <script>
            let save_method;
            $(document).ready(function() {
                pembelianTable();
            });

            function pembelianTable() {
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "/dataTable-writer",
                        data: function(d) {
                            d.category_id = $('#category_id').val();

                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            className: 'text-left',
                        },
                        {
                            data: 'title',
                            name: 'title',
                        },
                        {
                            data: 'users.name',
                            name: 'users.name',
                        },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data) {
                                return '<img src ="' +
                                    data +
                                    '" alt="" width="50" class ="">';
                            },
                        },
                        {
                            data: 'penerbits.name',
                            name: 'penerbits.name',
                            className: 'text-center',
                        },
                        {
                            data: 'categories.name',
                            name: 'categories.name',
                            className: 'text-center',
                        },
                        {
                            data: 'price',
                            name: 'price',
                            className: 'text-center',
                            render: function(data) {
                                return new Intl.NumberFormat("id-ID", {
                                    style: "currency",
                                    currency: "IDR"
                                }).format(data);
                            },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        },
                    ],

                });
                $('.filter-select').change(function() {
                    table.column($(this).data('column')).search($(this).val()).draw();
                });

            }

            function showDetailModal(e) {
                let id = e.getAttribute("data-id");

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "GET",
                    url: "writer-buku/" + id,
                    success: function(response) {
                        let result = response.data;
                        $("#title").text(result.title);
                        $("#description").text(result.description);
                        $("#jumlah").text(result.jumlah);
                        $("#price").text(result.price);
                        $("#penulis_id").text(result.users.name);
                        $("#category_id").text(result.categories.name);
                        $("#penerbit_id").text(result.penerbits.name);

                        $("#image").attr('src', result.image);
                        // $('#uuid').text(result.uuid);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.responseText);
                    },
                });
                // $('#detailPembelianForm')[0].reset();
                $("#modalDetail").modal("show");
            }
        </script>
    @endpush
@endsection
