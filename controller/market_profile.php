<?php
/**
 * Market Profile Controller
 * Displays aggregated CU Market Profile data across all federations
 * Grouped by year and provides summary views
 */

// =====================================================
// Market Profile Summary Routes
// =====================================================

// Main dashboard - Year selection
$app->get('/market_profile', function () use ($app, $smarty) {
    $pdo = getDbHandler();

    // Get available years from profiles
    $sql = "SELECT DISTINCT YEAR(created_at) as year
            FROM cu_market_profile
            ORDER BY year DESC";
    $sth = $pdo->query($sql);
    $years = $sth->fetchAll();

    // Get summary statistics by year
    $sql = "SELECT
                YEAR(mp.created_at) as year,
                COUNT(DISTINCT mp.profile_id) as total_profiles,
                COUNT(DISTINCT mp.federation_id) as total_federations,
                COUNT(DISTINCT f.country_id) as total_countries
            FROM cu_market_profile mp
            LEFT JOIN federation f ON mp.federation_id = f.id
            GROUP BY YEAR(mp.created_at)
            ORDER BY year DESC";
    $sth = $pdo->query($sql);
    $yearly_summary = $sth->fetchAll();

    $smarty->assign('years', $years);
    $smarty->assign('yearly_summary', $yearly_summary);
    $smarty->assign('page_title', 'Market Profile Summary');
    $smarty->display('market_profile/index.tpl');
});

// Year overview - Show all sections for selected year
$app->get('/market_profile/year/:year', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    // Get profiles for this year
    $sql = "SELECT mp.*, f.name as federation_name, c.name as country_name
            FROM cu_market_profile mp
            LEFT JOIN federation f ON mp.federation_id = f.id
            LEFT JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $profiles = $sth->fetchAll();

    // Get profile IDs for aggregation
    $profile_ids = array_column($profiles, 'profile_id');
    $smarty->assign('no_data', false);
    if (empty($profile_ids)) {
        $smarty->assign('year', $year);
        $smarty->assign('no_data', true);
        $smarty->display('market_profile/year_overview.tpl');
        return;
    }

    $ids_placeholder = implode(',', array_fill(0, count($profile_ids), '?'));

    // Get section completion status
    $sections = array(
        'country_profile' => 'Country Profiles',
        'memberships' => 'CU Memberships',
        'individual_members' => 'Individual Members',
        'assets' => 'Assets',
        'financial_structure' => 'Financial Structure',
        'movement_manpower' => 'Movement Manpower',
        'federation_info' => 'Federation Info',
        'financial_performance' => 'Financial Performance',
        'business_operations' => 'Business Operations',
        'board_members' => 'Board Members',
        'federation_manpower' => 'Federation Manpower',
        'regulator' => 'Regulator Info'
    );

    $section_data = array();
    foreach ($sections as $key => $label) {
        $table = 'cu_' . $key;
        $sql = "SELECT COUNT(DISTINCT profile_id) as count FROM $table WHERE profile_id IN ($ids_placeholder)";
        $sth = $pdo->prepare($sql);
        $sth->execute($profile_ids);
        $count = $sth->fetch()['count'];
        $section_data[$key] = array(
            'label' => $label,
            'count' => $count,
            'total' => count($profiles)
        );
    }

    $smarty->assign('year', $year);
    $smarty->assign('profiles', $profiles);
    $smarty->assign('section_data', $section_data);
    $smarty->assign('page_title', 'Market Profile ' . $year);
    $smarty->display('market_profile/year_overview.tpl');
});

// =====================================================
// Country Profile Summary
// =====================================================

$app->get('/market_profile/year/:year/country_profile', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    $sql = "SELECT
                c.name as country_name,
                f.name as federation_name,
                cp.*
            FROM cu_country_profile cp
            JOIN cu_market_profile mp ON cp.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $data = $sth->fetchAll();

    $smarty->assign('year', $year);
    $smarty->assign('data', $data);
    $smarty->assign('page_title', 'Country Profiles ' . $year);
    $smarty->display('market_profile/country_profile_summary.tpl');
});

// =====================================================
// CU Memberships Summary
// =====================================================

