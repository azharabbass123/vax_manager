<x-layout>
  <section id="hero" style="overflow-y: scroll">
    <!-- The sidebar -->
    <div class="mySidebar">
      <h3 class="text-info mb-4">
        Admin Dashboard
      </h3>
      <hr>
      <button class="myActive-button mySidebar-btn" id="hw"> Health Workers</button>
      <button class="mySidebar-btn" id="patient">Pateints</button>
      <button class="mySidebar-btn" id="appointment">Appointments</button>
      <button class="mySidebar-btn" id="vaccination">Vaccination</button>
      <a href="/blockedUsers" class="bg-success w-50 mt-5 mx-5 text-center text-white text-decoration-none p-2 rounded">Un-Block Users</a>
    </div>

    <!-- Page content -->
    <div class="container" id="myContainer">
      <div class="row mt-2">
        <div class="col">
          <!-- Health worker table  -->
          <x-hwTable></x-hwTable>
          <!-- patients table  -->
          <x-pTable></x-pTable>
          <!-- appointments table  -->
          <x-aptTable></x-aptTable>
          <!-- vaccination table  -->
          <x-vaxTable></x-vaxTable>
        </div>
      </div>
    </div>
  </section>
  <script src="{{ asset('assets/js/adminViewData.js') }}"></script>
</x-layout>