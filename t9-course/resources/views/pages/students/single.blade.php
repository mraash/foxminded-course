@extends ('layouts.default')

@section ('webTitle', 'Student')
@section ('tableTitle', 'Student')

@section ('content')
    <style>
        td.td-paddinged {
            padding: 0.75rem !important;
        }

        td.normal-padding {
            padding: 0.3rem !important;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="row mb-4 ml-1">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle td-paddinged">
                                ID
                            </td>
                            <td class="td-paddinged">
                                {{ $student->id }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle td-paddinged">
                                First name
                            </td>
                            <td class="td-paddinged">
                                {{ $student->first_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle td-paddinged">
                                Last name
                            </td>
                            <td class="td-paddinged">
                                {{ $student->last_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h4>
        Add course:
    </h4>
    <form action="{{ route('actions.students.courses.add', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group d-flex justify-content-between w-50">
            <select name="course-id" class="form-control mr-2">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>

            <button class="btn btn-success" style="
                text-overflow: ellipsis;
                white-space: nowrap;
            ">
                Add
            </button>
        </div>
    </form>

    <h4 class="mt-4">
        Current courses:
    </h4>
    @if ($student->courses->count() > 0)
        <div class="card mb-4 w-50">
            <div class="card-body p-0">
                    <table class="table table-sm">
                        <tbody>
                            @foreach ($student->courses as $course)
                                <tr>
                                    <td class="w-100 align-middle">
                                        {{ $course->name }}
                                    </td>
                                    <td class="normal-padding">
                                        <form
                                            action="{{ route(
                                                'actions.students.courses.remove',
                                                $student->id
                                            ) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <input
                                                type="hidden"
                                                name="course-id"
                                                value="{{ $course->id }}"
                                            >
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    @else
        No courses :(
    @endif
@endsection
