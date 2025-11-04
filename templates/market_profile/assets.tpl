{extends file='layout.tpl'}

{block name=content}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Assets of the CU Movement</h2>
            <div class="well well-sm">
                <strong>Federation:</strong> {$profile.federation_name} ({$profile.country_name})<br>
                <strong>Currency:</strong> {$profile.currency}<br>
                <p class="help-block">All figures in millions of {$profile.currency}</p>
            </div>
            <hr>

            <form method="POST" action="{$smarty.const.APP_PATH}/market_profile/{$profile.profile_id}/assets" class="form-horizontal">

                <h3>Urban CU Assets</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Assets</th>
                            <th>&lt; 100K</th>
                            <th>100K - 500K</th>
                            <th>500K - 1M</th>
                            <th>&gt; 1M</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" step="0.01" name="urban_total_assets" value="{$data.urban_total_assets|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_assets_lt100k" value="{$data.urban_assets_lt100k|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_assets_100k_500k" value="{$data.urban_assets_100k_500k|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_assets_500k_1m" value="{$data.urban_assets_500k_1m|default:0}" class="form-control" /></td>
                            <td><input type="number" name="urban_assets_gt1m" value="{$data.urban_assets_gt1m|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Rural CU Assets</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Assets</th>
                            <th>&lt; 100K</th>
                            <th>100K - 500K</th>
                            <th>500K - 1M</th>
                            <th>&gt; 1M</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="number" step="0.01" name="rural_total_assets" value="{$data.rural_total_assets|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_assets_lt100k" value="{$data.rural_assets_lt100k|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_assets_100k_500k" value="{$data.rural_assets_100k_500k|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_assets_500k_1m" value="{$data.rural_assets_500k_1m|default:0}" class="form-control" /></td>
                            <td><input type="number" name="rural_assets_gt1m" value="{$data.rural_assets_gt1m|default:0}" class="form-control" /></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Total Assets</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Assets</th>
                            <th>&lt; 100K</th>
                            <th>100K - 500K</th>
                            <th>500K - 1M</th>
                            <th>&gt; 1M</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="info">
                            <td><input type="number" step="0.01" name="total_assets" value="{$data.total_assets|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_assets_lt100k" value="{$data.total_assets_lt100k|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_assets_100k_500k" value="{$data.total_assets_100k_500k|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_assets_500k_1m" value="{$data.total_assets_500k_1m|default:0}" class="form-control" readonly /></td>
                            <td><input type="number" name="total_assets_gt1m" value="{$data.total_assets_gt1m|default:0}" class="form-control" readonly /></td>
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
    // Calculate total assets
    var urban_total = parseFloat($('input[name="urban_total_assets"]').val()) || 0;
    var rural_total = parseFloat($('input[name="rural_total_assets"]').val()) || 0;
    $('input[name="total_assets"]').val((urban_total + rural_total).toFixed(2));

    // Calculate asset categories
    var categories = ['lt100k', '100k_500k', '500k_1m', 'gt1m'];
    categories.forEach(function(cat) {
        var urban = parseInt($('input[name="urban_assets_' + cat + '"]').val()) || 0;
        var rural = parseInt($('input[name="rural_assets_' + cat + '"]').val()) || 0;
        $('input[name="total_assets_' + cat + '"]').val(urban + rural);
    });
}
</script>
{/block}
