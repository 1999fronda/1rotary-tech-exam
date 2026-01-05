window.taskTable = $("#taskTable").DataTable({
    searching: true,
    order: [[2, 'asc']],
    columnDefs: [
        { orderable: false, targets: -1 },
        { searchable: false, targets: -1 },
    ],
    language: {
        emptyTable: "No tasks found in this project",
    },
    stateSave: true,
});
