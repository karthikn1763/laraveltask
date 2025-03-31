@extends('layout.app')

@section('content')
<h2>Dashboard</h2>
<a href="{{ url('/form/create') }}" class="btn">Create New Form</a>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>File</th>
        <th>Actions</th>
    </tr>
    @foreach ($forms as $form)
    <tr>
        <td>{{ $form->name }}</td>
        <td>{{ $form->email }}</td>
        <td>
            @if($form->file_path)
                <a href="{{ asset('storage/'.$form->file_path) }}" target="_blank">View File</a>
            @else
                No File
            @endif
        </td>
        <td>
            <a href="{{ url('/form/edit/'.$form->id) }}" class="btn">Edit</a>
            <form action="{{ url('/form/delete/'.$form->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
