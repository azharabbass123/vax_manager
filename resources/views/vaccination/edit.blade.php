<x-layout>
  <section id="appointment" class="mt-5">

    <!-- Section Title -->
    <div class="container section-title aos-init aos-animate" data-aos="fade-up">
      <h2>Update Vaccination</h2>
      <p>Update vaccination records</p>
    </div><!-- End Section Title -->

    <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

      <form method="POST" action="/updateVaccination/{{$vaxData->id}}">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="name">Health Worker Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <label for="date">Vaccination date</label>
            <input type="date" name="vax_Date" id="date" class="form-control datepicker" value="{{$vaxData->vax_Date}}" id="date" placeholder="Appointment Date" disabled>
            @error('date')
            <p class="text-danger text-xs">{{ $errors['patient'] }}</p>
            @enderror
          </div>
          <div class="col-md-4 form-group my-3 ">
            <label for="status">Vaccination status</label>
            <select class="form-select" name="vax_Status" id="status">
              @if ($vaxData->vax_Status == 'schedule')
              <option selected>schedule</option>
              <option>done</option>
              @else
              <option selected>done</option>
              @endif
            </select>
          </div>
          <div class="text-center m-5"><button class="btn bg-primary" type="submit">Update Schedule</button></div>
        </div>
    </div>


    </form>

    </div>

  </section>
</x-layout>