let save_method;
$(document).ready(function () {
    categoryTable();
});

function categoryTable() {
    var table = $("#data-table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "/dataTable-category",
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
    $("#categoryForm")[0].reset();
    save_method = "create";
    resetValidation();
    $("#modalForm").modal("show");
    $(".modal-title").text("Create Category");
    $(".btnSubmit").text("Create");
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
        url: "category/" + id,
        success: function (response) {
            let result = response.data;
            $("#name").val(result.name);
            $("#uuid").val(result.uuid);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        },
    });
    // $('#pembelianForm')[0].reset();
    $("#modalForm").modal("show");
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
                url: "category/" + id,
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
$("#categoryForm").on("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    let url, method;
    url = "/category";
    method = "POST";

    if (save_method == "update") {
        url = "category/" + $("#uuid").val();
        formData.append("_method", "PUT");
    }

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
            console.log(errorThrown);
        },
    });
});
