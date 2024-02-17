<!-- Customize the form title depending on the value sent as an array -->
<h1>{{ $mode }} Diviso</h1>

@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Inputs -->
<!-- old('field_name') allows to keep the input value in case an error message is shown -->
<div class="form-group mb-3">
    <label for="name">Division Name</label>
    <input id="name" class="form-control mb-3 bg-white" type="text" name="name" value="{{ isset($division->nameDivision) ? $division->nameDivision : old('name') }}" placeholder="Enter division name" />

</div>

<div class="d-flex gap-2">
    <!-- Link to go back -->
    <a href="{{ url('division') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        Go back
    </a>

    <button id="submit" class="btn btn-primary" type="submit">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        {{ $mode }}
    </button>
</div>
