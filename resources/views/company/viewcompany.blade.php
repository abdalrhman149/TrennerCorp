@extends('admin.masteradmin')

@section('content3')
<nav class="side-navbar">
    <!-- (sidebar code unchanged) -->
    <div class="nav-header">
        <h2><i class="fas fa-leaf"></i> <span>GreenNav</span></h2>
    </div>
    <div class="nav-menu">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="/storecompany"><i class="fas fa-chart-bar"></i> <span>Add Company</span></a></li>
            <li><a href="/viewcompany" class="active"><i class="fas fa-users"></i> <span>All Users</span></a></li>
        </ul>
    </div>

    <div class="nav-footer">
        <div class="user-profile">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                 alt="User" class="rounded-circle" width="40">
            <div class="user-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </form>
    </div>
</nav>

<div class="container my-5">
    <h2 class="mb-4">All Users / Companies</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('viewcompany') }}" class="mb-3 d-flex">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search by name or email">
        <button type="submit" class="btn btn-success">Search</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success">
                <tr>
                    <th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Image</th><th>Description</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($alluser as $index => $item)
                <tr>
                    <td>{{ $alluser->firstItem() + $index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ ucfirst($item->role) }}</td>

                    {{-- prepare correct image URL (supports both 'uploads/...' public and storage/) --}}
                    @php
                        $imgUrl = null;
                        if ($item->imagepath) {
                            $imgPath = $item->imagepath;
                            if (\Illuminate\Support\Str::startsWith($imgPath, 'uploads/')) {
                                $imgUrl = asset($imgPath); // public/uploads/...
                            } else {
                                $imgUrl = asset('storage/' . ltrim($imgPath, '/')); // storage/...
                            }
                        }
                    @endphp

                    <td>
                        @if ($imgUrl)
                            <img src="{{ $imgUrl }}"
                                 alt="logo"
                                 width="48"
                                 class="rounded-circle"
                                 style="cursor:pointer"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imgModal{{ $item->id }}">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->description)
                            <span role="button" class="text-primary text-decoration-underline"
                                  data-bs-toggle="modal" data-bs-target="#descModal{{ $item->id }}">
                                {{ \Illuminate\Support\Str::limit($item->description, 20, '...') }}
                            </span>
                        @else
                            ---
                        @endif
                    </td>

                    <td>
                        {{-- Edit button --}}
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        {{-- Delete --}}
                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No users found</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $alluser->links() }}
</div>

{{-- MODALS: description, image, edit - placed AFTER the table --}}
@foreach($alluser as $item)
    {{-- Description modal --}}
    @if($item->description)
        <div class="modal fade" id="descModal{{ $item->id }}" tabindex="-1" aria-labelledby="descModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Full Description - {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="white-space: pre-line;">{{ $item->description }}</div>
                    <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>
    @endif

    {{-- Image modal --}}
    @if($item->imagepath)
        @php
            $imgPath = $item->imagepath;
            $imgUrl = \Illuminate\Support\Str::startsWith($imgPath, 'uploads/') ? asset($imgPath) : asset('storage/' . ltrim($imgPath, '/'));
        @endphp
        <div class="modal fade" id="imgModal{{ $item->id }}" tabindex="-1" aria-labelledby="imgModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Image - {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ $imgUrl }}" alt="full-image" class="img-fluid rounded">
                    </div>
                    <div class="modal-footer">
                        {{-- optional download button --}}
                        <a href="{{ $imgUrl }}" download class="btn btn-primary">Download</a>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit modal (same as before, simplified) --}}
    <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User: {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $item->email) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone', $item->phone) }}" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user" {{ $item->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="company" {{ $item->role == 'company' ? 'selected' : '' }}>Company</option>
                                <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Change Image (optional)</label><input type="file" name="imagepath" class="form-control"></div>
                        <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea></div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="submit" class="btn btn-success">Save changes</button></div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
