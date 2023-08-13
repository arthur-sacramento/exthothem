<!DOCTYPE html>
<html>
<head>
  <title>Exthothem</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: arial;
    }
    .top-bar {
      background-color: green;
      color: white;
      padding: 10px;
    }
    .table-container {
      display: flex;
    }

    .folders-list {
      border-right: 1px solid #CCC;
    }

    .folder-content {
      padding: 10px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    table, th, td {
      border: 1px solid CCC;
      padding: 8px;
      width: 100%;
    }
    
  </style>
</head>
<body>

  <table width='100%'>
  <tr>
    <td width='90%' valign='top'>

  <div class="top-bar">
    <a href='index.php' style='color: #FFF; text-decoration: none;'>Exthothem</a>
  </div>
  <div class="table-container">
    <div class="folders-list">   
      <br>
        <?php
        $categoriesFolder = 'categories';
        $folders = scandir($categoriesFolder);
        foreach ($folders as $folder) {
          if ($folder !== '.' && $folder !== '..' && is_dir($categoriesFolder . '/' . $folder)) {
            echo '&nbsp;&nbsp;&nbsp; <a href="?folder=' . urlencode($folder) . '">' . htmlentities($folder) . '</a>&nbsp;&nbsp;&nbsp; <br><hr>';
          }
        }
        ?>     
    </div>
    <div class="folder-content" align="left">
      <?php
      if (isset($_GET['folder'])) {
        $selectedFolder = $_GET['folder'];
        $folderPath = $categoriesFolder . '/' . $selectedFolder;
        if (is_dir($folderPath)) {
          echo '<h2>Contents of ' . htmlentities($selectedFolder) . '</h2>';
          echo "<table width='100%'>";
          echo '<tr><th>Name</th><th>Type</th></tr>';

          $contents = scandir($folderPath);
          foreach ($contents as $item) {
            if ($item !== '.' && $item !== '..') {
              $itemPath = $folderPath . '/' . $item;
              echo '<tr>';
              echo '<td>' . "<a href='$itemPath' target='blank'>" . htmlentities($item) . '</a></td>';
              echo '<td>' . (is_dir($itemPath) ? 'Folder' : 'File') . '</td>';
              echo '</tr>';
            }
          }

          echo '</table>';
        } else {
          echo '<p>Invalid folder selected.</p>';
        }
      } else {
        echo '<p>Please select a folder to view its contents.</p>';
      }
      ?>
    </div>
  </div>

  <hr>
    </td>
    <td align='right' width='90%' style='border-left: 1px solid #CCC;'>
      <a href="upload.php"><img src='icons/netvibes.png' alt='Upload a file (select)'></>    
      <a href="upload_drop.php"><img src='icons/package_add.png' alt='Upload a file (drop)'></a>
      <a href="fields.php"><img src='icons/document_copies.png' alt='Paste contents (multiple fields)'></a>
      <a href="paste.php"><img src='icons/document_empty.png' alt='Paste contents (one field)'></a>
      <a href="write_get.php"><img src='icons/attach.png' alt='Send text via GET contents'></a>  
      <a href="folders.php"><img src='icons/document_green.png' alt='Folders'></a>  
      <a href="files_full.php"><img src='icons/understanding.png' alt='Full search'></a>
      <a href="category_search.php"><img src='icons/folder_explorer.png' alt='Category search'></a>
      <a href="fields_search.php"><img src='icons/application_form_magnify.png' alt='Paste search'></a>
      <a href="chat.php"><img src='icons/comment.png' alt='Chat'></a>
      <a href="servers.php"><img src='icons/globe_australia.png' alt='Check servers'></a>        
      <a href="all_files_simple.php"><img src='icons/list.png' alt='Show all files (simple)'></a>
      <a href="all_files.php"><img src='icons/list_box.png' alt='Show all files'></a>      
      <a href="menu.html"><img src='icons/controlbar.png' alt='Menu'></a>
      <a href="README.txt"><img src='icons/information.png' alt='README'></a>     
      <a href='about.html'><img src='icons/help.png' alt='Options'></a>
    </tr>
  </table>

</body>
</html>