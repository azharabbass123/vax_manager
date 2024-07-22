
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
            ajax: "fetch-hw-apt",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'patient_name', name: 'patient_Name' },
                { data: 'health_worker_name', name: 'health_worker_name' },
                { data: 'appointment_date', name: 'appointment_date' },
                { data: 'appointment_status', name: 'appointment_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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
            ajax: "fetch-hw-vax",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'patient_name', name: 'patient_Name' },
                { data: 'vax_date', name: 'vax_date' },
                { data: 'vax_status', name: 'vax_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
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

    function loadTrackedPatients(){
        if ($.fn.DataTable.isDataTable('#trackPatientsTable')) {
            $('#trackPatientsTable').DataTable().destroy();
        }
        $('#trackPatientsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "track-patients",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'patient_name', name: 'patient_Name' },
                { data: 'patient_email', name: 'patient_email' },
                { data: 'city_name', name: 'city_name' },
                { data: 'province_name', name: 'province_name' },
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

    window.deletePatient = function(id) {
        if (confirm('Are you sure you want to delete this patient?')) {
            $.ajax({
                url: "/delete-patient/" + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.success); // Show success message
                    $('#patientTable').DataTable().ajax.reload(); // Reload DataTable
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting patient:', error);
                }
            });
        }
    };
    
})