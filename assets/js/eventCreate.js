$(document).ready(function() {
    // Adding click event
    createClickEvents();
});


function createClickEvents() {
    // Status
    $('.showStatus').click(function() {
        $.ajax({
            url: '?showStats=true',
            dataType: 'JSON',
            success: function(stats) {
                $('.totalUserStat').html(stats.totalUser);
                $('.statModal').modal();
            }
        });
    });

    // Search
    $('.searchTermButton').click(function() {
        $.ajax({
            url: '?search=true',
            dataType: 'JSON',
            type: 'POST',
            data: {term:$('.searchTerm').val(),field:$('.searchDropdown').val()},
            success: function(result) {
                $('.searchResult').html(result.search.toString());                
                $('.searchedTerm').html(result.term + ' in field ' + $('.searchDropdown').val());
                $('.searchModal').modal();
            }
        });
    });
}