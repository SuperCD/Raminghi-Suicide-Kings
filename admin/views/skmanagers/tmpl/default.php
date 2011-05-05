<?php
defined('_JEXEC') or die('Restricted access');

// Menu generico per tutte le sezioni
JToolBarHelper::title( JText::_( 'Suicide Kings Manager' ), 'generic.png' );
JToolBarHelper::deleteList();
JToolBarHelper :: custom( 'suicide', 'iconname.png', 'iconname.png', 'Suicide', false, false );
JToolBarHelper :: custom( 'import', 'iconname.png', 'iconname.png', 'Importa giocatori', false, false );
JToolBarHelper :: custom( 'raids', 'iconname.png', 'iconname.png', 'Gestione Raid', false, false ); 
JToolBarHelper::editListX();
JToolBarHelper::addNewX();
JToolBarHelper::preferences('com_skmanager', 320);
?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
        <th width="20">
    	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->players ); ?>);" />
		</th>
            <th width="5">
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th width="5">
                <?php echo JText::_( 'Punteggio' ); ?>
            </th>
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->players ); $i < $n; $i++)
    {
        $row =& $this->players[$i];
        ?>
        <tr class="<?php echo "row$k"; ?>">
         	<?php $checked = JHTML::_( 'grid.id', $i, $row->profile_id); ?>
         	<td>
    		<?php echo $checked; ?>
			</td>
 
            <td>
                <?php echo $row->name; ?>
            </td>
            <td>
                <?php echo $row->punteggio; ?>
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
<input type="hidden" name="controller" value="player" />
 
</form>
