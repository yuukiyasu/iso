<?php

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
$filename='mission2-6.txt';
$name=$_POST['namae'];
$comment=$_POST['comment'];
$bangou = file('mission2-6.txt');
$count=count($bangou);
$fp=fopen($filename,'a');
$date=date('Y h:i:s A');
if($count==0){
	$count=1;
}
else{
	$count++;
}
//ファイル書き込み
//echo $_POST['edit1']."test edit1"."<br>";
if(empty($_POST['edit1'])&&!empty($comment)&&!empty($name)){
fwrite($fp,$count."<>".$name."<>".$comment."<>".$date."<>".$pass."\n");
}
else if(empty($_POST['edit1'])&&!empty($comment)&&empty($name)){
$name="名無しさん";
fwrite($fp,$count."<>".$name."<>".$comment."<>".$date."<>".$pass."\n");
}
//ファイルを閉じる
fclose($fp);


?>



	

<?php
$get_pass=$_POST['password']."\n";
$get_pass2=$_POST['password'];
$del2=$_POST['del2'];
$edit2=$_POST['edit2'];
if(isset($del2)){

$passfile=file('mission2-6.txt');

foreach($passfile as $line3){
		$passdata=explode("<>",$line3);
	if($passdata[0]==$del2){
		if($passdata[4]==$get_pass){
	$correct_pass=1;
	echo "削除しました"."<br>";
			}
	else{
	echo "パスワードが違います"."<br>";
		}

		}

	}

}

if(isset($edit2)){

$passfile=file('mission2-6.txt');
foreach($passfile as $line3){
		$passdata=explode("<>",$line3);
	if($passdata[0]==$edit2){
		if($passdata[4]==$get_pass){

	$correct_pass2=1;
//	echo "編集内容を入力してください"."<br>";
			}
	else{
	echo "パスワードが違います"."<br>";
	}

		}

	}

	
}


?>

<?php
if(isset($del2)&&$correct_pass==1){//削除番号が存在したら
	
	$filedata=file('mission2-6.txt');
	$fp2=fopen('mission2-6.txt','w+');
	//ファイルを一行ずつ取り込む
	foreach($filedata as $line){
		$deldata=explode("<>",$line);
	//削除番号としなかったらしたら
		if($deldata[0]!= $del2){
			fputs($fp2,$line);
	
		}
		else if($deldata[0]==$del2)
			fputs($fp2,"削除しました"."\n");
			}
fclose($fp2);

				}

//編集番号が存在したら
if(isset($edit2)&&$correct_pass2==1){
echo "編集内容を入力してください";
	$filedata=file('mission2-6.txt');		
	 foreach($filedata as $line){
		$editdata=explode("<>",$line);
	//編集番号と番号が一致したら
		if($editdata[0]==$edit2){
			$onamae=$editdata[1];//名前
			$ocomment=$editdata[2];//コメント
			$edit_num=$editdata[0];//番号
			$opass=$editdata[4];
			}
		}
	}

//echo "check|".$edit_num[0]."<br>";
?>
<form method="POST" action="mission_2-6vol3.php">
<input type="hidden" name="edit1" value="<?php echo $edit_num; ?>"><br/>
名前:<br />
<input type="text" name="namae" value="<?php echo $onamae;  ?>" ><br />
コメント:<br />
<textarea name="comment" cols="50" rows="5"><?php echo $ocomment; ?></textarea><br/>
パスワード:<br/>
<input type="password" name="pass" value="<?php echo $opass;  ?>" size="15"><br/>
<input type="submit" value="送信">
</form>
<form method="POST" action="mission_2-6vol3.php">
削除対象番号:<br />
<input type="text" name="delete"><br />
<input type="submit" value="削除">
</form>
<form method="POST" action="mission_2-6vol3.php">
編集対象番号:<br />
<input type="text" name="edit"><br />
<input type="submit" value="編集">
</form>
<?php if( $page_flag === 1 ): ?>
<form method="POST" action="mission_2-6vol3.php">
<input type="hidden" name="del2" value="<?php echo $del; ?>"><br/>
<input type="hidden" name="edit2" value="<?php echo $edit; ?>"><br/>
パスワードを入力してください:<br>
<input type="text" name="password"  >
<input type="submit" value="送信">
</form>
	<?php endif ?>
<?php
$edit1=$_POST['edit1'];
if(!empty($edit1)){
	$editfile=file('mission2-6.txt');
	$fp3=fopen('mission2-6.txt','w+');
	$filedata=file('mission2-6.txt');	
	 foreach($editfile as $line2){
	
		$editdata=explode("<>",$line2);

		if($editdata[0]==$edit1){
	
			$edit_text=$edit1."<>".$name."<>".$comment."<>".$date."<>".$pass."\n";
				fputs($fp3,$edit_text);

			}
		else{
			fputs($fp3,$line2);
			}
		}

fclose($fp3);
	}		
//echo "test4".$get_pass."<br>";		
$coments = file($filename);
for( $i = 0; $i < count($coments);++$i ){
$coment = explode("<>", $coments[$i]);
echo $coment[0]."<br/>";
echo $coment[1]."<br/>";
echo $coment[2]."<br/>";
echo $coment[3]."<br/>";

}

?>

</html>
