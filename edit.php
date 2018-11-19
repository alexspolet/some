<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 22:06
 */
session_start();

if (!isAuth()){
  header('location: auth.php');
  exit();
}

$dir = './articles';
$mainfile = 'index.php';

$fname = trim(filter_input(INPUT_GET , 'fname' , FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$title = $fname;
$path = $dir . '/' . $title;
$text = file_get_contents($path);
$errors = [];



if (!empty($_POST)) {
    $title = filter_input(INPUT_POST , 'title' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (preg_match('/[\/\\\:*?|]/' ,$title )){
    $errors[] = 'Chars: /\:*?«| are forbidden in names of files';
  }

  $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  $fname= trim(filter_input(INPUT_GET, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  //echo $fname;
  $path = $dir . '/' . $title;
  if ($title === '' OR $text === '') {
    $errors[] = 'All fields must be full';
  }
  if (file_exists($path) AND $fname != $title ) {
    $errors[] = 'File with this name already exists. Choose another title';
  }


  if ($errors) {
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }else{
      $oldPath = $dir . '/' . $fname;
      unlink($oldPath);
    file_put_contents($path , $text);
    header("location: article.php?fname=$title");
    exit();
  }
}


  ?>
    <form action="<?=$_SERVER['PHP_SELF']?>?fname=<?=$fname?>" method="post">
        <p>Enter title <br><input type="text" value="<?= $title ?>" name="title"></p>
        <p>Enter text <br><textarea name="text" cols="50" rows="10"><?= $text ?></textarea></p>
        <input type="submit" value="save">
    </form>
<?