@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-primary">Edit Form</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('form.update', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $form->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $form->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="file" class="form-control">
            @if($form->file_path)
                <p>Current File: <a href="{{ asset('storage/' . $form->file_path) }}" target="_blank">View</a></p>
            @endif
        </div>

        <h4 class="mt-4">Form Items</h4>
        <div id="items-container">
            @foreach($form->items as $index => $item)
            <div class="item-group mb-2">
                <input type="text" name="items[{{ $index }}][name]" value="{{ $item['item_name'] }}" class="form-control d-inline w-25" placeholder="Item Name" required>
                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}" class="form-control d-inline w-25" placeholder="Quantity" required>
                <input type="number" name="items[{{ $index }}][price]" value="{{ $item['price'] }}" class="form-control d-inline w-25" placeholder="Price" required>
                <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mt-2" id="add-item">+ Add More</button>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<style>
    .item-group {
        display: flex;
        gap: 10px;
    }
    .remove-item {
        height: 38px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemIndex = {{ count($form->items) }};
        
        document.getElementById('add-item').addEventListener('click', function () {
            let container = document.getElementById('items-container');
            let newItem = `
                <div class="item-group mb-2">
                    <input type="text" name="items[\${itemIndex}][name]" class="form-control d-inline w-25" placeholder="Item Name" required>
                    <input type="number" name="items[\${itemIndex}][quantity]" class="form-control d-inline w-25" placeholder="Quantity" required>
                    <input type="number" name="items[\${itemIndex}][price]" class="form-control d-inline w-25" placeholder="Price" required>
                    <button type="button" class="btn btn-danger btn-sm remove-item">X</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', newItem);
            itemIndex++;
        });

        document.getElementById('items-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>

@endsection
