
$(document).ready(function(){
    // Function to fetch cities based on selected province ID
    function fetchCities(prvId) {
        $.ajax({
            url: fetchCitiesUrl,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            data: { id: prvId }
        }).done(function(cities){
            $('#city_id').empty();
            cities.forEach(function(city){
                $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
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