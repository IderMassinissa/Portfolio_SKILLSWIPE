<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./public/css/forms.css">
</head>
<body>
    <h1>Reset your password</h1>
    <form action="/forgot_password" method = "post" >
        <label for="email">Email</label>
        <input type="email" id = "email" name = "email">
        <input type="submit">
    </form>
</body>
</html>