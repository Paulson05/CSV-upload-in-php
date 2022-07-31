<?php
namespace Phppot;

$result = $userModel->getAllUser();
if (! empty($result)) {
    ?>
<table id='empTable' class='display dataTable'>
    <thead>
        <tr>
            <th>Sn</th>
            <th>isoCode</th>
            <th>isonumericCode</th>
            <th>commonName</th>
            <th>officialName</th>
            <th>symbol</th>
        </tr>
    </thead>
<?php
    foreach ($result as $row) {
        ?>
                <tbody>
        <tr>
            <td><?php  echo $row['id']; ?></td>
            <td><?php  echo $row['isoCode']; ?></td>
            <td><?php  echo $row['isonumericCode']; ?></td>
            <td><?php  echo $row['officialName']; ?></td>
            <td><?php  echo $row['commonName']; ?></td>
            <td><?php  echo $row['symbol']; ?></td>
        </tr>
                    <?php
    }
    ?>
                </tbody>
</table>

<?php } ?>