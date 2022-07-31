<?php
namespace Phppot;

use Phppot\DataSource;
require_once __DIR__ . '/lib/UserModel.php';
$userModel = new UserModel();
if (isset($_POST["import"])) {
    $response = $userModel->readUserRecords();
}
?>

<html>
    <head>
        <title>Datatable AJAX pagination with PHP and PDO</title>
        <!-- Datatable CSS -->
        <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

        <!-- jQuery Library -->
        <script src="jquery-3.3.1.min.js"></script>
        
        <!-- Datatable JS -->
        <script src="DataTables/datatables.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body >
   
    <div >
       <div class = "center">
       <h2>Import country CSV file into Mysql using PHP</h2>
       <div class="row">
            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data"
                onsubmit="return validateFile()">
                <div Class="input-row">
                    <input type="file" name="file" id="file"
                        class="file" accept=".csv,.xls,.xlsx">
                    <div class="import">
                        <button type="submit" id="submit" name="import"
                            class="btn-submit">Import</button>
                    </div>
                </div>
            </form>
        </div>
       </div>
        <div >
            <!-- Table -->
            <table id='empTable' class='display dataTable'>
                <thead>
                <tr>
                <th>Sn</th>
            <th>Iso Code</th>
            <th>IsonumericCode</th>
            <th>CommonName</th>
            <th>OfficialName</th>
            <th>symbol</th>
                </tr>
                </thead>
                
            </table>
        </div>
        
    </div>
      
    <div id="response"
        class="<?php if(!empty($response["type"])) { echo $response["type"] ; } ?>">
        <?php if(!empty($response["message"])) { echo $response["message"]; } ?>
        </div>
    
        
        <!-- Script -->
        <script>
        $(document).ready(function(){
            $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ajaxfile.php'
                },
                'columns': [
                    { data: 'isoCode' },
                    { data: 'isonumericCode' },
                    { data: 'commonName' },
                    { data: 'officialName' },
                    { data: 'symbol' },
                ]
            });
        });
        </script>
    </body>

</html>
