//datatable
$(function () {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        scrollX: false,
        order: [],
        columnDefs: [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            }
        ],
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
    });
});