@extends ('layouts.default')

@section ('webTitle', 'Drivers | Monaco 2018 Racing')
@section ('tableTitle', 'Drivers')

@section ('main')
    <div class="card mb-4">
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    @foreach ($racers as $racer)
                        <tr>
                            <td>
                                <a href="{{ route('report.drivers.single', strtolower($racer->abbreviation)) }}">
                                    {{ $racer->abbreviation }}
                                </a>
                            </td>
                            <td>{{ $racer->fullName }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
