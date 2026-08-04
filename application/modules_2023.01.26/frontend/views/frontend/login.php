<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php');?>
    
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="766322749137-4vifcva65njviaagh376blv1d04ffqfk.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">
        
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="login">
                            <h2>Login</h2>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="registered">
                                        <h5>Registered Customer</h5>
                                        <h6>Log in to check out faster and <br>track your orders in My Account.</h6>

                                        <div class="row">
                                            <!-- Login Facebook -->
                                            <div class="col-12 col-md-6 pad_so_r">
                                                <script>
                                                    var token = "";
                                                    var userId = "";

                                                    window.fbAsyncInit = function(){
                                                        FB.init({
                                                            // ใส่่ App ID
                                                            appId: '709071086967463',
                                                            status: false,
                                                            cookie: false,
                                                            xfbml: true
                                                        });
                                                        FB.Event.subscribe('auth.authResponseChange',function(response){
                                                            console.log(response);
                                                            //Logout-unauthen
                                                            if(response.authResponse == null | response.status == "unknow"){
                                                                return;
                                                            }
                                                            token = response.authResponse.accessToken;
                                                            userId = response.authResponse.userID;
                                                            if(response.status === 'connected'){

                                                            }else if(response.status === 'not_authorized'){
                                                                FB.login(function() { scope: 'pubile_actions'});
                                                            }else{
                                                                FB.login(function() { scope: 'pubile_actions'});
                                                            }
                                                        });
                                                    };
                                                    // Load the SDK asynchronously
                                                    (function(d){
                                                        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                                                        if(d.getElementById(id)){
                                                            //console.log(7);
                                                            return;
                                                        }
                                                        js = d.createElement('script');
                                                        js.id = id; js.async = true;
                                                        js.src = "https://connect.facebook.net/en_US/all.js";
                                                        ref.parentNode.insertBefore(js, ref);
                                                    }(document));

                                                    var loginProfile = {};
                                                    
                                                    // เรียกใช้ function fbLogin ตรงคลิกลิงก์
                                                    function fbLogin(){
                                                        FB.login(function(response){
                                                            if(response.authResponse){
                                                                access_token = response.authResponse.accessToken;
                                                                user_id = response.authResponse.user_ID;
                                                                //FB.api('/me', { locale: 'en_US', fields: 'name, email, gender,locale,picture' },
                                                                FB.api('/me', { locale: 'en_US', fields: 'name, gender,locale,picture' },
                                                                    function(response){
                                                                    console.log('EMAIL : '+response.email);
                                                                    console.log(response);
                                                                    var id      = response.id;
                                                                    var name    = response.name;
                                                                    //var email   = response.email;
                                                                    var gender  = response.gender;
                                                                    var locale  = response.locale;
                                                                    var picture = response.picture['data']['url'];
                                                                    
                                                                    // ใช้เป็น ajax
                                                                    $.ajaxSetup({
                                                                        async: true
                                                                    });
                                                                    
                                                                    $.ajax('<?php echo site_url("frontend/path/ajaxLoginFacebook");?>', {
                                                                        type: 'POST',
                                                                        data: {
                                                                            'id' : id,
                                                                            'member_name' : name,
                                                                            //'member_email' : email,
                                                                            'gender' : gender,
                                                                            'locale' : locale,
                                                                            'picture' : picture
                                                                        },
                                                                        dataType: 'html',
                                                                        success: function(data) {
                                                                            //location.reload();
                                                                            window.location.href = '<?php echo site_url();?>';
                                                                        }
                                                                    });
                                                                    // End ใช้เป็น ajax
                                                                });
                                                            }else{

                                                            }
                                                        },{
                                                            scope: 'public_profile, email'
                                                        }); 
                                                    }
                                                </script>
                                                <div style="padding: 100" align="center">
                                                    <button type="button" class="button_social facebook" onclick="fbLogin();"><i class="fa fa-facebook" aria-hidden="true"></i> Connect</button>
                                                </div>
                                            </div>
                                            <!-- End Login Facebook -->
                                            <!-- Login Google -->
