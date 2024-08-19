@extends ('layouts.default')

@section ('webTitle', 'Delete student')
@section ('tableTitle', 'Delete student')

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

    <form action="{{ route('actions.students.delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <label class="form-check-label" for="delete-input">
                Student ID
            </label>
            <input
                name="id"
                class="form-control"
                id="delete-input"
                placeholder=""
                style="width: 120px"
            >
        </div>

        <div class="mt-2">
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
        </div>
    </form>
@endsection
