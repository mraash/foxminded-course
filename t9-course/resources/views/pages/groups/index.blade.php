@extends ('layouts.default')

@section ('webTitle', 'Find group')
@section ('tableTitle', 'Groups')

@section ('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form >
        <div class="form-group">
            <label class="form-check-label" for="equal-or-less-input">
                Equal or less
            </label>
            <input
                name="max-students"
                class="form-control"
                id="equal-or-less-input"
                value="{{ request()->input('max-students') }}"
                style="width: 120px"
            >
            <div class="mt-2">
                <button type="submit" class="btn btn-success">
                    Apply
                </button>
            </div>
        </div>
    </form>

    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Students</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->students_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $groups->links() }}
    </div>
@endsection
