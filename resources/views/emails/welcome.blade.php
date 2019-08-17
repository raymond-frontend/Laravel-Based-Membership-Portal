<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user->name}}</h2>
<br/>
Your Membership ID is {{$user->reference_id}}. This is your login credential in addition to your password.
</body>

</html>