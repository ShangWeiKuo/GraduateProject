<?php include("part/header.php"); ?>
<style type="text/css">
    .linkbg:hover {
        border-radius: 4px;
        background: #E2E2E2;
    }
</style>
<body>
    <script>
        function check(){
            var ac_input = document.getElementsByName('account')[0].value;
            var pw_input = document.getElementsByName('password')[0].value;
            var en = ac_input.length >= 4 && ac_input.length <= 16 && pw_input.length >=4 && pw_input.length <= 32
            var bt = document.getElementsByName('loginbt')[0];
            bt.disabled = !en;
            bt.style = bt.disabled ? 'background-color: #DDDDDD !important;' : 'background-color: #4dd0e1 !important;';
        }
    </script>

    <div id="main">
        <div class="wrapper">
            <?php include("part/sidebar.php"); ?> 
            <?php
                if(isset($_SESSION['account'])){
                    header('Location: index.php');
                }
            ?>
            <div class="row login-box">
                <div class="row login-content">
                    <form action="./function/do-login.php" method="post">
                        <h6 class="center-align" style="color:red" >
                            <?php
                                if(isset($_GET['f'])){
                                    if($_GET['f'] == 1){
                                        echo '帳號或密碼錯誤，請重新登入';
                                    }
                                }
                            ?>
                        </h6>
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" name="account" id="icon_prefix" onkeydown="check();" onkeyup="check();" placeholder="帳號" class="validate" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input type="password" name="password" id="icon_prefix" placeholder="密碼" onkeydown="check();" onkeyup="check();" class="validate" required/>
                            </div>
                            <?php
                                if(isset($_SERVER['HTTP_REFERER'])){
                                    echo '<input type="hidden" name="ref" value="'.$_SERVER['HTTP_REFERER'].'"/>';
                                }
                            ?>
                        </div>
                        <a href="./register.php">   
                            <div class="left grey-text text-darken-1 linkbg">尚無帳號？註冊</div>
                        </a>
                        <a href="./reset-password.php">   
                            <div class="left grey-text text-darken-1 linkbg"  style="margin-left: 24px;">忘記密碼</div>
                        </a>
                        <input type="submit" name='loginbt' class=" waves-light btn right cyan lighten-2" value="登入" disabled="disabled" style="background-color: #DDDDDD !important;"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("part/footer.php"); ?> 