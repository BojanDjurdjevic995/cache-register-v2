$(document).ready(function () {
    var page = $('meta[name="page"]').attr('content');
    if (page == 'index')
    {
        calculationTable('calculation');
    }
});
function calculationTable(table)
{
    $('#'+table+'').DataTable({
        "processing": false,
        "serverSide": true,
        "autoWidth": false,
        language: {
            paginate: {
                next: '<a class="page-link">Next</a>',
                previous: '<a class="page-link"  tabindex="-1">Previous</a>',
            }
        },
        'ajax': {
            method: "POST",
            dataType: 'JSON',
            url: '../ajax/get-calculations.php',
            data : {_token : $('meta[name="csrf-token"]').attr('content')}
        },
        "fnDrawCallback": function () {
            $('#'+table+'').removeClass('dataTable').addClass('table-dark');
            styleDatatables(table)
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "object"},
            {"data": "date"},
            {"data": "document"},
            {"data": "items"},
        ]
    })
}
function styleDatatables(table)
{
    $('#' + table + '_wrapper').addClass('mt-4');
    $('select[name="' + table + '_length"]').addClass('form-control').css({'margin-left' : '10px', 'margin-right' : '10px'});
    $('#' + table + '_info').addClass('alert alert-primary');
    $('#' + table + '_length label').addClass('d-flex align-items-center');
    $('#' + table + '_filter label').css('font-weight', '700').addClass('d-flex align-items-center');
    $('#' + table + '_filter label input').attr('Placeholder', 'Enter something...').addClass('form-control');

}