<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalFormLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="bukuForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body border-top border-bottom">
                    {{-- <input type="hidden" name="uuid" id="uuid"> --}}
                    {{-- <input type="hidden" name="no_transaksi" value="{{ $pembelian->no_transaksi }}"> --}}

                    <div class="mb-3 form-group">
                        <label for="harga_beli">Judul Buku
                        </label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="jumlah">Jumlah Buku</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="description">
                            Description
                        </label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="flex mb-3 form-group d-flex flex-column">
                        <label for="image" class="mb-2">
                            Image
                        </label>
                        <img src="" alt="" id="blah" width="100px" class="mb-2 rounded">
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="category_id">Pilih Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">-- Pilih Category --</option>
                            @foreach ($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="author">Pilih Penulis</label>
                        <select class="form-control" id="author" name="author">
                            <option value="">-- Pilih Penulis --</option>
                            @foreach ($penulis as $penulises)
                                <option value="{{ $penulises->id }}">{{ $penulises->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="penerbit_id">Pilih Penerbit</label>
                        <select class="form-control" id="penerbit_id" name="penerbit_id">
                            <option value="">-- Pilih Penerbit --</option>
                            @foreach ($penerbit as $penerbites)
                                <option value="{{ $penerbites->id }}">{{ $penerbites->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" min="1"
                            max="100" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnSubmit"></button>
                </div>
            </form>
        </div>
    </div>
</div>
