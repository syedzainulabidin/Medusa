@section('title', 'Vaccines - Medusa Vaccination System')

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
                <h1 class="dashboard-title">Manage Vaccines</h1>
                <p class="dashboard-subtitle">Add, remove, or update vaccines status from the system</p>
            </div>
            <button class="btns btn-secondary" onclick="modal(null, 'admin-vaccine-add')"><span
                    class="material-icons">add_box</span> Vaccine</button>
        </div>
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('admin.vaccines') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('admin.vaccines') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Vaccine Name</th>
                        <th>Status</th>
                        <th>Toggle</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vaccines as $index => $vaccine)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vaccine->name }}</td>
                            <td>
                                <span class="status status-{{ $vaccine->available ? 'available' : 'unavailable' }}">
                                    {{ $vaccine->available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('vaccines.toggle', $vaccine->id) }}" method="POST">
                                    @csrf
                                    <label class="switch">
                                        <input type="checkbox" {{ $vaccine->available ? 'checked' : '' }}
                                            onclick="this.form.submit()">
                                        <span class="slider"></span>
                                    </label>
                                </form>
                            </td>
                            <td>
                                <button class="btns btn-danger"
                                    onclick="modal({{ $vaccine }}, 'admin-vaccine-delete')"><span
                                        class="material-icons">delete</span></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No vaccines added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('partials.modal.index')
@endsection
