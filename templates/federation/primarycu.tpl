{include file='header.tpl'}
<h3>Administration - Primary Credit Unions</h3>

{include file='common/alert.tpl'}

<form role="form" method='post' action='//{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/federation/primarycu'>
  <div class="form-group">
    <label for="country">Region/Chapter</label>
    <select id='chapter_id' name='chapter_id' class="form-control">
    	{foreach from=$chapters item=chapter}
    		<option value='{$chapter.id}'>{$chapter.name}</option>
    	{/foreach}
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Primary Credit Union Name</label>
    <input type="text" name='name' class="form-control" id="exampleInputEmail1" placeholder="Enter Primary Credit Union Name">
  </div>
  <input type='hidden' name='federation_id' value='{$smarty.session.user_federation_id}' />
  <button type="submit" class="btn btn-default">Add Primary Credit Union</button>
</form>

<h3>Primary Credit Unions</h3>

<table id='report' class='table table-striped table-bordered'>
		<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
		</thead>

		<tbody>
		{foreach from=$primarycus item=primarycu}
			<tr>
				<td>{$primarycu.name}</td>
				<td>
					<a href='//{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/federation/primarycu/edit/{$primarycu.id}' class='btn btn-sm btn-primary'>Edit</a>
					<a href='//{$smarty.server.HTTP_HOST}{$smarty.const.APP_PATH}/federation/primarycu/delete/{$primarycu.id}' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure you want to delete this Primary Credit Union?");'>Delete</a>
				</td>
			</tr>
		{/foreach}
		</tbody>
	</table>


{include file='footer.tpl'}