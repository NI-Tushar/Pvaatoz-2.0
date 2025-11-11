@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Users')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bolder">Manage Users</h5>
                @canAny(['isAdmin'])
                    <a href="{{ route('admin.user.create') }}" class="btn btn-md btn-outline-success"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
                @endcanAny
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead class="text-gray">
                    <tr>
                      <th style="width: 20px">Sl</th>
                      <th>Image</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Role</th>
                      <th>Last Login</th>
                      @canAny(['isAdmin'])
                        <th style="width: 100px">Action</th>
                      @endcanAny
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <img style="height: 50px;width:50px;object-fit:contain;border-radius:100%;border:1px solid #ddd" src="{{ asset($user->image ? $user->image : 'avatar.png') }}" alt="Image">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'Number not found' }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Never logged in' }}
                        </td>
                        @canAny(['isAdmin'])
                        <td>
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="d-inline-block" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-outline-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        @endcanAny
                    </tr>
                    @empty
                        <span>Data Not Found</span>
                    @endforelse
                  </tbody>
                </table>
              </div>
        </div>
    </div>
@endsection


