<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
        <th width="5">
    	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->importraids ); ?>);" />
		</th>
            <th width="20">
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th width="5">
                <?php echo JText::_( 'Data' ); ?>
            </th> 
            <th width="5">
                <?php echo JText::_( 'Importa' ); ?>
            </th>                         
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->importraids ); $i < $n; $i++)
    {
        $row =& $this->importraids[$i];
        $importlink = 'index.php?option=com_skmanager&amp;controller=raidedit&amp;raidid='.$row->raid_id;              
        ?>
        <tr class="<?php echo "row$k"; ?>">
         	<?php $checked = JHTML::_( 'grid.id', $i, $row->raid_id, false, 'rid'); ?>
         	<td>
    		<?php echo $checked; ?>
			</td>
            <td>
                <?php echo $row->name; ?>
            </td>
            <td>
                <?php echo date('Y-m-d H:i:s', intval($row->date)); ?>
            </td>
            <td>
                <a href=<?php echo $importlink?>>Modifica raid</a>
            </td>                     
        </tr>
        <?php
        $k = 1 - $k;
    }
    ?>
    </table>    
</div>
 
<input type="hidden" name="option" value="com_skmanager" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="raids" />
 
</form>
