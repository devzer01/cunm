{extends file='layout.tpl'}

{block name=content}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Credit Unions and Memberships</h2>
            <div class="well well-sm">
                <strong>Federation:</strong> {$profile.federation_name} ({$profile.country_name})<br>
                <strong>Currency:</strong> {$profile.currency}
            </div>
            <hr>

            <form method="POST" action="{$smarty.const.APP_PATH}/market_profile/{$profile.profile_id}/memberships" class="form-horizontal">

                <h3>Urban Credit Unions</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total CUs</th>
                            <th>Total Members</th>
                            <th>&lt; 300</th>
                            <th>301-1000</th>
                            <th>1001-3000</th>
                            <th>3001-5000</th>
                            <th>&gt; 5000</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="urban_cu" value="{$data.urban_cu|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_members" value="{$data.urban_members|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_lt300" value="{$data.urban_lt300|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_301_1000" value="{$data.urban_301_1000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_1001_3000" value="{$data.urban_1001_3000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_3001_5000" value="{$data.urban_3001_5000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_gt5000" value="{$data.urban_gt5000|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Rural Credit Unions</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total CUs</th>
                            <th>Total Members</th>
                            <th>&lt; 300</th>
                            <th>301-1000</th>
                            <th>1001-3000</th>
                            <th>3001-5000</th>
                            <th>&gt; 5000</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="rural_cu" value="{$data.rural_cu|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_members" value="{$data.rural_members|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_lt300" value="{$data.rural_lt300|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_301_1000" value="{$data.rural_301_1000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_1001_3000" value="{$data.rural_1001_3000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_3001_5000" value="{$data.rural_3001_5000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_gt5000" value="{$data.rural_gt5000|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Total</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total CUs</th>
                            <th>Total Members</th>
                            <th>&lt; 300</th>
                            <th>301-1000</th>
                            <th>1001-3000</th>
                            <th>3001-5000</th>
                            <th>&gt; 5000</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" name="total_cu" value="{$data.total_cu|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_members" value="{$data.total_members|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_lt300" value="{$data.total_lt300|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_301_1000" value="{$data.total_301_1000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_1001_3000" value="{$data.total_1001_3000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_3001_5000" value="{$data.total_3001_5000|default:0}" class="form-control" /></td>
                            <td><input type="number" name="total_gt5000" value="{$data.total_gt5000|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Number of CUs Implementing Microfinance (CUMI)</label>
                    <div class="col-sm-4">
                        <input type="number" name="cus_microfinance" value="{$data.cus_microfinance|default:0}" class="form-control" />
                    </div>
                </div>

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
    // Calculate total CUs
    var urban_cu = parseInt($('input[name="urban_cu"]').val()) || 0;
    var rural_cu = parseInt($('input[name="rural_cu"]').val()) || 0;
    $('input[name="total_cu"]').val(urban_cu + rural_cu);

    // Calculate total members
    var urban_members = parseInt($('input[name="urban_members"]').val()) || 0;
    var rural_members = parseInt($('input[name="rural_members"]').val()) || 0;
    $('input[name="total_members"]').val(urban_members + rural_members);

    // Calculate size categories
    var categories = ['lt300', '301_1000', '1001_3000', '3001_5000', 'gt5000'];
    categories.forEach(function(cat) {
        var urban = parseInt($('input[name="urban_' + cat + '"]').val()) || 0;
        var rural = parseInt($('input[name="rural_' + cat + '"]').val()) || 0;
        $('input[name="total_' + cat + '"]').val(urban + rural);
    });
}
</script>
{/block}