$app->get('/market_profile/year/:year/memberships', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    // Get individual federation data
    $sql = "SELECT
                c.name as country_name,
                f.name as federation_name,
                m.*
            FROM cu_memberships m
            JOIN cu_market_profile mp ON m.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $memberships = $sth->fetchAll();

    // Calculate aggregated totals
    $totals = array(
        'urban_cu' => 0,
        'urban_members' => 0,
        'urban_lt300' => 0,
        'urban_301_1000' => 0,
        'urban_1001_3000' => 0,
        'urban_3001_5000' => 0,
        'urban_gt5000' => 0,
        'rural_cu' => 0,
        'rural_members' => 0,
        'rural_lt300' => 0,
        'rural_301_1000' => 0,
        'rural_1001_3000' => 0,
        'rural_3001_5000' => 0,
        'rural_gt5000' => 0,
        'total_cu' => 0,
        'total_members' => 0,
        'total_lt300' => 0,
        'total_301_1000' => 0,
        'total_1001_3000' => 0,
        'total_3001_5000' => 0,
        'total_gt5000' => 0,
        'cus_microfinance' => 0
    );

    foreach ($memberships as $row) {
        foreach ($totals as $key => $value) {
            $totals[$key] += (int)$row[$key];
        }
    }

    $smarty->assign('year', $year);
    $smarty->assign('memberships', $memberships);
    $smarty->assign('totals', $totals);
    $smarty->assign('page_title', 'CU Memberships Summary ' . $year);
    $smarty->display('market_profile/memberships_summary.tpl');
});

// =====================================================
// Individual Members Summary
// =====================================================

$app->get('/market_profile/year/:year/individual_members', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    // Get individual federation data
    $sql = "SELECT
                c.name as country_name,
                f.name as federation_name,
                im.*
            FROM cu_individual_members im
            JOIN cu_market_profile mp ON im.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $individual_members = $sth->fetchAll();

    // Calculate aggregated totals
    $totals = array(
        'urban_ind_members' => 0,
        'urban_male' => 0,
        'urban_female' => 0,
        'urban_age_lt20' => 0,
        'urban_age_20_40' => 0,
        'urban_age_40_60' => 0,
        'urban_age_gt60' => 0,
        'rural_ind_members' => 0,
        'rural_male' => 0,
        'rural_female' => 0,
        'rural_age_lt20' => 0,
        'rural_age_20_40' => 0,
        'rural_age_40_60' => 0,
        'rural_age_gt60' => 0,
        'total_ind_members' => 0,
        'total_male' => 0,
        'total_female' => 0,
        'total_age_lt20' => 0,
        'total_age_20_40' => 0,
        'total_age_40_60' => 0,
        'total_age_gt60' => 0
    );

    foreach ($individual_members as $row) {
        foreach ($totals as $key => $value) {
            $totals[$key] += (int)$row[$key];
        }
    }

    $smarty->assign('year', $year);
    $smarty->assign('individual_members', $individual_members);
    $smarty->assign('totals', $totals);
    $smarty->assign('page_title', 'Individual Members Summary ' . $year);
    $smarty->display('market_profile/individual_members_summary.tpl');
});

// =====================================================
// Assets Summary
// =====================================================

$app->get('/market_profile/year/:year/assets', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    // Get individual federation data
    $sql = "SELECT
                c.name as country_name,
                c.currency,
                f.name as federation_name,
                a.*
            FROM cu_assets a
            JOIN cu_market_profile mp ON a.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $assets = $sth->fetchAll();

    // Group by country for totals
    $country_totals = array();
    foreach ($assets as $row) {
        $country = $row['country_name'];
        if (!isset($country_totals[$country])) {
            $country_totals[$country] = array(
                'currency' => $row['currency'],
                'urban_total_assets' => 0,
                'urban_assets_lt100k' => 0,
                'urban_assets_100k_500k' => 0,
                'urban_assets_500k_1m' => 0,
                'urban_assets_gt1m' => 0,
                'rural_total_assets' => 0,
                'rural_assets_lt100k' => 0,
                'rural_assets_100k_500k' => 0,
                'rural_assets_500k_1m' => 0,
                'rural_assets_gt1m' => 0,
                'total_assets' => 0,
                'total_assets_lt100k' => 0,
                'total_assets_100k_500k' => 0,
                'total_assets_500k_1m' => 0,
                'total_assets_gt1m' => 0
            );
        }

        foreach ($country_totals[$country] as $key => $value) {
            if ($key != 'currency') {
                $country_totals[$country][$key] += (float)$row[$key];
            }
        }
    }

    $smarty->assign('year', $year);
    $smarty->assign('assets', $assets);
    $smarty->assign('country_totals', $country_totals);
    $smarty->assign('page_title', 'Assets Summary ' . $year);
    $smarty->display('market_profile/assets_summary.tpl');
});

// =====================================================
// Financial Structure Summary
// =====================================================

