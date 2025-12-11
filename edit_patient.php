<?php
include 'config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header('Location: index.php'); exit; }
$res = mysqli_query($conn, "SELECT * FROM patient WHERE id=$id");
$p = mysqli_fetch_assoc($res);
if (!$p) { header('Location: index.php'); exit; }
$dlist = mysqli_query($conn, "SELECT id, name FROM doctors ORDER BY name ASC");
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تعديل مريض</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="padding-top:30px;">
  <h3>تعديل بيانات المريض</h3>
  <form action="update.php" method="POST">
    <input type="hidden" name="type" value="patient">
    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
    <div class="mb-3">
      <label class="form-label">الاسم</label>
      <input class="form-control" name="name" value="<?php echo htmlspecialchars($p['name']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">العمر</label>
      <input type="number" class="form-control" name="age" value="<?php echo $p['age']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">الدكتور (اختياري)</label>
      <select name="doctor_id" class="form-select">
        <option value="">-- بدون --</option>
        <?php while($rd = mysqli_fetch_assoc($dlist)): ?>
          <option value="<?php echo $rd['id']; ?>" <?php if ($p['doctor_id'] == $rd['id']) echo 'selected'; ?>><?php echo htmlspecialchars($rd['name']); ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">الهاتف</label>
      <input class="form-control" name="phone" value="<?php echo htmlspecialchars($p['phone']); ?>">
    </div>
    <button class="btn btn-primary">حفظ التعديل</button>
    <a class="btn btn-secondary" href="index.php">إلغاء</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
