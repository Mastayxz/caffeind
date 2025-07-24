<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <a href="{{ route('product.create') }}">add+</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $product->name }}</th>
                    <th>{{ $product->price }}</th>
                    <th>{{ $product->description }}</th>
                    <th><img src="" alt=""></th>
                    <th>
                        <a href="{{ route('product.edit', $product->id) }}">edit</a> | delete
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
