
// This file is required in admin view to show data 
$(document).ready(function() {
    $('#patient_card').hide();
    $('#appointment_card').hide();
    $('#vaccination_card').hide();
    // Initially load health workers data
    loadHealthWorkers();
    // Event handlers for menu buttons
    $('#hw').click(function() {
        $('#patient').removeClass('myActive-button');
        $('#appointment').removeClass('myActive-button');
        $('#vaccination').removeClass('myActive-button');
        $('#hw').addClass('myActive-button');
        $('#health_worker_card').show();
        $('#patient_card').hide();
        $('#appointment_card').hide();
        $('#vaccination_card').hide();
        loadHealthWorkers();
    });

    $('#patient').click(function() {
        $('#patient').addClass('myActive-button');
        $('#appointment').removeClass('myActive-button');
        $('#vaccination').removeClass('myActive-button');
        $('#hw').removeClass('myActive-button');
        $('#patient_card').show();
        $('#health_worker_card').hide();
        $('#appointment_card').hide();
        $('#vaccination_card').hide();
        loadPatients();
    });

    $('#appointment').click(function() {
        $('#patient').removeClass('myActive-button');
        $('#appointment').addClass('myActive-button');
        $('#vaccination').removeClass('myActive-button');
        $('#hw').removeClass('myActive-button');
        $('#patient_card').hide();
        $('#health_worker_card').hide();
        $('#appointment_card').show();
        $('#vaccination_card').hide();
        loadAppointments();
    });

    $('#vaccination').click(function() {
        $('#patient').removeClass('myActive-button');
        $('#appointment').removeClass('myActive-button');
        $('#vaccination').addClass('myActive-button');
        $('#hw').removeClass('myActive-button');
        $('#patient_card').hide();
        $('#health_worker_card').hide();
        $('#appointment_card').hide();
        $('#vaccination_card').show();
        loadVaccinations();
    });

   // Function to load health workers data via AJAX
   function loadHealthWorkers() {
    if ($.fn.DataTable.isDataTable('#hwTable')) {
        $('#hwTable').DataTable().destroy();
    }
    $('#hwTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/fetch-hw",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'city_name', name: 'city_name' },
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

// Function to load patients data via AJAX
function loadPatients() {
    if ($.fn.DataTable.isDataTable('#hwTable')) {
        $('#hwTable').DataTable().destroy();
    }
    $('#patientTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "fetch-patient",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'city_name', name: 'city_name' },
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

// Function to load appointments data via AJAX
function loadAppointments() {
    $.ajax({
        url: fetchDataUrl,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        data: {action: 'apt'},
        success: function(data) {
            updateTableAppointments('#appointment_data', data);
        },
        error: function(xhr, status, error) {
            console.error('Error loading appointments:', error);
        }
    });
}

// Function to load vaccinations data via AJAX
function loadVaccinations() {
    $.ajax({
        url: fetchDataUrl,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        dataType: 'json',
        data: {action: 'vax'},
        success: function(data) {
            updateTableVaccinations('#vaccination_data', data);
        },
        error: function(xhr, status, error) {
            console.error('Error loading vaccinations:', error);
        }
    });
}



function updateTableAppointments(tableId, data) {
  var tableBody = $(tableId);
  tableBody.empty(); 
  var sn = 1;
  $.each(data, function(index, item) {
      var row = '<tr id="' + item.id + '">' +
          '<td>' + sn + '</td>' +
          '<td>' + item.patient_name + '</td>' +
          '<td>' + item.health_worker_name + '</td>' +
          '<td>' + item.appointment_date + '</td>' +
          '<td>' + item.appointment_status + '</td>' +
          '</tr>';
      tableBody.append(row);
      sn++;
  });
}

function updateTableVaccinations(tableId, data) {
  var tableBody = $(tableId);
  tableBody.empty(); 
  var sn = 1;
  $.each(data, function(index, item) {
      var row = '<tr id="' + item.vaccination_id + '">' +
          '<td>' + sn + '</td>' +
          '<td>' + item.patient_name + '</td>' +
          '<td>' + item.vaccination_date + '</td>' +
          '<td>' + item.vaccination_status + '</td>' +
         '</tr>';
      tableBody.append(row);
      sn++;
  });
}


// Function to delete patient via AJAX
window.deletePatient = function(id) {
    if (confirm('Are you sure you want to delete this patient?')) {
        $.ajax({
            url: "/delte-patient/" + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.success); // Show success message
                table.ajax.reload(); // Reload DataTable
            },
            error: function(xhr, status, error) {
                console.error('Error deleting patient:', error);
            }
        });
    }
};

window.deleteHw = function(id) {
    if (confirm('Are you sure you want to delete this health worker?')) {
        $.ajax({
            url: "/delete-hw/" + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.success); // Show success message
                table.ajax.reload(); // Reload DataTable
            },
            error: function(xhr, status, error) {
                console.error('Error deleting health worker:', error);
            }
        });
    }
};
})