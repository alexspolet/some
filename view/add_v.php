<? if (isset($res) AND $res): ?>
    <p>Article was successfully added</p>
    <p><a href="<?= $mainfile ?>"></a></p>
<? else: ?>
  <? if ($errors): ?>
    <? foreach ($errors as $error): ?>
            <p><?= $error ?></p>
    <? endforeach; ?>
  <? endif; ?>


    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <p>Enter title <br><input type="text" value="<?= $title ?>" name="title"></p>
        <p>Enter text <br><textarea name="text" cols="50" rows="10"><?= $text ?></textarea></p>
        <input type="submit" value="save">
    </form>
<? endif; ?>