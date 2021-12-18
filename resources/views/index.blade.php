<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>
<body>
    <table border="1">
    <thead>
        <tr>Supplier</tr>
        <tr>product</tr>
    </thead>
    <tbody>
    @foreach($suppliers as $supplier)
    @foreach($supplier->products as $product)
<tr>
<td>{{$supplier->name}}</td>
<td>{{$product->name}}</td>
</tr>
@endforeach
@endforeach
</tbody>
    </table>
</body>
</html>