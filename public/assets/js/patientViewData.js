$(document).ready(function(){
    $('#ptvaccination_card').hide();

    loadAppointments();

    $('#ptappointment').click(function(){
        $('#ptvaccination_card').hide();
        $('#ptappointment_card').show();
        $('#ptappointment').addClass('myActive-button');
        $('#ptvaccination').removeClass('myActive-button');
        loadAppointments();
    });

    $('#ptvaccination').click(function(){
        $('#ptvaccination_card').show();
        $('#ptappointment_card').hide();
        $('#ptappointment').removeClass('myActive-button');
        $('#ptvaccination').addClass('myActive-button');
        loadVaccinations();
    });

    // Function to load appointments data via AJAX
function loadAppointments() {
    if ($.fn.DataTable.isDataTable('#ptAptTable')) {
        $('#ptAptTable').DataTable().destroy();
    }
    $('#ptAptTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "fetch-patient-apt",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'patient_name', name: 'patient_Name' },
            { data: 'health_worker_name', name: 'health_worker_name' },
            { data: 'appointment_date', name: 'appointment_date' },
            { data: 'appointment_status', name: 'appointment_status' },
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ]
    });
}

function loadVaccinations() {
    if ($.fn.DataTable.isDataTable('#ptVaxTable')) {
        $('#ptVaxTable').DataTable().destroy();
    }
    $('#ptVaxTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "fetch-patient-vax",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'patient_name', name: 'patient_Name' },
            { data: 'vax_date', name: 'vax_date' },
            { data: 'vax_status', name: 'vax_status' },
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ]
    });
}
})