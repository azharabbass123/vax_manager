
$(document).ready(function(){
    // Function to fetch cities based on selected province ID
    function fetchCities(prvId) {
        $.ajax({
            url: 'controllers/register/loadCities.php',
            method: 'post',
            data: { id: prvId }
        }).done(function(cities){
            cities = JSON.parse(cities);
            $('#city').empty();
            cities.forEach(function(city){
                $('#city').append(`<option value="${city.id}">${city.name}</option>`);
            });
        });
    }

    // Initially fetch cities based on the selected province
    var prvId = $('#province').val(); // Get initial selected province ID
    fetchCities(prvId); // Fetch cities on page load

    // Change event handler for province selection
    $('#province').change(function(){
        var prvId = $(this).val(); // Get selected province ID
        fetchCities(prvId); // Fetch cities based on the selected province
    });
});