<?php
// Google Project API Credentials
$clientId = '766322749137-4vifcva65njviaagh376blv1d04ffqfk.apps.googleusercontent.com';
$clientSecret = 'YQgFtTmBcGVYBDh0qgr-vm2f';
$redirectUrl = site_url('frontend/path/callback_google');

//Include Google Client Library for PHP autoload file
require_once FCPATH.'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId($clientId);

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret($clientSecret);

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri($redirectUrl);

//
$google_client->addScope('email');
$google_client->addScope('profile');
?>
                                            <div class="col-12 col-md-6 pad_so_l">
                                                <a href="<?php echo $google_client->createAuthUrl();?>"><button type="button" class="button_social mail"><i class="fa fa-envelope" aria-hidden="true"></i> Connect</button></a>
                                            </div>
                                            <!-- End Login Google -->
                                        </div>

                                        <input type="text" class="form-login" placeholder="User Name" name="member_email" id="member_email">
                                        <input type="password" class="form-login" placeholder="Password" name="member_password" id="member_password">
                                        <p><a href="javascript:forgotPassword();">Help! I forgot my password</a></p>
                                        <button type="button" class="button_login" onclick="login();">Login</button>
                                        <p>Not a member yet?  <span><a href="<?php echo site_url('frontend/path/register');?>">Register now!</a></span></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <!-- ตู่บอกว่าให้ปิดไว้ก่อน
                                    <div class="registered" style="border: none;">
                                        <h5>Not a member</h5>
                                        <h6>Enter your e-mail address to continue with your purchase. of you wish, you can create an account later.</h6>
                                        <input type="email" class="form-login" placeholder="Email">
                                        <button type="button" class="button_login">Next</button>
                                    </div>
                                    End ตู่บอกว่าให้ปิดไว้ก่อน -->
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            
        
    <?php require('inc_footer.php'); ?>
    </div>
    <script>
        function forgotPassword() {
            if($("#member_email").val() == '') {
                alert('Please enter Email');

                $("#member_email").focus();
            } else if(!isEmail($("#member_email").val())) {
                alert('Invalid Email');

                $("#member_email").focus();

                $("#member_email").val('');
            } else {
                $.post('<?php echo site_url("frontend/path/ajaxForgotPassword");?>', { member_email: $("#member_email").val() }, function(data) {
                    alert(data);
                });
            }
        }

        function login() {
            if($("#member_email").val() == '') {
                alert('Please enter Email');

                $("#member_email").focus();
            } else if(!isEmail($("#member_email").val())) {
                alert('Please enter Email');

                $("#member_email").focus();

                $("#member_email").val('');
            } else if($("#member_password").val() == '') {
                alert('Please enter Password');

                $("#member_password").focus();
            } else {
                $.post('<?php echo site_url("frontend/path/ajaxLogin");?>', { member_email: $("#member_email").val(), member_password: $("#member_password").val() }, function(data) {
                    if(data == true) {
                        window.location.href = '<?php echo site_frontend('member1.php');?>';
                    } else {
                        alert(data);

                        $("#member_email").val('');
                        $("#member_password").val('');
                    }
                });
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        /*function onSignIn(googleUser) {
            
            // ขอมูลของผู้ใช้งานที่ล็อกอิน ที่เราสามารถนำไปใช้งานได้ 
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // google แนะนำว่าไม่ควรส่งคานี้ไปเก็บไว้บน server 
            // ค่า ID นี้เราสามรรถประยุกต์เพิ่มเติมตามต้องการ เช่นอาจจะเข้ารหัสก่อนบันทึกหรืออะไรก็ได้
            // แต่ในที่นี้จะใช้วิธีอยางง่่ายเพื่อเป็นแนวทาง
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());
    
            // google แนะนำให้ใช้ ID token สำหรับใช้ในการตรวจสอบการล็อกอิน
            var id_token = googleUser.getAuthResponse().id_token;
            console.log("ID Token: " + id_token);

            $.post('<?php echo site_url("frontend/path/ajaxLoginGoogle");?>', { member_first_name: profile.getGivenName(), member_last_name: profile.getFamilyName(), member_email: profile.getEmail() }, function(data) {
                window.location.href = '<?php echo site_url();?>';
            });
        };*/

    </script>
</body>

</html>