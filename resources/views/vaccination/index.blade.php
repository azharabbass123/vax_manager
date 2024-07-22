<x-layout>
  <section id="vaccination" class="mt-5">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
      <h2>Vaccination Schedule</h2>
      <p>Create new vaccination schedule for available patient</p>
    </div><!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

      <form method="post" action="/vaccination">
        @csrf
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="name">Health Worker Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{$userName}}" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="date">Vaccination date</label>
            <input type="date" name="vax_Date" id="date" class="form-control datepicker" id="date" placeholder="Appointment Date">
            @error('vax_Date')
            <p class="text-danger text-xs">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group mt-3">
            <label for="patient">Patient</label>
            <select name="patient_id" id="patient" class="form-select">
              <option selected="" disabled="">Select Patient</option>
              @php
              // Convert the array $patients to a collection
              $patientCollection = collect($patients);
              @endphp
              @foreach ($patientCollection->unique('patient_name') as $patient)
              <option id="{{ $patient->id }}" value="{{ $patient->id }}">{{ $patient->patient_name }}</option>
              @endforeach
            </select>
            @error('patient_id')
            <p class="text-danger text-xs">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group my-3 ">
            <label for="status">Vaccination status</label>
            <select class="form-select" name="vax_Status" id="status">
              <option value="schedule" selected="">schedule</option>
            </select>
          </div>
          <div class="text-center m-5"><button class="btn bg-primary" type="submit">Create Schedule</button></div>
        </div>
    </div>


    </form>

    </div>

  </section>
</x-layout>