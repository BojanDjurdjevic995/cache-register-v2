$(document).ready(function () {
    var page = $('meta[name="page"]').attr('content');
    switch (page) {
        case 'index': calculationTable('calculation');
            break;
        case 'add-calc': getDetails('calc');
            break;
        case 'sale': saleTable('sale');
            break;
        case 'add-sale': getDetails('sale');
            break;
    }

    $('#lagerListForm').on('submit', function() {
        setTimeout(() => {
            $('#lagerListForm')[0].reset();
        }, 500);
    })

    if ($('#alertForSuccess').length) {
        $('#alertForSuccess').css('transform', 'translateX(60px)');

        setTimeout(function () {
            $('#alertForSuccess').css('transform', 'translateX(-360px)');
        }, 4000);

        setTimeout(function () {
            $('#alertForSuccess').remove();
        }, 8000);
    }
});
function getDetails(file) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var num = $('.numOfAppend').last().data('num') !== undefined ? ($('.numOfAppend').last().data('num') + 1) : 1;
    console.log($('.numOfAppend').last().data('num'))
    $.ajax({
        cache: false,
        method: 'POST',
        url: '../ajax/get-' + file + '-details.php',
        dataType: 'JSON',
        data: { _token: token, num: num },
        success: function (response) {
            $('#appednDetails').append(response)
        }
    });
}
function calculationTable(table) {
    $('#' + table + '').DataTable({
        "processing": false,
        "serverSide": true,
        "autoWidth": false,
        language: {
            paginate: {
                next: '<a class="page-link">Slijedeća</a>',
                previous: '<a class="page-link"  tabindex="-1">Prethodna</a>',
            }
        },
        'ajax': {
            method: "POST",
            dataType: 'JSON',
            url: '../ajax/get-calculations.php',
            data: { _token: $('meta[name="csrf-token"]').attr('content') }
        },
        "fnDrawCallback": function () {
            $('#' + table + '').removeClass('dataTable').addClass('table-dark');
            styleDatatables(table)
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "object" },
            { "data": "date" },
            { "data": "document" },
            { "data": "items", "orderable": false },
        ]
    })
}
function saleTable(table) {
    $('#' + table + '').DataTable({
        "processing": false,
        "serverSide": true,
        "autoWidth": false,
        language: {
            paginate: {
                next: '<a class="page-link">Slijedeća</a>',
                previous: '<a class="page-link"  tabindex="-1">Prethodna</a>',
            }
        },
        'ajax': {
            method: "POST",
            dataType: 'JSON',
            url: '../ajax/get-sale.php',
            data: { _token: $('meta[name="csrf-token"]').attr('content') }
        },
        "fnDrawCallback": function () {
            $('#' + table + '').removeClass('dataTable').addClass('table-dark');
            styleDatatables(table)
        },
        "columns": [
            { "data": "id" },
            { "data": "customer" },
            { "data": "customer_pib" },
            { "data": "customer_jib" },
            { "data": "invoice" },
            { "data": "delivery_place" },
            { "data": "items", "orderable": false  },
        ]
    })
}

function styleDatatables(table) {
    $('#' + table + ' th').addClass('cursorPointer');
    $('#' + table + '_wrapper').addClass('mt-4');
    $('select[name="' + table + '_length"]').addClass('form-control').css({ 'margin-left': '10px', 'margin-right': '10px' });
    $('#' + table + '_info').addClass('alert alert-primary');
    $('#' + table + '_length label').addClass('d-flex align-items-center');
    $('#' + table + '_length label').contents().first().replaceWith('Prikaži');
    $('#' + table + '_length label').contents().last().replaceWith('unosa');
    $('#' + table + '_filter label').css('font-weight', '700').addClass('d-flex align-items-center');
    $('#' + table + '_filter label').contents().first().replaceWith('Pretraži');
    $('#' + table + '_filter label input').attr('Placeholder', 'Unesite nešto...').addClass('form-control');

    let infoText = $('#' + table + '_info').text();
    infoText = infoText.replace('Showing', 'Prikaz');
    infoText = infoText.replace('to', 'do');
    infoText = infoText.replace('of', 'od');
    infoText = infoText.replace('entries', 'unosa');
    $('#' + table + '_info').text(infoText);
}