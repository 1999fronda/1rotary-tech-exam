$("#taskTable").on("click", ".delete", function () {
    const url = $(this).data("url");

    Swal.fire({
        title: "Confirm",
        text: "Are you sure you want to delete this task?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: res.message,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    const message =
                        xhr.responseJSON?.message || "Something went wrong.";
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: message,
                    });
                },
            });
        }
    });
});
