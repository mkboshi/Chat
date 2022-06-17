<form action="/" method="GET">
    <p>Логин:</p>
    <input name="login">
    <p>Пароль:</p>
    <input name="password">
    <p>Сообщение:</p>
    <input name="message"><br>
    <button>Ок</button>
</form>

<?php
$login = 'ma';
$password = '123456789';

if (isset($_GET['login']) && isset($_GET['password']) && isset($_GET['message'])) {

    if (($_GET['login'] == $login) && ($_GET['password'] == $password)) {
        if ($_GET['message'] !== '') {
            $json_data = json_decode(file_get_contents('mes.json'));
            $newMessage = (object)['date' => date('d-m-y h:i:s'), 'user' => $_GET['login'], 'message' => $_GET['message']];
            $json_data[] = $newMessage;
            file_put_contents('mes.json', json_encode($json_data));
        }
    }
    else {
        echo 'Не верный логин или пароль';
    }
}

$json_data = json_decode(file_get_contents('mes.json'));
foreach($json_data as $cur){
    echo $cur->date . ' | ' . $cur->user . ': ' . $cur->message;
}

?>