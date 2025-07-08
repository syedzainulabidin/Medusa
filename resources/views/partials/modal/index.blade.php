<div class="modal-container" onclick="modalHide()">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="admin-child-edit component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Edit Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="admin-child-edit-name">Name</label>
                        <input type="text" id="admin-child-edit-name" name="admin-child-edit-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-child-edit-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <p>Gender</p>
                        <span>
                            <input type="radio" name="admin-child-edit-gender" value="male"
                                id="admin-child-edit-male"></span>
                        <label for="admin-child-edit-male"><strong>Male</strong></label>
                        <span>
                            <input type="radio" name="admin-child-edit-gender" value="female"
                                id="admin-child-edit-female"></span>
                        <label for="admin-child-edit-female"><strong>Female</strong></label>
                        <span>
                            <input type="radio" name="admin-child-edit-gender" value="other"
                                id="admin-child-edit-other"></span>
                        <label for="admin-child-edit-other"><strong>Other</strong></label>
                        <span>
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-child-edit-dob">Date of Birth</label>
                        <input type="date" id="admin-child-edit-dob" name="admin-child-edit-dob">
                        <span>
                            @error('admin-child-edit-dob')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit">Update</button>

                </form>
            </div>
        </div>
        <div class="admin-child-delete component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Delete Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="form-submit-btn" type="submit"></button>

                </form>
            </div>
        </div>
        <div class="admin-child-add component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Add Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="admin-child-add-name">Name</label>
                        <input type="text" id="admin-child-add-name" name="admin-child-add-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-child-add-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-child-add-parent">Parent Name</label>
                        <select class="admin-child-add-parent" name="admin-child-add-parent"></select>
                        {{-- <input type="text" id="admin-child-add-parent" name="admin-child-add-parent"
                            placeholder="Enter Name"> --}}
                        <span>
                            @error('admin-child-add-parent')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <p>Gender</p>
                        <span>
                            <input type="radio" name="admin-child-add-gender" value="male"
                                id="admin-child-add-male"></span>
                        <label for="admin-child-add-male"><strong>Male</strong></label>
                        <span>
                            <input type="radio" name="admin-child-add-gender" value="female"
                                id="admin-child-add-female"></span>
                        <label for="admin-child-add-female"><strong>Female</strong></label>
                        <span>
                            <input type="radio" name="admin-child-add-gender" value="other"
                                id="admin-child-add-other"></span>
                        <label for="admin-child-add-other"><strong>Other</strong></label>
                        <span>
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-child-add-dob">Date of Birth</label>
                        <input type="date" id="admin-child-add-dob" name="admin-child-add-dob"
                            max="{{ now()->toDateString() }}">
                        <span>
                            @error('admin-child-add-dob')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit"></button>

                </form>
            </div>
        </div>
        <div class="admin-parent-edit component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Edit Parent</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="admin-parent-edit-name">Name</label>
                        <input type="text" id="admin-parent-edit-name" name="admin-parent-edit-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-parent-edit-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-edit-email">Email</label>
                        <input type="text" id="admin-parent-edit-email" disabled name="admin-parent-edit-email">
                        <span>
                            @error('admin-parent-edit-email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="admin-parent-edit-password">Password</label>
                        <input type="password" id="admin-parent-edit-password" name="admin-parent-edit-password"
                            placeholder="Enter password">
                        <span>
                            @error('admin-parent-edit-password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-edit-password">Password Confirm</label>
                        <input type="password" id="admin-parent-edit-password"
                            name="admin-parent-edit-password_confirmation" placeholder="Leave blank to keep current">
                        <span>
                            @error('admin-parent-edit-password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-edit-phone">Phone</label>
                        <input type="text" id="admin-parent-edit-phone" name="admin-parent-edit-phone">
                        <span>
                            @error('admin-parent-edit-phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-edit-address">Address</label>
                        <input type="text" id="admin-parent-edit-address" name="admin-parent-edit-address">
                        <span>
                            @error('admin-parent-edit-address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <button class="form-submit-btn" type="submit">Update</button>

                </form>
            </div>
        </div>
        <div class="admin-parent-delete component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Delete Parent</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="form-submit-btn" type="submit"></button>

                </form>
            </div>
        </div>
        <div class="admin-parent-add component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Add Parent</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="admin-parent-add-name">Name</label>
                        <input type="text" id="admin-parent-add-name" name="admin-parent-add-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-parent-add-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-add-email">Email</label>
                        <input type="text" id="admin-parent-add-email" name="admin-parent-add-email"
                            placeholder="Enter Email">
                        <span>
                            @error('admin-parent-add-email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-add-password">Password</label>
                        <input type="password" id="admin-parent-add-password" name="admin-parent-add-password"
                            placeholder="Enter password">
                        <span>
                            @error('admin-parent-add-password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-add-phone">Phone</label>
                        <input type="text" id="admin-parent-add-phone" name="admin-parent-add-phone"
                            placeholder="Enter phone">
                        <span>
                            @error('admin-parent-add-phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-parent-add-address">Address</label>
                        <input type="text" id="admin-parent-add-address" name="admin-parent-add-address"
                            placeholder="Enter address">
                        <span>
                            @error('admin-parent-add-address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit"></button>

                </form>
            </div>
        </div>
        <div class="admin-hospital-edit component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Edit hospital</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="admin-hospital-edit-name">Name</label>
                        <input type="text" id="admin-hospital-edit-name" name="admin-hospital-edit-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-hospital-edit-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-edit-email">Email</label>
                        <input type="text" id="admin-hospital-edit-email" disabled
                            name="admin-hospital-edit-email">
                        <span>
                            @error('admin-hospital-edit-email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="admin-hospital-edit-password">Password</label>
                        <input type="password" id="admin-hospital-edit-password" name="admin-hospital-edit-password"
                            placeholder="Enter password">
                        <span>
                            @error('admin-hospital-edit-password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-edit-password">Password Confirm</label>
                        <input type="password" id="admin-hospital-edit-password"
                            name="admin-hospital-edit-password_confirmation"
                            placeholder="Leave blank to keep current">
                        <span>
                            @error('admin-hospital-edit-password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-edit-phone">Phone</label>
                        <input type="text" id="admin-hospital-edit-phone" name="admin-hospital-edit-phone">
                        <span>
                            @error('admin-hospital-edit-phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-edit-address">Address</label>
                        <input type="text" id="admin-hospital-edit-address" name="admin-hospital-edit-address">
                        <span>
                            @error('admin-hospital-edit-address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <button class="form-submit-btn" type="submit">Update</button>

                </form>
            </div>
        </div>
        <div class="admin-hospital-add component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Add Hospital</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="admin-hospital-add-name">Name</label>
                        <input type="text" id="admin-hospital-add-name" name="admin-hospital-add-name"
                            placeholder="Enter Name">
                        <span>
                            @error('admin-hospital-add-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-add-email">Email</label>
                        <input type="text" id="admin-hospital-add-email" name="admin-hospital-add-email"
                            placeholder="Enter Email">
                        <span>
                            @error('admin-hospital-add-email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-add-password">Password</label>
                        <input type="password" id="admin-hospital-add-password" name="admin-hospital-add-password"
                            placeholder="Enter password">
                        <span>
                            @error('admin-hospital-add-password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-add-phone">Phone</label>
                        <input type="text" id="admin-hospital-add-phone" name="admin-hospital-add-phone"
                            placeholder="Enter phone">
                        <span>
                            @error('admin-hospital-add-phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="admin-hospital-add-address">Address</label>
                        <input type="text" id="admin-hospital-add-address" name="admin-hospital-add-address"
                            placeholder="Enter address">
                        <span>
                            @error('admin-hospital-add-address')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit">Add</button>

                </form>
            </div>
        </div>
        <div class="admin-hospital-delete component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Delete Hospital</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="form-submit-btn" type="submit"></button>
                </form>
            </div>
        </div>
        <div class="admin-vaccine-add component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Add Vaccine</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form action="{{ route('vaccines.store') }}" class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="admin-vaccine-add-name">Name</label>
                        <input type="text" id="admin-vaccine-add-name" name="admin-vaccine-add-name"
                            placeholder="Enter Vaccine Name">
                        <span>
                            @error('admin-vaccine-add-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit">Add</button>

                </form>
            </div>
        </div>
        <div class="admin-vaccine-delete component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Delete Vaccine</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="form-submit-btn" type="submit"></button>
                </form>
            </div>
        </div>
        <div class="parent-child-add component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Add Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="parent-child-add-name">Name</label>
                        <input type="text" id="parent-child-add-name" name="parent-child-add-name"
                            placeholder="Enter Name">
                        <span>
                            @error('parent-child-add-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="parent-child-add-dob">Date of Birth</label>
                        <input type="date" id="parent-child-add-dob" name="parent-child-add-dob"
                            max="{{ now()->toDateString() }}">
                        <span>
                            @error('parent-child-add-dob')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <p>Gender</p>
                        <span>
                            <input type="radio" name="parent-child-add-gender" value="male"
                                id="parent-child-add-male"></span>
                        <label for="parent-child-add-male"><strong>Male</strong></label>
                        <span>
                            <input type="radio" name="parent-child-add-gender" value="female"
                                id="parent-child-add-female"></span>
                        <label for="parent-child-add-female"><strong>Female</strong></label>
                        <span>
                            <input type="radio" name="parent-child-add-gender" value="other"
                                id="parent-child-add-other"></span>
                        <label for="parent-child-add-other"><strong>Other</strong></label>
                        <span>
                            @error('parent-child-add-gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button class="form-submit-btn" type="submit">Add</button>

                </form>
            </div>
        </div>
        <div class="parent-child-edit component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Edit Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="parent-child-edit-name">Name</label>
                        <input type="text" id="parent-child-edit-name" name="parent-child-edit-name"
                            placeholder="Enter Name">
                        <span>
                            @error('parent-child-edit-name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <p>Gender</p>
                        <span>
                            <input type="radio" name="parent-child-edit-gender" value="male"
                                id="parent-child-edit-male"></span>
                        <label for="parent-child-edit-male"><strong>Male</strong></label>
                        <span>
                            <input type="radio" name="parent-child-edit-gender" value="female"
                                id="parent-child-edit-female"></span>
                        <label for="parent-child-edit-female"><strong>Female</strong></label>
                        <span>
                            <input type="radio" name="parent-child-edit-gender" value="other"
                                id="parent-child-edit-other"></span>
                        <label for="parent-child-edit-other"><strong>Other</strong></label>
                        <span>
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="parent-child-edit-dob">Date of Birth</label>
                        <input type="date" id="parent-child-edit-dob" name="parent-child-edit-dob"
                            max="{{ now()->toDateString() }}">
                        <span>
                            @error('parent-child-edit-dob')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button class="form-submit-btn" type="submit">Update</button>

                </form>
            </div>
        </div>
        <div class="parent-child-delete component">
            <div class="form-container">
                <div class="header">
                    <h3 class="title">Delete Child</h3>
                    <div class="cross" onclick="modalHide()"><i class="material-icons">cancel</i></div>
                </div>
                <form class="form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="form-submit-btn" type="submit"></button>

                </form>
            </div>
        </div>
    </div>
</div>
