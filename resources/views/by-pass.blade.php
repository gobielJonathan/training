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
      <input type="email" class="form-control is-invalid" name="email" aria-describedby="emailHelpId"
        placeholder="Email">
      <small id="emailHelpId" class="form-text text-muted">Example : John Doe@gmail.com</small>
    </div>

    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

    <button class="btn w-100 bg-primary text-white">
      Sign In
    </button>
  </form>
</fieldset>

<table>
  <thead>
    <tr>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($users as $item)
    <tr>
      <td>{{$item->email}}</td>
      <td>{{$item->isAdmin() ? "Admin" : "Non Admin"}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<fieldset>
  <legend>register</legend>
  <form action="{{route('addUser', [], false)}}" method="post">
    @csrf
    <div class="form-group">
      <input type="email" class="form-control is-invalid" name="email" aria-describedby="emailHelpId"
        placeholder="Email">
      <small id="emailHelpId" class="form-text text-muted">Example : John Doe@gmail.com</small>
    </div>

    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password">
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