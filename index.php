<form action="/" method="post">
    <input name="login" placeholder="введите логин"/>
    <input name="password" placeholder="введите пароль"/>
    <input name="message" placeholder="введите сообщение"/>
    <button>Отправить</button>
</form>

<?php
    function add_message($login, $message){
        $message_object = (object) ['user' => $login, 'message' => $message, 'date' => date('d.m.Y H:i')];
        $content = json_decode(file_get_contents("message.json"));
        $content->messages[] = $message_object;
        file_put_contents("message.json", json_encode($content));
    }

    function show_messages(){
        $content = json_decode(file_get_contents("message.json"));
        foreach($content->messages as $message){
            echo "<p>";
            echo "$message->user:       $message->message";
            echo "</p>";
            echo "<p>";
            echo "$message->date";
            echo "</p>";

            echo "<p>";
            echo "=================";
            echo "</p>";
        }
    }

    $login = $_POST["login"];
    $password = $_POST["password"];
    $message = $_POST["message"];

    if (($login === "ma") ||
    ($login === "shibo" && $password === "1234") || ($login === "user" && $password === "12345")){
        add_message($login, $message);
    } else{
        echo "Неверный логин или пароль";
    }

    show_messages();
?>
