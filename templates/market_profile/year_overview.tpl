{include file='header.tpl'}

<div class="container-fluid">
    <h1>Market Profile Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to All Years
        </a>
    </p>
    <hr>

    {if $no_data}
        <div class="alert alert-warning">
            <i class="glyphicon glyphicon-exclamation-sign"></i> No data available for year {$year}.
        </div>
    {else}
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Participating Federations ({$profiles|@count})</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Country</th>
                            <th>Federation</th>
                            <th>Organization</th>
                            <th>Submission Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$profiles item=profile}
                        <tr>
                            <td>{$profile.country_name}</td>
                            <td>{$profile.federation_name}</td>
                            <td>{$profile.organization_name}</td>
                            <td>{$profile.submission_date|date_format:'%Y-%m-%d'}</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>

        <h2>Data Sections</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Section A: Credit Union Movement Level</h4>
                    </div>
                    <div class="list-group">
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/country_profile" class="list-group-item">
                            <span class="badge">{$section_data.country_profile.count}/{$section_data.country_profile.total}</span>
                            <strong>Country Profiles</strong>
                            <br><small>Population, GDP, Currency</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/memberships" class="list-group-item">
                            <span class="badge">{$section_data.memberships.count}/{$section_data.memberships.total}</span>
                            <strong>CU Memberships</strong>
                            <br><small>Urban/Rural CUs by size</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/individual_members" class="list-group-item">
                            <span class="badge">{$section_data.individual_members.count}/{$section_data.individual_members.total}</span>
                            <strong>Individual Members</strong>
                            <br><small>Age, Gender, Area</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/assets" class="list-group-item">
                            <span class="badge">{$section_data.assets.count}/{$section_data.assets.total}</span>
                            <strong>Assets</strong>
                            <br><small>Asset distribution by size</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/financial_structure" class="list-group-item">
                            <span class="badge">{$section_data.financial_structure.count}/{$section_data.financial_structure.total}</span>
                            <strong>Financial Structure</strong>
                            <br><small>Share, Savings, Loans, Reserves</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/movement_manpower" class="list-group-item">
                            <span class="badge">{$section_data.movement_manpower.count}/{$section_data.movement_manpower.total}</span>
                            <strong>Movement Manpower</strong>
                            <br><small>Officers, Managers, Staff</small>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4>Section B: Federation Level</h4>
                    </div>
                    <div class="list-group">
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/federation_info" class="list-group-item">
                            <span class="badge">{$section_data.federation_info.count}/{$section_data.federation_info.total}</span>
                            <strong>Federation Information</strong>
                            <br><small>General & membership info</small>
                        </a>
                        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}/financial_performance" class="list-group-item">
                            <span class="badge">{$section_data.financial_performance.count}/{$section_data.financial_performance.total}</span>
                            <strong>Financial Performance</strong>
                            <br><small>2024 vs 2025 comparison</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>

{include file='footer.tpl'}
