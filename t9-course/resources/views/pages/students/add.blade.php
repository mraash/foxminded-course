@extends ('layouts.default')

@section ('webTitle', 'Add student')
@section ('tableTitle', 'Add student')

@section ('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('actions.students.add') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label class="form-check-label" for="first-name-input">
                First Name
            </label>
            <input
                name="first-name"
                value="{{ old('first-name') }}"
                class="form-control"
                id="first-name-input"
                placeholder=""
                style="width: 280px"
            >
        </div>

        <div class="form-group">
            <label class="form-check-label" for="last-name-input">
                Last Name
            </label>
            <input
                name="last-name"
                value="{{ old('last-name') }}"
                class="form-control"
                id="last-name-input"
                placeholder=""
                style="width: 280px"
            >
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-success">
                Add
            </button>
        </div>
    </form>
@endsection
