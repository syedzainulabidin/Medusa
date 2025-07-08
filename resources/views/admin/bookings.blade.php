@section('title', 'Bookings - Medusa Vaccination System')

@extends('admin.partials.main')
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
                <h1 class="dashboard-title">All Bookings</h1>
                <p class="dashboard-subtitle">System-wide bookings overview</p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.bookings') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search bookings"
                                    value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.bookings') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Child</th>
                        <th>Parent</th>
                        <th>Hospital</th>
                        <th>Vaccine</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->child->name ?? 'N/A' }}</td>
                            <td>{{ $booking->parent->name ?? 'N/A' }}</td>
                            <form method="POST" action="{{ route('booking.assign', $booking->id) }}">
                                @csrf
                                <td>
                                    <select name="hospital_id" {{ $booking->status !== 'pending' ? 'disabled' : '' }}>
                                        <option selected disabled>Select Hospital</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}"
                                                {{ $booking->hospital_id == $hospital->id ? 'selected' : '' }}>
                                                {{ $hospital->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ $booking->vaccine }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>

                                    <button type="submit" name="status" value="approved"
                                        class="btns status-available {{ $booking->status !== 'pending' ? 'fade' : '' }}"
                                        {{ $booking->status !== 'pending' ? 'disabled' : '' }}>
                                        Approved
                                    </button>

                                    <button type="submit" name="status" value="rejected"
                                        class="btns btn-danger {{ $booking->status !== 'pending' ? 'fade' : '' }}"
                                        {{ $booking->status !== 'pending' ? 'disabled' : '' }}>
                                        Rejected
                                    </button>
                                </td>

                            </form>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No bookings available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
