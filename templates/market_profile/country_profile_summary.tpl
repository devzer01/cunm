{include file='header.tpl'}

<div class="container-fluid">
    <h1>Country Profiles - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Country Economic Profiles</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Federation</th>
                        <th>Population (2024)</th>
                        <th>GDP (USD)</th>
                        <th>GDP per Capita</th>
                        <th>Local Currency</th>
                        <th>Exchange Rate<br>(Dec 2024)</th>
                        <th>CU Penetration</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$data item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.federation_name}</td>
                        <td class="text-right">{$row.population_2024|number_format:0}</td>
                        <td>{$row.gdp_usd}</td>
                        <td class="text-right">${$row.gdp_per_capita_usd|number_format:2}</td>
                        <td class="text-center">{$row.local_currency}</td>
                        <td class="text-right">1 USD = {$row.exchange_rate_dec_2024|number_format:4}</td>
                        <td>{$row.cu_penetration}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file='footer.tpl'}
