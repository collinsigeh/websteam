
@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
      - {{ $error }}<br>
  @endforeach
</div>
@endif
@if (strlen(Session::get('success_message') > 1) && $success_message = Session::get('success_message'))
@php
  Session::put('success_message', '');
@endphp
<div class="alert alert-success">
  {{ $success_message }}
</div>
@endif