if ($('.MakeDataTable').length) {
    var dataTables = $('.MakeDataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
           'excel'
        ],
        language: {
            search: "",
            searchPlaceholder: "Search"
        },
    });
}
