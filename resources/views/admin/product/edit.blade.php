<form action="{{ route('product.update', $product->id) }}" method="post">
    @csrf
    <div class="mb4">
        <label for="">name</label>
        <input type="text" name="" id="" value="old()">
    </div>
    <div class="mb4">
        <label for="">Price</label>
        <input type="text" name="" id="">
    </div>
    <div class="mb4">
        <label for="">Description</label>
        <input type="text" name="" id="">
    </div>
    <div class="mb4">
        <label for="">Image</label>
        <input type="file" src="" alt="">
    </div>
</form>
