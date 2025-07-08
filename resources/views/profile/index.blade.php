<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('universal/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <link rel="stylesheet" href="{{ asset('partials/toast.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    @if (session('success'))
        <div class="toast animate success">
            <div class="content">{{ session('success') }}</div>
            <span class="material-icons toast-close">clear</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast animate danger">
            <div class="content">
                <ol type='number'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
            <span class="material-icons toast-close">clear</span>
        </div>
    @endif
    <div class="profile-container">
        @php
            $backRoute =
                Auth::user()->role == 'admin'
                    ? route('admin.dashboard')
                    : (Auth::user()->role == 'hospital'
                        ? route('hospital.dashboard')
                        : route('parent.dashboard'));
        @endphp

        <a href="{{ $backRoute }}" class="btns btn-back">
            <span class="material-icons">arrow_back</span>
        </a>
        <div class="form-container">
            <div class="logo-container margin-bottom margin-small">
                <h1>Profile</h1>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    <span>
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label>Email (cannot be changed):</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled>
                    <span>
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label>New Password:</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current">

                    <label>Confirm New Password:</label>
                    <input type="password" name="password_confirmation">
                    <span>
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                    <span>
                        @error('phone')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                        required>
                    <span>
                        @error('address')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <button class="form-submit-btn" type="submit">Update Profile</button>
            </form>
        </div>
    </div>

</body>
<script src="{{ asset('partials/toast.js') }}"></script>

</html>
