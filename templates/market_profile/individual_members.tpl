{extends file='layout.tpl'}

{block name=content}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Individual Members Demographics</h2>
            <div class="well well-sm">
                <strong>Federation:</strong> {$profile.federation_name} ({$profile.country_name})<br>
                <p class="help-block">Based on Area, Age, and Gender</p>
            </div>
            <hr>

            <form method="POST" action="{$smarty.const.APP_PATH}/market_profile/{$profile.profile_id}/individual_members" class="form-horizontal">

                <h3>Urban Members</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Members</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>&lt; 20</th>
                            <th>20-40</th>
                            <th>40-60</th>
                            <th>&gt; 60</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="urban_ind_members" value="{$data.urban_ind_members|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_male" value="{$data.urban_male|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_female" value="{$data.urban_female|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_age_lt20" value="{$data.urban_age_lt20|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_age_20_40" value="{$data.urban_age_20_40|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_age_40_60" value="{$data.urban_age_40_60|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_age_gt60" value="{$data.urban_age_gt60|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Rural Members</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Members</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>&lt; 20</th>
                            <th>20-40</th>
                            <th>40-60</th>
                            <th>&gt; 60</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="rural_ind_members" value="{$data.rural_ind_members|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_male" value="{$data.rural_male|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_female" value="{$data.rural_female|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_age_lt20" value="{$data.rural_age_lt20|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_age_20_40" value="{$data.rural_age_20_40|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_age_40_60" value="{$data.rural_age_40_60|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_age_gt60" value="{$data.rural_age_gt60|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Total</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Members</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>&lt; 20</th>
                            <th>20-40</th>
                            <th>40-60</th>
                            <th>&gt; 60</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="total_ind_members" value="{$data.total_ind_members|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_male" value="{$data.total_male|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_female" value="{$data.total_female|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_age_lt20" value="{$data.total_age_lt20|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_age_20_40" value="{$data.total_age_20_40|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_age_40_60" value="{$data.total_age_40_60|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_age_gt60" value="{$data.total_age_gt60|default:0}" class="form-control" readonly /></td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="glyphicon glyphicon-save"></i> Save Data
                        </button>
                        <a href="{$smarty.const.APP_PATH}/market_profile/edit/{$profile.profile_id}" class="btn btn-default">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-calculate totals
$(document).ready(function() {
    $('input[name^="urban_"], input[name^="rural_"]').on('change', function() {
        calculateTotals();
    });
});

function calculateTotals() {
    var fields = ['ind_members', 'male', 'female', 'age_lt20', 'age_20_40', 'age_40_60', 'age_gt60'];
    fields.forEach(function(field) {
        var urban = parseInt($('input[name="urban_' + field + '"]').val()) || 0;
        var rural = parseInt($('input[name="rural_' + field + '"]').val()) || 0;
        $('input[name="total_' + field + '"]').val(urban + rural);
    });
}
</script>
{/block}
