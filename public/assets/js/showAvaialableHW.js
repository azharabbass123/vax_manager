$(document).ready(function(){
    // Function to fetch cities based on selected province ID
    function fetchHW(date) {
        $.ajax({
            url: 'fetch-avaialble-hw',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            data: { date: date }
        }).done(function(hws){
            $('#hw_id').empty();
            hws.forEach(function(hw){
                $('#hw_id').append(`<option value="${hw.id}">${hw.name}</option>`);
            });
        });
    }
    $('#date').change(function(){
        var date = $(this).val(); 
        fetchHW(date); 
    });

});