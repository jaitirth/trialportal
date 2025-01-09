<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the uploaded file information
  $file = $_FILES['resume'];

  // Check for errors
  if ($file['error'] !== UPLOAD_ERR_OK) {
    die("Upload failed with error code: " . $file['error']);
  }

  // Get the file extension
  $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

  // Allow only specific file types
  $allowedExtensions = ['pdf', 'doc', 'docx'];
  if (!in_array($fileExt, $allowedExtensions)) {
    die("Invalid file type. Only PDF, DOC, and DOCX files are allowed.");
  }

  // Set the upload directory
  $uploadDir = 'uploads/';

  // Generate a unique filename
  $newFileName = uniqid() . '_' . $file['name'];

  // Move the uploaded file to the uploads directory
  if (move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
    echo "Resume uploaded successfully.";
  } else {
    echo "Error uploading resume.";
  }
}
?>
