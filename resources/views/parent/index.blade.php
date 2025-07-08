@section('title','Dashboard - Medusa Vaccination System')
@extends('parent.partials.main')
    @section('content')
        <div class="dashboard-container">
            <div class="header main">
                <div class="headings">
                <h1 class="dashboard-title">Welcome, {{ Auth::user()->name }} <small>({{ Auth::user()->role }})</small> </h1>

                    <p class="dashboard-subtitle">
                        Here’s an overview of your account.
                    </p>
                </div>
            </div>
            <div class="dashboard-cards features">
                <div class="tag">
                    <h1>
                        <span>{{ $children->count() === 0 ? 'No' : $children->count() }}</span> @choice('Child|Children', $children->count())
                    </h1>
                    <p>Add, remove or update {{ Str::plural('child', $children->count()) }} status.</p>
                    <div class="call-to-action">
                        <a href="{{ route('child.index') }}" class="action-btn"><i class="material-icons">north_east</i></a>
                    </div>
                </div>
                <div class="tag">
                    <h1><span>{{ $totalBookings === 0 ? 'No' : $totalBookings }}</span> @choice('Booking|Bookings', $totalBookings)</h1>
                    <p>Review Hospitals and Vaccines to Book an appointment for you child.</p>
                    <div class="call-to-action">
                        <a href="{{ route('booking.index') }}" class="action-btn"><i
                                class="material-icons">north_east</i></a>
                    </div>
                </div>
                <div class="tag">
                    <div class="{{ $upcomingBookings->count() !== 0 ? 'notification' : '' }}"></div>

                    <h1><span>{{ $upcomingBookings->count() === 0 ? 'No' : $upcomingBookings->count() }}</span>
                        @choice('Upcoming Booking|Upcoming Bookings', $upcomingBookings->count())</h1>
                    @foreach ($upcomingBookings as $upcomingBooking)
                        <p class="btns btn-danger">{{ $upcomingBooking->date }}</p>
                    @endforeach
                    <div class="call-to-action">
                        <a href="{{ route('booking.index') }}" class="action-btn"><i
                                class="material-icons">north_east</i></a>
                    </div>
                </div>
                <div class="tag">
                    <h1><span> {{ $latestReport->count() }}</span>
                        @choice('Report|Reports', $latestReport->count())</h1>
                    <p>Vaccination Reports generated for you children.</p>
                    <div class="call-to-action">
                        <a href="{{ route('reports.parent') }}" class="action-btn"><i
                                class="material-icons">north_east</i></a>
                    </div>
                </div>

            </div>
        </div>
    @endsection
