$(document).ready(function(){
    // Function to fetch cities based on selected province ID
    function fetchHW(date) {
        $.ajax({
            url: 'controllers/health_worker/availableHw.php',
            method: 'post',
            data: { date: date}
        }).done(function(hws){
            hws = JSON.parse(hws);
            $('#hw').empty();
            hws.forEach(function(hw){
                $('#hw').append(`<option value="${hw.id}">${hw.name}</option>`);
            });
        });
    }
    $('#date').change(function(){
        var date = $(this).val(); // Get selected province ID
        fetchHW(date); // Fetch cities based on the selected province
    });
});