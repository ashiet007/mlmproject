<!DOCTYPE html>
<html lang='en-US'>
<head>
</head>
<body>
    <h2>Welcome to Mudrashakti India</h2>
    <div>
        Dear {{$user->name}}, <br>
        <p>Thank you for the registration!</p>
        <p>Following are your login credentials:</p>
        <table>
            <tr>
                <td><strong>Username:</strong></td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td><strong>Password:</strong></td>
                <td>{{$user->userPassword->password}}</td>
            </tr>
        </table>
        <br>
        <p>Thanks!</p>
        <p><a href="{{url('/')}}" class="site-logo">
			<img src="{{asset('images/logoMudra3.png')}}" alt="">
		</a></p>
    </div>
</body>
</html>
