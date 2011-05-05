<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Dettagli' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="player">
					<?php echo JText::_( 'Nome' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="32" maxlength="250" value="<?php echo $this->player->name; ?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="player">
					<?php echo JText::_( 'Punteggio' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="punteggio" id="punteggio" size="32" maxlength="250" value="<?php echo $this->player->punteggio; ?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_skmanager" />
<input type="hidden" name="profile_id" value="<?php echo $this->player->profile_id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="player" />
</form>
