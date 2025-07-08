@section('title', 'Registration Requests - Medusa Vaccination System')

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
                <h1 class="dashboard-title">Pending Registration</h1>
                <p class="dashboard-subtitle">Approve or Reject Parents and Hospital's registration request</p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.requests') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search pending users"
                                    value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.requests') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>


                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendings as $pending)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $pending->name }}</td>
                            <td>{{ $pending->email }}</td>
                            <td>{{ $pending->phone }}</td>
                            <td>{{ $pending->address }}</td>
                            <td>{{ $pending->role }}</td>
                            <td>
                                <form method="POST"
                                    action="{{ route('admin.updateStatus', ['id' => $pending->id, 'status' => 'approved']) }}">
                                    @csrf
                                    <button class="btns status-available" type="submit"> <span
                                            class="material-icons">done</span>
                                    </button>
                                </form>
                                <form method="POST"
                                    action="{{ route('admin.updateStatus', ['id' => $pending->id, 'status' => 'rejected']) }}">
                                    @csrf
                                    <button class="btns btn-danger" type="submit"> <span
                                            class="material-icons">clear</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No Pending Registrations</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </table>
        </div>
    @endsection
