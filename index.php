<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="bg-gray-200 p-6">
  
  <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">
    <h2 class="text-2xl font-semibold text-center	mb-4">Practice Form</h2>

    <?php
    $name = '';
    $gender = '';
    $subscribe = '';
    $datepicker = '';
    $timepicker = '';
    $options = [];
    $country = '';
    $photo = '';
    
    // print_r($_FILES);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

      $allowFile = ['image/jpeg','image/jpg','image/png'];

      if(!in_array($_FILES['photo']['type'] ,$allowFile)){
        echo 'Only JPG, JPEG & PNG files are allowed';
        exit;
      }
      if($_FILES['photo']['size'] >1024*1024){
        echo 'File size should be in 1 MB';
        exit;
      }
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.$_FILES['photo']['name'] );
    }
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
        $subscribe = isset($_POST['subscribe']) ? 'Yes' : 'No';
        $datepicker = isset($_POST['datepicker']) ? htmlspecialchars($_POST['datepicker']) : '';
        $timepicker = isset($_POST['timepicker']) ? htmlspecialchars($_POST['timepicker']) : '';
        $options = isset($_POST['options']) ? $_POST['options'] : [];
        $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
        $Photo = isset($_FILES['photo']) ? 'Uploaded' : '';

        
        echo '<div class="mb-6">';
        echo  '<ul>';
        echo    '<li> <strong>Name: </strong>' .$name .'</li>';
        echo    '<li> <strong>Gender: </strong>' .$gender .'</li>';
        echo    '<li> <strong>Subscribed: </strong>' .$subscribe .'</li>';
        echo    '<li> <strong>Date is: </strong>' .$datepicker .'</li>';
        echo    '<li> <strong>Time is: </strong>' .$timepicker .'</li>';
        echo    '<li> <strong>Options: </strong>' . implode(', ', $options) .'</li>';
        echo    '<li> <strong>Country: </strong>' .$country .'</li>';
        echo    '<li> <strong>Photo: </strong>' .$Photo .'</li>';
        echo   '</ul>';
        echo '</div>';
      }
    ?>

    <form action="#" method="POST" enctype="multipart/form-data">
      <!-- Input text  -->
    <div class="mb-b">
        <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
        <input type="text" id="name" name="name" value="<?= $name ?>" class="mt-1 p-2 w-full border rounded-md">
    </div>
      <!-- Radio  -->
    
      <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600 mt-1">Gender</label>
            <div class="mt-1 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="Male" class="form-radio text-indigo-600" <?=  $gender === 'Male' ? 'checked' : '' ?>>
                    <span class="ml-2">Male</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="female" class="form-radio text-indigo-600" <?= $gender === 'female' ? 'checked' : '' ?>>
                    <span class="ml-2">Female</span>
                </label>
            </div>
        </div>
      
      
      <!-- Subscribe  -->
    <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600">Subscribe</label>
            <input type="checkbox" id="subscribe" name="subscribe" value="subscribe" class="form-checkbox text-indigo-600" <?= $subscribe === 'Yes' ? 'checked' : '' ?>>
    </div>
      <!-- Date  -->
    <div class="mb-4 ">
        <label for="datepicker" class="block text-sm font-medium text-gray-600 mt-1">Pick a Date</label>
        <input type="text" id="datepicker" value="<?= $datepicker; ?>" name="datepicker" class="mt-1 p-2 w-full border rounded-md">
    </div>
      <!-- Time  -->
    <div class="mb-4">
            <label for="timepicker" class="block text-sm font-medium text-gray-600">Pick a Time</label>
            <input type="text" id="timepicker" name="timepicker" value="<?= $timepicker; ?>" class="mt-1 p-2 w-full border rounded-md">
    </div>
    <!-- Multiselect Dropdown using Select2 -->
    <div class="mb-4">
        <label for="options" class="block text-sm font-medium text-gray-600">Select Options</label>
        <select id="options" name="options[]" class="mt-1 p-2 w-full border rounded-md" multiple>
            <option value="Toyota" <?= in_array('Toyota' , $options)  ? 'selected' : '' ?>>Toyota</option>
            <option value="Honda" <?= in_array('Honda' , $options)  ? 'selected' : '' ?>>Honda</option>
            <option value="Nissan"<?= in_array('Nissan' , $options)  ? 'selected' : '' ?>>Nissan</option>
            <option value="Subaru"<?= in_array('Subaru' , $options)  ? 'selected' : '' ?>>Subaru</option>
            <option value="Mazda"<?= in_array('Mazda' , $options)  ? 'selected' : '' ?>>Mazda</option>
            <option value="Lexus"<?= in_array('Lexus' , $options)  ? 'selected' : '' ?>>Lexus</option>
        </select>
    </div>
    <!-- Multiselect Dropdown using Select2 -->
    <div class="mb-4">
        <label for="country" class="block text-sm font-medium text-gray-600">Select Options</label>
        <select id="country" name="country" class="mt-2 p-2 w-full border rounded-md">
            <option value="Bangladesh">Bangladesh</option>
            <option value="USA">USA</option>
            <option value="Canada">Canada</option>
            <option value="Germany">Germany</option>
            <option value="France">France</option>
            <option value="UK">UK</option>
        </select>
    </div>
    <!-- Photo -->
    <div class="mb-4">
        <input type="file" name="photo" value="Uploaded" <?= isset($_FILES['photo']) ? $_FILES['photo']['name'] : '' ?> class="text-sm font-sm text-gray-600">
    </div>

    
    

  
    <!-- Submit -->
    <div class="mt-6">
            <button type="submit" class="bg-indigo-600 text-white p-2 rounded-md">Submit</button>
        </div>
        
    </form>
  </div>

  <script>
    $(document).ready(function() {
    $('#options').select2();
});
    flatpickr("#datepicker", {
      dateFormat: "m-d-y"
    });
    flatpickr("#timepicker", {
      enableTime:true,
      noCalendar: true,
      dateFormat: "H:i",
    });
  </script>
</body>
</html>