<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>5-1 掲示板と投稿を合体！</title>
    </head>
    <body>
        
        <form method = "post" action>
            <input type = "text" name = "name" placeholder = "名前">
            <input type = "text" name = "comment" placeholder = "コメント">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        //DB下準備
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
                //echo "完了";
        
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        
                //echo"$name";
        
        
        //DBに書き込み
        if(!empty($name) && !empty($comment)){
        $sql = $pdo -> prepare("INSERT INTO tbtest(name, comment) 
        VALUES (:name, :comment)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> execute();
        }
                //echo "送信完了";
        
        //DBを表示
        $sql = 'SELECT * FROM tbtest';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //rowの添字[]にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].'<br>';
        echo "<hr>";
        }
                //echo"書き込み完了";
                
        ?>
    </body>
</html>