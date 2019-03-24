<?php include("part/header.php"); ?>
<?php include_once('part/sql-connection.php') ?>
<?php include_once('function/token.php') ?>
<body>
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
                    <form action="./reset-password-post.php" method="post">
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" name="account" id="icon_prefix" placeholder="帳號" class="validate" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                <input type="email" name="email" id="icon_prefix" placeholder="信箱" class="validate" required/>
                            </div>
                        </div>
                        <input type="hidden" name="token" value='<?php echo $token; ?>' />
                        <input type="submit" name='reset' class=" waves-light btn right cyan lighten-2" value="重設密碼"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("part/footer.php"); ?> 