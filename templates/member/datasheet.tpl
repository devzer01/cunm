{include file='header.tpl'}
<h3>Primary Credit Union - Data Sheet</h3>

{include file='common/alert.tpl'}

{if $op_area_set eq 0}
	<div class="alert alert-danger">Please set a href='http://{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/member/operations'>Operational Areas</a> before creating datasheet</div>
{/if}

<div class="alert alert-info">
	Please note that <strong>Date</strong> will always be default to <strong>25th</strong> regardless of the date you select<br/>
	Please use the date field to only select correct <strong>month and year</strong>.
</div>
<form role="form" method='post' action='//{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/member/datasheet'>
Data Sheet Date: <input type="text" class="datepicker1" value="" id="date" name='date'>
<button id='createsheet' type="submit" onclick="return validateDate();" class="btn btn-success">Create New Datasheet</button>
</form>

<script type="text/javascript">
	function validateDate() {
		if (document.getElementById('date').value === "") {
			alert("Please select Date Sheet Date");
			return false;
		}
		return true;
	}
	$(function () {
		$( ".datepicker1" ).datepicker( { dateFormat: "yy-mm-25", changeMonth: true, changeYear: true } );
	});
</script>

<hr>

<h3>Past Data Sheets</h3>

<table id='report' class='table table-striped table-bordered'>
		<thead>
		<tr>
			<th>Date</th>
			<th>Total Members</th>
			<th>View</th>
		</tr>
		</thead>
		
		<tbody>
		{foreach from=$ds item=d}
		<tr>
			<td>{$d.date}</td>
			<td>{$d.total_members}</td>
			<td><a href='//{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/member/detail/{$d.id}'>View</a></td>
		</tr>
		{/foreach}
		</tbody>
	</table>

{include file='footer.tpl'}
