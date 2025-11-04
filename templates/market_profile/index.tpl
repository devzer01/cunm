{include file='header.tpl'}

<div class="container-fluid">
    <h1>CU Market Profile Summary</h1>
    <p class="lead">Aggregated credit union data across all federations</p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Data by Year</h3>
        </div>
        <div class="panel-body">
            {if $yearly_summary}
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Total Profiles</th>
                            <th>Federations</th>
                            <th>Countries</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$yearly_summary item=summary}
                        <tr>
                            <td><strong>{$summary.year}</strong></td>
                            <td>{$summary.total_profiles}</td>
                            <td>{$summary.total_federations}</td>
                            <td>{$summary.total_countries}</td>
                            <td>
                                <a href="{$smarty.const.APP_PATH}/market_profile/year/{$summary.year}" class="btn btn-primary">
                                    View Summary <i class="glyphicon glyphicon-chevron-right"></i>
                                </a>
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else}
                <div class="alert alert-info">
                    <i class="glyphicon glyphicon-info-sign"></i> No market profile data available yet.
                </div>
            {/if}
        </div>
    </div>
</div>

{include file='footer.tpl'}
