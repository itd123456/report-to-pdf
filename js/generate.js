$('#generate').on('click', function()
{
    report = $('#reportType').val();
    pn = $('#pnNumber').val();
    url = '';

    if (report == 'nonPdc')
    {
        url = './pdf/php/non-pdc.php?pnNumber=' + pn;
    }
    else if (report == 'pdc')
    {
    	url = './pdf/php/pdc.php?pnNumber=' + pn;
    }
    else if (report == 'promissory')
    {
    	url = './pdf/php/promissory-note.php?pnNumber=' + pn;
    }

    window.open(url);
});