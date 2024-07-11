
$(document).ready(function() {
    $('#hwvaccination_card').hide();
    $('#trackPatients_card').hide();
    loadAppointments();

    $('#hwappointment').click(function () {
        $('#hwappointment').addClass('myActive-button');
        $('#trackPatients').removeClass('myActive-button');
        $('#hwvaccination').removeClass('myActive-button');
        $('#hwappointment_card').show();
        $('#hwvaccination_card').hide();
        $('#trackPatients_card').hide();
        loadAppointments();
    });

    $('#hwvaccination').click(function () {
        $('#hwappointment').removeClass('myActive-button');
        $('#trackPatients').removeClass('myActive-button');
        $('#hwvaccination').addClass('myActive-button');
        $('#hwappointment_card').hide();
        $('#hwvaccination_card').show();
        $('#trackPatients_card').hide();
        loadVaccinations();
    });

    $('#trackPatients').click(function () {
        $('#hwappointment').removeClass('myActive-button');
        $('#trackPatients').addClass('myActive-button');
        $('#hwvaccination').removeClass('myActive-button');
        $('#hwappointment_card').hide();
        $('#hwvaccination_card').hide();
        $('#trackPatients_card').show();
        loadTrackedPatients();
    });

    function loadAppointments() {
        if ($.fn.DataTable.isDataTable('#hwAptTable')) {
            $('#hwAptTable').DataTable().destroy();
        }
        $('#hwAptTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "fetch-apt",
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
        if ($.fn.DataTable.isDataTable('#hwVaxTable')) {
            $('#hwVaxTable').DataTable().destroy();
        }
        $('#hwVaxTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "fetch-vax",
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