{include file="headerv2.tpl"}
<div class="container">
    <h1>Credit Union Market Profile (Regular & Affiliate Member)</h1>
    <p class="subtitle">As of December 31, 2025</p>

    <form id="cuMarketProfileForm" method="post" action="/federation/cu-market-profile/save">
        <!-- Organization Information -->
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="orgName">Organization Name:</label>
                    <input type="text" id="orgName" name="orgName" required>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="3" required></textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="telephone">Telephone:</label>
                    <input type="tel" id="telephone" name="telephone">
                </div>
                <div>
                    <label for="fax">Fax:</label>
                    <input type="tel" id="fax" name="fax">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="website">Website:</label>
                    <input type="url" id="website" name="website">
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
                <td><input type="number" class="table-input" id="population" name="population" value="0"></td>
            </tr>
            <tr>
                <td><label for="gdp">GDP (US$)</label></td>
                <td><input type="text" class="table-input" id="gdp" name="gdp"></td>
            </tr>
            <tr>
                <td><label for="gdpPerCapita">GDP per Capita US$</label></td>
                <td><input type="number" class="table-input" id="gdpPerCapita" name="gdpPerCapita" value="0"></td>
            </tr>
            <tr>
                <td><label for="localCurrency">Name of the Local Currency</label></td>
                <td><input type="text" class="table-input" id="localCurrency" name="localCurrency"></td>
            </tr>
            <tr>
                <td><label for="exchangeRate">Exchange Rate as of December 2024</label></td>
                <td><input type="number" step="0.0001" class="table-input" id="exchangeRate" name="exchangeRate" value="0"></td>
            </tr>
            <tr>
                <td><label for="cuPenetration">CU Penetration</label></td>
                <td><input type="text" class="table-input" id="cuPenetration" name="cuPenetration"></td>
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
                <td><input type="number" class="table-input" name="urban_cu" value="0"></td>
                <td><input type="number" class="table-input" name="urban_members" value="0"></td>
                <td><input type="number" class="table-input" name="urban_lt300" value="0"></td>
                <td><input type="number" class="table-input" name="urban_301_1000" value="0"></td>
                <td><input type="number" class="table-input" name="urban_1001_3000" value="0"></td>
                <td><input type="number" class="table-input" name="urban_3001_5000" value="0"></td>
                <td><input type="number" class="table-input" name="urban_gt5000" value="0"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_cu" value="0"></td>
                <td><input type="number" class="table-input" name="rural_members" value="0"></td>
                <td><input type="number" class="table-input" name="rural_lt300" value="0"></td>
                <td><input type="number" class="table-input" name="rural_301_1000" value="0"></td>
                <td><input type="number" class="table-input" name="rural_1001_3000" value="0"></td>
                <td><input type="number" class="table-input" name="rural_3001_5000" value="0"></td>
                <td><input type="number" class="table-input" name="rural_gt5000" value="0"></td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><input type="number" class="table-input" name="total_cu" value="0"></td>
                <td><input type="number" class="table-input" name="total_members" value="0"></td>
                <td><input type="number" class="table-input" name="total_lt300" value="0"></td>
                <td><input type="number" class="table-input" name="total_301_1000" value="0"></td>
                <td><input type="number" class="table-input" name="total_1001_3000" value="0"></td>
                <td><input type="number" class="table-input" name="total_3001_5000" value="0"></td>
                <td><input type="number" class="table-input" name="total_gt5000" value="0"></td>
            </tr>
            </tbody>
        </table>

        <!-- 2) CUs in Microfinance-Business -->
        <h3>2) CUs in Microfinance-Business</h3>
        <div class="form-group">
            <label for="cusMicrofinance">Number of CUs in Microfinance-Business:</label>
            <input type="number" id="cusMicrofinance" name="cusMicrofinance" value="0">
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
                <td><input type="number" class="table-input" name="urban_ind_members" value="0"></td>
                <td><input type="number" class="table-input" name="urban_male" value="0"></td>
                <td><input type="number" class="table-input" name="urban_female" value="0"></td>
                <td><input type="number" class="table-input" name="urban_age_lt20" value="0"></td>
                <td><input type="number" class="table-input" name="urban_age_20_40" value="0"></td>
                <td><input type="number" class="table-input" name="urban_age_40_60" value="0"></td>
                <td><input type="number" class="table-input" name="urban_age_gt60" value="0"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_ind_members" value="0"></td>
                <td><input type="number" class="table-input" name="rural_male" value="0"></td>
                <td><input type="number" class="table-input" name="rural_female" value="0"></td>
                <td><input type="number" class="table-input" name="rural_age_lt20" value="0"></td>
                <td><input type="number" class="table-input" name="rural_age_20_40" value="0"></td>
                <td><input type="number" class="table-input" name="rural_age_40_60" value="0"></td>
                <td><input type="number" class="table-input" name="rural_age_gt60" value="0"></td>
            </tr>
            <tr>
                <td><strong>Total Number</strong></td>
                <td><input type="number" class="table-input" name="total_ind_members" value="0"></td>
                <td><input type="number" class="table-input" name="total_male" value="0"></td>
                <td><input type="number" class="table-input" name="total_female" value="0"></td>
                <td><input type="number" class="table-input" name="total_age_lt20" value="0"></td>
                <td><input type="number" class="table-input" name="total_age_20_40" value="0"></td>
                <td><input type="number" class="table-input" name="total_age_40_60" value="0"></td>
                <td><input type="number" class="table-input" name="total_age_gt60" value="0"></td>
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
                <td><input type="number" class="table-input" name="urban_total_assets" value="0"></td>
                <td><input type="number" class="table-input" name="urban_assets_lt100k" value="0"></td>
                <td><input type="number" class="table-input" name="urban_assets_100k_500k" value="0"></td>
                <td><input type="number" class="table-input" name="urban_assets_500k_1m" value="0"></td>
                <td><input type="number" class="table-input" name="urban_assets_gt1m" value="0"></td>
            </tr>
            <tr>
                <td>Rural</td>
                <td><input type="number" class="table-input" name="rural_total_assets" value="0"></td>
                <td><input type="number" class="table-input" name="rural_assets_lt100k" value="0"></td>
                <td><input type="number" class="table-input" name="rural_assets_100k_500k" value="0"></td>
                <td><input type="number" class="table-input" name="rural_assets_500k_1m" value="0"></td>
                <td><input type="number" class="table-input" name="rural_assets_gt1m" value="0"></td>
            </tr>
            <tr>
                <td><strong>Total Number</strong></td>
                <td><input type="number" class="table-input" name="total_assets" value="0"></td>
                <td><input type="number" class="table-input" name="total_assets_lt100k" value="0"></td>
                <td><input type="number" class="table-input" name="total_assets_100k_500k" value="0"></td>
                <td><input type="number" class="table-input" name="total_assets_500k_1m" value="0"></td>
                <td><input type="number" class="table-input" name="total_assets_gt1m" value="0"></td>
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
                <td><input type="number" class="table-input" name="share_amount" value="0"></td>
                <td><input type="number" class="table-input" name="share_male" value="0"></td>
                <td><input type="number" class="table-input" name="share_female" value="0"></td>
                <td><input type="number" class="table-input" name="share_youth" value="0"></td>
                <td><input type="number" class="table-input" name="share_non_members" value="0"></td>
            </tr>
            <tr>
                <td>Savings/Other Deposits</td>
                <td><input type="number" class="table-input" name="savings_amount" value="0"></td>
                <td><input type="number" class="table-input" name="savings_male" value="0"></td>
                <td><input type="number" class="table-input" name="savings_female" value="0"></td>
                <td><input type="number" class="table-input" name="savings_youth" value="0"></td>
                <td><input type="number" class="table-input" name="savings_non_members" value="0"></td>
            </tr>
            <tr>
                <td>Delinquency Loan</td>
                <td><input type="number" class="table-input" name="delinquency_amount" value="0"></td>
                <td><input type="number" class="table-input" name="delinquency_male" value="0"></td>
                <td><input type="number" class="table-input" name="delinquency_female" value="0"></td>
                <td><input type="number" class="table-input" name="delinquency_youth" value="0"></td>
                <td><input type="number" class="table-input" name="delinquency_non_members" value="0"></td>
            </tr>
            <tr>
                <td>Loan Outstanding</td>
                <td><input type="number" class="table-input" name="loan_outstanding_amount" value="0"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_male" value="0"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_female" value="0"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_youth" value="0"></td>
                <td><input type="number" class="table-input" name="loan_outstanding_non_members" value="0"></td>
            </tr>
            <tr>
                <td>Total Loan Granted</td>
                <td><input type="number" class="table-input" name="total_loan_granted_amount" value="0"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_male" value="0"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_female" value="0"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_youth" value="0"></td>
                <td><input type="number" class="table-input" name="total_loan_granted_non_members" value="0"></td>
            </tr>
            <tr>
                <td>Total Reserved</td>
                <td><input type="number" class="table-input" name="total_reserved_amount" value="0"></td>
                <td><input type="number" class="table-input" name="total_reserved_male" value="0"></td>
                <td><input type="number" class="table-input" name="total_reserved_female" value="0"></td>
                <td><input type="number" class="table-input" name="total_reserved_youth" value="0"></td>
                <td><input type="number" class="table-input" name="total_reserved_non_members" value="0"></td>
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
                <td><input type="number" class="table-input" name="elected_officers_male" value="0"></td>
                <td><input type="number" class="table-input" name="elected_officers_female" value="0"></td>
                <td><input type="number" class="table-input" name="elected_officers_total" value="0"></td>
            </tr>
            <tr>
                <td>Senior Managers</td>
                <td><input type="number" class="table-input" name="senior_managers_male" value="0"></td>
                <td><input type="number" class="table-input" name="senior_managers_female" value="0"></td>
                <td><input type="number" class="table-input" name="senior_managers_total" value="0"></td>
            </tr>
            <tr>
                <td>Staff</td>
                <td><input type="number" class="table-input" name="staff_male" value="0"></td>
                <td><input type="number" class="table-input" name="staff_female" value="0"></td>
                <td><input type="number" class="table-input" name="staff_total" value="0"></td>
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
                    <input type="text" id="fedName" name="fedName">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regDate">Registration Date:</label>
                    <input type="date" id="regDate" name="regDate">
                </div>
                <div>
                    <label for="regNumber">Registration Number:</label>
                    <input type="text" id="regNumber" name="regNumber">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="primaryActivity">Primary Business Activity:</label>
                    <input type="text" id="primaryActivity" name="primaryActivity" placeholder="e.g., Credit Union, Savings & Credit Cooperative">
                </div>
            </div>

            <h4 style="margin-top: 20px; color: #555;">Contact Information:</h4>
            <div class="form-row">
                <div>
                    <label for="fedAddress">Address:</label>
                    <textarea id="fedAddress" name="fedAddress" rows="3"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="fedPhone">Phone Number:</label>
                    <input type="tel" id="fedPhone" name="fedPhone">
                </div>
                <div>
                    <label for="fedEmail">Email Address:</label>
                    <input type="email" id="fedEmail" name="fedEmail">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="fedWebsite">Website (if applicable):</label>
                    <input type="url" id="fedWebsite" name="fedWebsite">
                </div>
            </div>
        </div>

        <!-- 2. Membership Information -->
        <h3>2. Membership Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="totalMemberCUs">Total Number of Member CUs:</label>
                    <input type="number" id="totalMemberCUs" name="totalMemberCUs" value="0">
                </div>
                <div>
                    <label for="activeMemberCUs">Number of Active Members CUs:</label>
                    <input type="number" id="activeMemberCUs" name="activeMemberCUs" value="0">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="indMemberTotal">Individual Member Total:</label>
                    <input type="number" id="indMemberTotal" name="indMemberTotal" value="0">
                </div>
                <div>
                    <label for="indMemberMale">Male:</label>
                    <input type="number" id="indMemberMale" name="indMemberMale" value="0">
                </div>
                <div>
                    <label for="indMemberFemale">Female:</label>
                    <input type="number" id="indMemberFemale" name="indMemberFemale" value="0">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="membershipGrowth">Individual Membership Growth Rate (past year):</label>
                    <input type="text" id="membershipGrowth" name="membershipGrowth" placeholder="e.g., 5%">
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
                <td><input type="number" class="table-input" name="assets_2024" value="0"></td>
                <td><input type="number" class="table-input" name="assets_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="assets_increase" value="0"></td>
            </tr>
            <tr>
                <td>Total Loans Outstanding / Interleading Loans Outstanding</td>
                <td><input type="number" class="table-input" name="loans_outstanding_2024" value="0"></td>
                <td><input type="number" class="table-input" name="loans_outstanding_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="loans_outstanding_increase" value="0"></td>
            </tr>
            <tr>
                <td>Total Share Capital</td>
                <td><input type="number" class="table-input" name="share_capital_2024" value="0"></td>
                <td><input type="number" class="table-input" name="share_capital_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="share_capital_increase" value="0"></td>
            </tr>
            <tr>
                <td>Total Deposits (Time Deposit, Promissory Notes, Savings Deposit, and all types of Deposit liabilities)</td>
                <td><input type="number" class="table-input" name="deposits_2024" value="0"></td>
                <td><input type="number" class="table-input" name="deposits_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="deposits_increase" value="0"></td>
            </tr>
            <tr>
                <td>External Borrowings</td>
                <td><input type="number" class="table-input" name="borrowings_2024" value="0"></td>
                <td><input type="number" class="table-input" name="borrowings_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="borrowings_increase" value="0"></td>
            </tr>
            <tr>
                <td>Net Institutional Capital (Total of Reserve Fund, Land & Building Fund, Donated Capital, institutional building fund, and other funds allocated for the acquisition of assets)</td>
                <td><input type="number" class="table-input" name="institutional_capital_2024" value="0"></td>
                <td><input type="number" class="table-input" name="institutional_capital_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="institutional_capital_increase" value="0"></td>
            </tr>
            <tr>
                <td>Non-Performing Loans (NPL)</td>
                <td><input type="number" class="table-input" name="npl_2024" value="0"></td>
                <td><input type="number" class="table-input" name="npl_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="npl_increase" value="0"></td>
            </tr>
            <tr>
                <td>Return on Equity (ROE): % of Dividends to Share Capital</td>
                <td><input type="number" step="0.01" class="table-input" name="roe_2024" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="roe_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="roe_increase" value="0"></td>
            </tr>
            <tr>
                <td>Capital Adequacy Ratio</td>
                <td><input type="number" step="0.01" class="table-input" name="car_2024" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="car_2025" value="0"></td>
                <td><input type="number" step="0.01" class="table-input" name="car_increase" value="0"></td>
            </tr>
            </tbody>
        </table>

        <!-- 4. Business Operations & Services -->
        <h3>4. Business Operations & Services as of December 31, 2024</h3>
        <div class="form-group">
            <label for="fedServices">Federation's Services to Members:</label>
            <textarea id="fedServices" name="fedServices" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="staffEngage">How many staff engage:</label>
            <input type="number" id="staffEngage" name="staffEngage" value="0">
        </div>

        <h4 style="margin-top: 20px; color: #555;">Technology Usage:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label>Core Banking System:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="coreBanking" value="yes"> Yes</label>
                        <label><input type="radio" name="coreBanking" value="no" checked> No</label>
                    </div>
                </div>
                <div>
                    <label>Mobile Banking:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="mobileBanking" value="yes"> Yes</label>
                        <label><input type="radio" name="mobileBanking" value="no" checked> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Internet Banking:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="internetBanking" value="yes"> Yes</label>
                        <label><input type="radio" name="internetBanking" value="no" checked> No</label>
                    </div>
                </div>
                <div>
                    <label>Money Transfer:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="moneyTransfer" value="yes"> Yes</label>
                        <label><input type="radio" name="moneyTransfer" value="no" checked> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="otherDigitalServices">Other Digital Services (e.g., SMS alerts, online loan applications):</label>
                    <textarea id="otherDigitalServices" name="otherDigitalServices" rows="3"></textarea>
                </div>
            </div>
        </div>

        <h4 style="margin-top: 20px; color: #555;">Product Offerings:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="loanProducts">Loan Products (List all loan products offered):</label>
                    <textarea id="loanProducts" name="loanProducts" rows="3"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="savingsProducts">Savings Products (List all savings products offered):</label>
                    <textarea id="savingsProducts" name="savingsProducts" rows="3"></textarea>
                </div>
            </div>
        </div>

        <h4 style="margin-top: 20px; color: #555;">Type of Training and Education Program:</h4>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label>Professional Training Certificate Courses:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="professionalTraining" value="yes"> Yes</label>
                        <label><input type="radio" name="professionalTraining" value="no" checked> No</label>
                    </div>
                </div>
                <div>
                    <label>Technical Skill Training:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="technicalTraining" value="yes"> Yes</label>
                        <label><input type="radio" name="technicalTraining" value="no" checked> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Basic Training:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="basicTraining" value="yes"> Yes</label>
                        <label><input type="radio" name="basicTraining" value="no" checked> No</label>
                    </div>
                </div>
                <div>
                    <label>Consultancy Service:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="consultancy" value="yes"> Yes</label>
                        <label><input type="radio" name="consultancy" value="no" checked> No</label>
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
                        <label><input type="radio" name="auditing" value="yes"> Yes</label>
                        <label><input type="radio" name="auditing" value="no" checked> No</label>
                    </div>
                </div>
                <div>
                    <label>Supervision Services:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="supervision" value="yes"> Yes</label>
                        <label><input type="radio" name="supervision" value="no" checked> No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label>Stabilization:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="stabilization" value="yes"> Yes</label>
                        <label><input type="radio" name="stabilization" value="no" checked> No</label>
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
            <tr>
                <td>1</td>
                <td><input type="text" class="table-input" name="board_name_1"></td>
                <td>
                    <select class="table-input" name="board_gender_1">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_1"></td>
                <td><input type="email" class="table-input" name="board_email_1"></td>
            </tr>
            <tr>
                <td>2</td>
                <td><input type="text" class="table-input" name="board_name_2"></td>
                <td>
                    <select class="table-input" name="board_gender_2">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_2"></td>
                <td><input type="email" class="table-input" name="board_email_2"></td>
            </tr>
            <tr>
                <td>3</td>
                <td><input type="text" class="table-input" name="board_name_3"></td>
                <td>
                    <select class="table-input" name="board_gender_3">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_3"></td>
                <td><input type="email" class="table-input" name="board_email_3"></td>
            </tr>
            <tr>
                <td>4</td>
                <td><input type="text" class="table-input" name="board_name_4"></td>
                <td>
                    <select class="table-input" name="board_gender_4">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_4"></td>
                <td><input type="email" class="table-input" name="board_email_4"></td>
            </tr>
            <tr>
                <td>5</td>
                <td><input type="text" class="table-input" name="board_name_5"></td>
                <td>
                    <select class="table-input" name="board_gender_5">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_5"></td>
                <td><input type="email" class="table-input" name="board_email_5"></td>
            </tr>
            <tr>
                <td>6</td>
                <td><input type="text" class="table-input" name="board_name_6"></td>
                <td>
                    <select class="table-input" name="board_gender_6">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_6"></td>
                <td><input type="email" class="table-input" name="board_email_6"></td>
            </tr>
            <tr>
                <td>7</td>
                <td><input type="text" class="table-input" name="board_name_7"></td>
                <td>
                    <select class="table-input" name="board_gender_7">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_7"></td>
                <td><input type="email" class="table-input" name="board_email_7"></td>
            </tr>
            <tr>
                <td>8</td>
                <td><input type="text" class="table-input" name="board_name_8"></td>
                <td>
                    <select class="table-input" name="board_gender_8">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_8"></td>
                <td><input type="email" class="table-input" name="board_email_8"></td>
            </tr>
            <tr>
                <td>9</td>
                <td><input type="text" class="table-input" name="board_name_9"></td>
                <td>
                    <select class="table-input" name="board_gender_9">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_9"></td>
                <td><input type="email" class="table-input" name="board_email_9"></td>
            </tr>
            <tr>
                <td>10</td>
                <td><input type="text" class="table-input" name="board_name_10"></td>
                <td>
                    <select class="table-input" name="board_gender_10">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_10"></td>
                <td><input type="email" class="table-input" name="board_email_10"></td>
            </tr>
            <tr>
                <td>11</td>
                <td><input type="text" class="table-input" name="board_name_11"></td>
                <td>
                    <select class="table-input" name="board_gender_11">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_11"></td>
                <td><input type="email" class="table-input" name="board_email_11"></td>
            </tr>
            <tr>
                <td>12</td>
                <td><input type="text" class="table-input" name="board_name_12"></td>
                <td>
                    <select class="table-input" name="board_gender_12">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_12"></td>
                <td><input type="email" class="table-input" name="board_email_12"></td>
            </tr>
            <tr>
                <td>13</td>
                <td><input type="text" class="table-input" name="board_name_13"></td>
                <td>
                    <select class="table-input" name="board_gender_13">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_13"></td>
                <td><input type="email" class="table-input" name="board_email_13"></td>
            </tr>
            <tr>
                <td>14</td>
                <td><input type="text" class="table-input" name="board_name_14"></td>
                <td>
                    <select class="table-input" name="board_gender_14">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_14"></td>
                <td><input type="email" class="table-input" name="board_email_14"></td>
            </tr>
            <tr>
                <td>15</td>
                <td><input type="text" class="table-input" name="board_name_15"></td>
                <td>
                    <select class="table-input" name="board_gender_15">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_15"></td>
                <td><input type="email" class="table-input" name="board_email_15"></td>
            </tr>
            <tr>
                <td>16</td>
                <td><input type="text" class="table-input" name="board_name_16"></td>
                <td>
                    <select class="table-input" name="board_gender_16">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_16"></td>
                <td><input type="email" class="table-input" name="board_email_16"></td>
            </tr>
            <tr>
                <td>17</td>
                <td><input type="text" class="table-input" name="board_name_17"></td>
                <td>
                    <select class="table-input" name="board_gender_17">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_17"></td>
                <td><input type="email" class="table-input" name="board_email_17"></td>
            </tr>
            <tr>
                <td>18</td>
                <td><input type="text" class="table-input" name="board_name_18"></td>
                <td>
                    <select class="table-input" name="board_gender_18">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_18"></td>
                <td><input type="email" class="table-input" name="board_email_18"></td>
            </tr>
            <tr>
                <td>19</td>
                <td><input type="text" class="table-input" name="board_name_19"></td>
                <td>
                    <select class="table-input" name="board_gender_19">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_19"></td>
                <td><input type="email" class="table-input" name="board_email_19"></td>
            </tr>
            <tr>
                <td>20</td>
                <td><input type="text" class="table-input" name="board_name_20"></td>
                <td>
                    <select class="table-input" name="board_gender_20">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_20"></td>
                <td><input type="email" class="table-input" name="board_email_20"></td>
            </tr>
            <tr>
                <td>21</td>
                <td><input type="text" class="table-input" name="board_name_21"></td>
                <td>
                    <select class="table-input" name="board_gender_21">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
                <td><input type="text" class="table-input" name="board_position_21"></td>
                <td><input type="email" class="table-input" name="board_email_21"></td>
            </tr>
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
                <td><input type="number" class="table-input" name="total_employees_male" value="0"></td>
                <td><input type="number" class="table-input" name="total_employees_female" value="0"></td>
            </tr>
            <tr>
                <td>Total Number of Executive Employees</td>
                <td><input type="number" class="table-input" name="exec_employees_male" value="0"></td>
                <td><input type="number" class="table-input" name="exec_employees_female" value="0"></td>
            </tr>
            <tr>
                <td>Number of Full-time Employees</td>
                <td><input type="number" class="table-input" name="fulltime_employees_male" value="0"></td>
                <td><input type="number" class="table-input" name="fulltime_employees_female" value="0"></td>
            </tr>
            <tr>
                <td>Number of Part-time Employees</td>
                <td><input type="number" class="table-input" name="parttime_employees_male" value="0"></td>
                <td><input type="number" class="table-input" name="parttime_employees_female" value="0"></td>
            </tr>
            </tbody>
        </table>

        <div class="form-group">
            <label for="execStaffNames">Name of Executive Staff and Position:</label>
            <textarea id="execStaffNames" name="execStaffNames" rows="6" placeholder="List names and positions of executive staff"></textarea>
        </div>

        <!-- 7. Regulator -->
        <h3>7. Regulator</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="regulatorName">Name:</label>
                    <input type="text" id="regulatorName" name="regulatorName">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorAddress">Address:</label>
                    <textarea id="regulatorAddress" name="regulatorAddress" rows="2"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorTel">Tel:</label>
                    <input type="tel" id="regulatorTel" name="regulatorTel">
                </div>
                <div>
                    <label for="regulatorFax">Fax:</label>
                    <input type="tel" id="regulatorFax" name="regulatorFax">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label for="regulatorEmail">Email:</label>
                    <input type="email" id="regulatorEmail" name="regulatorEmail">
                </div>
                <div>
                    <label for="regulatorWebsite">Website:</label>
                    <input type="url" id="regulatorWebsite" name="regulatorWebsite">
                </div>
            </div>
        </div>

        <!-- 8. Challenges and Opportunities -->
        <h3>8. Challenges and Opportunities</h3>
        <div class="form-group">
            <label for="majorChallenges">Major Challenges (e.g., Competition, Regulatory Issues, Financial Inclusion):</label>
            <textarea id="majorChallenges" name="majorChallenges" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="opportunities">Opportunities for Growth (e.g., New markets, Product diversification, Technology adoption):</label>
            <textarea id="opportunities" name="opportunities" rows="5"></textarea>
        </div>

        <!-- 9. Respondent Information -->
        <h3>9. Respondent Information</h3>
        <div class="form-group">
            <div class="form-row">
                <div>
                    <label for="respondentName">Name/Position of Respondent:</label>
                    <input type="text" id="respondentName" name="respondentName" required>
                </div>
                <div>
                    <label for="responseDate">Date:</label>
                    <input type="date" id="responseDate" name="responseDate" required>
                </div>
            </div>
        </div>

        <!-- Note -->
        <div class="note">
            <strong>Note:</strong> Microfinance loan is loan granted to income generating activities and microcredit programs and which is less than US$ 200.
        </div>

        <!-- Submit Section -->
        <div class="submit-section">
            <button type="submit">Submit Form</button>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Please return this form before Feb 28, 2026 to accumail@aaccu.coop</strong></p>
        </div>
    </form>
</div>
{include file="footerv2.tpl"}