@extends ('layouts.default')

@section ('webTitle', $racer->fullName . ' | Monaco 2018 Racing')
@section ('tableTitle', $racer->fullName)

@section ('main')
    <style>
        td {
            padding: 0.75rem !important;
        }
    </style>

    <div class="row mb-4 ml-2">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle">Abbreviation</td>
                            <td>{{ $racer->abbreviation }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle">Car</td>
                            <td>{{ $racer->car }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle">Best time</td>
                            <td>{{ $racer->bestTime }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.8em" class="align-middle">Position</td>
                            <td>{{ $racer->position }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
