const createModal = $("#createTaskModal");
const createForm = $("#createTaskForm");
const createSubmitButton = $("#createSubmitButton");
const spinner = getButtonSpinner(createSubmitButton);

createModal.on("hidden.bs.modal", function () {
    createForm[0].reset();
});

createForm.on("submit", function (e) {
    e.preventDefault();

    createSubmitButton.prop("disabled", true);
    spinner.show();

    const url = this.action;
    const formData = new FormData(this);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            createModal.modal("hide");

            Swal.fire({
                icon: "success",
                title: "Saved!",
                text: res.message,
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        },
        error: function (xhr) {
            const message = xhr.responseJSON.message;

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,
            });
        },
        complete: function () {
            createSubmitButton.prop("disabled", false);
            spinner.hide();
        },
    });
});
