<?php
include 'config.php';
// Fetch doctors and patients
$doctors_res = mysqli_query($conn, "SELECT * FROM doctors ORDER BY id DESC");
$patients_res = mysqli_query($conn, "SELECT patient.*, doctors.name AS doctor_name FROM patient LEFT JOIN doctors ON patient.doctor_id = doctors.id ORDER BY patient.id DESC");

$msg_map = [
    'doctor_added' => 'تم إضافة الدكتور',
    'patient_added' => 'تم إضافة المريض',
    'doctor_updated' => 'تم تعديل بيانات الدكتور',
    'patient_updated' => 'تم تعديل بيانات المريض',
    'doctor_deleted' => 'تم حذف الدكتور',
    'patient_deleted' => 'تم حذف المريض'
];
$msg = '';
if (isset($_GET['msg']) && isset($msg_map[$_GET['msg']])) {
    $msg = $msg_map[$_GET['msg']];
}
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>نظام المستشفى - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <h1 class="mb-4">نظام إدارة المشفى</h1>

  <?php if ($msg): ?>
    <div class="alert alert-success"> <?php echo $msg; ?> </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">إضافة دكتور جديد</h5>
          <form action="add.php" method="POST">
            <input type="hidden" name="type" value="doctor">
            <div class="mb-3">
              <label class="form-label">الاسم <span class="required">*</span></label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">التخصص</label>
              <input type="text" name="specialty" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">الهاتف</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <button class="btn btn-primary">إضافة الدكتور</button>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">قائمة الأطباء</h5>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead><tr><th>#</th><th>الاسم</th><th>التخصص</th><th>الهاتف</th><th>إجراءات</th></tr></thead>
              <tbody>
              <?php while($d = mysqli_fetch_assoc($doctors_res)): ?>
                <tr>
                  <td><?php echo $d['id']; ?></td>
                  <td><?php echo htmlspecialchars($d['name']); ?></td>
                  <td><?php echo htmlspecialchars($d['specialty']); ?></td>
                  <td><?php echo htmlspecialchars($d['phone']); ?></td>
                  <td class="table-actions">
                    <a class="btn btn-sm btn-outline-secondary" href="edit_doctor.php?id=<?php echo $d['id']; ?>">تعديل</a>
                    <a class="btn btn-sm btn-outline-danger" href="delete.php?type=doctor&id=<?php echo $d['id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذا الدكتور؟');">حذف</a>
                  </td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">إضافة مريض جديد</h5>
          <form action="add.php" method="POST">
            <input type="hidden" name="type" value="patient">
            <div class="mb-3">
              <label class="form-label">الاسم <span class="required">*</span></label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">العمر</label>
              <input type="number" name="age" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">الدكتور (اختياري)</label>
              <select name="doctor_id" class="form-select">
                <option value="">-- بدون --</option>
                <?php
                  // fetch doctors again for select
                  $d2 = mysqli_query($conn, "SELECT id, name FROM doctors ORDER BY name ASC");
                  while($rowd = mysqli_fetch_assoc($d2)){
                    echo '<option value="'.$rowd['id'].'">'.htmlspecialchars($rowd['name']).'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">الهاتف</label>
              <input type="text" name="phone" class="form-control">
            </div>
            <button class="btn btn-success">إضافة المريض</button>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">قائمة المرضى</h5>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead><tr><th>#</th><th>الاسم</th><th>العمر</th><th>الدكتور</th><th>الهاتف</th><th>إجراءات</th></tr></thead>
              <tbody>
              <?php while($p = mysqli_fetch_assoc($patients_res)): ?>
                <tr>
                  <td><?php echo $p['id']; ?></td>
                  <td><?php echo htmlspecialchars($p['name']); ?></td>
                  <td><?php echo $p['age']; ?></td>
                  <td><?php echo htmlspecialchars($p['doctor_name']); ?></td>
                  <td><?php echo htmlspecialchars($p['phone']); ?></td>
                  <td class="table-actions">
                    <a class="btn btn-sm btn-outline-secondary" href="edit_patient.php?id=<?php echo $p['id']; ?>">تعديل</a>
                    <a class="btn btn-sm btn-outline-danger" href="delete.php?type=patient&id=<?php echo $p['id']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذا المريض؟');">حذف</a>
                  </td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
