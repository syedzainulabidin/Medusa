@section('title', 'Bookings - Medusa Vaccination System')
@extends('hospital.partials.main')
@section('content')
    @if (session('success'))
        <div class="toast animate success">
            <div class="content">{{ session('success') }}</div>
            <span class="material-icons toast-close">clear</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast animate danger">
            <div class="content">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <span class="material-icons toast-close">clear</span>
        </div>
    @endif
    <div class="dashboard-container">
        <div class="header">
            <div class="headings">
                <h1 class="dashboard-title">Assigned Bookings</h1>
                <p class="dashboard-subtitle">Manage all Children Vaccination Appointments.</p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('hospital.bookings') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search bookings"
                                    value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('hospital.bookings') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>


                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Child Name</th>
                        <th>Parent Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Vaccine</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $booking->child->name }}</td>
                        <td>{{ $booking->parent->name }}</td>
                        <td>{{ $booking->child->gender }}</td>
                        <td>{{ $booking->child->dob }}</td>
                        <td>{{ $booking->vaccine }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>
                        <td>
                            <form method="POST"
                                action="{{ route('hospital.booking.assign', [$booking->id, 'completed']) }}">
                                @csrf @method('PUT')
                                <button type="submit" class="btns status-available" title="Mark as completed">
                                    <span class="material-icons">done</span>
                                </button>
                            </form>

                            <form method="POST"
                                action="{{ route('hospital.booking.assign', [$booking->id, 'rejected']) }}">
                                @csrf @method('PUT')
                                <button type="submit" class="btns btn-danger" title="Reject booking">
                                    <span class="material-icons">close</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            No Bookings
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection
