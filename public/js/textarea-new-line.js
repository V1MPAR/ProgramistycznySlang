$(document).ready(function(){

    $('#addSlang').on('click', function(){

        var text = $('textarea[name=example]').text();
        text.replace(/\n\r?/g, '<br />');

    });

});
