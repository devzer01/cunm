{include file="headerv2.tpl"}
{debug}
<div class="container">
    <h1>Credit Union Market Profile (Regular & Affiliate Member)</h1>
    <p class="subtitle">As of December 31, 2025</p>

    <div class="view-actions" style="margin-bottom: 20px; text-align: right;">
        <a href="/federation/cu-market-profile/list" class="btn btn-secondary">Back to List</a>
        <a href="/federation/cu-market-profile/edit/{$profile.profile_id}" class="btn btn-primary">Edit</a>
    </div>

    <div id="cuMarketProfileView">
        <!-- Organization Information -->
        <div class="form-group">
            <h2>Organization Information</h2>
            <div class="info-row">
                <div class="info-item">
                    <label>Organization Name:</label>
                    <div class="info-value">{$profile.organization_name|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Address:</label>
                    <div class="info-value">{$profile.address|nl2br|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Telephone:</label>
                    <div class="info-value">{$profile.telephone|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Fax:</label>
                    <div class="info-value">{$profile.fax|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Email:</label>
                    <div class="info-value">{$profile.email|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Website:</label>
                    <div class="info-value">
                        {if $profile.website}
                            <a href="{$profile.website}" target="_blank">{$profile.website}</a>
                        {else}
                            -
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- Country Profile -->
        <h2>Country Profile</h2>
        <table class="view-table">
            <tr>
                <th style="width: 40%;">Item</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Population as of 2024</td>
                <td>{$country_profile.population_2024|number_format|default:'-'}</td>
            </tr>
            <tr>
                <td>GDP (US$)</td>
                <td>{$country_profile.gdp_usd|default:'-'}</td>
            </tr>
            <tr>
                <td>GDP per Capita US$</td>
                <td>{if $country_profile.gdp_per_capita_usd}${$country_profile.gdp_per_capita_usd|number_format:2}{else}-{/if}</td>
            </tr>
            <tr>
                <td>Name of the Local Currency</td>
                <td>{$country_profile.local_currency|default:'-'}</td>
            </tr>
            <tr>
                <td>Exchange Rate as of December 2024</td>
                <td>{$country_profile.exchange_rate_dec_2024|default:'-'}</td>
            </tr>
            <tr>
                <td>CU Penetration</td>
                <td>{$country_profile.cu_penetration|default:'-'}</td>
            </tr>
        </table>

        <!-- Section A: Credit Union Movement Level -->
        <h2>A: CREDIT UNION MOVEMENT LEVEL</h2>

        <!-- 1) Credit Unions and Memberships -->
        <h3>1) Credit Unions and Memberships</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th rowspan="2">Type of CU</th>
                <th rowspan="2">Credit Unions</th>
                <th rowspan="2">No of Members</th>
                <th colspan="5">Classification based on Membership</th>
            </tr>
            <tr>
                <th>&lt; 300 Members</th>
                <th>301-1000 Members</th>
                <th>1001-3000 Members</th>
                <th>3001-5000 Members</th>
                <th>5000 above Members</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Urban</strong></td>
                <td>{$memberships.urban_cu|default:'0'}</td>
                <td>{$memberships.urban_members|number_format|default:'0'}</td>
                <td>{$memberships.urban_lt300|default:'0'}</td>
                <td>{$memberships.urban_301_1000|default:'0'}</td>
                <td>{$memberships.urban_1001_3000|default:'0'}</td>
                <td>{$memberships.urban_3001_5000|default:'0'}</td>
                <td>{$memberships.urban_gt5000|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Rural</strong></td>
                <td>{$memberships.rural_cu|default:'0'}</td>
                <td>{$memberships.rural_members|number_format|default:'0'}</td>
                <td>{$memberships.rural_lt300|default:'0'}</td>
                <td>{$memberships.rural_301_1000|default:'0'}</td>
                <td>{$memberships.rural_1001_3000|default:'0'}</td>
                <td>{$memberships.rural_3001_5000|default:'0'}</td>
                <td>{$memberships.rural_gt5000|default:'0'}</td>
            </tr>
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td><strong>Total</strong></td>
                <td>{$memberships.total_cu|default:'0'}</td>
                <td>{$memberships.total_members|number_format|default:'0'}</td>
                <td>{$memberships.total_lt300|default:'0'}</td>
                <td>{$memberships.total_301_1000|default:'0'}</td>
                <td>{$memberships.total_1001_3000|default:'0'}</td>
                <td>{$memberships.total_3001_5000|default:'0'}</td>
                <td>{$memberships.total_gt5000|default:'0'}</td>
            </tr>
            </tbody>
        </table>

        <!-- 2) CUs in Microfinance-Business -->
        <h3>2) CUs in Microfinance-Business</h3>
        <div class="info-item">
            <label>Number of CUs in Microfinance-Business:</label>
            <div class="info-value">{$memberships.cus_microfinance|default:'0'}</div>
        </div>

        <!-- 3) Individual Members: Based on the Area, Age, and sex -->
        <h3>3) Individual Members: Based on the Area, Age, and sex</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th>Type of CU</th>
                <th>No of Members</th>
                <th>Male</th>
                <th>Female</th>
                <th colspan="4">Age Segment of CU Membership</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>&lt; 20</th>
                <th>20-40</th>
                <th>40-60</th>
                <th>60 &gt;</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Urban</strong></td>
                <td>{$individual_members.urban_ind_members|number_format|default:'0'}</td>
                <td>{$individual_members.urban_male|number_format|default:'0'}</td>
                <td>{$individual_members.urban_female|number_format|default:'0'}</td>
                <td>{$individual_members.urban_age_lt20|number_format|default:'0'}</td>
                <td>{$individual_members.urban_age_20_40|number_format|default:'0'}</td>
                <td>{$individual_members.urban_age_40_60|number_format|default:'0'}</td>
                <td>{$individual_members.urban_age_gt60|number_format|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Rural</strong></td>
                <td>{$individual_members.rural_ind_members|number_format|default:'0'}</td>
                <td>{$individual_members.rural_male|number_format|default:'0'}</td>
                <td>{$individual_members.rural_female|number_format|default:'0'}</td>
                <td>{$individual_members.rural_age_lt20|number_format|default:'0'}</td>
                <td>{$individual_members.rural_age_20_40|number_format|default:'0'}</td>
                <td>{$individual_members.rural_age_40_60|number_format|default:'0'}</td>
                <td>{$individual_members.rural_age_gt60|number_format|default:'0'}</td>
            </tr>
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td><strong>Total Number</strong></td>
                <td>{$individual_members.total_ind_members|number_format|default:'0'}</td>
                <td>{$individual_members.total_male|number_format|default:'0'}</td>
                <td>{$individual_members.total_female|number_format|default:'0'}</td>
                <td>{$individual_members.total_age_lt20|number_format|default:'0'}</td>
                <td>{$individual_members.total_age_20_40|number_format|default:'0'}</td>
                <td>{$individual_members.total_age_40_60|number_format|default:'0'}</td>
                <td>{$individual_members.total_age_gt60|number_format|default:'0'}</td>
            </tr>
            </tbody>
        </table>

        <!-- 4) Assets of the CU Movement -->
        <h3>4) Assets of the CU Movement (aggregated figures of the credit union members)</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th>Type of CU</th>
                <th>Total Assets US$</th>
                <th colspan="4">Assets Group US$</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>&lt; 100,000</th>
                <th>100,001 - 500,000</th>
                <th>500,001 - 1,000,000</th>
                <th>1,000,000 &gt;</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Urban</strong></td>
                <td>${$assets.urban_total_assets|number_format:2|default:'0.00'}</td>
                <td>{$assets.urban_assets_lt100k|default:'0'}</td>
                <td>{$assets.urban_assets_100k_500k|default:'0'}</td>
                <td>{$assets.urban_assets_500k_1m|default:'0'}</td>
                <td>{$assets.urban_assets_gt1m|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Rural</strong></td>
                <td>${$assets.rural_total_assets|number_format:2|default:'0.00'}</td>
                <td>{$assets.rural_assets_lt100k|default:'0'}</td>
                <td>{$assets.rural_assets_100k_500k|default:'0'}</td>
                <td>{$assets.rural_assets_500k_1m|default:'0'}</td>
                <td>{$assets.rural_assets_gt1m|default:'0'}</td>
            </tr>
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td><strong>Total</strong></td>
                <td>${$assets.total_assets|number_format:2|default:'0.00'}</td>
                <td>{$assets.total_assets_lt100k|default:'0'}</td>
                <td>{$assets.total_assets_100k_500k|default:'0'}</td>
                <td>{$assets.total_assets_500k_1m|default:'0'}</td>
                <td>{$assets.total_assets_gt1m|default:'0'}</td>
            </tr>
            </tbody>
        </table>

        <!-- 5) Financial Structure of the Movement -->
        <h3>5) Financial Structure of the Movement (aggregated figures of the credit union members)</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th>Type of CU</th>
                <th>Amount in US$</th>
                <th colspan="4">Usage of Services US$</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Male</th>
                <th>Female</th>
                <th>Youth</th>
                <th>Non-Members</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Share</strong></td>
                <td>${$financial_structure.share_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.share_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.share_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.share_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.share_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            <tr>
                <td><strong>Savings/Other Deposits</strong></td>
                <td>${$financial_structure.savings_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.savings_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.savings_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.savings_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.savings_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            <tr>
                <td><strong>Delinquency Loan</strong></td>
                <td>${$financial_structure.delinquency_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.delinquency_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.delinquency_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.delinquency_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.delinquency_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            <tr>
                <td><strong>Loan Outstanding</strong></td>
                <td>${$financial_structure.loan_outstanding_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.loan_outstanding_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.loan_outstanding_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.loan_outstanding_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.loan_outstanding_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            <tr>
                <td><strong>Total Loan Granted</strong></td>
                <td>${$financial_structure.total_loan_granted_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_loan_granted_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_loan_granted_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_loan_granted_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_loan_granted_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            <tr>
                <td><strong>Total Reserved</strong></td>
                <td>${$financial_structure.total_reserved_amount|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_reserved_male|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_reserved_female|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_reserved_youth|number_format:2|default:'0.00'}</td>
                <td>${$financial_structure.total_reserved_non_members|number_format:2|default:'0.00'}</td>
            </tr>
            </tbody>
        </table>

        <!-- 6) Number of Manpower of the CU Movement -->
        <h3>6) Number of Manpower of the CU Movement</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th>Manpower in CUs and Federation</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Elected Officers</strong></td>
                <td>{$movement_manpower.elected_officers_male|default:'0'}</td>
                <td>{$movement_manpower.elected_officers_female|default:'0'}</td>
                <td>{$movement_manpower.elected_officers_total|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Senior Managers</strong></td>
                <td>{$movement_manpower.senior_managers_male|default:'0'}</td>
                <td>{$movement_manpower.senior_managers_female|default:'0'}</td>
                <td>{$movement_manpower.senior_managers_total|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Staff</strong></td>
                <td>{$movement_manpower.staff_male|default:'0'}</td>
                <td>{$movement_manpower.staff_female|default:'0'}</td>
                <td>{$movement_manpower.staff_total|default:'0'}</td>
            </tr>
            </tbody>
        </table>

        <!-- Section B: Credit Union Federation Level -->
        <h2>B: CREDIT UNION FEDERATION LEVEL</h2>

        <!-- 1. General Information -->
        <h3>1. General Information</h3>
        <div class="form-group">
            <div class="info-row">
                <div class="info-item">
                    <label>Federation League Name:</label>
                    <div class="info-value">{$federation_info.fed_name|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Registration Date:</label>
                    <div class="info-value">{$federation_info.reg_date|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Registration Number:</label>
                    <div class="info-value">{$federation_info.reg_number|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Primary Business Activity:</label>
                    <div class="info-value">{$federation_info.primary_activity|default:'-'}</div>
                </div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Contact Information:</h4>
            <div class="info-row">
                <div class="info-item">
                    <label>Address:</label>
                    <div class="info-value">{$federation_info.fed_address|nl2br|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Phone Number:</label>
                    <div class="info-value">{$federation_info.fed_phone|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Email Address:</label>
                    <div class="info-value">{$federation_info.fed_email|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Website:</label>
                    <div class="info-value">
                        {if $federation_info.fed_website}
                            <a href="{$federation_info.fed_website}" target="_blank">{$federation_info.fed_website}</a>
                        {else}
                            -
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Membership Information -->
        <h3>2. Membership Information</h3>
        <div class="form-group">
            <div class="info-row">
                <div class="info-item">
                    <label>Total Number of Member CUs:</label>
                    <div class="info-value">{$federation_info.total_member_cus|default:'0'}</div>
                </div>
                <div class="info-item">
                    <label>Number of Active Members CUs:</label>
                    <div class="info-value">{$federation_info.active_member_cus|default:'0'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Individual Member Total:</label>
                    <div class="info-value">{$federation_info.ind_member_total|number_format|default:'0'}</div>
                </div>
                <div class="info-item">
                    <label>Male:</label>
                    <div class="info-value">{$federation_info.ind_member_male|number_format|default:'0'}</div>
                </div>
                <div class="info-item">
                    <label>Female:</label>
                    <div class="info-value">{$federation_info.ind_member_female|number_format|default:'0'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Individual Membership Growth Rate (past year):</label>
                    <div class="info-value">{$federation_info.membership_growth|default:'-'}</div>
                </div>
            </div>
        </div>

        <!-- 3. Financial Performance (Federation level) -->
        <h3>3. Financial Performance (Federation level)</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th style="width: 40%;">Financials of the Federation / Central Finance Facilities</th>
                <th>December 31, 2024</th>
                <th>December 31, 2025</th>
                <th>% Increase</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Assets</strong></td>
                <td>${$financial_performance.assets_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.assets_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.assets_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Total Loans Outstanding</strong></td>
                <td>${$financial_performance.loans_outstanding_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.loans_outstanding_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.loans_outstanding_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Total Share Capital</strong></td>
                <td>${$financial_performance.share_capital_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.share_capital_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.share_capital_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Total Deposits</strong></td>
                <td>${$financial_performance.deposits_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.deposits_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.deposits_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>External Borrowings</strong></td>
                <td>${$financial_performance.borrowings_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.borrowings_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.borrowings_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Net Institutional Capital</strong></td>
                <td>${$financial_performance.institutional_capital_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.institutional_capital_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.institutional_capital_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Non-Performing Loans (NPL)</strong></td>
                <td>${$financial_performance.npl_2024|number_format:2|default:'0.00'}</td>
                <td>${$financial_performance.npl_2025|number_format:2|default:'0.00'}</td>
                <td>{$financial_performance.npl_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Return on Equity (ROE)</strong></td>
                <td>{$financial_performance.roe_2024|default:'0'}%</td>
                <td>{$financial_performance.roe_2025|default:'0'}%</td>
                <td>{$financial_performance.roe_increase|default:'0'}%</td>
            </tr>
            <tr>
                <td><strong>Capital Adequacy Ratio</strong></td>
                <td>{$financial_performance.car_2024|default:'0'}%</td>
                <td>{$financial_performance.car_2025|default:'0'}%</td>
                <td>{$financial_performance.car_increase|default:'0'}%</td>
            </tr>
            </tbody>
        </table>

        <!-- 4. Business Operations & Services -->
        <h3>4. Business Operations & Services as of December 31, 2024</h3>
        <div class="form-group">
            <div class="info-item">
                <label>Federation's Services to Members:</label>
                <div class="info-value">{$business_operations.fed_services|nl2br|default:'-'}</div>
            </div>

            <div class="info-item">
                <label>How many staff engage:</label>
                <div class="info-value">{$business_operations.staff_engage|default:'0'}</div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Technology Usage:</h4>
            <div class="info-row">
                <div class="info-item">
                    <label>Core Banking System:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.core_banking == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.core_banking == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Mobile Banking:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.mobile_banking == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.mobile_banking == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Internet Banking:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.internet_banking == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.internet_banking == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Money Transfer:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.money_transfer == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.money_transfer == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>

            <div class="info-item">
                <label>Other Digital Services:</label>
                <div class="info-value">{$business_operations.other_digital_services|nl2br|default:'-'}</div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Product Offerings:</h4>
            <div class="info-item">
                <label>Loan Products:</label>
                <div class="info-value">{$business_operations.loan_products|nl2br|default:'-'}</div>
            </div>

            <div class="info-item">
                <label>Savings Products:</label>
                <div class="info-value">{$business_operations.savings_products|nl2br|default:'-'}</div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Type of Training and Education Program:</h4>
            <div class="info-row">
                <div class="info-item">
                    <label>Professional Training Certificate Courses:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.professional_training == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.professional_training == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Technical Skill Training:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.technical_training == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.technical_training == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Basic Training:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.basic_training == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.basic_training == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Consultancy Service:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.consultancy == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.consultancy == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Supervision and Monitoring:</h4>
            <div class="info-row">
                <div class="info-item">
                    <label>Auditing Services:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.auditing == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.auditing == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Supervision Services:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.supervision == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.supervision == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Stabilization:</label>
                    <div class="info-value">
                            <span class="badge {if $business_operations.stabilization == 'yes'}badge-success{else}badge-secondary{/if}">
                                {if $business_operations.stabilization == 'yes'}Yes{else}No{/if}
                            </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Board Members -->
        <h3>5. Board Members (Only of the National Federation)</h3>
        {if $board_members}
            <table class="view-table">
                <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 30%;">Name</th>
                    <th style="width: 10%;">Gender</th>
                    <th style="width: 25%;">Position</th>
                    <th style="width: 30%;">E-mail Address</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$board_members item=member}
                    <tr>
                        <td>{$member.member_number}</td>
                        <td>{$member.name|default:'-'}</td>
                        <td>{$member.gender|default:'-'}</td>
                        <td>{$member.position|default:'-'}</td>
                        <td>{$member.email|default:'-'}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        {else}
            <p class="no-data">No board members information available.</p>
        {/if}

        <!-- 6. Federation Manpower -->
        <h3>6. Federation Manpower</h3>
        <table class="view-table">
            <thead>
            <tr>
                <th>Staff Information</th>
                <th>Male</th>
                <th>Female</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Total Number of Employees</strong></td>
                <td>{$federation_manpower.total_employees_male|default:'0'}</td>
                <td>{$federation_manpower.total_employees_female|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Total Number of Executive Employees</strong></td>
                <td>{$federation_manpower.exec_employees_male|default:'0'}</td>
                <td>{$federation_manpower.exec_employees_female|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Number of Full-time Employees</strong></td>
                <td>{$federation_manpower.fulltime_employees_male|default:'0'}</td>
                <td>{$federation_manpower.fulltime_employees_female|default:'0'}</td>
            </tr>
            <tr>
                <td><strong>Number of Part-time Employees</strong></td>
                <td>{$federation_manpower.parttime_employees_male|default:'0'}</td>
                <td>{$federation_manpower.parttime_employees_female|default:'0'}</td>
            </tr>
            </tbody>
        </table>

        <div class="form-group">
            <div class="info-item">
                <label>Name of Executive Staff and Position:</label>
                <div class="info-value">{$federation_manpower.exec_staff_names|nl2br|default:'-'}</div>
            </div>
        </div>

        <!-- 7. Regulator -->
        <h3>7. Regulator</h3>
        <div class="form-group">
            <div class="info-row">
                <div class="info-item">
                    <label>Name:</label>
                    <div class="info-value">{$regulator.regulator_name|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Address:</label>
                    <div class="info-value">{$regulator.regulator_address|nl2br|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Tel:</label>
                    <div class="info-value">{$regulator.regulator_tel|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Fax:</label>
                    <div class="info-value">{$regulator.regulator_fax|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Email:</label>
                    <div class="info-value">{$regulator.regulator_email|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Website:</label>
                    <div class="info-value">
                        {if $regulator.regulator_website}
                            <a href="{$regulator.regulator_website}" target="_blank">{$regulator.regulator_website}</a>
                        {else}
                            -
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- 8. Challenges and Opportunities -->
        <h3>8. Challenges and Opportunities</h3>
        <div class="form-group">
            <div class="info-item">
                <label>Major Challenges:</label>
                <div class="info-value">{$profile.major_challenges|nl2br|default:'-'}</div>
            </div>

            <div class="info-item">
                <label>Opportunities for Growth:</label>
                <div class="info-value">{$profile.opportunities|nl2br|default:'-'}</div>
            </div>
        </div>

        <!-- 9. Respondent Information -->
        <h3>9. Respondent Information</h3>
        <div class="form-group">
            <div class="info-row">
                <div class="info-item">
                    <label>Name/Position of Respondent:</label>
                    <div class="info-value">{$profile.respondent_name|default:'-'}</div>
                </div>
                <div class="info-item">
                    <label>Date:</label>
                    <div class="info-value">{$profile.response_date|default:'-'}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-item">
                    <label>Submission Date:</label>
                    <div class="info-value">{$profile.submission_date|default:'-'}</div>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>Note:</strong> Microfinance loan is loan granted to income generating activities and microcredit programs and which is less than US$ 200.
        </div>

    </div>
</div>

<style>
    .view-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .view-table th, .view-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .view-table th {
        background-color: #3498db;
        color: white;
        font-weight: bold;
    }

    .view-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .info-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-item {
        margin-bottom: 15px;
    }

    .info-item label {
        display: block;
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .info-value {
        padding: 10px;
        background-color: #f8f9fa;
        border-left: 3px solid #3498db;
        min-height: 20px;
    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge-success {
        background-color: #27ae60;
        color: white;
    }

    .badge-secondary {
        background-color: #95a5a6;
        color: white;
    }

    .no-data {
        padding: 20px;
        text-align: center;
        color: #7f8c8d;
        font-style: italic;
    }

    .view-actions {
        margin-bottom: 20px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin-left: 10px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>

{include file="footerv2.tpl"}