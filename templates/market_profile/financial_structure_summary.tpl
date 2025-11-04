{include file='header.tpl'}

<div class="container-fluid">
    <h1>Financial Structure Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Financial Structure by Federation (in millions, local currency)</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Currency</th>
                        <th>Federation</th>
                        <th>Share</th>
                        <th>Savings/Deposits</th>
                        <th>Delinquency Loan</th>
                        <th>Loan Outstanding</th>
                        <th>Total Loan Granted</th>
                        <th>Total Reserved</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$financial_structure item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.currency}</td>
                        <td>{$row.federation_name}</td>
                        <td class="text-right">{$row.share_amount|number_format:2}</td>
                        <td class="text-right">{$row.savings_amount|number_format:2}</td>
                        <td class="text-right">{$row.delinquency_amount|number_format:2}</td>
                        <td class="text-right">{$row.loan_outstanding_amount|number_format:2}</td>
                        <td class="text-right">{$row.total_loan_granted_amount|number_format:2}</td>
                        <td class="text-right">{$row.total_reserved_amount|number_format:2}</td>
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
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Currency</th>
                        <th>Share</th>
                        <th>Savings/Deposits</th>
                        <th>Delinquency Loan</th>
                        <th>Loan Outstanding</th>
                        <th>Total Loan Granted</th>
                        <th>Total Reserved</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$country_totals key=country item=totals}
                    <tr>
                        <td><strong>{$country}</strong></td>
                        <td>{$totals.currency}</td>
                        <td class="text-right"><strong>{$totals.share_amount|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$totals.savings_amount|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$totals.delinquency_amount|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$totals.loan_outstanding_amount|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$totals.total_loan_granted_amount|number_format:2}</strong></td>
                        <td class="text-right"><strong>{$totals.total_reserved_amount|number_format:2}</strong></td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file='footer.tpl'}
