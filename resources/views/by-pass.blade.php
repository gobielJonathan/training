@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<fieldset>
    <legend>Sign In</legend>
    <form action="{{route('loginAs', [], false)}}" method="post">
        @error('errors')
            <span>{{$errors->email->first()}}</span>
        @enderror
        @csrf
        <div class="form-group">
          <input type="email" class="form-control is-invalid" name="email"  aria-describedby="emailHelpId" placeholder="Email">
          <small id="emailHelpId" class="form-text text-muted">Example : John Doe@gmail.com</small>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password"  placeholder="Password">
        </div>

        <button class="btn w-100 bg-primary text-white">
            Sign In
        </button>
    </form>
</fieldset>

<fieldset>
    <legend>register</legend>
    <form action="{{route('addUser', [], false)}}" method="post">
        @csrf
        <div class="form-group">
          <input type="email" class="form-control is-invalid" name="email"  aria-describedby="emailHelpId" placeholder="Email">
          <small id="emailHelpId" class="form-text text-muted">Example : John Doe@gmail.com</small>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password"  placeholder="Password">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="address"  aria-describedby="helpId" placeholder="Full Address">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="telephone"  aria-describedby="helpId" placeholder="Telephone">
        </div>

        <div class="form-group">
          <select class="form-control" name="role">
            <option value="{{App\Models\User::ADMIN}}">Admin</option>
            <option value="{{App\Models\User::USER}}">User</option>
          </select>
        </div>

        <button class="btn w-100 bg-primary text-white">
            Sign Up
        </button>
    </form>
</fieldset>

<fieldset>
  <legend>stimulus</legend>
  <form action="{{route('addStimulus', [], false)}}" method="post">
      @csrf
      <div class="form-group">
        <input type="text" class="form-control is-invalid" name="name"  aria-describedby="emailHelpId" placeholder="Name">
      </div>
      <button class="btn w-100 bg-primary text-white">
          Add
      </button>
  </form>
</fieldset>

<fieldset>
  <legend>payment</legend>
  <form action="{{route('addPayment', [], false)}}" method="post">
      @csrf
      <div class="form-group">
        <input type="text" class="form-control is-invalid" name="name"  aria-describedby="emailHelpId" placeholder="Name">
      </div>
      <div class="form-group">
        <input type="number" class="form-control is-invalid" name="number"  aria-describedby="emailHelpId" placeholder="Number">
      </div>
      <button class="btn w-100 bg-primary text-white">
          Add
      </button>
  </form>
</fieldset>