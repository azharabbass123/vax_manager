<x-layout>
  <section id="appointment" class="mt-5">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
      <h2>Appointment</h2>
      <p>Update appointment record</p>
    </div><!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

      <form method="post" action="/updateAppointment/{{$aptData->id}}">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <input type="hidden" name="patient_id" value="{{Auth::user()->id}}">
            <label for="name">Health Worekr:</label>
            <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="date">Appointment date</label>
            <input type="date" name="apt_Date" id="date" class="form-control datepicker" value="{{$aptData->apt_Date}}" id="date" placeholder="Appointment Date" disabled>
            @error('apt_Date')
            <p class="text-danger text-xs">{{ $errors['patient'] }}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group my-3 ">
            <label for="status">Appointment status</label>
            <select class="form-select" name="apt_Status" id="status">
              @if ($aptData->apt_Status == 'schedule')
              <option selected>schedule</option>
              <option>done</option>
              @else
              <option selected>done</option>
              @endif
            </select>
          </div>
          <div class="text-center m-5"><button class="btn bg-primary" type="submit">Update Appointment</button></div>
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