 مقدمة عن المشروع
نظام إدارة المستشفى هو تطبيق ويب متكامل مصمم لإدارة 
المعلومات الطبية في المستشفيات والعيادات. يوفر النظام واجهة سهلة الاستخدام باللغة العربية
 لإدارة سجلات الأطباء والمرضى، مع الحفاظ على العلاقات بينهم بطريقة منظمة وآمنة.





hospital_project_B/
├── config.php          // إعدادات اتصال قاعدة البيانات
├── index.php           // الصفحة الرئيسية - واجهة النظام
├── add.php             // إضافة بيانات جديدة (أطباء/مرضى)
├── update.php          // تحديث البيانات (أطباء/مرضى)
├── delete.php          // حذف البيانات (أطباء/مرضى)
├── edit_doctor.php     // صفحة تعديل بيانات الطبيب
├── edit_patient.php    // صفحة تعديل بيانات المريض
├── css/
│   └── style.css       // تنسيقات CSS المخصصة
└── README.txt          // ملف التعليمات (هذا الملف)




SQL:
CREATE DATABASE hospital;
USE hospital;

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    specialty VARCHAR(100),
    phone VARCHAR(20)
);
CREATE TABLE patient (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    doctor_id INT,
    phone VARCHAR(20),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE SET NULL
);

