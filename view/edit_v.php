<form action="<?=$_SERVER['PHP_SELF']?>?aid=<?=$id?>" method="post">
  <p>Enter title <br><input type="text" value="<?= $title ?>" name="title"></p>
  <p>Enter text <br><textarea name="text" cols="50" rows="10"><?= $text ?></textarea></p>
  <input type="submit" value="save">
</form>