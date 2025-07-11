<?php
require_once './helpers/MemberDAO.php';

$email = '';
$errs = [];

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION['member'])) {
    header('Location: index.php');
    exit;
}
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($email === '') {
        $errs[] = 'メールアドレスを入力して下さい。';
    }
    
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errs[] = 'メールアドレスの形式に誤りがあります。';
    }

   
    if ($password === '') {
        $errs[] = 'パスワードを入力して下さい。';
    }

    
    if (empty($errs)) {
        $memberDAO = new MemberDAO();
        $member = $memberDAO->get_member($email, $password);

        if ($member !== false) {
            session_regenerate_id(true);
            $_SESSION['member'] = $member;
            header('Location: index.php');
            exit;
        } else {
            $errs[] = 'メールアドレスまたはパスワードに誤りがあります。';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
</head>
<body>
<?php include 'header2.php'; ?>

<form action="" method="post">
    <table>
        <tr>
            <th colspan="2">
                ログイン
            </th> 
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td>
                <input type="text" name="email">
            </td> 
        </tr>
        <tr>
            <td>パスワード</td>
            <td>
                <input type="password" name="password">
            </td> 
        </tr>
        <tr>
            <td>
                <input type="submit" value="ログイン">
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php foreach($errs as $e): ?>
                    <span style="color:red"><?= $e ?></span>
                    <br>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
</form>



</body>
</html>
