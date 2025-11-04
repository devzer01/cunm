{extends file='layout.tpl'}

{block name=content}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Country Profile</h2>
            <div class="well well-sm">
                <strong>Federation:</strong> {$profile.federation_name}<br>
                <strong>Country:</strong> {$profile.country_name}
            </div>
            <hr>

            <form method="POST" action="{$smarty.const.APP_PATH}/market_profile/{$profile.profile_id}/country_profile" class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-4 control-label">Population (2024)</label>
                    <div class="col-sm-6">
                        <input type="number" name="population_2024" value="{$data.population_2024|default:''}"
                               class="form-control" placeholder="e.g., 50000000" />
                        <p class="help-block">Total population of the country</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">GDP (USD)</label>
                    <div class="col-sm-6">
                        <input type="text" name="gdp_usd" value="{$data.gdp_usd|default:''}"
                               class="form-control" placeholder="e.g., $100 billion" />
                        <p class="help-block">Gross Domestic Product in US Dollars</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">GDP per Capita (USD)</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" name="gdp_per_capita_usd" value="{$data.gdp_per_capita_usd|default:''}"
                               class="form-control" placeholder="e.g., 2000.00" />
                        <p class="help-block">GDP per capita in US Dollars</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Local Currency</label>
                    <div class="col-sm-6">
                        <input type="text" name="local_currency" value="{$data.local_currency|default:$profile.currency}"
                               class="form-control" placeholder="e.g., THB, PHP, INR" />
                        <p class="help-block">Currency code (3 letters)</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Exchange Rate (December 2024)</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">1 USD =</span>
                            <input type="number" step="0.0001" name="exchange_rate_dec_2024"
                                   value="{$data.exchange_rate_dec_2024|default:''}"
                                   class="form-control" placeholder="e.g., 35.5000" />
                            <span class="input-group-addon">{$profile.currency}</span>
                        </div>
                        <p class="help-block">Exchange rate: 1 USD to local currency</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">CU Penetration</label>
                    <div class="col-sm-6">
                        <input type="text" name="cu_penetration" value="{$data.cu_penetration|default:''}"
                               class="form-control" placeholder="e.g., 5.2% or 5.2 million members" />
                        <p class="help-block">Credit union penetration rate or member count</p>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="glyphicon glyphicon-save"></i> Save Country Profile
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
{/block}
