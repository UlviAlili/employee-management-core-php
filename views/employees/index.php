<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Employee List</title>
</head>
<body>

<h2>Employee List</h2>

<a href="index.php?action=create">Yeni Employee əlavə et</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Ad Soyad</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Vəzifə</th>
            <th>Maaş</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($employees)): ?>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($employee['first_name']) ?>
                        <?= htmlspecialchars($employee['last_name']) ?>
                    </td>
                    <td><?= htmlspecialchars($employee['email']) ?></td>
                    <td><?= htmlspecialchars($employee['phone']) ?></td>
                    <td><?= htmlspecialchars($employee['position']) ?></td>
                    <td><?= htmlspecialchars($employee['salary']) ?></td>
                    <td>
                        <a href="index.php?action=edit&id=<?= $employee['id'] ?>">Edit</a>

                        |

                        <a href="index.php?action=delete&id=<?= $employee['id'] ?>"
                           onclick="return confirm('Silmək istədiyinizə əminsiniz?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Employee yoxdur</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>