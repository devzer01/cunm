{include file='header.tpl'}

<div class="container-fluid">
    <h1>CU Memberships Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Credit Unions and Memberships by Federation</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table table-bordered table-striped table-condensed" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th rowspan="2">Country</th>
                        <th rowspan="2">Federation</th>
                        <th colspan="7" class="text-center" style="background-color: #d9edf7;">Urban CUs</th>
                        <th colspan="7" class="text-center" style="background-color: #dff0d8;">Rural CUs</th>
                        <th colspan="7" class="text-center" style="background-color: #fcf8e3;">Total</th>
                        <th rowspan="2">CUMI</th>
                    </tr>
                    <tr>
                        <!-- Urban -->
                        <th style="background-color: #d9edf7;">CUs</th>
                        <th style="background-color: #d9edf7;">Members</th>
                        <th style="background-color: #d9edf7;">&lt;300</th>
                        <th style="background-color: #d9edf7;">301-1K</th>
                        <th style="background-color: #d9edf7;">1K-3K</th>
                        <th style="background-color: #d9edf7;">3K-5K</th>
                        <th style="background-color: #d9edf7;">&gt;5K</th>
                        <!-- Rural -->
                        <th style="background-color: #dff0d8;">CUs</th>
                        <th style="background-color: #dff0d8;">Members</th>
                        <th style="background-color: #dff0d8;">&lt;300</th>
                        <th style="background-color: #dff0d8;">301-1K</th>
                        <th style="background-color: #dff0d8;">1K-3K</th>
                        <th style="background-color: #dff0d8;">3K-5K</th>
                        <th style="background-color: #dff0d8;">&gt;5K</th>
                        <!-- Total -->
                        <th style="background-color: #fcf8e3;">CUs</th>
                        <th style="background-color: #fcf8e3;">Members</th>
                        <th style="background-color: #fcf8e3;">&lt;300</th>
                        <th style="background-color: #fcf8e3;">301-1K</th>
                        <th style="background-color: #fcf8e3;">1K-3K</th>
                        <th style="background-color: #fcf8e3;">3K-5K</th>
                        <th style="background-color: #fcf8e3;">&gt;5K</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$memberships item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.federation_name}</td>
                        <!-- Urban -->
                        <td class="text-right">{$row.urban_cu|number_format:0}</td>
                        <td class="text-right">{$row.urban_members|number_format:0}</td>
                        <td class="text-right">{$row.urban_lt300|number_format:0}</td>
                        <td class="text-right">{$row.urban_301_1000|number_format:0}</td>
                        <td class="text-right">{$row.urban_1001_3000|number_format:0}</td>
                        <td class="text-right">{$row.urban_3001_5000|number_format:0}</td>
                        <td class="text-right">{$row.urban_gt5000|number_format:0}</td>
                        <!-- Rural -->
                        <td class="text-right">{$row.rural_cu|number_format:0}</td>
                        <td class="text-right">{$row.rural_members|number_format:0}</td>
                        <td class="text-right">{$row.rural_lt300|number_format:0}</td>
                        <td class="text-right">{$row.rural_301_1000|number_format:0}</td>
                        <td class="text-right">{$row.rural_1001_3000|number_format:0}</td>
                        <td class="text-right">{$row.rural_3001_5000|number_format:0}</td>
                        <td class="text-right">{$row.rural_gt5000|number_format:0}</td>
                        <!-- Total -->
                        <td class="text-right"><strong>{$row.total_cu|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_members|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_lt300|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_301_1000|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_1001_3000|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_3001_5000|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_gt5000|number_format:0}</strong></td>
                        <!-- CUMI -->
                        <td class="text-right">{$row.cus_microfinance|number_format:0}</td>
                    </tr>
                    {/foreach}
                </tbody>
                <tfoot>
                    <tr class="success" style="font-weight: bold;">
                        <td colspan="2">GRAND TOTAL</td>
                        <!-- Urban -->
                        <td class="text-right">{$totals.urban_cu|number_format:0}</td>
                        <td class="text-right">{$totals.urban_members|number_format:0}</td>
                        <td class="text-right">{$totals.urban_lt300|number_format:0}</td>
                        <td class="text-right">{$totals.urban_301_1000|number_format:0}</td>
                        <td class="text-right">{$totals.urban_1001_3000|number_format:0}</td>
                        <td class="text-right">{$totals.urban_3001_5000|number_format:0}</td>
                        <td class="text-right">{$totals.urban_gt5000|number_format:0}</td>
                        <!-- Rural -->
                        <td class="text-right">{$totals.rural_cu|number_format:0}</td>
                        <td class="text-right">{$totals.rural_members|number_format:0}</td>
                        <td class="text-right">{$totals.rural_lt300|number_format:0}</td>
                        <td class="text-right">{$totals.rural_301_1000|number_format:0}</td>
                        <td class="text-right">{$totals.rural_1001_3000|number_format:0}</td>
                        <td class="text-right">{$totals.rural_3001_5000|number_format:0}</td>
                        <td class="text-right">{$totals.rural_gt5000|number_format:0}</td>
                        <!-- Total -->
                        <td class="text-right">{$totals.total_cu|number_format:0}</td>
                        <td class="text-right">{$totals.total_members|number_format:0}</td>
                        <td class="text-right">{$totals.total_lt300|number_format:0}</td>
                        <td class="text-right">{$totals.total_301_1000|number_format:0}</td>
                        <td class="text-right">{$totals.total_1001_3000|number_format:0}</td>
                        <td class="text-right">{$totals.total_3001_5000|number_format:0}</td>
                        <td class="text-right">{$totals.total_gt5000|number_format:0}</td>
                        <!-- CUMI -->
                        <td class="text-right">{$totals.cus_microfinance|number_format:0}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Summary Statistics</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="well text-center">
                        <h3>{$totals.total_cu|number_format:0}</h3>
                        <p>Total Credit Unions</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well text-center">
                        <h3>{$totals.total_members|number_format:0}</h3>
                        <p>Total Members</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well text-center">
                        <h3>{($totals.total_members / $totals.total_cu)|number_format:0}</h3>
                        <p>Avg Members per CU</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well text-center">
                        <h3>{$totals.cus_microfinance|number_format:0}</h3>
                        <p>CUs with CUMI</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}
