@section('title', 'Book Hospital')
@extends('parent.partials.main')
@section('content')
    <div class="dashboard-container">
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
        <div class="header">
            <div class="headings">
                <h1 class="dashboard-title">Book a Vaccination Slot</h1>
            </div>
        </div>

        @if ($children->isEmpty())
            <p>You must register at least one child before booking.</p>
            <a href="{{ route('child.index') }}">Add Child</a>
        @else
            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                <label for="child_id">Select Child</label>
                <select name="child_id" id="child_id" required>
                    <option value="">-- Choose a Child --</option>
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                    @endforeach
                </select>
                <label for="vaccine">Vaccine</label>
                <select name="vaccine" required>
                    <option value="">-- Select Vaccine --</option>
                    @foreach ($vaccines as $vaccine)
                        <option value="{{ $vaccine->name }}">{{ $vaccine->name }}</option>
                    @endforeach
                </select>


                <label for="hospital_id">Select Hospital</label>
                <select name="hospital_id" id="hospital_id" required>
                    <option value="">-- Choose a Hospital --</option>
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                    @endforeach
                </select>

                <label for="date">Preferred Date</label>
                <input type="date" name="date" id="date" min="{{ date('Y-m-d') }}" required>

                <button type="submit" class="btns btn-secondary">Submit Booking</button>
            </form>
    </div>
    @endif
@endsection
