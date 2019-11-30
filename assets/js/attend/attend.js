//datatable
$(function () {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        scrollX: false,
        data: attend_json,
        columns: [
            { 'data': "student_name" },
            { 'data': "attended_at" },
            { 'data': "lefted_at" },
            { 'data': "time_diff" },
        ],
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
});