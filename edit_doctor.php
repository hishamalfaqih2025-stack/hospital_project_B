<?php
include 'config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { header('Location: index.php'); exit; }
$res = mysqli_query($conn, "SELECT * FROM doctors WHERE id=$id");
$d = mysqli_fetch_assoc($res);
if (!$d) { header('Location: index.php'); exit; }
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تعديل دكتور</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="padding-top:30px;">
  <h3>تعديل بيانات الدكتور</h3>
  <form action="update.php" method="POST">
    <input type="hidden" name="type" value="doctor">
    <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
    <div class="mb-3">
      <label class="form-label">الاسم</label>
      <input class="form-control" name="name" value="<?php echo htmlspecialchars($d['name']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">التخصص</label>
      <input class="form-control" name="specialty" value="<?php echo htmlspecialchars($d['specialty']); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">الهاتف</label>
      <input class="form-control" name="phone" value="<?php echo htmlspecialchars($d['phone']); ?>">
    </div>
    <button class="btn btn-primary">حفظ التعديل</button>
    <a class="btn btn-secondary" href="index.php">إلغاء</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
