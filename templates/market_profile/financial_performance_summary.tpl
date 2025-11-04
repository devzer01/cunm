{include file='header.tpl'}

<div class="container-fluid">
    <h1>Financial Performance Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Financial Performance Comparison (2024 vs 2025)</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto; font-size: 11px;">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th rowspan="2">Country</th>
                        <th rowspan="2">Currency</th>
                        <th rowspan="2">Federation</th>
                        <th colspan="3" class="text-center" style="background-color: #d9edf7; color: #000;">Assets</th>
                        <th colspan="3" class="text-center" style="background-color: #dff0d8; color: #000;">Loans Outstanding</th>
                        <th colspan="3" class="text-center" style="background-color: #fcf8e3; color: #000;">Share Capital</th>
                        <th colspan="3" class="text-center" style="background-color: #f2dede; color: #000;">NPL</th>
                    </tr>
                    <tr>
                        <th style="background-color: #d9edf7; color: #000;">2024</th>
                        <th style="background-color: #d9edf7; color: #000;">2025</th>
                        <th style="background-color: #d9edf7; color: #000;">% Δ</th>
                        <th style="background-color: #dff0d8; color: #000;">2024</th>
                        <th style="background-color: #dff0d8; color: #000;">2025</th>
                        <th style="background-color: #dff0d8; color: #000;">% Δ</th>
                        <th style="background-color: #fcf8e3; color: #000;">2024</th>
                        <th style="background-color: #fcf8e3; color: #000;">2025</th>
                        <th style="background-color: #fcf8e3; color: #000;">% Δ</th>
                        <th style="background-color: #f2dede; color: #000;">2024</th>
                        <th style="background-color: #f2dede; color: #000;">2025</th>
                        <th style="background-color: #f2dede; color: #000;">% Δ</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$financial_performance item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.currency}</td>
                        <td>{$row.federation_name}</td>
                        <!-- Assets -->
                        <td class="text-right">{$row.assets_2024|number_format:2}</td>
                        <td class="text-right">{$row.assets_2025|number_format:2}</td>
                        <td class="text-right {if $row.assets_increase > 0}text-success{elseif $row.assets_increase < 0}text-danger{/if}">
                            {$row.assets_increase|number_format:2}%
                        </td>
                        <!-- Loans -->
                        <td class="text-right">{$row.loans_outstanding_2024|number_format:2}</td>
                        <td class="text-right">{$row.loans_outstanding_2025|number_format:2}</td>
                        <td class="text-right {if $row.loans_outstanding_increase > 0}text-success{elseif $row.loans_outstanding_increase < 0}text-danger{/if}">
                            {$row.loans_outstanding_increase|number_format:2}%
                        </td>
                        <!-- Share Capital -->
                        <td class="text-right">{$row.share_capital_2024|number_format:2}</td>
                        <td class="text-right">{$row.share_capital_2025|number_format:2}</td>
                        <td class="text-right {if $row.share_capital_increase > 0}text-success{elseif $row.share_capital_increase < 0}text-danger{/if}">
                            {$row.share_capital_increase|number_format:2}%
                        </td>
                        <!-- NPL -->
                        <td class="text-right">{$row.npl_2024|number_format:2}</td>
                        <td class="text-right">{$row.npl_2025|number_format:2}</td>
                        <td class="text-right {if $row.npl_increase < 0}text-success{elseif $row.npl_increase > 0}text-danger{/if}">
                            {$row.npl_increase|number_format:2}%
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file='footer.tpl'}
