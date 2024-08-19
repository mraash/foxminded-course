@extends ('layouts.default')

@section ('webTitle', 'Report | Monaco 2018 Racing')
@section ('tableTitle', 'Report')

@section ('main')
    <div class="card mb-4">
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Best time</th>
                    </tr>
                </thead>
                <tbody>
                    <style>
                        tr.tr-bordered-top td {
                            border-top: 1.5px solid #999;
                        }
                    </style>

                    @foreach ($report as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}.</td>
                            <td>{{ $item->fullName }}</td>
                            <td>{{ $item->bestTime }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
