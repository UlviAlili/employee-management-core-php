<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
</head>
<body>

<h2>Yeni Employee əlavə et</h2>

<a href="index.php">Geri qayıt</a>

<br><br>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?action=store" method="POST">
    <label>Ad:</label><br>
    <input type="text" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
    <br><br>

    <label>Soyad:</label><br>
    <input type="text" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <br><br>

    <label>Telefon:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
    <br><br>

    <label>Vəzifə:</label><br>
    <input type="text" name="position" value="<?= htmlspecialchars($_POST['position'] ?? '') ?>">
    <br><br>

    <label>Maaş:</label><br>
    <input type="text" name="salary" value="<?= htmlspecialchars($_POST['salary'] ?? '') ?>">
    <br><br>

    <button type="submit">Yadda saxla</button>
</form>

</body>
</html>