<form action="{{ route('product.store') }}" method="post">
    @csrf
    <div class="mb4">
        <label for="name">name</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="mb4">
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
    </div>
    <div class="mb4">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
    </div>
    <div class="mb4">
        <label for="image">Image</label>
        <input type="file" src="image" alt="image">
    </div>
    <div class="">
        <button type="submit">submit</button>
    </div>
</form>
