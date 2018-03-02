
{{ content() }}

<div class="page-header">
    <h2>Register for OPENPOC PM</h2>
</div>

{{ form('register', 'id': 'registerForm', 'onbeforesubmit': 'return false', 'class' : 'ui form') }}

    <div id="name_div" class="required field">
        {{ form.label('name') }}
        {{ form.render('name') }}
        <div class="ui basic red pointing prompt label transition hidden" id="name_alert">Please enter your full name</div>
    </div>
    <div id="username_div" class="required field">
        {{ form.label('username') }}
        {{ form.render('username') }}
        <div class="ui basic red pointing prompt label transition hidden" id="username_alert">Please enter your desired user name</div>
    </div>
    <div id="email_div" class="required field">
        {{ form.label('email') }}
        {{ form.render('email') }}
        <div class="ui basic red pointing prompt label transition hidden" id="email_alert">Please enter your email</div>
    </div>
    <div id="password_div" class="required field">
        {{ form.label('password') }}
        {{ form.render('password') }}
        <div class="ui basic red pointing prompt label transition hidden" id="password_alert">Please provide a valid password</div>
    </div>
    <div id="repeatPassword_div" class="required field">
        <label for="repeatPassword">Repeat Password</label>
        {{ password_field('repeatPassword') }}
        <div class="ui basic red pointing prompt label transition hidden" id="repeatPassword_alert">The password does not match</div>
    </div>

    {{ submit_button('Register', 'class': 'ui primary submit button', 'onclick': 'return SignUp.validate();') }}
    <p class="help-block">By signing up, you accept terms of use and privacy policy.</p>

</form>
