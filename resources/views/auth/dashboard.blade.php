<form action="/form" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="file" name="file">
    <button type="submit">Submit</button>
</form>

@foreach ($forms as $form)
    <p>{{ $form->name }} - {{ $form->email }}</p>
    <form action="/form/{{ $form->id }}" method="POST">
        @csrf @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endforeach
