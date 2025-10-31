{include file="headerv2.tpl"}
<div class="container">
    <h1>Edit Credit Union Market Profile</h1>
    <p class="subtitle">As of December 31, 2025</p>

    <div class="view-actions" style="margin-bottom: 20px;">
        <a href="/federation/cu-market-profile/view/{$profile.profile_id}" class="btn btn-secondary">Cancel</a>
    </div>

    <form id="cuMarketProfileForm" method="post" action="/federation/cu-market-profile/save">
        <input type="hidden" name="profile_id" value="{$profile.profile_id}">

        <!-- Organization Information -->
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="orgName">Organization Name:</label>
                    <input type="text" id="orgName" name="orgName" value="{$profile.organization_name}" required>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="3" required>{$profile.address}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="telephone">Telephone:</label>
                    <input type="tel" id="telephone" name="telephone" value="{$profile.telephone}">
                </div>
                <div>
                    <label for="fax">Fax:</label>
                    <input type="tel" id="fax" name="fax" value="{$profile.fax}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{$profile.email}" required>
                </div>
                <div>
                    <label for="website">Website:</label>
                    <input type="url" id="website" name="website" value="{$profile.website}">
                </div>
            </div>
        </div>

        <!-- Country Profile -->
        <h2>Country Profile</h2>
        <table>
            <tr>
                <th style="width: 40%;">Item</th>
                <th>Value</th>
            </tr>
            <tr>
                <td><label for="population">Population as of 2024</label></td>
                <td><input type="number" class="table-input" id="population" name="population" value="{$country_profile.population_2024|default:'0'}"></td>
            </tr>
            <tr>
                <td><label for="gdp">GDP (US$)</label></td>
                <td><input type="text" class="table-input" id="gdp" name="gdp" value="{$country_profile.gdp_usd}"></td>
            </tr>
            <tr>
                <td><label for="gdpPerCapita">GDP per Capita US$</label></td>
                <td><input type="number" class="table-input" id="gdpPerCapita" name="gdpPerCapita" value="{$country_profile.gdp_per_capita_usd|default:'0'}"></td>
            </tr>
            <tr>
                <td><label for="localCurrency">Name of the Local Currency</label></td>
                <td><input type="text" class="table-input" id="localCurrency" name="localCurrency" value="{$country_profile.local_currency}"></td>
            </tr>
            <tr>
                <td><label for="exchangeRate">Exchange Rate as of December 2024</label></td>
                <td><input type="number" step="0.0001" class="table-input" id="exchangeRate" name="exchangeRate" value="{$country_profile.exchange_rate_dec_2024|default:'0'}"></td>
            </tr>
            <tr>
                <td><label for="cuPenetration">CU Penetration</label></td>
                <td><input type="text" class="table-input" id="cuPenetration" name="cuPenetration" value="{$country_profile.cu_penetration}"></td>
            </tr>
        </table>

        <!-- Section A: Credit Union Movement Level -->
        <h2>A: CREDIT UNION MOVEMENT LEVEL</h2>

        <!-- 1) Credit Unions and Memberships -->
        <h3>1) Credit Unions and Memberships</h3>
        <table>
            <thead>
            <tr>
                <th rowspan="2">Type of CU</th>
                <th rowspan="2">Credit Unions</th>
                <th rowspan="2">No of Members</th>
                <th colspan="5">Classification based on Membership</th>
            </tr>
            <tr>
                <th>No of CU: &lt; 300 Members</th>
                <th>No of CU: 301-1000 Members</th>
                <th>No of CU: 1001-3000 Members</th>
                <th>No of CU: 3001-5000 Members</th>
                <th>No of CU: 5000 above Members</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Urban</td>
                <td><input type="number" class="table-input" name="urban_cu" value="{$memberships.urban_cu|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_members" value="{$memberships.urban_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_lt300" value="{$memberships.urban_lt300|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_301_1000" value="{$memberships.urban_301_1000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_1001_3000" value="{$memberships.urban_1001_3000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_3001_5000" value="{$memberships.urban_3001_5000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_gt5000" value="{$memberships.urban_gt5000|default:'0'}"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_cu" value="{$memberships.rural_cu|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_members" value="{$memberships.rural_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_lt300" value="{$memberships.rural_lt300|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_301_1000" value="{$memberships.rural_301_1000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_1001_3000" value="{$memberships.rural_1001_3000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_3001_5000" value="{$memberships.rural_3001_5000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_gt5000" value="{$memberships.rural_gt5000|default:'0'}"></td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><input type="number" class="table-input" name="total_cu" value="{$memberships.total_cu|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_members" value="{$memberships.total_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_lt300" value="{$memberships.total_lt300|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_301_1000" value="{$memberships.total_301_1000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_1001_3000" value="{$memberships.total_1001_3000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_3001_5000" value="{$memberships.total_3001_5000|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_gt5000" value="{$memberships.total_gt5000|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- 2) CUs in Microfinance-Business -->
        <h3>2) CUs in Microfinance-Business</h3>
        <div class="form-group">
            <label for="cusMicrofinance">Number of CUs in Microfinance-Business:</label>
            <input type="number" id="cusMicrofinance" name="cusMicrofinance" value="{$memberships.cus_microfinance|default:'0'}">
        </div>

        <!-- 3) Individual Members: Based on the Area, Age, and sex -->
        <h3>3) Individual Members: Based on the Area, Age, and sex</h3>
        <table>
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
                <td>Urban</td>
                <td><input type="number" class="table-input" name="urban_ind_members" value="{$individual_members.urban_ind_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_male" value="{$individual_members.urban_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_female" value="{$individual_members.urban_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_age_lt20" value="{$individual_members.urban_age_lt20|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_age_20_40" value="{$individual_members.urban_age_20_40|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_age_40_60" value="{$individual_members.urban_age_40_60|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_age_gt60" value="{$individual_members.urban_age_gt60|default:'0'}"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_ind_members" value="{$individual_members.rural_ind_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_male" value="{$individual_members.rural_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_female" value="{$individual_members.rural_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_age_lt20" value="{$individual_members.rural_age_lt20|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_age_20_40" value="{$individual_members.rural_age_20_40|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_age_40_60" value="{$individual_members.rural_age_40_60|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_age_gt60" value="{$individual_members.rural_age_gt60|default:'0'}"></td>
            </tr>
            <tr>
                <td><strong>Total Number</strong></td>
                <td><input type="number" class="table-input" name="total_ind_members" value="{$individual_members.total_ind_members|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_male" value="{$individual_members.total_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_female" value="{$individual_members.total_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_age_lt20" value="{$individual_members.total_age_lt20|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_age_20_40" value="{$individual_members.total_age_20_40|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_age_40_60" value="{$individual_members.total_age_40_60|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_age_gt60" value="{$individual_members.total_age_gt60|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- 4) Assets of the CU Movement -->
        <h3>4) Assets of the CU Movement (aggregated figures of the credit union members)</h3>
        <table>
            <thead>
            <tr>
                <th>Type of CU</th>
                <th>Total Assets US$</th>
                <th colspan="4">Assets Group US$</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>&lt; 100,000 US$</th>
                <th>100,001 - 500,000 US$</th>
                <th>500,001 - 1,000,000 US$</th>
                <th>1,000,000 &gt; US$</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Urban</td>
                <td><input type="number" class="table-input" name="urban_total_assets" value="{$assets.urban_total_assets|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_assets_lt100k" value="{$assets.urban_assets_lt100k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_assets_100k_500k" value="{$assets.urban_assets_100k_500k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_assets_500k_1m" value="{$assets.urban_assets_500k_1m|default:'0'}"></td>
                <td><input type="number" class="table-input" name="urban_assets_gt1m" value="{$assets.urban_assets_gt1m|default:'0'}"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_total_assets" value="{$assets.rural_total_assets|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_assets_lt100k" value="{$assets.rural_assets_lt100k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_assets_100k_500k" value="{$assets.rural_assets_100k_500k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_assets_500k_1m" value="{$assets.rural_assets_500k_1m|default:'0'}"></td>
                <td><input type="number" class="table-input" name="rural_assets_gt1m" value="{$assets.rural_assets_gt1m|default:'0'}"></td>
            </tr>
            <tr>
                <td><strong>Total Number</strong></td>
                <td><input type="number" class="table-input" name="total_assets" value="{$assets.total_assets|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_assets_lt100k" value="{$assets.total_assets_lt100k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_assets_100k_500k" value="{$assets.total_assets_100k_500k|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_assets_500k_1m" value="{$assets.total_assets_500k_1m|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_assets_gt1m" value="{$assets.total_assets_gt1m|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- 5) Financial Structure of the Movement -->
        <h3>5) Financial Structure of the Movement (aggregated figures of the credit union members)</h3>
        <table>
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
                <td>Share</td>
                <td><input type="number" class="table-input" name="share_amount" value="{$financial_structure.share_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="share_male" value="{$financial_structure.share_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="share_female" value="{$financial_structure.share_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="share_youth" value="{$financial_structure.share_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="share_non_members" value="{$financial_structure.share_non_members|default:'0'}"></td>
            </tr>
            <tr>
                <td>Savings/Other Deposits</td>
                <td><input type="number" class="table-input" name="savings_amount" value="{$financial_structure.savings_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="savings_male" value="{$financial_structure.savings_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="savings_female" value="{$financial_structure.savings_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="savings_youth" value="{$financial_structure.savings_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="savings_non_members" value="{$financial_structure.savings_non_members|default:'0'}"></td>
            </tr>
            <tr>
                <td>Delinquency Loan</td>
                <td><input type="number" class="table-input" name="delinquency_amount" value="{$financial_structure.delinquency_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="delinquency_male" value="{$financial_structure.delinquency_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="delinquency_female" value="{$financial_structure.delinquency_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="delinquency_youth" value="{$financial_structure.delinquency_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="delinquency_non_members" value="{$financial_structure.delinquency_non_members|default:'0'}"></td>
            </tr>
            <tr>
                <td>Loan Outstanding</td>
                <td><input type="number" class="table-input" name="loan_outstanding_amount" value="{$financial_structure.loan_outstanding_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_male" value="{$financial_structure.loan_outstanding_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_female" value="{$financial_structure.loan_outstanding_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_youth" value="{$financial_structure.loan_outstanding_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_non_members" value="{$financial_structure.loan_outstanding_non_members|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Loan Granted</td>
                <td><input type="number" class="table-input" name="total_loan_granted_amount" value="{$financial_structure.total_loan_granted_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_male" value="{$financial_structure.total_loan_granted_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_female" value="{$financial_structure.total_loan_granted_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_youth" value="{$financial_structure.total_loan_granted_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_non_members" value="{$financial_structure.total_loan_granted_non_members|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Reserved</td>
                <td><input type="number" class="table-input" name="total_reserved_amount" value="{$financial_structure.total_reserved_amount|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_reserved_male" value="{$financial_structure.total_reserved_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_reserved_female" value="{$financial_structure.total_reserved_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_reserved_youth" value="{$financial_structure.total_reserved_youth|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_reserved_non_members" value="{$financial_structure.total_reserved_non_members|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- 6) Number of Manpower of the CU Movement -->
        <h3>6) Number of Manpower of the CU Movement</h3>
        <table>
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
                <td>Elected Officers</td>
                <td><input type="number" class="table-input" name="elected_officers_male" value="{$movement_manpower.elected_officers_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="elected_officers_female" value="{$movement_manpower.elected_officers_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="elected_officers_total" value="{$movement_manpower.elected_officers_total|default:'0'}"></td>
            </tr>
            <tr>
                <td>Senior Managers</td>
                <td><input type="number" class="table-input" name="senior_managers_male" value="{$movement_manpower.senior_managers_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="senior_managers_female" value="{$movement_manpower.senior_managers_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="senior_managers_total" value="{$movement_manpower.senior_managers_total|default:'0'}"></td>
            </tr>
            <tr>
                <td>Staff</td>
                <td><input type="number" class="table-input" name="staff_male" value="{$movement_manpower.staff_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="staff_female" value="{$movement_manpower.staff_female|default:'0'}"></td>
                <td><input type="number" class="table-input" name="staff_total" value="{$movement_manpower.staff_total|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- Section B: Credit Union Federation Level -->
        <h2>B: CREDIT UNION FEDERATION LEVEL</h2>

        <!-- 1. General Information -->
        <h3>1. General Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="fedName">Federation League Name:</label>
                    <input type="text" id="fedName" name="fedName" value="{$federation_info.fed_name}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regDate">Registration Date:</label>
                    <input type="date" id="regDate" name="regDate" value="{$federation_info.reg_date}">
                </div>
                <div>
                    <label for="regNumber">Registration Number:</label>
                    <input type="text" id="regNumber" name="regNumber" value="{$federation_info.reg_number}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="primaryActivity">Primary Business Activity:</label>
                    <input type="text" id="primaryActivity" name="primaryActivity" value="{$federation_info.primary_activity}" placeholder="e.g., Credit Union, Savings & Credit Cooperative">
                </div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Contact Information:</h4>
            <div class="form-row">
                <div>
                    <label for="fedAddress">Address:</label>
                    <textarea id="fedAddress" name="fedAddress" rows="3">{$federation_info.fed_address}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="fedPhone">Phone Number:</label>
                    <input type="tel" id="fedPhone" name="fedPhone" value="{$federation_info.fed_phone}">
                </div>
                <div>
                    <label for="fedEmail">Email Address:</label>
                    <input type="email" id="fedEmail" name="fedEmail" value="{$federation_info.fed_email}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="fedWebsite">Website (if applicable):</label>
                    <input type="url" id="fedWebsite" name="fedWebsite" value="{$federation_info.fed_website}">
                </div>
            </div>
        </div>

        <!-- 2. Membership Information -->
        <h3>2. Membership Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="totalMemberCUs">Total Number of Member CUs:</label>
                    <input type="number" id="totalMemberCUs" name="totalMemberCUs" value="{$federation_info.total_member_cus|default:'0'}">
                </div>
                <div>
                    <label for="activeMemberCUs">Number of Active Members CUs:</label>
                    <input type="number" id="activeMemberCUs" name="activeMemberCUs" value="{$federation_info.active_member_cus|default:'0'}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="indMemberTotal">Individual Member Total:</label>
                    <input type="number" id="indMemberTotal" name="indMemberTotal" value="{$federation_info.ind_member_total|default:'0'}">
                </div>
                <div>
                    <label for="indMemberMale">Male:</label>
                    <input type="number" id="indMemberMale" name="indMemberMale" value="{$federation_info.ind_member_male|default:'0'}">
                </div>
                <div>
                    <label for="indMemberFemale">Female:</label>
                    <input type="number" id="indMemberFemale" name="indMemberFemale" value="{$federation_info.ind_member_female|default:'0'}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="membershipGrowth">Individual Membership Growth Rate (past year):</label>
                    <input type="text" id="membershipGrowth" name="membershipGrowth" value="{$federation_info.membership_growth}" placeholder="e.g., 5%">
                </div>
            </div>
        </div>

        <!-- 3. Financial Performance (Federation level) -->
        <h3>3. Financial Performance (Federation level - can be expressed in local currency)</h3>
        <table>
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
                <td>Assets</td>
                <td><input type="number" class="table-input" name="assets_2024" value="{$financial_performance.assets_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="assets_2025" value="{$financial_performance.assets_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="assets_increase" value="{$financial_performance.assets_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Loans Outstanding / Interleading Loans Outstanding</td>
                <td><input type="number" class="table-input" name="loans_outstanding_2024" value="{$financial_performance.loans_outstanding_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="loans_outstanding_2025" value="{$financial_performance.loans_outstanding_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="loans_outstanding_increase" value="{$financial_performance.loans_outstanding_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Share Capital</td>
                <td><input type="number" class="table-input" name="share_capital_2024" value="{$financial_performance.share_capital_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="share_capital_2025" value="{$financial_performance.share_capital_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="share_capital_increase" value="{$financial_performance.share_capital_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Deposits (Time Deposit, Promissory Notes, Savings Deposit, and all types of Deposit liabilities)</td>
                <td><input type="number" class="table-input" name="deposits_2024" value="{$financial_performance.deposits_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="deposits_2025" value="{$financial_performance.deposits_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="deposits_increase" value="{$financial_performance.deposits_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>External Borrowings</td>
                <td><input type="number" class="table-input" name="borrowings_2024" value="{$financial_performance.borrowings_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="borrowings_2025" value="{$financial_performance.borrowings_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="borrowings_increase" value="{$financial_performance.borrowings_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Net Institutional Capital (Total of Reserve Fund, Land & Building Fund, Donated Capital, institutional building fund, and other funds allocated for the acquisition of assets)</td>
                <td><input type="number" class="table-input" name="institutional_capital_2024" value="{$financial_performance.institutional_capital_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="institutional_capital_2025" value="{$financial_performance.institutional_capital_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="institutional_capital_increase" value="{$financial_performance.institutional_capital_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Non-Performing Loans (NPL)</td>
                <td><input type="number" class="table-input" name="npl_2024" value="{$financial_performance.npl_2024|default:'0'}"></td>
                <td><input type="number" class="table-input" name="npl_2025" value="{$financial_performance.npl_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="npl_increase" value="{$financial_performance.npl_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Return on Equity (ROE): % of Dividends to Share Capital</td>
                <td><input type="number" step="0.01" class="table-input" name="roe_2024" value="{$financial_performance.roe_2024|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="roe_2025" value="{$financial_performance.roe_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="roe_increase" value="{$financial_performance.roe_increase|default:'0'}"></td>
            </tr>
            <tr>
                <td>Capital Adequacy Ratio</td>
                <td><input type="number" step="0.01" class="table-input" name="car_2024" value="{$financial_performance.car_2024|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="car_2025" value="{$financial_performance.car_2025|default:'0'}"></td>
                <td><input type="number" step="0.01" class="table-input" name="car_increase" value="{$financial_performance.car_increase|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <!-- 4. Business Operations & Services -->
        <h3>4. Business Operations & Services as of December 31, 2024</h3>
        <div class="form-group">
            <label for="fedServices">Federation's Services to Members:</label>
            <textarea id="fedServices" name="fedServices" rows="4">{$business_operations.fed_services}</textarea>
        </div>

        <div class="form-group">
            <label for="staffEngage">How many staff engage:</label>
            <input type="number" id="staffEngage" name="staffEngage" value="{$business_operations.staff_engage|default:'0'}">
        </div>

        <h4 style="margin-top: 20px; color: #555;">Technology Usage:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label>Core Banking System:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="coreBanking" value="yes" {if $business_operations.core_banking == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="coreBanking" value="no" {if $business_operations.core_banking != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
                <div>
                    <label>Mobile Banking:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="mobileBanking" value="yes" {if $business_operations.mobile_banking == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="mobileBanking" value="no" {if $business_operations.mobile_banking != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Internet Banking:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="internetBanking" value="yes" {if $business_operations.internet_banking == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="internetBanking" value="no" {if $business_operations.internet_banking != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
                <div>
                    <label>Money Transfer:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="moneyTransfer" value="yes" {if $business_operations.money_transfer == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="moneyTransfer" value="no" {if $business_operations.money_transfer != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="otherDigitalServices">Other Digital Services (e.g., SMS alerts, online loan applications):</label>
                    <textarea id="otherDigitalServices" name="otherDigitalServices" rows="3">{$business_operations.other_digital_services}</textarea>
                </div>
            </div>
        </div>

        <h4 style="margin-top: 20px; color: #555;">Product Offerings:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="loanProducts">Loan Products (List all loan products offered):</label>
                    <textarea id="loanProducts" name="loanProducts" rows="3">{$business_operations.loan_products}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="savingsProducts">Savings Products (List all savings products offered):</label>
                    <textarea id="savingsProducts" name="savingsProducts" rows="3">{$business_operations.savings_products}</textarea>
                </div>
            </div>
        </div>

        <h4 style="margin-top: 20px; color: #555;">Type of Training and Education Program:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label>Professional Training Certificate Courses:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="professionalTraining" value="yes" {if $business_operations.professional_training == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="professionalTraining" value="no" {if $business_operations.professional_training != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
                <div>
                    <label>Technical Skill Training:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="technicalTraining" value="yes" {if $business_operations.technical_training == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="technicalTraining" value="no" {if $business_operations.technical_training != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Basic Training:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="basicTraining" value="yes" {if $business_operations.basic_training == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="basicTraining" value="no" {if $business_operations.basic_training != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
                <div>
                    <label>Consultancy Service:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="consultancy" value="yes" {if $business_operations.consultancy == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="consultancy" value="no" {if $business_operations.consultancy != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>
        </div>

        <h4 style="margin-top: 20px; color: #555;">Supervision and Monitoring:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label>Auditing Services:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="auditing" value="yes" {if $business_operations.auditing == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="auditing" value="no" {if $business_operations.auditing != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
                <div>
                    <label>Supervision Services:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="supervision" value="yes" {if $business_operations.supervision == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="supervision" value="no" {if $business_operations.supervision != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Stabilization:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="stabilization" value="yes" {if $business_operations.stabilization == 'yes'}checked{/if}> Yes</label>
                        <label><input type="radio" name="stabilization" value="no" {if $business_operations.stabilization != 'yes'}checked{/if}> No</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Board Members (Only of the National Federation) -->
        <h3>5. Board Members (Only of the National Federation)</h3>
        <table>
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
                    <td><input type="text" class="table-input" name="board_name_{$member.member_number}" value="{$member.name}"></td>
                    <td>
                        <select class="table-input" name="board_gender_{$member.member_number}">
                            <option value="">Select</option>
                            <option value="Male" {if $member.gender == 'Male'}selected{/if}>Male</option>
                            <option value="Female" {if $member.gender == 'Female'}selected{/if}>Female</option>
                        </select>
                    </td>
                    <td><input type="text" class="table-input" name="board_position_{$member.member_number}" value="{$member.position}"></td>
                    <td><input type="email" class="table-input" name="board_email_{$member.member_number}" value="{$member.email}"></td>
                </tr>
            {/foreach}

            {* If no board members exist, show empty rows *}
            {if !$board_members || count($board_members) == 0}
                {section name=boardrow start=1 loop=22}
                    <tr>
                        <td>{$smarty.section.boardrow.index}</td>
                        <td><input type="text" class="table-input" name="board_name_{$smarty.section.boardrow.index}"></td>
                        <td>
                            <select class="table-input" name="board_gender_{$smarty.section.boardrow.index}">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                        <td><input type="text" class="table-input" name="board_position_{$smarty.section.boardrow.index}"></td>
                        <td><input type="email" class="table-input" name="board_email_{$smarty.section.boardrow.index}"></td>
                    </tr>
                {/section}
            {/if}
            </tbody>
        </table>

        <!-- 6. Federation Manpower -->
        <h3>6. Federation Manpower</h3>
        <table>
            <thead>
            <tr>
                <th>Staff Information</th>
                <th>Male</th>
                <th>Female</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Total Number of Employees</td>
                <td><input type="number" class="table-input" name="total_employees_male" value="{$federation_manpower.total_employees_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="total_employees_female" value="{$federation_manpower.total_employees_female|default:'0'}"></td>
            </tr>
            <tr>
                <td>Total Number of Executive Employees</td>
                <td><input type="number" class="table-input" name="exec_employees_male" value="{$federation_manpower.exec_employees_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="exec_employees_female" value="{$federation_manpower.exec_employees_female|default:'0'}"></td>
            </tr>
            <tr>
                <td>Number of Full-time Employees</td>
                <td><input type="number" class="table-input" name="fulltime_employees_male" value="{$federation_manpower.fulltime_employees_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="fulltime_employees_female" value="{$federation_manpower.fulltime_employees_female|default:'0'}"></td>
            </tr>
            <tr>
                <td>Number of Part-time Employees</td>
                <td><input type="number" class="table-input" name="parttime_employees_male" value="{$federation_manpower.parttime_employees_male|default:'0'}"></td>
                <td><input type="number" class="table-input" name="parttime_employees_female" value="{$federation_manpower.parttime_employees_female|default:'0'}"></td>
            </tr>
            </tbody>
        </table>

        <div class="form-group">
            <label for="execStaffNames">Name of Executive Staff and Position:</label>
            <textarea id="execStaffNames" name="execStaffNames" rows="6" placeholder="List names and positions of executive staff">{$federation_manpower.exec_staff_names}</textarea>
        </div>

        <!-- 7. Regulator -->
        <h3>7. Regulator</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="regulatorName">Name:</label>
                    <input type="text" id="regulatorName" name="regulatorName" value="{$regulator.regulator_name}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorAddress">Address:</label>
                    <textarea id="regulatorAddress" name="regulatorAddress" rows="2">{$regulator.regulator_address}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorTel">Tel:</label>
                    <input type="tel" id="regulatorTel" name="regulatorTel" value="{$regulator.regulator_tel}">
                </div>
                <div>
                    <label for="regulatorFax">Fax:</label>
                    <input type="tel" id="regulatorFax" name="regulatorFax" value="{$regulator.regulator_fax}">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorEmail">Email:</label>
                    <input type="email" id="regulatorEmail" name="regulatorEmail" value="{$regulator.regulator_email}">
                </div>
                <div>
                    <label for="regulatorWebsite">Website:</label>
                    <input type="url" id="regulatorWebsite" name="regulatorWebsite" value="{$regulator.regulator_website}">
                </div>
            </div>
        </div>

        <!-- 8. Challenges and Opportunities -->
        <h3>8. Challenges and Opportunities</h3>
        <div class="form-group">
            <label for="majorChallenges">Major Challenges (e.g., Competition, Regulatory Issues, Financial Inclusion):</label>
            <textarea id="majorChallenges" name="majorChallenges" rows="5">{$profile.major_challenges}</textarea>
        </div>

        <div class="form-group">
            <label for="opportunities">Opportunities for Growth (e.g., New markets, Product diversification, Technology adoption):</label>
            <textarea id="opportunities" name="opportunities" rows="5">{$profile.opportunities}</textarea>
        </div>

        <!-- 9. Respondent Information -->
        <h3>9. Respondent Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="respondentName">Name/Position of Respondent:</label>
                    <input type="text" id="respondentName" name="respondentName" value="{$profile.respondent_name}" required>
                </div>
                <div>
                    <label for="responseDate">Date:</label>
                    <input type="date" id="responseDate" name="responseDate" value="{$profile.response_date}" required>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>Note:</strong> Microfinance loan is loan granted to income generating activities and microcredit programs and which is less than US$ 200.
        </div>

        <!-- Submit Section -->
        <div class="submit-section">
            <button type="submit" class="btn-submit">Update Profile</button>
            <a href="/federation/cu-market-profile/view/{$profile.profile_id}" class="btn-cancel">Cancel</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Last Updated:</strong> {$profile.updated_at|default:$profile.created_at}</p>
        </div>
    </form>
</div>

<style>
    .btn-cancel {
        display: inline-block;
        padding: 12px 30px;
        background-color: #95a5a6;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-left: 10px;
    }

    .btn-cancel:hover {
        background-color: #7f8c8d;
    }
</style>

{include file="footerv2.tpl"}