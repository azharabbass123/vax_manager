$(document).ready(function(){

    function loadBlockedUsers() {
        if ($.fn.DataTable.isDataTable('#BlockedUserTable')) {
            $('#BlockedUserTable').DataTable().destroy();
        }
        $('#BlockedUserTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/blocked-users",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'role_id', name: 'role_id' },
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

    window.unBlockUsers = function(id) {
        if (confirm('Are you sure you want to Unblock this user?')) {
            $.ajax({
                url: "/unBlockUser/" + id,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.success); // Show success message
                    $('#BlockedUserTable').DataTable().ajax.reload(); // Reload DataTable
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting user:', error);
                }
            });
        }
    };

    loadBlockedUsers();
})