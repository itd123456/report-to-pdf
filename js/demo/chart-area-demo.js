$('#generate').on('click', function()
{
    report = $('#reportType').val();
    pn = $('#pnNumber').val();
    url = '';

    if (report == 'nonPdc')
    {
        url = './pdf/php/non-pdc.php';
    }

    console.log(report + ' ' + pn);
});