<h2>pagina inicial</h2>

<ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <?= $todo['title']; ?>
        </li>
    <?php endforeach ?>
</ul>

<form action="<?= APP_URL; ?>/create" method="post">
    <input type="text" name="title">
    <input type="submit">
</form>

