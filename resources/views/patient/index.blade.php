<x-layout>
  <section id="hero">
    <!-- The sidebar -->
    <div class="mySidebar">
      <h3 class="text-info text-center mb-4">
        {{Auth::user()->name}}
      </h3>
      <hr>

      <button class="myActive-button mySidebar-btn " id="ptappointment">Appointments</button>
      <button class="mySidebar-btn" id="ptvaccination">Vaccination</button>
      <a href="appointment" class="mySidebar-btn mt-2 mx-2 text-center btn text-dark text-decoration-none p-2 rounded">Create new Appointment</a>
      <a href="/edit/{{Auth::user()->id}}" class="bg-info w-50 mt-5 mx-2 text-center text-white text-decoration-none p-2 rounded">Edit Profile</a>
    </div>
    <!-- Page content -->
    <div class="container" id="myContainer">
      <div class="row mt-2">
        <div class="col">
          <!-- appointments table  -->
          <div id="ptappointment_card" class="card mt-2">
            <div class="card-header">
              <h3 class="display-6 fw-bold text-center text-primary">Appointments</h3>
            </div>
            <div class="card-body">
              <table id="ptAptTable" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th class="bg-primary text-white text-center">SN</th>
                    <th class="bg-primary text-white text-center">Patient Name</th>
                    <th class="bg-primary text-white text-center">Health Worker</th>
                    <th class="bg-primary text-white text-center">Date</th>
                    <th class="bg-primary text-white text-center">Status</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- vaccination table  -->
          <div id="ptvaccination_card" class="card mt-2">
            <div class="card-header">
              <h3 class="display-6 fw-bold text-center text-primary">Vaccinations Schedule</h3>
            </div>
            <div class="card-body">
              <table id="ptVaxTable" class="table table-bordered table-striped text-center">
                <thead>
                  <tr>
                    <th class="bg-primary text-white text-center">SN</th>
                    <th class="bg-primary text-white text-center">Patient Name</th>
                    <th class="bg-primary text-white text-center">Date</th>
                    <th class="bg-primary text-white text-center">Status</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('assets/js/patientViewData.js') }}"></script>
</x-layout>