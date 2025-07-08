@section('title','Dashboard - Medusa Vaccination System')
@extends('hospital.partials.main')
@section('content')
    <div class="dashboard-container">
        <div class="header main">
            <div class="headings">
                <h1 class="dashboard-title">Welcome, {{ Auth::user()->name }} <small>({{ Auth::user()->role }})</small> </h1>

                <p class="dashboard-subtitle">
                    Here’s a quick summary of your assigned children and reports.
                </p>
            </div>
        </div>

        <div class="dashboard-cards container features">
            <div class="tag">
                <div class="{{ $bookingCount !== 0 ? 'notification' : '' }}"></div>

                <h1><span>{{ $bookingCount === 0 ? 'No' : $bookingCount }}</span> @choice('Booking|Bookings', $bookingCount)</h1>

                <p>All Assigned Bookings for you.</p>
                <div class="call-to-action">
                    <a href="{{ route('hospital.bookings') }}" class="action-btn"><i
                            class="material-icons">north_east</i></a>
                </div>
            </div>

            <div class="tag">
                <h1><span>{{ $reportCount === 0 ? 'No' : $reportCount }}</span> @choice('report|reports', $reportCount)</h1>
                <p>Reports of Vaccinated Children from this hospital.
                </p>
                <div class="call-to-action">
                    <a href="{{ route('hospital.reports') }}" class="action-btn"><i
                            class="material-icons">north_east</i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
