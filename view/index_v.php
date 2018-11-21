<?if (isAuth()):?>
    <p><a href="account.php">To the private account</a></p>
  <?else:?>
    <p><a href="auth.php">Authorization</a></p>
<?endif;?>
<hr>

<?foreach ($articles as $item) :?>
<p>
  <a href="article.php?aid=<?=$item['id']?>"><?=$item['title']?></a>
  <?if (isAuth()):?>
    <a href="edit.php?aid=<?=$item['id']?>">Edit</a>
    <a href="delete.php?aid=<?=$item['id']?>">Delete</a>

  <?endif;?>
</p>
<?endforeach;?>

<hr>
<?if (isAuth()):?>
  <p><a href="add.php">Add new article</a></p>
<?endif;?>