$app->get('/market_profile/year/:year/financial_structure', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    $sql = "SELECT
                c.name as country_name,
                c.currency,
                f.name as federation_name,
                fs.*
            FROM cu_financial_structure fs
            JOIN cu_market_profile mp ON fs.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $financial_structure = $sth->fetchAll();

    // Group by country
    $country_totals = array();
    foreach ($financial_structure as $row) {
        $country = $row['country_name'];
        if (!isset($country_totals[$country])) {
            $country_totals[$country] = array(
                'currency' => $row['currency'],
                'share_amount' => 0,
                'savings_amount' => 0,
                'delinquency_amount' => 0,
                'loan_outstanding_amount' => 0,
                'total_loan_granted_amount' => 0,
                'total_reserved_amount' => 0
            );
        }

        $country_totals[$country]['share_amount'] += (float)$row['share_amount'];
        $country_totals[$country]['savings_amount'] += (float)$row['savings_amount'];
        $country_totals[$country]['delinquency_amount'] += (float)$row['delinquency_amount'];
        $country_totals[$country]['loan_outstanding_amount'] += (float)$row['loan_outstanding_amount'];
        $country_totals[$country]['total_loan_granted_amount'] += (float)$row['total_loan_granted_amount'];
        $country_totals[$country]['total_reserved_amount'] += (float)$row['total_reserved_amount'];
    }

    $smarty->assign('year', $year);
    $smarty->assign('financial_structure', $financial_structure);
    $smarty->assign('country_totals', $country_totals);
    $smarty->assign('page_title', 'Financial Structure Summary ' . $year);
    $smarty->display('market_profile/financial_structure_summary.tpl');
});

// =====================================================
// Movement Manpower Summary
// =====================================================

$app->get('/market_profile/year/:year/movement_manpower', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    $sql = "SELECT
                c.name as country_name,
                f.name as federation_name,
                mm.*
            FROM cu_movement_manpower mm
            JOIN cu_market_profile mp ON mm.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $manpower = $sth->fetchAll();

    // Calculate totals
    $totals = array(
        'elected_officers_male' => 0,
        'elected_officers_female' => 0,
        'elected_officers_total' => 0,
        'senior_managers_male' => 0,
        'senior_managers_female' => 0,
        'senior_managers_total' => 0,
        'staff_male' => 0,
        'staff_female' => 0,
        'staff_total' => 0
    );

    foreach ($manpower as $row) {
        foreach ($totals as $key => $value) {
            $totals[$key] += (int)$row[$key];
        }
    }

    $smarty->assign('year', $year);
    $smarty->assign('manpower', $manpower);
    $smarty->assign('totals', $totals);
    $smarty->assign('page_title', 'Movement Manpower Summary ' . $year);
    $smarty->display('market_profile/movement_manpower_summary.tpl');
});

// =====================================================
// Federation Level Summaries
// =====================================================

$app->get('/market_profile/year/:year/federation_info', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    $sql = "SELECT
                c.name as country_name,
                f.name as federation_name,
                fi.*
            FROM cu_federation_info fi
            JOIN cu_market_profile mp ON fi.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $federation_info = $sth->fetchAll();

    // Calculate totals
    $totals = array(
        'total_member_cus' => 0,
        'active_member_cus' => 0,
        'ind_member_total' => 0,
        'ind_member_male' => 0,
        'ind_member_female' => 0
    );

    foreach ($federation_info as $row) {
        foreach ($totals as $key => $value) {
            $totals[$key] += (int)$row[$key];
        }
    }

    $smarty->assign('year', $year);
    $smarty->assign('federation_info', $federation_info);
    $smarty->assign('totals', $totals);
    $smarty->assign('page_title', 'Federation Information Summary ' . $year);
    $smarty->display('market_profile/federation_info_summary.tpl');
});

$app->get('/market_profile/year/:year/financial_performance', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    $sql = "SELECT
                c.name as country_name,
                c.currency,
                f.name as federation_name,
                fp.*
            FROM cu_financial_performance fp
            JOIN cu_market_profile mp ON fp.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':year' => $year));
    $financial_performance = $sth->fetchAll();

    $smarty->assign('year', $year);
    $smarty->assign('financial_performance', $financial_performance);
    $smarty->assign('page_title', 'Financial Performance Summary ' . $year);
    $smarty->display('market_profile/financial_performance_summary.tpl');
});

// =====================================================
// Export to Excel/PDF
// =====================================================

$app->get('/market_profile/year/:year/export', function ($year) use ($app, $smarty) {
    // This route can be extended to export data to Excel or PDF
    // For now, redirect to year overview
    $app->redirect(APP_PATH . '/market_profile/year/' . $year);
});
