
$(document).ready(function() {
    $('#hwvaccination_card').hide();
    $('#trackPatients_card').hide();

    hwappointment_card = function () {
        $('#hwappointment').addClass('myActive-button');
        $('#trackPatients').removeClass('myActive-button');
        $('#hwvaccination').removeClass('myActive-button');
        $('#hwappointment_card').show();
        $('#hwvaccination_card').hide();
        $('#trackPatients_card').hide();
        }

    hwvaccination_card = function () {
        $('#hwappointment').removeClass('myActive-button');
        $('#trackPatients').removeClass('myActive-button');
        $('#hwvaccination').addClass('myActive-button');
        $('#hwappointment_card').hide();
        $('#hwvaccination_card').show();
        $('#trackPatients_card').hide();
        }

    trackPatients_card = function () {
        $('#hwappointment').removeClass('myActive-button');
        $('#trackPatients').addClass('myActive-button');
        $('#hwvaccination').removeClass('myActive-button');
        $('#hwappointment_card').hide();
        $('#hwvaccination_card').hide();
        $('#trackPatients_card').show();
    }
})