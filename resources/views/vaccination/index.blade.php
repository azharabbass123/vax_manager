<x-layout>
<section id="appointment" class="mt-5">

<!-- Section Title -->
<div class="container section-title aos-init aos-animate" data-aos="fade-up">
  <h2>Vaccination Schedule</h2>
  <p>Create new vaccination schedule for available patient</p>
</div><!-- End Section Title -->

<div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

  <form method="POST" action="/vaccination">
    @csrf
    <div class="row">
      <div class="col-md-4 form-group mt-3">
      <label for="name">Health Worker Name</label>
       <input class="form-control" type="text" name="name" id="name" value="{{session('userName')}}" disabled>
       </div>
    </div>
    <div class="row">
      <div class="col-md-4 form-group mt-3">
      <label for="date">Vaccination date</label>
        <input type="date" name="vax_Date" id="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required="">
        @error('date')
            <p class="text-danger text-xs">{{ $errors['patient'] }}</p>
        @enderror  
      </div>
      <div class="col-md-4 form-group mt-3">
      <label for="patient">Patient</label>
        <select name="patient_id" id="patient" class="form-select" required="">
          <option selected="" disabled="">Select Patient</option>
          @foreach ($patients as $patient)
        <option id="{{ $patient->id }}" value="{{ $patient->id }}">{{ $patient->patient_name }}</option>
        @endforeach
        </select>
        @error('patient_id')
            <p class="text-danger text-xs">{{ $errors['patient'] }}</p>
        @enderror  
      </div>
      <div class="col-md-4 form-group my-3 ">
        <label for="status">Vaccination status</label>
        <select class="form-select" name="vax_Status" id="status">
          <option  value="schedule" selected="">schedule</option>
        </select>
       </div>
       <div class="text-center m-5"><button class="btn bg-primary" type="submit">Create Schedule</button></div>
    </div>
    </div>

    <!-- <div class="form-group mt-3">
      <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
    </div> -->
    <!-- <div class="mb-3">
      <div class="loading">Loading</div>
      <div class="error-message"></div>
      <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
    </div> -->
    
  </form>

</div>

</section>
</x-layout>