<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="{{ route('store') }}" method="POST">
        @csrf
        <input type="text"  name="name" placeholder="Name">
        <input type="text"  name="phone" placeholder="Phone">
        <input type="email"  name="email" placeholder="Email">
        <input type="number"  name="role" placeholder="Role">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
