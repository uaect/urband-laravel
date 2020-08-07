<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome</h2>
<br/>
Welcome {{$user->name}} to Urband Music
<br/>
Email: {{$user->email}}<br/>
Password: {{$user->password}}
</body>

</html>
