@section('title', 'Children - Medusa Vaccination System')

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
                <h1 class="dashboard-title">Registered Children</h1>
                <p class="dashboard-subtitle">Manage all children and their associated parents</p>
            </div>
            <button class="btns btn-secondary" onclick="modal({{ $parents }}, 'admin-child-add')"><span
                    class="material-icons">add_box</span> Child</button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.children') }}" method="GET" style="display: flex; gap: 10px;">
                                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.children') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Child Name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Parent</th>
                        <th>Registered On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($children as $index => $child)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ ucfirst($child->gender) }}</td>
                            <td>{{ \Carbon\Carbon::parse($child->dob)->format('M d, Y') }}</td>
                            <td>{{ $child->parent->name ?? 'N/A' }}</td>
                            <td>{{ $child->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btns btn-secondary"
                                    onclick="modal({{ $child }}, 'admin-child-edit')">
                                    <span class="material-icons">create</span>
                                </button>
                                <button class="btns btn-danger"
                                    onclick="modal({{ $child }}, 'admin-child-delete')"><span
                                        class="material-icons">delete</span></button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No children records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('partials.modal.index')
@endsection
