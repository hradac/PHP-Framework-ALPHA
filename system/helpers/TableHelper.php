<?php
/**
 * Description of TableHelper
 *
 * @author Jason
 *
 * Date May 2, 2011
 */
class TableHelper {
    public static function buildTable($data, $headers){
?>
<table>
<thead>
    <tr>
<?php foreach ($headers as $th) :?>
        <th><?=$th?></th>
<?php endforeach; ?>
    </tr>
</thead>
<tbody>
<?php foreach ($data as $row): ?>
    <tr>
        <?php foreach ($row as $td) : ?>
        <td><?=$td?></td>
        <?php endforeach;?>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php
    
    } // End buildTable method
}

?>
