@section('title', 'Parents - Medusa Vaccination System')

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
                <h1 class="dashboard-title">Manage Parents</h1>
                <p class="dashboard-subtitle">View and manage all registered parent accounts</p>
            </div>
            <button class="btns btn-secondary" onclick="modal(null, 'admin-parent-add')"><span
                    class="material-icons">add_box</span> Parent</button>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.parents') }}" method="GET" style="display: flex; gap: 10px;">
                                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.parents') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Parent Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Registered On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parents as $index => $parent)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $parent->name }}</td>
                            <td>{{ $parent->email }}</td>
                            <td>{{ $parent->phone }}</td>
                            <td>{{ $parent->address }}</td>
                            <td>{{ $parent->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btns btn-secondary"
                                    onclick="modal({{ $parent }}, 'admin-parent-edit')">
                                    <span class="material-icons">create</span>
                                </button>
                                <button class="btns btn-danger"
                                    onclick="modal({{ $parent }}, 'admin-parent-delete')"><span
                                        class="material-icons">delete</span></button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No parent accounts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </table>
        </div>
        @include('partials.modal.index')
    @endsection
