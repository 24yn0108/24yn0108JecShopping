<?php
    require_once './helpers/MemberDAO.php';
    require_once './helpers/CartDAO.php';

    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!empty($_SESSION['member'])) {
        $member = $_SESSION['member'];
    }
    $cart_num = 0;

    if (isset($_SESSION['member'])) {
        $member = $_SESSION['member'];
        $cartDAO = new CartDAO();
        $cart_list = $cartDAO->get_cart_by_memberid($member->memberid);
        foreach ($cart_list as $cart) {
            $cart_num += $cart->num;
        }
}
?> 
<header>
    <div>
        <a href="index.php">
            <img src="images/JecShoppingLogo.svg" alt="JecShoppingロゴ">
        </a>
    </div>
    <div>
        <?php if (isset($member)) : ?>
            <?= $member->membername ?>さん
            <a href="cart.php">カート（<?= $cart_num ?>）</a>
            <a href="logout.php">ログアウト</a>
        <?php else: ?>
        <a href="login.php">ログイン</a>
        <?php endif; ?>
    </div>
    <hr>
</header>
