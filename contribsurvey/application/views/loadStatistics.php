<div id="statdiv">
<?	$q = 1;
	foreach($statistics AS $s):?>
	<p class="qtitle"><b>Question <?=$q++?>:</b> <?=$s->questiontext?> <?=$s->answered?> answers</p>
	
	<?if(is_array($s->stats) == true):?>
		<div style="padding-left:10px;">
			<table class="result">
				<tr><th class="col_option">Option</th>
					<th width="50%" class="col_option">Total</th>
				</tr>
				<?foreach($s->stats AS $count):?>
						<tr><td><?=$count->option?></td>
							<td><?=$count->total;
								if($count->percent > 0):
									echo "<br>".$count->percent;
								endif;?>
							</td>
							
						</tr>
				<?endforeach;?>
			</table>
		</div>
	<?endif;?>
	
<?endforeach;?>
</div>

<style>
	#statdiv{ width: 250%; }
	.result{
		text-align: left;
		border-collapse: collapse;
		border-spacing: 2px;
		border-color: gray;
		width:100%;
	}
	table th{
		border: 1pt solid #aaa;
		margin: 0;
		padding: 2px;
		text-align: center;
	}
	table td{
		border: 1pt solid #aaa;
		margin: 0;
		padding: 2px;
	}
	.col_option{width: 50%;}
	#statdiv.qtitle{font-size:12px;}
</style>