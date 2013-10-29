<?php $spons = $dir->GetChallSponsorship($challengeid)?>
<script src="<?=$siteurl;?>/datatable/js/jquery.dataTables.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=$siteurl?>/datatable/css/demo_table.css" type="text/css" />
  <script type="text/javascript" charset="utf-8">
     $(document).ready(function() {
				jQuery("#sponsortable").dataTable( {
					"aaSorting": [],
					"aoColumnDefs": [
					                 { "sWidth": "10%", "aTargets": [ 0 ],
					                   "sWidth": "30%", "aTargets": [ 1 ],
					                   "sWidth": "30%", "aTargets": [ 2 ],
					                   "sWidth": "30%", "aTargets": [ 3 ],
					                   "sWidth": "30%", "aTargets": [ 4 ] 
				                	 }
					               ]
					
				} );

				$('#sponsortable').css('width','100%');

				 
			} );
</script>

 <table id="sponsortable" class="display">
    <thead>
       <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Message</th>
            <th>Date</th>
         </tr>
        </thead>
         <tbody>
            <?php if (count($spons)>0):?>
               <?php for ($i=0;$i<count($spons);$i++):?>
                 <tr>
                   <td><?php echo $spons[$i]['Username']?></td>
                   <td><a href="<?php echo $spons[$i]['Url']?>" target="_blank"><?php echo $spons[$i]['Name']?></a></td>
                   <td>
                     <?php if ($spons[$i]['Type']=="1"):?>
                         <?php echo "Monetary Sponsorship"?>
                         <?php else:?>
                         <?php echo "Another Sponsorship"?>
                     <?php endif;?>
                   </td>
                   <td><?php echo $spons[$i]['Amount']?></td>
                   <td><?php echo $spons[$i]['Message']?></td>
                   <td><?php echo $spons[$i]['Date']?></td>
                 </tr>
               <?php endfor;?>
            <?php else:?>
				<tr>
					<td colspan="6">
						<p style="text-align:center">No data found</p>
						<br><br><br>
					</td>
				</tr>
            <?php endif;?>
         </tbody>
       </table>  
