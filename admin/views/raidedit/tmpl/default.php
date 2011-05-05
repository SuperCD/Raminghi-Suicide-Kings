<?php defined('_JEXEC') or die('Restricted access'); ?>
<h3><?php echo JText::_( 'Partecipanti' ); ?></h3>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
            <th>
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Iscritto' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Azioni' ); ?>              
            </th>                             
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->played ); $i < $n; $i++)
    {
        $row =& $this->played[$i];
        $link = 'index.php?option=com_skmanager&amp;controller=raidedit&amp;task=removepartecipation&amp;raidid='.$row->raid_id. '&amp;playerid='. $row->profile_id;
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row->name ?>
            </td>
            <td>   
                <?php
                if ($row->signedup) {$html = 'Si';} else {$html = 'No';}
                echo $html ?>
            </td>          
            <td>
                <a href=<?php echo $link?>>Non ha partecipato</a>
            </td>
        </tr>        
        <?php
        $k = 1 - $k;
    }
    ?>
    </table>
<h3><?php echo JText::_( 'Iscritti' ); ?></h3>    
    <table class="adminlist">
    <thead>
        <tr>
            <th>
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Iscritto' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Azioni' ); ?>              
            </th>                             
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->signed ); $i < $n; $i++)
    {
        $row =& $this->signed[$i];
        $link = 'index.php?option=com_skmanager&amp;controller=raidedit&amp;task=addpartecipation&amp;raidid='.$row['raid_id'].'&amp;playerid='. $row['profile_id'];        
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row['name'] ?>
            </td>
            <td>   
                <?php
                if ($row['signedup'] = 1) {$html = 'Si';} else {$html = 'No';}
                echo $html ?>
            </td>         
            <td>
                <a href=<?php echo $link?>>Ha partecipato</a>
            </td>
        </tr>        
        <?php
        $k = 1 - $k;
    }
    ?>
    </table> 
<h3><?php echo JText::_( 'Non disponibili' ); ?></h3>    
    <table class="adminlist">
    <thead>
        <tr>
            <th>
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Azioni' ); ?>              
            </th>                             
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->unaviable ); $i < $n; $i++)
    {
        $row =& $this->unaviable[$i];
        $link = 'index.php?option=com_skmanager&amp;controller=raidedit&amp;task=addpartecipation&amp;raidid='.$row['raid_id'].'&amp;playerid='. $row['profile_id'];            
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row['name'] ?>
            </td>       
            <td>
                <a href=<?php echo $link?>>Ha partecipato</a>
            </td>
        </tr>        
        <?php
        $k = 1 - $k;
    }
    ?>
    </table> 
<h3><?php echo JText::_( 'Non iscritti' )?></h3>    
    <table class="adminlist">
    <thead>
        <tr>
            <th>
                <?php echo JText::_( 'Nome' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Azioni' ); ?>              
            </th>                             
        </tr>            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->unsigned ); $i < $n; $i++)
    {
        $row =& $this->unsigned[$i];
        $link = 'index.php?option=com_skmanager&amp;controller=raidedit&amp;task=addpartecipation&amp;raidid='. $this->details->raid_id .'&amp;playerid='. $row['profile_id'];            
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row['name'] ?>
            </td>       
            <td>
                <a href=<?php echo $link?>>Ha partecipato</a>
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
<input type="hidden" name="pid" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="raidedit" />
 
</form>
