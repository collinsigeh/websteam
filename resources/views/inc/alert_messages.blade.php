
@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
      - {{ $error }}<br>
  @endforeach
</div>
@endif
@if ($success_message = Session::get('success_message'))
<div class="alert alert-success">
  {{ $success_message }}
</div>
@endif