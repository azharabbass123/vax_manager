<x-layout>
<section
      id="hero" style="overflow-y: scroll;">
      <div class="d-flex mt-3 align-items-center justify-content-center">
        <form method="POST" class="p-5 mx-5 w-50 bg-light rounded">
            @csrf
          <h2 class="text-center text-primary">Login</h2>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              :value="old('email')"
              aria-describedby="emailHelp"
            />
            <div id="emailHelp" class="form-text">
              We'll never share your email with anyone else.
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-5">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Login as:</label>
            <select
              class="form-select"
              id="role_id"
              name="role_id"
              aria-label="Default select example"
            >
              <option selected="" disabled="">select role</option>

              @foreach ($roles as $role)

                <option id="{{ $role['id'] }}" value="{{ $role['id'] }}">{{ $role['name'] }}</option>

              @endforeach

            </select>
            @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('authFail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary my-3">Submit</button>
          <p>
            Did not have account, register
            <a href="register">here</a>
          </p>
        </form>
      </div>
    </section>
</x-layout>