<?php include_once("part/header.php"); ?>
<?php include_once("part/sql-connection.php"); ?>
<?php include_once('function/token.php') ?>
<style type="text/css">
    .linkbg:hover {
        border-radius: 4px;
        background: #E2E2E2;
    }
</style>
<body>
    <script>
        function check(x){
            var a0 = document.getElementsByName('account')[0];
            var e0 = document.getElementsByName('email')[0];
            var p0 = document.getElementsByName('password')[0];
            var p1 = document.getElementsByName('password-confirm')[0];
            var i0 = document.getElementsByName('account-i')[0];
            var i1 = document.getElementsByName('email-i')[0];
            var i2 = document.getElementsByName('lock-i0')[0];
            var i3 = document.getElementsByName('lock-i1')[0];
            var s0 = document.getElementsByName('span-error0')[0];
            var s1 = document.getElementsByName('span-error1')[0];
            var s2 = document.getElementsByName('span-error2')[0];
            var s3 = document.getElementsByName('span-error3')[0];
            var idcheck = new RegExp('^[A-Za-z0-9]+$');
            var sbt = document.getElementsByName('sbt')[0];
            var exp0 = (!a0.value.match(idcheck) || a0.value === '' || a0.value.length < 4 || a0.value.length > 16);
            var exp1 = (e0.value === '');
            var exp2 = (p0.value === '' || p0.value.length < 4 || p0.value.length > 32);
            var exp3 = (p0.value !== p1.value || p1.value == '');
            const D0 = 'color: #FF0000; display: block; margin-top: -12px; margin-left: 48px;';
            const D1 = 'display: none;'
            i0.style = (exp0 && x !== 0) ? 'color: #FF0000;' : '';
            s0.style = (exp0 && x !== 0) ? D0 : D1;
            i1.style = (exp1 && x !== 1) ? 'color: #FF0000;' : '';
            s1.style = (exp1 && x !== 1) ? D0 : D1;
            i2.style = (exp2 && x !== 2) ? 'color: #FF0000;' : '';
            s2.style = (exp2 && x !== 2) ? D0 : D1;
            i3.style = (exp3 && x !== 3) ? 'color: #FF0000;' : '';
            s3.style = (exp3 && x !== 3) ? D0 : D1;
            sbt.disabled = (exp0 || exp1 || exp2 || exp3);
            sbt.style = sbt.disabled ? 'background-color: #DDDDDD !important;' : 'background-color: #4dd0e1 !important;';
        }
    </script>
    <div id="main">
        <div class="wrapper">
            <?php include("part/sidebar.php"); ?>
            <div class="row login-box">
                <form action='/register-post.php' method='POST'>
                    <div class="row login-content">
                        <div class="row">
                            <div class="input-field">
                                <i name="account-i" class="material-icons prefix">account_circle</i>
                                <input name="account" id="icon_prefix" type="text" class="validate" placeholder="帳號（不建議使用學號）" onfocus="check(0);" <?php if(isset($_GET['account'])){ echo 'value="'.$_GET['account'].'"';}?> onkeyup="check(0);" onkeydown="check(0);" required/>
                                <span name="span-error0" style="color: #FF0000; display: none;">
                                    請填寫 4 ~ 16 位之英數作為帳號組合。
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i name="email-i" class="material-icons prefix">email</i>
                                <input name="email" id="icon_prefix" type="text" class="validate" placeholder="電子信箱" onfocus="check(1);" <?php if(isset($_GET['email'])){ echo 'value="'.$_GET['email'].'"';}?> onkeyup="check(1);" onkeydown="check(1);" required/>
                                <span name="span-error1" style="color: #FF0000; display: none;">
                                    請填寫電子信箱。
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i name="lock-i0" class="material-icons prefix">lock</i>
                                <input name="password" id="icon_prefix" type="password" class="validate" placeholder="密碼" onfocus="check(2);" onkeyup="check(2);" onkeydown="check(2);" required/>
                                <span name="span-error2" style="color: #FF0000; display: none;">
                                    請填寫 4 ~ 32 位之組合作為密碼。
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i name="lock-i1" class="material-icons prefix">lock_outline</i>
                                <input name="password-confirm" id="icon_prefix" type="password" class="validate" placeholder="確認密碼" onfocus="check(3);" onkeyup="check(3);" onkeydown="check(3);" required/>
                                <span name="span-error3" style="color: #FF0000; display: none;">
                                    請再次確認密碼。
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">face</i>
                                <input name="nickname" id="icon_prefix" type="text" class="validate" placeholder="暱稱（可選，不建議使用學號）" onfocus="check(4);" <?php if(isset($_GET['nickname'])){ echo 'value="'.$_GET['nickname'].'"';}?> />
                            </div>
                        </div>
                        <input type="hidden" name="token" value='<?php echo $token; ?>' />
                        <a href="./login.php">   
                            <div class="left grey-text text-darken-1 linkbg">已有帳號？登入</div>
                        </a>
                        <input name="sbt" type="submit" class="waves-light btn right cyan lighten-2" value="註冊" disabled="disabled" style="background-color: #DDDDDD !important;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include("part/footer.php"); ?>