<h2>pagina inicial</h2>

<ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <?= $todo['title']; ?>
        </li>
    <?php endforeach ?>
</ul>

<form action="<?= APP_URL; ?>" method="post">
    <input type="text" name="todos[title]">
    <input type="text" name="todos[priority]" value="0">
    <input type="submit">
</form>

