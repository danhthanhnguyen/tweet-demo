<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reset password</title>
</head>
<body>
    <a href="{{ route('password.reset', ['token' => $token]) }}">Click to reset password</a>
</body>
</html>