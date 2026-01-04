const editModal = $("#editProjectModal");

$("#projectTable").on("click", ".edit", function () {
    const url = $(this).data("url");

    $.ajax({
        url: url,
        type: "GET",
        success: function (project) {
            $("#editProjectId").val(project.id);
            $("#editName").val(project.name);
            $("#editDescription").val(project.description);

            editModal.modal("show");
        },
        error: function (xhr) {
            if (xhr.status === 403) {
                Swal.fire({
                    icon: "error",
                    title: "Access denied",
                    text: xhr.responseJSON.message,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong.",
                });
            }
        },
    });
});

const updateForm = $("#updateProjectForm");
const updateSubmitButton = $("#updateSubmitButton");
const spinner = getButtonSpinner(updateSubmitButton);

updateForm.on("submit", function (e) {
    e.preventDefault();

    updateSubmitButton.prop("disabled", true);
    spinner.show();

    const formData = new FormData(this);
    const projectId = $("#editProjectId").val();

    $.ajax({
        url: `/projects/${projectId}/update`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            editModal.modal("hide");

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
            const message =
                xhr.responseJSON?.message || "Something went wrong.";

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,
            });
        },
        complete: function () {
            updateSubmitButton.prop("disabled", false);
            spinner.hide();
        },
    });
});
