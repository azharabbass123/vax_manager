<x-layout>
<section
      id="hero" style="overflow-y: scroll">
      <!-- The sidebar -->
    <div class="mySidebar">
    <h3 class="text-info text-center mb-4">
        {{session('userName')}}
</h3>
<hr>
      
      <button class="myActive-button mySidebar-btn " id="hwappointment">Appointments</button>
      <button class="mySidebar-btn" id="hwvaccination">Vaccination</button>
      <button class="mySidebar-btn" id="trackPatients">Track Patients</button>
      <a
          href="vaccination"
          class="mySidebar-btn text-center text-decoration-none p-2 rounded"
          >Schedule new vax plan</a
        >
      <a
          href="/edit/{{session('userId')}}"
          class="bg-info w-50 mt-5 mx-2 text-center text-white text-decoration-none p-2 rounded"
          >Edit Profile</a>
    </div> 
 <!-- Page content -->
 <div class="container" id="myContainer">
      <div class="row mt-2">
        <t class="col">
          <!-- appointments table  -->
          <div id="hwappointment_card" class="card mt-2">
            <div class="card-header">
      <h3 class="display-6 fw-bold text-center text-primary">Appointments</h3>
    </div>
    <div class="card-body">
      <table id="hwAptTable" class="table table-bordered table-striped text-center">
        <thead>
        <tr>
        <th class="bg-primary text-white text-center">Sr.</th>
          <th class="bg-primary text-white text-center">Patient Name</th>
          <th class="bg-primary text-white text-center">Health Worker</th>
          <th class="bg-primary text-white text-center">Apt. Date</th>
          <th class="bg-primary text-white text-center">Status</th>
          <th class="bg-primary text-white text-center">Edit</th>
        </tr>
        </thead>
      </table>
    </div>
          </div>
          <!-- vaccination table  -->
          <div id="hwvaccination_card" class="card mt-2">
            <div class="card-header">
      <h3 class="display-6 fw-bold text-center text-primary">Vaccinations Schedule</h3>
    </div>
    <div class="card-body">
      <table id="hwVaxTable" class="table table-bordered table-striped text-center">
        <thead>
        <tr>
        <th class="bg-primary text-white text-center">Sr.</th>
          <th class="bg-primary text-white text-center">Patient Name</th>
          <th class="bg-primary text-white text-center">Vax. Date</th>
          <th class="bg-primary text-white text-center">Status</th>
          <th class="bg-primary text-white text-center">Edit</th>
        </tr>
        </thead>
      </table>
    </div>
          </div>

          <!-- track patients table  -->
          <div id="trackPatients_card" class="card mt-2">
            <div class="card-header">
      <h3 class="display-6 fw-bold text-center text-primary">Patient Details</h3>
    </div>
    <div class="card-body">
      <table id="trackPatientsTable" class="table table-bordered table-striped text-center">
        <thead>
        <tr>
          <th class="bg-primary text-white text-center">SN</th>
          <th class="bg-primary text-white text-center">Name</th>
          <th class="bg-primary text-white text-center">Email</th>
          <th class="bg-primary text-white text-center">City</th>
          <th class="bg-primary text-white text-center">Province</th>
          <th class="bg-primary text-white text-center">Vax date</th>
          <th class="bg-primary text-white text-center">Vax Status</th>
          <th class="bg-primary text-white text-center">Action</th>
        </tr>
        </thead>
      </table>
    </div>
          </div>
        </div>
      </div>
    </div>
    </section>

    <script src="{{ asset('assets/js/hwViewData.js') }}"></script>
</x-layout>