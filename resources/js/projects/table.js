// @NOTE: I only used client-side datatables bc the app is small
window.projectTable = $("#projectTable").DataTable({
    searching: true,
    columnDefs: [
        { orderable: false, targets: -1 },
        { searchable: false, targets: -1 },
    ],
    language: {
        emptyTable: "No records found",
    },
    stateSave: true,
});
