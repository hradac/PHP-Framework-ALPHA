<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?=$PAGE_TITLE?></title>
        <link href="<?=WEBPATH?>css/main.css" media="screen" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div style="width:100%" class="clipx pbm head">
            <div class="elem line">
                <div class="fRight mrl mts mbs">
                    <form class="mrl unit" method="post" action="<?=WEBPATH?>index.php/Search">
                        <input style="background-color: #ededed;" class="border" type="text" name="searchQuery" id="searchBox"<?php if(isset($_POST['searchQuery'])) echo " value=\"{$_POST['searchQuery']}\"" ;?> />
                        <input class="action1" type="submit" value="Search" />
                    </form>
                    <div class="unit">
                <?php 
                // If not logged in then show the login and register links
                if(empty($_SESSION['user_id'])){
                    echo '<span class="mrm">';
                    LinkHelper::url('Login', 'Customer', 'login');
                    echo '</span>';
                    LinkHelper::url('Register', 'Customer', 'register');
                }else{
                    echo '<span class="mrm">';
                    LinkHelper::url('Logout', 'Customer', 'logout');
                    echo '</span>';
                    LinkHelper::url('My Account', 'Account');
                    
                }
                ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%" class="clipx pbm head">
            <div class="body">
                <div class="leftCol menu">
                    <?php 
                        $linkImg = '<img class="center" src="' . WEBPATH . 'img/logo.png" alt="logo" width="206" height="202" />';
                        LinkHelper::url($linkImg);
                    ?>
                    
                    <ul class="nav center ptl">
                        <li class="action">
                    <?php LinkHelper::url('Browse Widgets', 'Product');?>
                        </li>
                    </ul>
                    
                    <div class="ptl">
                        <?php 
                        if(!isset($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] != '/Cart'){
                            $linkImg = '<img class="center" src="' . WEBPATH . 'img/cart.png" alt="cart" width="45" height="39" />';
                            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                                LinkHelper::url($linkImg, 'Cart');
                                echo '<div class="action center ptl">';
                                LinkHelper::url('View your cart', 'Cart');
                                echo '</div>';
                            }else{
                                echo $linkImg;
                                echo '<div class="center ptl">';
                                echo 'Your cart is empty';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <div class="main">
                    <div class="innerCol ptm pbm">
                        <?php echo $output;?>
                    </div>
                </div>
            </div>
            <!--
            <div class="foot tcenter">
                2011 &copy; Super Widgets Mega Conglomo Inc.
            </div>
            -->
        </div>
    </body>
</html>
