
// This file is required in admin view to show data 
$(document).ready(function() {
    $('.table').DataTable();
    $('#patient_card').hide();
    $('#appointment_card').hide();
    $('#vaccination_card').hide();
    //getHealthWorkers();
    health_worker_card = function (){
      $('#patient').removeClass('myActive-button');
      $('#appointment').removeClass('myActive-button');
      $('#vaccination').removeClass('myActive-button');
      $('#hw').addClass('myActive-button');
      $('#health_worker_card').show();
      $('#patient_card').hide();
      $('#appointment_card').hide();
      $('#vaccination_card').hide();
    };
    patient_card = function () {
      $('#patient').addClass('myActive-button');
      $('#appointment').removeClass('myActive-button');
      $('#vaccination').removeClass('myActive-button');
      $('#hw').removeClass('myActive-button');
      $('#patient_card').show();
      $('#health_worker_card').hide();
      $('#appointment_card').hide();
      $('#vaccination_card').hide();
    }
    appointment_card = function () {
      $('#patient').removeClass('myActive-button');
      $('#appointment').addClass('myActive-button');
      $('#vaccination').removeClass('myActive-button');
      $('#hw').removeClass('myActive-button');
      $('#patient_card').hide();
      $('#health_worker_card').hide();
      $('#appointment_card').show();
      $('#vaccination_card').hide();
    }
    vaccination_card = function () {
      $('#patient').removeClass('myActive-button');
      $('#appointment').removeClass('myActive-button');
      $('#vaccination').addClass('myActive-button');
      $('#hw').removeClass('myActive-button');
      $('#patient_card').hide();
      $('#health_worker_card').hide();
      $('#appointment_card').hide();
      $('#vaccination_card').show();
    }

   // Function to load health workers data via AJAX
   function loadHealthWorkers() {
    $.ajax({
        url: 'controllers/admin/loadData.php', // Replace with your PHP endpoint
        type: 'GET',
        dataType: 'json',
        data:{action: 'hw'},
        success: function(data) {
            updateTableHw('#health_worker_data', data);
        },
        error: function(xhr, status, error) {
            console.error('Error loading health workers:', error);
        }
    });
}

// Function to load patients data via AJAX
function loadPatients() {
    $.ajax({
        url: 'controllers/admin/loadData.php', // Replace with your PHP endpoint
        type: 'GET',
        dataType: 'json',
        data: {action: 'patient'},
        success: function(data) {
            // Update patients table
            updateTablePatient('#patient_data', data);
        },
        error: function(xhr, status, error) {
            console.error('Error loading patients:', error);
        }
    });
}

// Function to load appointments data via AJAX
function loadAppointments() {
    $.ajax({
        url: 'controllers/admin/loadData.php', 
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
        url: 'controllers/admin/loadData.php', 
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

// Function to update a specific table with new data
function updateTableHw(tableId, data) {
    var tableBody = $(tableId);
    tableBody.empty(); 
    var sn = 1;
    $.each(data, function(index, item) {
        var row = '<tr id="' + item.id + '">' +
            '<td>' + sn + '</td>' +
            '<td>' + item.name + '</td>' +
            '<td>' + item.email + '</td>' +
            '<td>' + item.city_name + '</td>' +
            '<td><a href="#" onclick="deleteHw(' + item.id + ')" class="btn btn-sm btn-danger">Delete</a></td>' +
            '</tr>';
        tableBody.append(row);
        sn++;
    });
}

function updateTablePatient(tableId, data) {
  var tableBody = $(tableId);
  tableBody.empty();
  var sn = 1;
  $.each(data, function(index, item) {
      var row = '<tr id="' + item.id + '">' +
          '<td>' + sn + '</td>' +
          '<td>' + item.name + '</td>' +
          '<td>' + item.email + '</td>' +
          '<td>' + item.city_name + '</td>' +
          '<td><a href="#" onclick="deletePatient(' + item.id + ')" class="btn btn-sm btn-danger">Delete</a></td>' +
          '</tr>';
      tableBody.append(row);
      sn++;
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
          //'<td><a href="editAppointment?edit=' + item.appointment_id + '"class="btn btn-sm btn-primary">Edit</a></td>' +
          //'<td><a href="#" onclick="deleteAptRec(' + item.appointment_id + ')" class="btn btn-sm btn-danger">Delete</a></td>' +
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
        //   '<td><a href="editVaccination?edit=' + item.vaccination_id + '"class="btn btn-sm btn-primary">Edit</a></td>' +
        //   '<td><a href="#" onclick="deleteVaxRec(' + item.vaccination_id + ')" class="btn btn-sm btn-danger">Delete</a></td>' +
           '</tr>';
      tableBody.append(row);
      sn++;
  });
}

// Event handlers for menu buttons
$('#hw').click(function() {
    loadHealthWorkers();
});

$('#patient').click(function() {
    loadPatients();
});

$('#appointment').click(function() {
    loadAppointments();
});

$('#vaccination').click(function() {
    loadVaccinations();
});

// Initially load health workers data
loadHealthWorkers();

})