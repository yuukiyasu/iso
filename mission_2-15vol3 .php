<?php
//データベース接続
$dsn = 'データベース名';
$user ='ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);
$stmt= $pdo->query('SET NAMES utf8');


?>
<?php
//ページフラッグを立てる
$page_flag=0;

if(!empty($_POST['delete'])){
$page_flag=1;
}
else if(!empty($_POST['edit'])){
$page_flag=1;
}
?>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>プログラミング掲示板</title>
</head>
<h3>掲示板</h3>

<?php
	//変数の定義、ファイル名の氏名
$j=0;
$pass=$_POST['pass'];
$edit=$_POST['edit'];
$del=$_POST['delete'];
$name=$_POST['namae'];
$comment=$_POST['comment'];
$date=date('Y h:i:s A');


//データベース書き込み処理
//echo $_POST['edit1']."test edit1"."<br>";
if(empty($_POST['edit1'])&&!empty($comment)&&!empty($name)){
insert($name,$comment,$date,$pass);

}

else if(empty($_POST['edit1'])&&!empty($comment)&&empty($name)){
$name="名無しさん";
insert($name,$comment,$date,$pass);

}


function insert($name,$comment,$date,$pass){
$dsn = 'mysql:dbname=co_914_99sv_coco_com;host=localhost';
$user ='co-914.99sv-coco';
$password = 'Kmb9a';
$pdo = new PDO($dsn,$user,$password);
$stmt= $pdo->query('SET NAMES utf8');

$sql = $pdo -> prepare("INSERT INTO dbmission2 (name,comment,date,pass) VALUES (:name, :comment,:date,:pass);"); 
//$sql -> bindParam(':id', $count, PDO::PARAM_INT);
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);  
$sql -> bindParam(':date', $date, PDO::PARAM_STR);    
$sql -> bindParam(':pass', $pass, PDO::PARAM_INT);  
$sql -> execute();
}


?>



	

<?php
//パスワード確認処理
//$get_pass=$_POST['password']."\n";
$get_pass=$_POST['password'];
$get_pass2=$_POST['password'];
$del2=$_POST['del2'];
$edit2=$_POST['edit2'];
if(isset($del2)){
$sql = 'SELECT * FROM dbmission2';
$dbtable = $pdo -> query($sql);	
foreach($dbtable as $line3){

	if($line3['id']==$del2){

		if($line3['pass']==$get_pass){

	$correct_pass=1;

			}
	else{
	echo "パスワードが違います"."<br>";
	}

		}

	}

}
if(isset($edit2)){
$sql = 'SELECT * FROM dbmission2';
$dbtable = $pdo -> query($sql);
foreach($dbtable as $line3){

	if($line3['id']==$edit2){
		if($line3['pass']==$get_pass){

	$correct_pass2=1;

			}
	else{
	echo "パスワードが違います"."<br>";
	}

		}

	}
}

?>

<?php
if(isset($del2)&&$correct_pass==1){//削除番号が存在しかつパスワードが一致した場合のみ
$sql = 'SELECT * FROM dbmission2';
$dbtable = $pdo -> query($sql);


	foreach($dbtable as $line){

			if($line['id']==$del2){
	//データベース削除
	$id = $line['id'];
	$sql = "delete from dbmission2 where id=$id";  
	$result = $pdo->query($sql);
	$delcomment="削除しました";
	//削除したデータベースの変わりに”削除しました”を挿入する
$sql = $pdo -> prepare("INSERT INTO dbmission2 (id,comment) VALUES (:id,:comment);"); 
$sql -> bindParam(':id', $line['id'], PDO::PARAM_INT);
$sql -> bindParam(':comment', $delcomment, PDO::PARAM_STR);  
$sql -> execute();
		}


}

				}



//編集番号が存在しかつパスワードが一致した場合のみ

if(isset($edit2)&&$correct_pass2==1){
$sql = 'SELECT * FROM dbmission2';
echo "編集内容を入力してください";
$dbtable = $pdo -> query($sql);
	foreach($dbtable as $line){
			if($line['id']==$edit2){
			//フォーム受け渡し
			$edit_num=$line['id'];//番号
			$onamae=$line['name'];//名前
			$ocomment=$line['comment'];//コメント
			$opass=$line['pass'];
			}
	}
}

?>
<form method="POST" action="mission_2-15vol3.php">
<input type="hidden" name="edit1" value="<?php echo $edit_num; ?>"><br/>
名前:<br />
<input type="text" name="namae" value="<?php echo $onamae;  ?>" ><br />
コメント:<br />
<textarea name="comment" cols="50" rows="5"><?php echo $ocomment; ?></textarea><br/>
パスワード:<br/>
<input type="password" name="pass" value="<?php echo $opass;  ?>" size="15"><br/>
<input type="submit" value="送信">
</form>
<form method="POST" action="mission_2-15vol3.php">
削除対象番号:<br />
<input type="text" name="delete"><br />
<input type="submit" value="削除">
</form>
<form method="POST" action="mission_2-15vol3.php">
編集対象番号:<br />
<input type="text" name="edit"><br />
<input type="submit" value="編集">
</form>
<?php if( $page_flag === 1 ): ?>
<form method="POST" action="mission_2-15vol3.php">
<input type="hidden" name="del2" value="<?php echo $del; ?>"><br/>
<input type="hidden" name="edit2" value="<?php echo $edit; ?>"><br/>
パスワードを入力してください:<br>
<input type="text" name="password"  >
<input type="submit" value="送信">
</form>
	<?php endif ?>
<?php
$edit1=$_POST['edit1'];
//echo "test".$edit."<br>";//デバック
//echo "test".$_POST['edit1']."<br>";//デバック

if(!empty($edit1)){
$sql = 'SELECT * FROM dbmission2';
$dbtable = $pdo -> query($sql);
	foreach($dbtable as $line){
			if($line['id']==$edit1){
			//データベースアップデート処理
			$id=$line['id'];$nm=$_POST['namae'];$kome=$_POST['comment'];$ps=$_POST['pass'];
			$sql="update dbmission2 set name='$nm',comment='$kome',pass='$ps' where id = '$id';"; 
			$result = $pdo->query($sql);


			}
		}
	}


$sql = 'SELECT * FROM dbmission2';
$results = $pdo -> query($sql);
//データベース表示処理
foreach ($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    echo $row['id'].'<br>';
    echo $row['name'].'<br>';
    echo $row['comment'].'<br>';
	echo $row['date'].'<br>';

}

?>

</html>
