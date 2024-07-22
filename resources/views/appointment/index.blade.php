<x-layout>
  <section id="appointment" class="mt-5">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
      <h2>Appointment</h2>
      <p>Create new appointment with available health worker</p>
    </div><!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

      <form method="post" action="/appointment">
        @csrf
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <input type="hidden" name="patient_id" value="{{$userId}}">
            <label for="name">Patient Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{$userName}}" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="date">Appointment date</label>
            <input type="date" name="apt_Date" id="date" class="form-control datepicker" id="date" placeholder="Appointment Date">
            @error('apt_Date')
            <p class="text-danger text-xs">{{ $message }}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group mt-3">
            <label for="hw_id">Health worker</label>
            <select name="hw_id" id="hw_id" class="form-select">
            </select>
            @error('hw_id')
            <p class="text-danger text-xs">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group my-3 ">
            <label for="status">Appointment status</label>
            <select class="form-select" name="apt_Status" id="status">
              <option value="schedule">schedule</option>
            </select>
          </div>
          <div class="text-center m-5"><button class="btn bg-primary" type="submit">Make an Appointment</button></div>
        </div>
    </div>

    </form>

    </div>

  </section>
</x-layout>