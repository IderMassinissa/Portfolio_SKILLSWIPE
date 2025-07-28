
<body>
        <h1>Reset your password</h1>
        <form action="/reset_password" method = "post" >
                <input type="hidden" name="token" value = "<?$token?>">
                <label for="pass1">New Password:</label>
                <input type="password" id = "pass1" name="pass1">
                <label for="pass2">Re-enter Password:</label>
                <input type="password" id = "pass2" name = "pass2">
                <input type="submit">
        </form>
</body>
</html>