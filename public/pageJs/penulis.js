let save_method;
$(document).ready(function () {
    penulisTable();
});

function penulisTable() {
    var table = $("#data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "/dataTable-penulis",
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-left",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },

            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
    // $('.filter-select').change(function() {
    //     table.column($(this).data('column')).search($(this).val()).draw();
    // });
}

function resetValidation() {
    $(".is-invalid").removeClass("is-invalid");
    $(".is-valid").removeClass("is-valid");
    $("span.invalid-feedback").remove();
}

function showCreateModal() {
    $("#penulisForm")[0].reset();
    save_method = "create";
    resetValidation();
    $("#oldPassword").hide();
    $("#modalForm").modal("show");
    $(".modal-title").text("Create Category");
    $(".btnSubmit").text("Create");
}
function showDetailModal(e) {
    let id = e.getAttribute("data-id");

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        url: "penulis/" + id,
        success: function (response) {
            let result = response.data;
            $("#name_detail").text(result.name);
            $("#email_detail").text(result.email);
            // $('#uuid').text(result.uuid);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
    // $('#detailPembelianForm')[0].reset();
    $("#modalDetailPembelian").modal("show");
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
        url: "penulis/" + id,
        success: function (response) {
            let result = response.data;
            $("#name_update").val(result.name);
            $("#email_update").val(result.email);
            $("#uuids").val(result.uuid);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
    // $('#pembelianForm')[0].reset();
    $("#modalEditForm").modal("show");
    $(".modal-title").text("Edit Pembelian");
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
                url: "penulis/" + id,
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
//Store dan Update data
$("#penulisForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    let url, method;
    url = "/penulis";
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
        error: function (jqXHR, textStatus, errorThrown) {
            if (
                jqXHR.responseJSON.message ==
                "The email has already been taken."
            ) {
                alert(jqXHR.responseJSON.message);
            }
        },
    });
});

$("#penulisEditForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    formData.append("_method", "PUT");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "penulis/" + $("#uuids").val(),
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#modalEditForm").modal("hide");
            $("#data-table").DataTable().ajax.reload();
            Swal.fire({
                title: "Success",
                text: response.message,
                icon: "success",
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (
                jqXHR.responseJSON.message ==
                "The email has already been taken."
            ) {
                alert(jqXHR.responseJSON.message);
            }
            // alert(jqXHR.responseJSON.message);

            if (
                jqXHR.responseJSON.message ==
                    "The password confirm field is required." ||
                jqXHR.responseJSON.message ==
                    "The password confirm field must match password."
            ) {
                alert(jqXHR.responseJSON.message);
            }
        },
    });
});
