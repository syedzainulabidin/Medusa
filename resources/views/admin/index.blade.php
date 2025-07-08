@section('title', 'Dashboard - Medusa Vaccination System')
@extends('admin.partials.main')
@section('content')
    <div class="dashboard-container">
        <div class="header main">
            <div class="headings">
                <h1 class="dashboard-title">Welcome, {{ Auth::user()->name }} <small>({{ Auth::user()->role }})</small> </h1>
                <p class="dashboard-subtitle">
                    Here’s an overview of system-wide statistics.

                </p>
            </div>
        </div>
        <div class="dashboard-cards features">
            <div class="tag tag-card">
                <div class="{{ $requests !== 0 ? 'notification' : '' }}"></div>

                <h1>
                    <span>{{ $requests === 0 ? 'No' : $requests }}</span> @choice('Request|Requests', $requests)
                </h1>
                <p>Review Requests made by Parents & Hospitals. Approve or Reject accordingly.</p>
                <div class="call-to-action">
                    <a href="{{ route('admin.requests') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
            <div class="tag tag-card">
                <h1>
                    <span>{{ $childrenCount === 0 ? 'No' : $childrenCount }}</span> @choice('Child|Children', $childrenCount)
                </h1>
                <p>View Registered Children in the system & Edit or Delete.</p>
                <div class="call-to-action">
                    <a href="{{ route('admin.children') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
            <div class="tag tag-card">
                <h1><span>{{ $bookingCount === 0 ? 'No' : $bookingCount }}</span> @choice('Booking|Bookings', $bookingCount)</h1>
                <p>Total Bookings made by Parents for Children.
                </p>
                <div class="call-to-action">
                    <a href="{{ route('admin.bookings') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
            <div class="tag tag-card">
                <div class="{{ $pendingBookings !== 0 ? 'notification' : '' }}"></div>
                <h1><span>{{ $pendingBookings === 0 ? 'No' : $pendingBookings }}</span> @choice('Pending Booking|Pending Bookings', $pendingBookings)</h1>
                <p>Pending Bookings made by Parents, review them & allow by assigning a hospital.
                </p>
                <div class="call-to-action">
                    <a href="{{ route('admin.bookings') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
            <div class="tag tag-card">
                <h1><span>{{ $vaccinesCount === 0 ? 'No' : $vaccinesCount }}</span> @choice('Vaccine|Vaccines', $vaccinesCount)</h1>
                <p>Available Vaccines registered in the system ready when needed.</p>
                <div class="call-to-action">
                    <a href="{{ route('admin.vaccines') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
            <div class="tag tag-card">
                <h1><span>{{ $reportsCount === 0 ? 'No' : $reportsCount }}</span> @choice('Report|Reports', $reportsCount)</h1>

                <p>Automatically generated Reports of Vaccinated Children.</p>
                <div class="call-to-action">
                    <a href="{{ route('admin.reports') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
