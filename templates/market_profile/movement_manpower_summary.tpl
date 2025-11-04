{include file='header.tpl'}

<div class="container-fluid">
    <h1>Movement Manpower Summary - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">CU Movement Manpower by Federation</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">Country</th>
                        <th rowspan="2">Federation</th>
                        <th colspan="3" class="text-center" style="background-color: #d9edf7;">Elected Officers</th>
                        <th colspan="3" class="text-center" style="background-color: #dff0d8;">Senior Managers</th>
                        <th colspan="3" class="text-center" style="background-color: #fcf8e3;">Staff</th>
                    </tr>
                    <tr>
                        <th style="background-color: #d9edf7;">Male</th>
                        <th style="background-color: #d9edf7;">Female</th>
                        <th style="background-color: #d9edf7;">Total</th>
                        <th style="background-color: #dff0d8;">Male</th>
                        <th style="background-color: #dff0d8;">Female</th>
                        <th style="background-color: #dff0d8;">Total</th>
                        <th style="background-color: #fcf8e3;">Male</th>
                        <th style="background-color: #fcf8e3;">Female</th>
                        <th style="background-color: #fcf8e3;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$manpower item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.federation_name}</td>
                        <td class="text-right">{$row.elected_officers_male|number_format:0}</td>
                        <td class="text-right">{$row.elected_officers_female|number_format:0}</td>
                        <td class="text-right"><strong>{$row.elected_officers_total|number_format:0}</strong></td>
                        <td class="text-right">{$row.senior_managers_male|number_format:0}</td>
                        <td class="text-right">{$row.senior_managers_female|number_format:0}</td>
                        <td class="text-right"><strong>{$row.senior_managers_total|number_format:0}</strong></td>
                        <td class="text-right">{$row.staff_male|number_format:0}</td>
                        <td class="text-right">{$row.staff_female|number_format:0}</td>
                        <td class="text-right"><strong>{$row.staff_total|number_format:0}</strong></td>
                    </tr>
                    {/foreach}
                </tbody>
                <tfoot>
                    <tr class="success" style="font-weight: bold;">
                        <td colspan="2">GRAND TOTAL</td>
                        <td class="text-right">{$totals.elected_officers_male|number_format:0}</td>
                        <td class="text-right">{$totals.elected_officers_female|number_format:0}</td>
                        <td class="text-right">{$totals.elected_officers_total|number_format:0}</td>
                        <td class="text-right">{$totals.senior_managers_male|number_format:0}</td>
                        <td class="text-right">{$totals.senior_managers_female|number_format:0}</td>
                        <td class="text-right">{$totals.senior_managers_total|number_format:0}</td>
                        <td class="text-right">{$totals.staff_male|number_format:0}</td>
                        <td class="text-right">{$totals.staff_female|number_format:0}</td>
                        <td class="text-right">{$totals.staff_total|number_format:0}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Gender Distribution</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="well text-center">
                        <h3>{($totals.elected_officers_male + $totals.senior_managers_male + $totals.staff_male)|number_format:0}</h3>
                        <p>Total Male</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well text-center">
                        <h3>{($totals.elected_officers_female + $totals.senior_managers_female + $totals.staff_female)|number_format:0}</h3>
                        <p>Total Female</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well text-center">
                        <h3>{($totals.elected_officers_total + $totals.senior_managers_total + $totals.staff_total)|number_format:0}</h3>
                        <p>Total Personnel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}
