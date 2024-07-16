<x-layout>
<section
      id="hero" style="overflow-y: scroll;">
      <div class="d-flex align-items-center justify-content-center">
        <form method="POST" class="p-4 mt-4 w-50 bg-light rounded" action="/update/{{session('userId')}}">
            @csrf
            @method('patch')
          <h2 class="text-center text-dark">Update Your Data</h2>
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$userData->name}}" />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email"  value="{{$userData->email}}" disabled/>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="DOB" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="DOB" name="DOB"  value="{{$userData->DOB}}"/>
            @error('DOB')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="role_id" class="form-label">Registered as:</label>
            <select
              class="form-select"
              id="role_id"
              name="role_id"
              aria-label="Default select example"
            >
            @if ($userData->role_id == 3)
                <option selected disabled>patient</option>
            @else
                <option selected disabled>health worker</option>
            @endif
            </select>
            @error('role_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <select
              class="form-select"
              id="province"
              name="province"
              aria-label="Default select example"
            >
              <option selected="" disabled="">select province</option>
              @foreach ($provinces as $province)
                    <option id="{{ $province['id'] }}" value="{{ $province['id'] }}">{{ $province['name'] }}</option>
              @endforeach

            </select>
          </div>
          <div class="mb-3">
            <label for="city_id" class="form-label">Select your city</label>
            <select
              id="city_id"
              class="form-select"
              name="city_id"
              aria-label="Default select example"
            ></select>
            @error('city_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
          
          <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>
      </div>
    </section>
</x-layout>