<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
</head>
<body>

<h2>Employee redaktə et</h2>

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

<form action="index.php?action=update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($employee['id']) ?>">

    <label>Ad:</label><br>
    <input type="text" name="first_name" value="<?= htmlspecialchars($employee['first_name']) ?>">
    <br><br>

    <label>Soyad:</label><br>
    <input type="text" name="last_name" value="<?= htmlspecialchars($employee['last_name']) ?>">
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($employee['email']) ?>">
    <br><br>

    <label>Telefon:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($employee['phone']) ?>">
    <br><br>

    <label>Vəzifə:</label><br>
    <input type="text" name="position" value="<?= htmlspecialchars($employee['position']) ?>">
    <br><br>

    <label>Maaş:</label><br>
    <input type="text" name="salary" value="<?= htmlspecialchars($employee['salary']) ?>">
    <br><br>

    <button type="submit">Yenilə</button>
</form>

</body>
</html>