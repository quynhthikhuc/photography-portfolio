<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>

<?php
  if (isset($_POST["submit"])) {
    $Title = mysqli_real_escape_string($connection, $_POST['Title']);
    $CoverImage = mysqli_real_escape_string($connection, $_POST['CoverImage']);
    $PostContent = mysqli_real_escape_string($connection, $_POST['PostContent']);

    // validation

    $query = "INSERT INTO posts (";
    $query .= " CoverImage, Title, PostContent";
    $query .= ") VALUES (";
    $query .= " '{$CoverImage}', '{$Title}', '{$PostContent}'";
    $query .= ")";

    // error_log($query);

    $result = mysqli_query($connection, $query);

    if ($result) {
      $message = '<div class="alert alert-success" role="alert">Post uploaded!</div>';
    } else {
      $message = '<div class="alert alert-danger" role="alert">Post upload failed.</div>';
    }
  }
?>
<?php include_once '../public/includes/_header.php'; ?>

<body>
  <div>
    <main>
      <h1>Add new post</h1>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
          <label for="CoverImage">Post Cover Image</label>
          <input type="textarea" name="CoverImage" require>
        </div>
        <div>
          <label for="Title">Post Title</label>
          <textarea name="Title" require></textarea>
        </div>
        <div>
          <label for="PostContent">Post Content</label>
          <textarea name="PostContent" require></textarea>
        </div>
        <button type="submit" name="submit">Create post</button>
      </form>
      <?php echo $message; ?>
    </main>
  </div>

  <script src="https://cdn.tiny.cloud/1/rbkgwjbarzymqqu84k0ovrb7zqwuj456p02ogl91ms0jbdkm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'image code',
      toolbar: 'undo redo | link image | code',
      // enable title field in the Image dialog
      image_title: true, 
      // enable automatic uploads of images represented by blob or data URIs
      automatic_uploads: true,
      // add custom filepicker only to Image dialog
      file_picker_types: 'image',
      file_picker_callback: function(cb, value, meta) {
        let input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function() {
          let file = this.files[0];
          let reader = new FileReader();
          
          reader.onload = function () {
            let id = 'blobid' + (new Date()).getTime();
            let blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            let base64 = reader.result.split(',')[1];
            let blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            // call the callback and populate the Title field with the file name
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };
        
        input.click();
      }
    });
  </script>

  <?php include_once '../public/includes/footer.php'; ?>
</body>
</html>