@extends('layout.v_template')
@section('title','Disposisi')
@section('bawah','Kelola Disposisi Surat Masuk dan Nota Dinas')
@section('content')

<a href="{{ route('admin.users.create') }}" class="btn btn-success">Tambah User</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->nama_lengkap }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ ucfirst($u->role) }}</td>
            <td>{{ ucfirst($u->status) }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus user ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
