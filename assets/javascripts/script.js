$(document).ready(function()
    {
    
        $('.alert').delay(5000).fadeOut('slow');
        
        // ajax to perform tv show search
        $('#books_search button').click(function (event){
            event.preventDefault();
            $('#process_results, #hidden_results').html('');
            console.log('Books search Called.');
            $.ajax({
                type: 'POST',
                url: base_url+'books/ajax_search',
                dataType: 'html',
                data: ({
                    'title' : $('#search').val()
                }),
                success: function(data)
                {
                    $('#hidden_results').html(data);
                    $('#hidden_results').show();
                }
            })
        });

    }); // document ready end here

