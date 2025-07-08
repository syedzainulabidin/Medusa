@section('title', 'Bookings - Medusa Vaccination System')
@extends('parent.partials.main')
@section('content')
    <div class="dashboard-container">

        <div class="header">
            <div class="headings">
                <h1 class="dashboard-title">Manage Children</h1>
                <p class="dashboard-subtitle">View and manage all children.</p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('booking.index') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search your children"
                                    value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('booking.index') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Vaccine</th>
                        <th>Hospital</th>
                        <th>Booking on</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $book)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $book->child->name }}</td>
                            <td>{{ $book->child->dob }}</td>
                            <td>{{ $book->child->gender }}</td>
                            <td>{{ $book->vaccine }}</td>
                            <td>{{ $book->hospital?->name ?? 'Pending' }}</td>
                            <td>{{ $book->created_at }}</td>
                            <td>
                                <span
                                    class=@if ($book->status == 'pending') "btns btn-danger status-pending"

                                @else
                                @if ($book->status == 'rejected')
                                    "btns btn-danger"
                                @else
                                "btns btn-danger status-approved" @endif
                                    @endif">{{ $book->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </table>
        </div>
    @endsection
