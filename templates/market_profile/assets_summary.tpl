{include file='header.tpl'}

<div class="container-fluid">
    <h1>Assets Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Assets by Federation (in millions, local currency)</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th rowspan="2">Country</th>
                        <th rowspan="2">Currency</th>
                        <th rowspan="2">Federation</th>
                        <th colspan="5" class="text-center" style="background-color: #d9edf7;">Urban</th>
                        <th colspan="5" class="text-center" style="background-color: #dff0d8;">Rural</th>
                        <th colspan="5" class="text-center" style="background-color: #fcf8e3;">Total</th>
                    </tr>
                    <tr>
                        <!-- Urban -->
                        <th style="background-color: #d9edf7;">Total</th>
                        <th style="background-color: #d9edf7;">&lt;100K</th>
                        <th style="background-color: #d9edf7;">100K-500K</th>
                        <th style="background-color: #d9edf7;">500K-1M</th>
                        <th style="background-color: #d9edf7;">&gt;1M</th>
                        <!-- Rural -->
                        <th style="background-color: #dff0d8;">Total</th>
                        <th style="background-color: #dff0d8;">&lt;100K</th>
                        <th style="background-color: #dff0d8;">100K-500K</th>
                        <th style="background-color: #dff0d8;">500K-1M</th>
                        <th style="background-color: #dff0d8;">&gt;1M</th>
                        <!-- Total -->
                        <th style="background-color: #fcf8e3;">Total</th>
                        <th style="background-color: #fcf8e3;">&lt;100K</th>
                        <th style="background-color: #fcf8e3;">100K-500K</th>
                        <th style="background-color: #fcf8e3;">500K-1M</th>
                        <th style="background-color: #fcf8e3;">&gt;1M</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$assets item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.currency}</td>
                        <td>{$row.federation_name}</td>
                        <!-- Urban -->
                        <td class="text-right">{$row.urban_total_assets|number_format:2}</td>
                        <td class="text-right">{$row.urban_assets_lt100k|number_format:0}</td>
                        <td class="text-right">{$row.urban_assets_100k_500k|number_format:0}</td>
                        <td class="text-right">{$row.urban_assets_500k_1m|number_format:0}</td>
                        <td class="text-right">{$row.urban_assets_gt1m|number_format:0}</td>
                        <!-- Rural -->
                        <td class="text-right">{$row.rural_total_assets|number_format:2}</td>
                        <td class="text-right">{$row.rural_assets_lt100k|number_format:0}</td>
                        <td class="text-right">{$row.rural_assets_100k_500k|number_format:0}</td>
                        <td class="text-right">{$row.rural_assets_500k_1m|number_format:0}</td>
                        <td class="text-right">{$row.rural_assets_gt1m|number_format:0}</td>
                        <!-- Total -->
                        <td class="text-right"><strong>{$row.total_assets|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$row.total_assets_lt100k|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_assets_100k_500k|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_assets_500k_1m|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_assets_gt1m|number_format:0}</strong></td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Country Totals</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Currency</th>
                        <th>Urban Assets</th>
                        <th>Rural Assets</th>
                        <th>Total Assets</th>
                        <th>CUs &lt;100K</th>
                        <th>CUs 100K-500K</th>
                        <th>CUs 500K-1M</th>
                        <th>CUs &gt;1M</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$country_totals key=country item=totals}
                    <tr>
                        <td><strong>{$country}</strong></td>
                        <td>{$totals.currency}</td>
                        <td class="text-right">{$totals.urban_total_assets|number_format:2}</td>
                        <td class="text-right">{$totals.rural_total_assets|number_format:2}</td>
                        <td class="text-right"><strong>{$totals.total_assets|number_format:2}</strong></td>
                        <td class="text-right">{$totals.total_assets_lt100k|number_format:0}</td>
                        <td class="text-right">{$totals.total_assets_100k_500k|number_format:0}</td>
                        <td class="text-right">{$totals.total_assets_500k_1m|number_format:0}</td>
                        <td class="text-right">{$totals.total_assets_gt1m|number_format:0}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file='footer.tpl'}
