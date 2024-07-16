<x-layout>

<section class="hero">
 
<!-- sidebar  -->
<div class="mySidebar">
    </div> 

<!-- Page content -->
<div class="container" id="myContainer">
      <div class="row mt-2">
        <div class="col">
<!-- appointments table  -->
<div id="patient_details" class="card mt-2">
            <div class="card-header">
      <h3 class="display-6 fw-bold text-center text-primary">Blocked Users</h3>
    </div>
    <div class="card-body">
      <table id="BlockedUserTable" class="table table-bordered table-striped text-center">
        <thead>
        <tr>
          <th class="bg-primary text-white text-center">SN</th>
          <th class="bg-primary text-white text-center">Name</th>
          <th class="bg-primary text-white text-center">Role</th>
          <th class="bg-primary text-white text-center">Action</th>
        </tr>
        </thead>
      </table>
      <a
          href="/admin"
          class="bg-info w-50 mt-5 mx-2 text-center text-white text-decoration-none p-2 rounded"
          >Go Back</a>
    </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('assets/js/blockedUsersData.js')}}"></script>
</section>
</x-layout>