image.onchange = (evt) => {
    const [file] = image.files;
    if (file) {
        blah.src = URL.createObjectURL(file);
    }
};

image_update.onchange = (evt) => {
    const [file] = image_update.files;
    if (file) {
        imageShow.src = URL.createObjectURL(file);
    }
};

let save_method;
$(document).ready(function () {
    pembelianTable();
});

function pembelianTable() {
    var table = $("#data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "/dataTable-buku",
            data: function (d) {
                d.category_id = $("#category_id").val();
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-left",
            },
            {
                data: "title",
                name: "title",
            },
            {
                data: "users.name",
                name: "users.name",
            },
            {
                data: "image",
                name: "image",
                render: function (data) {
                    return (
                        '<img src ="' + data + '" alt="" width="50" class ="">'
                    );
                },
            },
            {
                data: "penerbits.name",
                name: "penerbits.name",
                className: "text-center",
            },
            {
                data: "categories.name",
                name: "categories.name",
                className: "text-center",
            },
            {
                data: "price",
                name: "price",
                className: "text-center",
                render: function (data) {
                    return new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(data);
                },
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
    $(".filter-select").change(function () {
        table.column($(this).data("column")).search($(this).val()).draw();
    });
}

function resetValidation() {
    $(".is-invalid").removeClass("is-invalid");
    $(".is-valid").removeClass("is-valid");
    $("span.invalid-feedback").remove();
}

function showCreateModal() {
    $("#blah").attr("src", "");
    $("#bukuForm")[0].reset();
    save_method = "create";
    resetValidation();
    $("#modalForm").modal("show");
    $(".modal-title").text("Create Buku");
    $(".btnSubmit").text("Create");
}
function showDetailModal(e) {
    let id = e.getAttribute("data-id");

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        url: "buku/" + id,
        success: function (response) {
            let result = response.data;
            $("#title_detail").text(result.title);
            $("#description_detail").text(result.description);
            $("#jumlah_detail").text(result.jumlah);
            $("#price_detail").text(result.price);
            $("#penulis_id_detail").text(result.users.name);
            $("#category_id_detail").text(result.categories.name);
            $("#penerbit_id_detail").text(result.penerbits.name);

            $("#image_detail").attr("src", result.image);
            // $('#uuid').text(result.uuid);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
    // $('#detailPembelianForm')[0].reset();
    $("#modalDetail").modal("show");
}
function showEditModal(e) {
    let id = e.getAttribute("data-id");

    save_method = "update";
    resetValidation();

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        url: "buku/" + id,
        success: function (response) {
            let result = response.data;
            $("#title_update").val(result.title);
            $("#description_update").val(result.description);
            $("#price_update").val(result.price);
            $("#category_id_update").val(result.category_id);
            $("#imageShow").attr("src", result.image);
            $("#author_update").val(result.author);
            $("#jumlah_update").val(result.author);
            $("#penerbit_id_update").val(result.penerbit_id);
            $("#uuid").val(result.uuid);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
    // $('#pembelianForm')[0].reset();
    $("#modalUpdateForm").modal("show");
    $(".modal-title-update").text("Edit Buku");
    $(".btnSubmit").text("Update");
}

function deleteModal(e) {
    let id = e.getAttribute("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "DELETE",
                url: "buku/" + id,
                dataType: "json",
                success: function (response) {
                    // $('#modalForm').modal('hide');
                    $("#data-table").DataTable().ajax.reload();

                    Swal.fire({
                        title: "Deleted!",
                        text: response.message,
                        icon: "success",
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
            });
        }
    });
}

//Store data
$("#bukuForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    let url, method;
    url = "/buku";
    method = "POST";

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#modalForm").modal("hide");
            $("#data-table").DataTable().ajax.reload();
            Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {},
    });
});
//update
$("#bukuUpdateForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    let url, method;
    method = "POST";

    url = "buku/" + $("#uuid").val();
    formData.append("_method", "PUT");

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#modalUpdateForm").modal("hide");
            $("#data-table").DataTable().ajax.reload();
            Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
});
