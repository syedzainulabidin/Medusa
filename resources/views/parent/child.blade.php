@section('title', 'Children - Medusa Vaccination System')
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
                <h1 class="dashboard-title">Manage Children</h1>
                <p class="dashboard-subtitle">View and manage all children.</p>
            </div>
            <button class="btns btn-secondary" onclick="modal({{ Auth::user()->id }}, 'parent-child-add')"><span
                    class="material-icons">add_box</span> Child</button>
        </div>
        <div class="table-responsive">


            <table class="table">
                <thead>
                    <tr>
                        <td colspan="7">
                            <form action="{{ route('child.index') }}" method="GET"
                                style="display: flex; gap: 10px; margin-bottom: 15px;">
                                <input type="text" name="search" placeholder="Search your children"
                                    value="{{ request('search') }}">

                                <button type="submit" class="btns btn-secondary">Filter</button>

                                @if (request('search'))
                                    <button type="button" class="btns btn-danger"
                                        onclick="window.location.href='{{ route('child.index') }}'">
                                        Clear
                                    </button>
                                @endif
                            </form>

                        </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DOB</th>
                        <th>GENDER</th>
                        <th colspan="2">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($children as $child)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ $child->dob }}</td>
                            <td>{{ $child->gender }}</td>
                            <td>
                                <button class="btns btn-secondary"
                                    onclick="modal({{ $child }}, 'parent-child-edit')">
                                    <span class="material-icons">create</span>
                                </button>
                                <button class="btns btn-danger"
                                    onclick="modal({{ $child }}, 'parent-child-delete')"><span
                                        class="material-icons">delete</span></button>
                            </td>
                        </tr>
                    @empty
                        <p>No record found</p>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    @include('partials.modal.index')
@endsection
