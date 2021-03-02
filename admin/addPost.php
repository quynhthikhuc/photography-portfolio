<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>

<?php
  if (isset($_POST["submit"])) {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $metadata = mysqli_real_escape_string($connection, $_POST['metadata']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);

    // validation

    $query = "INSERT INTO posts (";
    $query .= " metadata, title, content";
    $query .= ") VALUES (";
    $query .= " '{$metadata}', '{$title}', '{$content}'";
    $query .= ")";

    // error_log($query);

    $result = mysqli_query($connection, $query);

    header('Location: admin.php');
    exit;
  }
?>

<body>
  <?php include_once '../public/includes/_header.php'; ?>
  <div>
    <main>
      <h1>Add new post</h1>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
          <label for="metadata">Post MetaData</label>
          <textarea name="metadata" require></textarea>
        </div>
        <div>
          <label for="title">Post Title</label>
          <textarea name="title" require></textarea>
        </div>
        <div>
          <label for="content">Post Content</label>
          <textarea name="content" require></textarea>
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