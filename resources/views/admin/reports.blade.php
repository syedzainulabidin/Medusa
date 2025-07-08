@section('title', 'Reports - Medusa Vaccination System')

@extends('admin.partials.main')
@section('content')
    <div class="dashboard-container">
        <div class="header">
            <div class="headings">
                <h1 class="dashboard-title">All Reports</h1>
                <p class="dashboard-subtitle">Automatically generated Reports of Vaccinated Children.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.reports') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.reports') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Child</th>
                        <th>Date of Birth</th>
                        <th>Parent</th>

                        <th>Hospital</th>
                        <th>Vaccine</th>

                        <th>Vaccination Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->child->name }}</td>
                            <td>{{ $report->child->dob }}</td>
                            <td>{{ $report->parent->name }}</td>
                            <td>{{ $report->hospital->name }}</td>
                            <td>{{ $report->vaccine }}</td>
                            <td>{{ $report->date }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.report.show', $report->id) }}">
                                    @csrf
                                    <button class="btns status-available" type="submit"> <span
                                            class="material-icons">visibility</span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.report.download', $report->id) }}">
                                    @csrf
                                    <button class="btns btn-secondary" type="submit"> <span
                                            class="material-icons">download</span>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Reports available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
