{include file='header.tpl'}

<div class="container-fluid">
    <h1>Individual Members Demographics - {$year}</h1>
    <p>
        <a href="{$smarty.const.APP_PATH}/market_profile/year/{$year}" class="btn btn-default">
            <i class="glyphicon glyphicon-arrow-left"></i> Back to Overview
        </a>
    </p>
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Individual Members by Area, Gender, and Age</h3>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table table-bordered table-striped table-condensed" style="font-size: 11px;">
                <thead>
                    <tr>
                        <th rowspan="2">Country</th>
                        <th rowspan="2">Federation</th>
                        <th colspan="7" class="text-center" style="background-color: #d9edf7; color: #000;">Urban Members</th>
                        <th colspan="7" class="text-center" style="background-color: #dff0d8; color: #000;">Rural Members</th>
                        <th colspan="7" class="text-center" style="background-color: #fcf8e3; color: #000;">Total</th>
                    </tr>
                    <tr>
                        <!-- Urban -->
                        <th style="background-color: #d9edf7; color: #000;">Total</th>
                        <th style="background-color: #d9edf7; color: #000;">Male</th>
                        <th style="background-color: #d9edf7; color: #000;">Female</th>
                        <th style="background-color: #d9edf7; color: #000;">&lt;20</th>
                        <th style="background-color: #d9edf7; color: #000;">20-40</th>
                        <th style="background-color: #d9edf7; color: #000;">40-60</th>
                        <th style="background-color: #d9edf7; color: #000;">&gt;60</th>
                        <!-- Rural -->
                        <th style="background-color: #dff0d8; color: #000;">Total</th>
                        <th style="background-color: #dff0d8; color: #000;">Male</th>
                        <th style="background-color: #dff0d8; color: #000;">Female</th>
                        <th style="background-color: #dff0d8; color: #000;">&lt;20</th>
                        <th style="background-color: #dff0d8; color: #000;">20-40</th>
                        <th style="background-color: #dff0d8; color: #000;">40-60</th>
                        <th style="background-color: #dff0d8; color: #000;">&gt;60</th>
                        <!-- Total -->
                        <th style="background-color: #fcf8e3; color: #000;">Total</th>
                        <th style="background-color: #fcf8e3; color: #000;">Male</th>
                        <th style="background-color: #fcf8e3; color: #000;">Female</th>
                        <th style="background-color: #fcf8e3; color: #000;">&lt;20</th>
                        <th style="background-color: #fcf8e3; color: #000;">20-40</th>
                        <th style="background-color: #fcf8e3; color: #000;">40-60</th>
                        <th style="background-color: #fcf8e3; color: #000;">&gt;60</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$individual_members item=row}
                    <tr>
                        <td>{$row.country_name}</td>
                        <td>{$row.federation_name}</td>
                        <!-- Urban -->
                        <td class="text-right">{$row.urban_ind_members|number_format:0}</td>
                        <td class="text-right">{$row.urban_male|number_format:0}</td>
                        <td class="text-right">{$row.urban_female|number_format:0}</td>
                        <td class="text-right">{$row.urban_age_lt20|number_format:0}</td>
                        <td class="text-right">{$row.urban_age_20_40|number_format:0}</td>
                        <td class="text-right">{$row.urban_age_40_60|number_format:0}</td>
                        <td class="text-right">{$row.urban_age_gt60|number_format:0}</td>
                        <!-- Rural -->
                        <td class="text-right">{$row.rural_ind_members|number_format:0}</td>
                        <td class="text-right">{$row.rural_male|number_format:0}</td>
                        <td class="text-right">{$row.rural_female|number_format:0}</td>
                        <td class="text-right">{$row.rural_age_lt20|number_format:0}</td>
                        <td class="text-right">{$row.rural_age_20_40|number_format:0}</td>
                        <td class="text-right">{$row.rural_age_40_60|number_format:0}</td>
                        <td class="text-right">{$row.rural_age_gt60|number_format:0}</td>
                        <!-- Total -->
                        <td class="text-right"><strong>{$row.total_ind_members|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_male|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_female|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_age_lt20|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_age_20_40|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_age_40_60|number_format:0}</strong></td>
                        <td class="text-right"><strong>{$row.total_age_gt60|number_format:0}</strong></td>
                    </tr>
                    {/foreach}
                </tbody>
                <tfoot>
                    <tr class="success" style="font-weight: bold;">
                        <td colspan="2">GRAND TOTAL</td>
                        <!-- Urban -->
                        <td class="text-right">{$totals.urban_ind_members|number_format:0}</td>
                        <td class="text-right">{$totals.urban_male|number_format:0}</td>
                        <td class="text-right">{$totals.urban_female|number_format:0}</td>
                        <td class="text-right">{$totals.urban_age_lt20|number_format:0}</td>
                        <td class="text-right">{$totals.urban_age_20_40|number_format:0}</td>
                        <td class="text-right">{$totals.urban_age_40_60|number_format:0}</td>
                        <td class="text-right">{$totals.urban_age_gt60|number_format:0}</td>
                        <!-- Rural -->
                        <td class="text-right">{$totals.rural_ind_members|number_format:0}</td>
                        <td class="text-right">{$totals.rural_male|number_format:0}</td>
                        <td class="text-right">{$totals.rural_female|number_format:0}</td>
                        <td class="text-right">{$totals.rural_age_lt20|number_format:0}</td>
                        <td class="text-right">{$totals.rural_age_20_40|number_format:0}</td>
                        <td class="text-right">{$totals.rural_age_40_60|number_format:0}</td>
                        <td class="text-right">{$totals.rural_age_gt60|number_format:0}</td>
                        <!-- Total -->
                        <td class="text-right">{$totals.total_ind_members|number_format:0}</td>
                        <td class="text-right">{$totals.total_male|number_format:0}</td>
                        <td class="text-right">{$totals.total_female|number_format:0}</td>
                        <td class="text-right">{$totals.total_age_lt20|number_format:0}</td>
                        <td class="text-right">{$totals.total_age_20_40|number_format:0}</td>
                        <td class="text-right">{$totals.total_age_40_60|number_format:0}</td>
                        <td class="text-right">{$totals.total_age_gt60|number_format:0}</td>
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
                        <h3>{$totals.total_ind_members|number_format:0}</h3>
                        <p>Total Individual Members</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well text-center" style="background-color: #d9edf7; color: #000;">
                        <h3>{$totals.total_male|number_format:0}</h3>
                        <p>Male ({(($totals.total_male / $totals.total_ind_members) * 100)|number_format:1}%)</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well text-center" style="background-color: #f9d5e5; color: #000;">
                        <h3>{$totals.total_female|number_format:0}</h3>
                        <p>Female ({(($totals.total_female / $totals.total_ind_members) * 100)|number_format:1}%)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}
