{include file='header.tpl'}

<div class="container-fluid">
    <h1>Federation Information Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Federation Membership Information</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Federation</th>
                        <th>Reg. Date</th>
                        <th>Member CUs<br>(Total)</th>
                        <th>Member CUs<br>(Active)</th>
                        <th>Individual<br>Members</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Membership<br>Growth</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$federation_info item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.fed_name}</td>
                        <td>{$row.reg_date|date_format:'%Y-%m-%d'}</td>
                        <td class="text-right">{$row.total_member_cus|number_format:0}</td>
                        <td class="text-right">{$row.active_member_cus|number_format:0}</td>
                        <td class="text-right">{$row.ind_member_total|number_format:0}</td>
                        <td class="text-right">{$row.ind_member_male|number_format:0}</td>
                        <td class="text-right">{$row.ind_member_female|number_format:0}</td>
                        <td>{$row.membership_growth}</td>
                    </tr>
                    {/foreach}
                </tbody>
                <tfoot>
                    <tr class="success" style="font-weight: bold;">
                        <td colspan="3">GRAND TOTAL</td>
                        <td class="text-right">{$totals.total_member_cus|number_format:0}</td>
                        <td class="text-right">{$totals.active_member_cus|number_format:0}</td>
                        <td class="text-right">{$totals.ind_member_total|number_format:0}</td>
                        <td class="text-right">{$totals.ind_member_male|number_format:0}</td>
                        <td class="text-right">{$totals.ind_member_female|number_format:0}</td>
                        <td>-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{include file='footer.tpl'}
