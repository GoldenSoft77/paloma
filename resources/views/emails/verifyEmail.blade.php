<!DOCTYPE html>
<html lang="en">

<body>
	
<p>Hello {{ $user->name }}</p>
<p>Your verification code is: <b> {{$user->email_verification_token}}</b></p>
<p>	If you didn’t request this please contact us immediately.	 
 	</p>
<p>Thanks</p>
</body>

</html> 