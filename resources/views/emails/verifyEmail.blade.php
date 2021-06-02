<!DOCTYPE html>
<html lang="en">

<body>
    <div class="email-template-container" style="max-width: 600px;margin: 0 auto;">

        <div class="email-body" style="background-color: #454d55!important;color: #fff;font-size:15px;">
            <div class="body-container"
                style="margin: 30px 30px 0px 30px;padding: 20px 0 40px 0;background-color: #454d55;">
                <img src="{{ \Illuminate\Support\Facades\URL::to('/') }}/images/logo.jpg"
                    style="margin: 0 auto 50px auto;width: 240px;display: block;">
                <hr>
                <p>Hello {{ $user->name }}</p>
                <p>Your verification code is: <b> {{$user->email_verification_token}}</b></p>
                <p> If you didn’t request this please contact us immediately.
                </p>
                <p>Thanks</p>
                <p>Paloma Team</p>
            </div>
        </div>
    </div>
</body>

</html>