<?php
require_once 'vendor/autoload.php';
require_once 'vendor/spipu/html2pdf/html2pdf.class.php';

$app->get("/mandashboard", function () use ($app, $smarty) {
	$smarty->display('mandashboard.tpl');
});

$app->get("/dashboard", function () use ($app, $smarty) {
	$smarty->display('dashboard.tpl');
});

$app->get("/password", function () use ($app, $smarty) {
	$smarty->display('password.tpl');
});

$app->post("/password", function () use ($app, $smarty) {
	
	$db = getDbHandler();
	
	$sql = "UPDATE user SET password = PASSWORD(:password_new) WHERE id = :id AND password = PASSWORD(:password_current) ";
	$sth = $db->prepare($sql);
	$sth->execute(array(':password_new' => $_POST['new_password'], ':id' => $_SESSION['user_id'], ':password_current' => $_POST['current_password']));
	
	if ($sth->rowCount() == 0) {
		setErrorMessage("Password Not Saved, Maybe current password not match");
	} else {
		setSuccessMessage("Password changed");
	}
	
	$app->redirect(APP_PATH . '/password', 301);
	return;
});

$app->group("/report", function () use ($app, $smarty) {
	
	$app->get('/', function () use ($app, $smarty) {
		$db = getDbHandler();

		if ($_SESSION['user_level'] == 0) {

			$sql = "SELECT id, name FROM country";
			$sth = $db->prepare($sql);
			$sth->execute();
			$c = $sth->fetchAll();
			$country = array();
			foreach ($c as $ct) {
				$country[$ct['id']] = $ct['name'];
			}
			$smarty->assign('country', $country);

			$sql = "SELECT id, name FROM federation ";
			$sth = $db->prepare($sql);
			$sth->execute();
			$f = $sth->fetchAll();
			$fed = array();
			foreach ($f as $fd) {
				$fed[$fd['id']] = $fd['name'];
			}
			$smarty->assign('federation', $fed);

			$sql = "SELECT id, name FROM chapter ";
			$sth = $db->prepare($sql);
			$sth->execute();
			$f = $sth->fetchAll();
			$chapters = array();
			foreach ($f as $fd) {
				$chapters[$fd['id']] = $fd['name'];
			}
			$smarty->assign('chapters', $chapters);

			$smarty->assign('cus', array());
		}
		
		$country = "";
		if (isset($_SESSION['user_country_id'])) {
			$sql = "SELECT id, name FROM country WHERE id = :id ";
			$sth = $db->prepare($sql);
			$sth->execute(array(':id' => $_SESSION['user_country_id']));
			$row = $sth->fetch();
			$country = $row['name'];
		}
		
		$smarty->assign('ucountry', $country);

		$ufed = "";
		if (isset($_SESSION['user_federation_id'])) {
			$sql = "SELECT id, name FROM federation WHERE id = :id ";
			$sth = $db->prepare($sql);
			$sth->execute(array(':id' => $_SESSION['user_federation_id']));
			$row = $sth->fetch();
			$ufed = $row['name'];
		}
		$smarty->assign('ufed', $ufed);
		
		$smarty->display('member/report_search.tpl');
	});
	
	$app->post("/main", function () use ($app, $smarty) {
		require_once 'lib/report.php';
		
		if ($_SESSION['user_level'] != 0) {
			
			list($cur, $rate) =  GetCurrencyAndRate();
			
			$smarty->assign('local_currency', $cur);
			$smarty->assign('exchange_rate', $rate);
		}

		$_SESSION['postDataSaved'] = serialize($_POST);
		
		if ($_POST['report_type'] == 2) {
			$smarty->assign('report_type', 'Comparison');
			RunComparisonReport($app, $smarty);
			return;
		} else {
			$smarty->assign('report_type', 'Individual');
			RunIndividualReport($app, $smarty);
		}
	});

	$app->post("/pdf", function () use ($app, $smarty) {
		require_once 'lib/report.php';

		$type = $_POST['type'];
		$_POST = unserialize($_SESSION['postDataSaved']); // = serialize($_POST);

		if ($_SESSION['user_level'] != 0) {

			list($cur, $rate) =  GetCurrencyAndRate();

			$smarty->assign('local_currency', $cur);
			$smarty->assign('exchange_rate', $rate);
		}

		if ($_POST['report_type'] == 2) {
			$smarty->assign('report_type', 'Comparison');
			$html = RunComparisonReport($app, $smarty, 'report_compare_pdf.tpl');

		} else {
			$smarty->assign('report_type', 'Individual');
			$html = RunIndividualReport($app, $smarty, 'report_pdf.tpl');
		}

		switch ($type) {
			case 'pdf':
				try {
					$app->contentType("Content-type: application/pdf");
					header('Content-Disposition: attachment; filename=example.pdf');
					header('Content-Transfer-Encoding: binary');
					$html2pdf = new Html2Pdf('L', 'A4', 'en');
					$html2pdf->setDefaultFont('Arial');
					$html2pdf->writeHTML($html);
					$html2pdf->Output('exemple.pdf');
				} catch (Exception $e) {
					echo $e->getMessage();
				}
				break;
			case 'print':
				echo "<html><head></head><body>";
				echo $html;
				echo "</body></html>";
				break;
			case 'excel':
				$app->contentType("Content-type: application/vnd.ms-exce");
				header("Content-Disposition: attachment; filename=example.xls");
				echo "<html><head></head><body>";
				echo $html;
				echo "</body></html>";
				break;
		}
	});
});

$app->get("/adduser", function () use ($app, $smarty) {
	
	$db = getDbHandler();
	
	$sql = "SELECT id,name FROM country ";
	$sth = $db->prepare($sql);
	$sth->execute();
	$countries = $sth->fetchAll();
	
	$sql = "SELECT id,name FROM federation ";
	$sth = $db->prepare($sql);
	$sth->execute();
	$federations = $sth->fetchAll();
	
	$smarty->assign('countries', $countries);
	
	$smarty->assign('federations', $federations);
	
	if ($_SESSION['user_level'] == 1) {
		$sql = "SELECT id, name FROM primary_union WHERE federation_id = :federation_id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));

		$primarycus = $sth->fetchAll();
		$smarty->assign('primarycus', $primarycus);
		
	}
	$smarty->display('adduser.tpl');	
});

$app->post('/adduser', function () use ($app, $smarty) {
	
	$pdo = getDbHandler();
	
	$sql = "INSERT INTO user (email, password, level, status, federation_id, primary_union_id, country_id) "
	     . " VALUES (:email, PASSWORD(:password), :level, :status, :federation_id, :primary_union_id, :country_id) ";
	
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':email' => $_POST['username'], ':password' => $_POST['password'], 
			':level' => $_POST['level'], ':status' => 1, ':federation_id' => $_POST['federation_id'],
			':primary_union_id' => $_POST['primary_union_id'], ':country_id' => $_POST['country_id']));
	
	setSuccessMessage('User Added');
	
	$app->redirect(APP_PATH . "/admin/users");
	
});

$app->group("/member", function () use ($app, $smarty) {
	require_once 'controller/member.php';
});

$app->group("/federation", function () use ($app, $smarty) {
	
	$app->get("/primarycu", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		$sql = "SELECT id, federation_id, name FROM primary_union WHERE federation_id = :federation_id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));
		
		$primarycus = $sth->fetchAll();
		$smarty->assign('primarycus', $primarycus);
		
		$sql = "SELECT id, federation_id, name FROM chapter WHERE federation_id = :federation_id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));
		
		$chapters = $sth->fetchAll();
		$smarty->assign('chapters', $chapters);
		
		$smarty->display('federation/primarycu.tpl');
	});
	
	$app->post("/primarycu", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		$sql = "INSERT INTO primary_union (federation_id, chapter_id, name) VALUES (:federation_id, :chapter_id, :name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_POST['federation_id'], ':chapter_id' => $_POST['chapter_id'], ':name' => $_POST['name']));
		
		setSuccessMessage('Primary Credit Union Added');
		
		$app->redirect(APP_PATH . '/federation/primarycu');
		
	});
	
	$app->get("/chapter", function () use ($app, $smarty) {
	
		$db = getDbHandler();
		$sql = "SELECT id, federation_id, name FROM chapter WHERE federation_id = :federation_id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));
	
		$chapters = $sth->fetchAll();
		$smarty->assign('chapters', $chapters);
	
		$smarty->display('federation/chapter.tpl');
	});
	
	$app->post("/chapter", function () use ($app, $smarty) {

		$db = getDbHandler();
		$sql = "INSERT INTO chapter (federation_id, name) VALUES (:federation_id, :name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':federation_id' => $_POST['federation_id'], ':name' => $_POST['name']));

		setSuccessMessage('Region/Chapter Added');

		$app->redirect(APP_PATH . '/federation/chapter');

	});

    $app->get("/cu-market-profile/new", function () use ($app, $smarty){
        $smarty->display("federation/cu_market_profile_form.tpl");
    });
    /**
     * Credit Union Market Profile Form - Save Endpoint
     * Slim Framework Controller Action
     *
     * This endpoint handles the submission of the CU Market Profile 2025 form
     * and saves all data to the MySQL database structure with proper foreign key relationships
     */

    $app->post("/cu-market-profile/save", function () use ($app, $smarty) {

        $db = getDbHandler();

        try {
            // Start transaction for data integrity
            $db->beginTransaction();

            // Get federation_id from session
            $federation_id = $_SESSION['user_federation_id'];

            // Check if we're updating an existing profile or creating a new one
            $profile_id = isset($_POST['profile_id']) ? $_POST['profile_id'] : null;

            // =====================================================
            // 1. SAVE/UPDATE MAIN MARKET PROFILE
            // =====================================================
            if ($profile_id) {
                // Update existing profile
                $sql = "UPDATE cu_market_profile SET 
                    organization_name = :org_name,
                    address = :address,
                    telephone = :telephone,
                    fax = :fax,
                    email = :email,
                    website = :website,
                    respondent_name = :respondent_name,
                    response_date = :response_date,
                    major_challenges = :major_challenges,
                    opportunities = :opportunities,
                    updated_at = NOW()
                    WHERE id = :profile_id AND federation_id = :federation_id";

                $sth = $db->prepare($sql);
                $sth->execute(array(
                    ':profile_id' => $profile_id,
                    ':federation_id' => $federation_id,
                    ':org_name' => $_POST['orgName'],
                    ':address' => $_POST['address'],
                    ':telephone' => $_POST['telephone'],
                    ':fax' => $_POST['fax'],
                    ':email' => $_POST['email'],
                    ':website' => $_POST['website'],
                    ':respondent_name' => $_POST['respondentName'],
                    ':response_date' => $_POST['responseDate'],
                    ':major_challenges' => $_POST['majorChallenges'],
                    ':opportunities' => $_POST['opportunities']
                ));
            } else {
                // Create new profile
                $sql = "INSERT INTO cu_market_profile 
                    (federation_id, organization_name, address, telephone, fax, email, website, 
                    respondent_name, response_date, major_challenges, opportunities, submission_date) 
                    VALUES 
                    (:federation_id, :org_name, :address, :telephone, :fax, :email, :website,
                    :respondent_name, :response_date, :major_challenges, :opportunities, NOW())";

                $sth = $db->prepare($sql);
                $sth->execute(array(
                    ':federation_id' => $federation_id,
                    ':org_name' => $_POST['orgName'],
                    ':address' => $_POST['address'],
                    ':telephone' => $_POST['telephone'],
                    ':fax' => $_POST['fax'],
                    ':email' => $_POST['email'],
                    ':website' => $_POST['website'],
                    ':respondent_name' => $_POST['respondentName'],
                    ':response_date' => $_POST['responseDate'],
                    ':major_challenges' => $_POST['majorChallenges'],
                    ':opportunities' => $_POST['opportunities']
                ));

                $profile_id = $db->lastInsertId();
            }

            // =====================================================
            // 2. SAVE COUNTRY PROFILE
            // =====================================================

            // Delete existing country profile data
            $sql = "DELETE FROM cu_country_profile WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            // Insert new country profile data
            $sql = "INSERT INTO cu_country_profile 
                (profile_id, federation_id, population_2024, gdp_usd, gdp_per_capita_usd, 
                local_currency, exchange_rate_dec_2024, cu_penetration) 
                VALUES 
                (:profile_id, :federation_id, :population, :gdp, :gdp_per_capita, 
                :local_currency, :exchange_rate, :cu_penetration)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':population' => $_POST['population'],
                ':gdp' => $_POST['gdp'],
                ':gdp_per_capita' => $_POST['gdpPerCapita'],
                ':local_currency' => $_POST['localCurrency'],
                ':exchange_rate' => $_POST['exchangeRate'],
                ':cu_penetration' => $_POST['cuPenetration']
            ));

            // =====================================================
            // 3. SAVE CREDIT UNIONS AND MEMBERSHIPS
            // =====================================================

            $sql = "DELETE FROM cu_memberships WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_memberships 
                (profile_id, federation_id, urban_cu, urban_members, urban_lt300, urban_301_1000, 
                urban_1001_3000, urban_3001_5000, urban_gt5000, rural_cu, rural_members, rural_lt300, 
                rural_301_1000, rural_1001_3000, rural_3001_5000, rural_gt5000, total_cu, total_members, 
                total_lt300, total_301_1000, total_1001_3000, total_3001_5000, total_gt5000, cus_microfinance) 
                VALUES 
                (:profile_id, :federation_id, :urban_cu, :urban_members, :urban_lt300, :urban_301_1000,
                :urban_1001_3000, :urban_3001_5000, :urban_gt5000, :rural_cu, :rural_members, :rural_lt300,
                :rural_301_1000, :rural_1001_3000, :rural_3001_5000, :rural_gt5000, :total_cu, :total_members,
                :total_lt300, :total_301_1000, :total_1001_3000, :total_3001_5000, :total_gt5000, :cus_microfinance)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':urban_cu' => $_POST['urban_cu'] ?: 0,
                ':urban_members' => $_POST['urban_members'] ?: 0,
                ':urban_lt300' => $_POST['urban_lt300'] ?: 0,
                ':urban_301_1000' => $_POST['urban_301_1000'] ?: 0,
                ':urban_1001_3000' => $_POST['urban_1001_3000'] ?: 0,
                ':urban_3001_5000' => $_POST['urban_3001_5000'] ?: 0,
                ':urban_gt5000' => $_POST['urban_gt5000'] ?: 0,
                ':rural_cu' => $_POST['rural_cu'] ?: 0,
                ':rural_members' => $_POST['rural_members'] ?: 0,
                ':rural_lt300' => $_POST['rural_lt300'] ?: 0,
                ':rural_301_1000' => $_POST['rural_301_1000'] ?: 0,
                ':rural_1001_3000' => $_POST['rural_1001_3000'] ?: 0,
                ':rural_3001_5000' => $_POST['rural_3001_5000'] ?: 0,
                ':rural_gt5000' => $_POST['rural_gt5000'] ?: 0,
                ':total_cu' => $_POST['total_cu'] ?: 0,
                ':total_members' => $_POST['total_members'] ?: 0,
                ':total_lt300' => $_POST['total_lt300'] ?: 0,
                ':total_301_1000' => $_POST['total_301_1000'] ?: 0,
                ':total_1001_3000' => $_POST['total_1001_3000'] ?: 0,
                ':total_3001_5000' => $_POST['total_3001_5000'] ?: 0,
                ':total_gt5000' => $_POST['total_gt5000'] ?: 0,
                ':cus_microfinance' => $_POST['cusMicrofinance'] ?: 0
            ));

            // =====================================================
            // 4. SAVE INDIVIDUAL MEMBERS DATA
            // =====================================================

            $sql = "DELETE FROM cu_individual_members WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_individual_members 
                (profile_id, federation_id, urban_ind_members, urban_male, urban_female, 
                urban_age_lt20, urban_age_20_40, urban_age_40_60, urban_age_gt60,
                rural_ind_members, rural_male, rural_female, rural_age_lt20, rural_age_20_40, 
                rural_age_40_60, rural_age_gt60, total_ind_members, total_male, total_female,
                total_age_lt20, total_age_20_40, total_age_40_60, total_age_gt60) 
                VALUES 
                (:profile_id, :federation_id, :urban_ind_members, :urban_male, :urban_female,
                :urban_age_lt20, :urban_age_20_40, :urban_age_40_60, :urban_age_gt60,
                :rural_ind_members, :rural_male, :rural_female, :rural_age_lt20, :rural_age_20_40,
                :rural_age_40_60, :rural_age_gt60, :total_ind_members, :total_male, :total_female,
                :total_age_lt20, :total_age_20_40, :total_age_40_60, :total_age_gt60)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':urban_ind_members' => $_POST['urban_ind_members'] ?: 0,
                ':urban_male' => $_POST['urban_male'] ?: 0,
                ':urban_female' => $_POST['urban_female'] ?: 0,
                ':urban_age_lt20' => $_POST['urban_age_lt20'] ?: 0,
                ':urban_age_20_40' => $_POST['urban_age_20_40'] ?: 0,
                ':urban_age_40_60' => $_POST['urban_age_40_60'] ?: 0,
                ':urban_age_gt60' => $_POST['urban_age_gt60'] ?: 0,
                ':rural_ind_members' => $_POST['rural_ind_members'] ?: 0,
                ':rural_male' => $_POST['rural_male'] ?: 0,
                ':rural_female' => $_POST['rural_female'] ?: 0,
                ':rural_age_lt20' => $_POST['rural_age_lt20'] ?: 0,
                ':rural_age_20_40' => $_POST['rural_age_20_40'] ?: 0,
                ':rural_age_40_60' => $_POST['rural_age_40_60'] ?: 0,
                ':rural_age_gt60' => $_POST['rural_age_gt60'] ?: 0,
                ':total_ind_members' => $_POST['total_ind_members'] ?: 0,
                ':total_male' => $_POST['total_male'] ?: 0,
                ':total_female' => $_POST['total_female'] ?: 0,
                ':total_age_lt20' => $_POST['total_age_lt20'] ?: 0,
                ':total_age_20_40' => $_POST['total_age_20_40'] ?: 0,
                ':total_age_40_60' => $_POST['total_age_40_60'] ?: 0,
                ':total_age_gt60' => $_POST['total_age_gt60'] ?: 0
            ));

            // =====================================================
            // 5. SAVE ASSETS DATA
            // =====================================================

            $sql = "DELETE FROM cu_assets WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_assets 
                (profile_id, federation_id, urban_total_assets, urban_assets_lt100k, urban_assets_100k_500k,
                urban_assets_500k_1m, urban_assets_gt1m, rural_total_assets, rural_assets_lt100k,
                rural_assets_100k_500k, rural_assets_500k_1m, rural_assets_gt1m, total_assets,
                total_assets_lt100k, total_assets_100k_500k, total_assets_500k_1m, total_assets_gt1m) 
                VALUES 
                (:profile_id, :federation_id, :urban_total_assets, :urban_assets_lt100k, :urban_assets_100k_500k,
                :urban_assets_500k_1m, :urban_assets_gt1m, :rural_total_assets, :rural_assets_lt100k,
                :rural_assets_100k_500k, :rural_assets_500k_1m, :rural_assets_gt1m, :total_assets,
                :total_assets_lt100k, :total_assets_100k_500k, :total_assets_500k_1m, :total_assets_gt1m)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':urban_total_assets' => $_POST['urban_total_assets'] ?: 0,
                ':urban_assets_lt100k' => $_POST['urban_assets_lt100k'] ?: 0,
                ':urban_assets_100k_500k' => $_POST['urban_assets_100k_500k'] ?: 0,
                ':urban_assets_500k_1m' => $_POST['urban_assets_500k_1m'] ?: 0,
                ':urban_assets_gt1m' => $_POST['urban_assets_gt1m'] ?: 0,
                ':rural_total_assets' => $_POST['rural_total_assets'] ?: 0,
                ':rural_assets_lt100k' => $_POST['rural_assets_lt100k'] ?: 0,
                ':rural_assets_100k_500k' => $_POST['rural_assets_100k_500k'] ?: 0,
                ':rural_assets_500k_1m' => $_POST['rural_assets_500k_1m'] ?: 0,
                ':rural_assets_gt1m' => $_POST['rural_assets_gt1m'] ?: 0,
                ':total_assets' => $_POST['total_assets'] ?: 0,
                ':total_assets_lt100k' => $_POST['total_assets_lt100k'] ?: 0,
                ':total_assets_100k_500k' => $_POST['total_assets_100k_500k'] ?: 0,
                ':total_assets_500k_1m' => $_POST['total_assets_500k_1m'] ?: 0,
                ':total_assets_gt1m' => $_POST['total_assets_gt1m'] ?: 0
            ));

            // =====================================================
            // 6. SAVE FINANCIAL STRUCTURE DATA
            // =====================================================

            $sql = "DELETE FROM cu_financial_structure WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_financial_structure 
                (profile_id, federation_id, share_amount, share_male, share_female, share_youth, share_non_members,
                savings_amount, savings_male, savings_female, savings_youth, savings_non_members,
                delinquency_amount, delinquency_male, delinquency_female, delinquency_youth, delinquency_non_members,
                loan_outstanding_amount, loan_outstanding_male, loan_outstanding_female, loan_outstanding_youth, loan_outstanding_non_members,
                total_loan_granted_amount, total_loan_granted_male, total_loan_granted_female, total_loan_granted_youth, total_loan_granted_non_members,
                total_reserved_amount, total_reserved_male, total_reserved_female, total_reserved_youth, total_reserved_non_members) 
                VALUES 
                (:profile_id, :federation_id, :share_amount, :share_male, :share_female, :share_youth, :share_non_members,
                :savings_amount, :savings_male, :savings_female, :savings_youth, :savings_non_members,
                :delinquency_amount, :delinquency_male, :delinquency_female, :delinquency_youth, :delinquency_non_members,
                :loan_outstanding_amount, :loan_outstanding_male, :loan_outstanding_female, :loan_outstanding_youth, :loan_outstanding_non_members,
                :total_loan_granted_amount, :total_loan_granted_male, :total_loan_granted_female, :total_loan_granted_youth, :total_loan_granted_non_members,
                :total_reserved_amount, :total_reserved_male, :total_reserved_female, :total_reserved_youth, :total_reserved_non_members)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':share_amount' => $_POST['share_amount'] ?: 0,
                ':share_male' => $_POST['share_male'] ?: 0,
                ':share_female' => $_POST['share_female'] ?: 0,
                ':share_youth' => $_POST['share_youth'] ?: 0,
                ':share_non_members' => $_POST['share_non_members'] ?: 0,
                ':savings_amount' => $_POST['savings_amount'] ?: 0,
                ':savings_male' => $_POST['savings_male'] ?: 0,
                ':savings_female' => $_POST['savings_female'] ?: 0,
                ':savings_youth' => $_POST['savings_youth'] ?: 0,
                ':savings_non_members' => $_POST['savings_non_members'] ?: 0,
                ':delinquency_amount' => $_POST['delinquency_amount'] ?: 0,
                ':delinquency_male' => $_POST['delinquency_male'] ?: 0,
                ':delinquency_female' => $_POST['delinquency_female'] ?: 0,
                ':delinquency_youth' => $_POST['delinquency_youth'] ?: 0,
                ':delinquency_non_members' => $_POST['delinquency_non_members'] ?: 0,
                ':loan_outstanding_amount' => $_POST['loan_outstanding_amount'] ?: 0,
                ':loan_outstanding_male' => $_POST['loan_outstanding_male'] ?: 0,
                ':loan_outstanding_female' => $_POST['loan_outstanding_female'] ?: 0,
                ':loan_outstanding_youth' => $_POST['loan_outstanding_youth'] ?: 0,
                ':loan_outstanding_non_members' => $_POST['loan_outstanding_non_members'] ?: 0,
                ':total_loan_granted_amount' => $_POST['total_loan_granted_amount'] ?: 0,
                ':total_loan_granted_male' => $_POST['total_loan_granted_male'] ?: 0,
                ':total_loan_granted_female' => $_POST['total_loan_granted_female'] ?: 0,
                ':total_loan_granted_youth' => $_POST['total_loan_granted_youth'] ?: 0,
                ':total_loan_granted_non_members' => $_POST['total_loan_granted_non_members'] ?: 0,
                ':total_reserved_amount' => $_POST['total_reserved_amount'] ?: 0,
                ':total_reserved_male' => $_POST['total_reserved_male'] ?: 0,
                ':total_reserved_female' => $_POST['total_reserved_female'] ?: 0,
                ':total_reserved_youth' => $_POST['total_reserved_youth'] ?: 0,
                ':total_reserved_non_members' => $_POST['total_reserved_non_members'] ?: 0
            ));

            // =====================================================
            // 7. SAVE MOVEMENT MANPOWER DATA
            // =====================================================

            $sql = "DELETE FROM cu_movement_manpower WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_movement_manpower 
                (profile_id, federation_id, elected_officers_male, elected_officers_female, elected_officers_total,
                senior_managers_male, senior_managers_female, senior_managers_total,
                staff_male, staff_female, staff_total) 
                VALUES 
                (:profile_id, :federation_id, :elected_officers_male, :elected_officers_female, :elected_officers_total,
                :senior_managers_male, :senior_managers_female, :senior_managers_total,
                :staff_male, :staff_female, :staff_total)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':elected_officers_male' => $_POST['elected_officers_male'] ?: 0,
                ':elected_officers_female' => $_POST['elected_officers_female'] ?: 0,
                ':elected_officers_total' => $_POST['elected_officers_total'] ?: 0,
                ':senior_managers_male' => $_POST['senior_managers_male'] ?: 0,
                ':senior_managers_female' => $_POST['senior_managers_female'] ?: 0,
                ':senior_managers_total' => $_POST['senior_managers_total'] ?: 0,
                ':staff_male' => $_POST['staff_male'] ?: 0,
                ':staff_female' => $_POST['staff_female'] ?: 0,
                ':staff_total' => $_POST['staff_total'] ?: 0
            ));

            // =====================================================
            // 8. SAVE FEDERATION INFO
            // =====================================================

            $sql = "DELETE FROM cu_federation_info WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_federation_info 
                (profile_id, federation_id, fed_name, reg_date, reg_number, primary_activity,
                fed_address, fed_phone, fed_email, fed_website, total_member_cus, active_member_cus,
                ind_member_total, ind_member_male, ind_member_female, membership_growth) 
                VALUES 
                (:profile_id, :federation_id, :fed_name, :reg_date, :reg_number, :primary_activity,
                :fed_address, :fed_phone, :fed_email, :fed_website, :total_member_cus, :active_member_cus,
                :ind_member_total, :ind_member_male, :ind_member_female, :membership_growth)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':fed_name' => $_POST['fedName'],
                ':reg_date' => $_POST['regDate'],
                ':reg_number' => $_POST['regNumber'],
                ':primary_activity' => $_POST['primaryActivity'],
                ':fed_address' => $_POST['fedAddress'],
                ':fed_phone' => $_POST['fedPhone'],
                ':fed_email' => $_POST['fedEmail'],
                ':fed_website' => $_POST['fedWebsite'],
                ':total_member_cus' => $_POST['totalMemberCUs'] ?: 0,
                ':active_member_cus' => $_POST['activeMemberCUs'] ?: 0,
                ':ind_member_total' => $_POST['indMemberTotal'] ?: 0,
                ':ind_member_male' => $_POST['indMemberMale'] ?: 0,
                ':ind_member_female' => $_POST['indMemberFemale'] ?: 0,
                ':membership_growth' => $_POST['membershipGrowth']
            ));

            // =====================================================
            // 9. SAVE FINANCIAL PERFORMANCE DATA
            // =====================================================

            $sql = "DELETE FROM cu_financial_performance WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_financial_performance 
                (profile_id, federation_id, assets_2024, assets_2025, assets_increase,
                loans_outstanding_2024, loans_outstanding_2025, loans_outstanding_increase,
                share_capital_2024, share_capital_2025, share_capital_increase,
                deposits_2024, deposits_2025, deposits_increase,
                borrowings_2024, borrowings_2025, borrowings_increase,
                institutional_capital_2024, institutional_capital_2025, institutional_capital_increase,
                npl_2024, npl_2025, npl_increase,
                roe_2024, roe_2025, roe_increase,
                car_2024, car_2025, car_increase) 
                VALUES 
                (:profile_id, :federation_id, :assets_2024, :assets_2025, :assets_increase,
                :loans_outstanding_2024, :loans_outstanding_2025, :loans_outstanding_increase,
                :share_capital_2024, :share_capital_2025, :share_capital_increase,
                :deposits_2024, :deposits_2025, :deposits_increase,
                :borrowings_2024, :borrowings_2025, :borrowings_increase,
                :institutional_capital_2024, :institutional_capital_2025, :institutional_capital_increase,
                :npl_2024, :npl_2025, :npl_increase,
                :roe_2024, :roe_2025, :roe_increase,
                :car_2024, :car_2025, :car_increase)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':assets_2024' => $_POST['assets_2024'] ?: 0,
                ':assets_2025' => $_POST['assets_2025'] ?: 0,
                ':assets_increase' => $_POST['assets_increase'] ?: 0,
                ':loans_outstanding_2024' => $_POST['loans_outstanding_2024'] ?: 0,
                ':loans_outstanding_2025' => $_POST['loans_outstanding_2025'] ?: 0,
                ':loans_outstanding_increase' => $_POST['loans_outstanding_increase'] ?: 0,
                ':share_capital_2024' => $_POST['share_capital_2024'] ?: 0,
                ':share_capital_2025' => $_POST['share_capital_2025'] ?: 0,
                ':share_capital_increase' => $_POST['share_capital_increase'] ?: 0,
                ':deposits_2024' => $_POST['deposits_2024'] ?: 0,
                ':deposits_2025' => $_POST['deposits_2025'] ?: 0,
                ':deposits_increase' => $_POST['deposits_increase'] ?: 0,
                ':borrowings_2024' => $_POST['borrowings_2024'] ?: 0,
                ':borrowings_2025' => $_POST['borrowings_2025'] ?: 0,
                ':borrowings_increase' => $_POST['borrowings_increase'] ?: 0,
                ':institutional_capital_2024' => $_POST['institutional_capital_2024'] ?: 0,
                ':institutional_capital_2025' => $_POST['institutional_capital_2025'] ?: 0,
                ':institutional_capital_increase' => $_POST['institutional_capital_increase'] ?: 0,
                ':npl_2024' => $_POST['npl_2024'] ?: 0,
                ':npl_2025' => $_POST['npl_2025'] ?: 0,
                ':npl_increase' => $_POST['npl_increase'] ?: 0,
                ':roe_2024' => $_POST['roe_2024'] ?: 0,
                ':roe_2025' => $_POST['roe_2025'] ?: 0,
                ':roe_increase' => $_POST['roe_increase'] ?: 0,
                ':car_2024' => $_POST['car_2024'] ?: 0,
                ':car_2025' => $_POST['car_2025'] ?: 0,
                ':car_increase' => $_POST['car_increase'] ?: 0
            ));

            // =====================================================
            // 10. SAVE BUSINESS OPERATIONS DATA
            // =====================================================

            $sql = "DELETE FROM cu_business_operations WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_business_operations 
                (profile_id, federation_id, fed_services, staff_engage, core_banking, mobile_banking,
                internet_banking, money_transfer, other_digital_services, loan_products, savings_products,
                professional_training, technical_training, basic_training, consultancy,
                auditing, supervision, stabilization) 
                VALUES 
                (:profile_id, :federation_id, :fed_services, :staff_engage, :core_banking, :mobile_banking,
                :internet_banking, :money_transfer, :other_digital_services, :loan_products, :savings_products,
                :professional_training, :technical_training, :basic_training, :consultancy,
                :auditing, :supervision, :stabilization)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':fed_services' => $_POST['fedServices'],
                ':staff_engage' => $_POST['staffEngage'] ?: 0,
                ':core_banking' => $_POST['coreBanking'] ?: 'no',
                ':mobile_banking' => $_POST['mobileBanking'] ?: 'no',
                ':internet_banking' => $_POST['internetBanking'] ?: 'no',
                ':money_transfer' => $_POST['moneyTransfer'] ?: 'no',
                ':other_digital_services' => $_POST['otherDigitalServices'],
                ':loan_products' => $_POST['loanProducts'],
                ':savings_products' => $_POST['savingsProducts'],
                ':professional_training' => $_POST['professionalTraining'] ?: 'no',
                ':technical_training' => $_POST['technicalTraining'] ?: 'no',
                ':basic_training' => $_POST['basicTraining'] ?: 'no',
                ':consultancy' => $_POST['consultancy'] ?: 'no',
                ':auditing' => $_POST['auditing'] ?: 'no',
                ':supervision' => $_POST['supervision'] ?: 'no',
                ':stabilization' => $_POST['stabilization'] ?: 'no'
            ));

            // =====================================================
            // 11. SAVE BOARD MEMBERS
            // =====================================================

            $sql = "DELETE FROM cu_board_members WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            // Loop through board members (up to 21)
            for ($i = 1; $i <= 21; $i++) {
                if (!empty($_POST['board_name_' . $i])) {
                    $sql = "INSERT INTO cu_board_members 
                        (profile_id, federation_id, member_number, name, gender, position, email) 
                        VALUES 
                        (:profile_id, :federation_id, :member_number, :name, :gender, :position, :email)";

                    $sth = $db->prepare($sql);
                    $sth->execute(array(
                        ':profile_id' => $profile_id,
                        ':federation_id' => $federation_id,
                        ':member_number' => $i,
                        ':name' => $_POST['board_name_' . $i],
                        ':gender' => $_POST['board_gender_' . $i],
                        ':position' => $_POST['board_position_' . $i],
                        ':email' => $_POST['board_email_' . $i]
                    ));
                }
            }

            // =====================================================
            // 12. SAVE FEDERATION MANPOWER
            // =====================================================

            $sql = "DELETE FROM cu_federation_manpower WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_federation_manpower 
                (profile_id, federation_id, total_employees_male, total_employees_female,
                exec_employees_male, exec_employees_female, fulltime_employees_male, fulltime_employees_female,
                parttime_employees_male, parttime_employees_female, exec_staff_names) 
                VALUES 
                (:profile_id, :federation_id, :total_employees_male, :total_employees_female,
                :exec_employees_male, :exec_employees_female, :fulltime_employees_male, :fulltime_employees_female,
                :parttime_employees_male, :parttime_employees_female, :exec_staff_names)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':total_employees_male' => $_POST['total_employees_male'] ?: 0,
                ':total_employees_female' => $_POST['total_employees_female'] ?: 0,
                ':exec_employees_male' => $_POST['exec_employees_male'] ?: 0,
                ':exec_employees_female' => $_POST['exec_employees_female'] ?: 0,
                ':fulltime_employees_male' => $_POST['fulltime_employees_male'] ?: 0,
                ':fulltime_employees_female' => $_POST['fulltime_employees_female'] ?: 0,
                ':parttime_employees_male' => $_POST['parttime_employees_male'] ?: 0,
                ':parttime_employees_female' => $_POST['parttime_employees_female'] ?: 0,
                ':exec_staff_names' => $_POST['execStaffNames']
            ));

            // =====================================================
            // 13. SAVE REGULATOR DATA
            // =====================================================

            $sql = "DELETE FROM cu_regulator WHERE profile_id = :profile_id AND federation_id = :federation_id";
            $sth = $db->prepare($sql);
            $sth->execute(array(':profile_id' => $profile_id, ':federation_id' => $federation_id));

            $sql = "INSERT INTO cu_regulator 
                (profile_id, federation_id, regulator_name, regulator_address, regulator_tel,
                regulator_fax, regulator_email, regulator_website) 
                VALUES 
                (:profile_id, :federation_id, :regulator_name, :regulator_address, :regulator_tel,
                :regulator_fax, :regulator_email, :regulator_website)";

            $sth = $db->prepare($sql);
            $sth->execute(array(
                ':profile_id' => $profile_id,
                ':federation_id' => $federation_id,
                ':regulator_name' => $_POST['regulatorName'],
                ':regulator_address' => $_POST['regulatorAddress'],
                ':regulator_tel' => $_POST['regulatorTel'],
                ':regulator_fax' => $_POST['regulatorFax'],
                ':regulator_email' => $_POST['regulatorEmail'],
                ':regulator_website' => $_POST['regulatorWebsite']
            ));

            // =====================================================
            // COMMIT TRANSACTION
            // =====================================================

            $db->commit();

            setSuccessMessage('Credit Union Market Profile saved successfully!');
            $app->redirect(APP_PATH . "/federation/cu-market-profile/view/" . $profile_id);

        } catch (Exception $e) {
            // Rollback on error
            $db->rollBack();
            print_r($e);

            setErrorMessage('Error saving profile: ' . $e->getMessage());
           // $app->redirect(APP_PATH . "/federation/cu-market-profile/new");
        }
    });

    /**
     * Additional helper endpoint to view saved profile
     */
    $app->get("/cu-market-profile/view/:id", function ($id) use ($app, $smarty) {

        $db = getDbHandler();
        $federation_id = $_SESSION['user_federation_id'];
        $profileId = $id;

        try {

            // 1. Get main profile data
            $profileStmt = $db->prepare("
            SELECT * FROM cu_market_profile
            WHERE profile_id = :profile_id");
            $profileStmt->execute(['profile_id' => $profileId]);
            $profile = $profileStmt->fetch(PDO::FETCH_ASSOC);

            if (!$profile) {
                // Profile not found
                return $app->response->write('Profile not found');
            }

            // 2. Get country profile data
            $countryProfileStmt = $db->prepare("
            SELECT * FROM cu_country_profile
            WHERE profile_id = :profile_id
        ");
            $countryProfileStmt->execute(['profile_id' => $profileId]);
            $countryProfile = $countryProfileStmt->fetch(PDO::FETCH_ASSOC);

            // 3. Get memberships data
            $membershipsStmt = $db->prepare("
            SELECT * FROM cu_memberships 
            WHERE profile_id = :profile_id
        ");
            $membershipsStmt->execute(['profile_id' => $profileId]);
            $memberships = $membershipsStmt->fetch(PDO::FETCH_ASSOC);

            // 4. Get individual members data
            $individualMembersStmt = $db->prepare("
            SELECT * FROM cu_individual_members 
            WHERE profile_id = :profile_id
        ");
            $individualMembersStmt->execute(['profile_id' => $profileId]);
            $individualMembers = $individualMembersStmt->fetch(PDO::FETCH_ASSOC);

            // 5. Get assets data
            $assetsStmt = $db->prepare("
            SELECT * FROM cu_assets 
            WHERE profile_id = :profile_id
        ");
            $assetsStmt->execute(['profile_id' => $profileId]);
            $assets = $assetsStmt->fetch(PDO::FETCH_ASSOC);

            // 6. Get financial structure data
            $financialStructureStmt = $db->prepare("
            SELECT * FROM cu_financial_structure 
            WHERE profile_id = :profile_id
        ");
            $financialStructureStmt->execute(['profile_id' => $profileId]);
            $financialStructure = $financialStructureStmt->fetch(PDO::FETCH_ASSOC);

            // 7. Get movement manpower data
            $movementManpowerStmt = $db->prepare("
            SELECT * FROM cu_movement_manpower 
            WHERE profile_id = :profile_id
        ");
            $movementManpowerStmt->execute(['profile_id' => $profileId]);
            $movementManpower = $movementManpowerStmt->fetch(PDO::FETCH_ASSOC);

            // 8. Get federation info data
            $federationInfoStmt = $db->prepare("
            SELECT * FROM cu_federation_info 
            WHERE profile_id = :profile_id
        ");
            $federationInfoStmt->execute(['profile_id' => $profileId]);
            $federationInfo = $federationInfoStmt->fetch(PDO::FETCH_ASSOC);

            // 9. Get financial performance data
            $financialPerformanceStmt = $db->prepare("
            SELECT * FROM cu_financial_performance 
            WHERE profile_id = :profile_id
        ");
            $financialPerformanceStmt->execute(['profile_id' => $profileId]);
            $financialPerformance = $financialPerformanceStmt->fetch(PDO::FETCH_ASSOC);

            // 10. Get business operations data
            $businessOperationsStmt = $db->prepare("
            SELECT * FROM cu_business_operations 
            WHERE profile_id = :profile_id
        ");
            $businessOperationsStmt->execute(['profile_id' => $profileId]);
            $businessOperations = $businessOperationsStmt->fetch(PDO::FETCH_ASSOC);

            // 11. Get board members data (multiple records)
            $boardMembersStmt = $db->prepare("
            SELECT * FROM cu_board_members 
            WHERE profile_id = :profile_id 
            ORDER BY member_number ASC
        ");
            $boardMembersStmt->execute(['profile_id' => $profileId]);
            $boardMembers = $boardMembersStmt->fetchAll(PDO::FETCH_ASSOC);

            // 12. Get federation manpower data
            $federationManpowerStmt = $db->prepare("
            SELECT * FROM cu_federation_manpower 
            WHERE profile_id = :profile_id
        ");
            $federationManpowerStmt->execute(['profile_id' => $profileId]);
            $federationManpower = $federationManpowerStmt->fetch(PDO::FETCH_ASSOC);

            // 13. Get regulator data
            $regulatorStmt = $db->prepare("
            SELECT * FROM cu_regulator 
            WHERE profile_id = :profile_id
        ");
            $regulatorStmt->execute(['profile_id' => $profileId]);
            $regulator = $regulatorStmt->fetch(PDO::FETCH_ASSOC);

            // Prepare data for Smarty template

            $smarty->assign('profile', $profile);
            $smarty->assign("country_profile", $countryProfile);

            $smarty->assign('memberships', $memberships ?: []);
            $smarty->assign('individual_members', $individualMembers ?: []);
            $smarty->assign('assets', $assets ?: []);
            $smarty->assign('financial_structure', $financialStructure ?: []);
            $smarty->assign('movement_manpower', $movementManpower ?: []);
            $smarty->assign('federation_info', $federationInfo ?: []);
            $smarty->assign('financial_performance', $financialPerformance ?: []);
            $smarty->assign('business_operations', $businessOperations ?: []);
            $smarty->assign('board_members', $boardMembers ?: []);
            $smarty->assign('federation_manpower', $federationManpower ?: []);
            $smarty->assign('regulator', $regulator ?: []);

            // Render Smarty template
            $smarty->display("federation/profile_view.tpl");

        } catch (PDOException $e) {
            // Log error
            error_log("Database error in cu-market-profile/view: " . $e->getMessage());

            // Return error response
            return $app->response->write('An error occurred while retrieving the profile');
        }
    });
});

$app->group("/ajax", function () use ($app, $smarty) {
	require_once 'controller/ajax.php';
});

$app->group("/admin", function () use ($app, $smarty) {
	
	
	$app->get("/unlock", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		$sql = "SELECT ur.*, pu.name AS pu_name, IF(ur.pu_datasheet_id IS NULL, 'Profile', 'Datasheet') AS type FROM unlock_request AS ur "
			 . "LEFT JOIN primary_union AS pu ON ur.primary_union_id = pu.id "
			 . "WHERE unlock_date IS NULL AND ur.federation_id = :fid ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':fid' => $_SESSION['user_federation_id']));
		$reqs = $sth->fetchAll();
		
		$smarty->assign('reqs', $reqs);
		
		$smarty->display('admin/unlocks.tpl');
		
	});
	
	$app->post('/unlock', function () use ($app) {
		
		$db = getDbHandler();
		
		$sql = "SELECT * FROM unlock_request WHERE id = :id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':id' => $_POST['id']));
		
		$req = $sth->fetch();
		
		if ($req['pu_profile_id'] !== null) {
			
			$sql = "UPDATE pu_profile SET locked = 0 WHERE id = :id ";
			$sth = $db->prepare($sql);
			$sth->execute(array(':id' => $req['pu_profile_id']));
			
		} else if ($req['pu_datasheet_id'] !== null) {

			$sql = "UPDATE pu_datasheet SET locked = 0 WHERE id = :id ";
			$sth = $db->prepare($sql);
			$sth->execute(array(':id' => $req['pu_datasheet_id']));
			
		}
		
		$sql = "UPDATE unlock_request SET unlock_date = NOW() WHERE id = :id ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':id' => $_POST['id']));
		
		$app->contentType('application/json');
		echo json_encode(array());
		
	});
	
	$app->get("/servicearea", function () use ($app, $smarty) {

		$db = getDbHandler();
		$sql = "SELECT id, name FROM area ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$areas = $sth->fetchAll();
		
		$smarty->assign('areas', $areas);
		
		$smarty->display('admin/servicearea.tpl');
	});
	
	$app->post('/servicearea', function () use ($app, $smarty) {
		
		$db = getDbHandler();
		
		$sql = "INSERT INTO area (name) VALUES (:name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':name' => $_POST['name']));
		
		setSuccessMessage('Service Area Added');
		
		$app->redirect(APP_PATH . '/admin/servicearea');
	});

	$app->get("/asset", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		$sql = "SELECT id, name FROM asset_group ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$assetgroups = $sth->fetchAll();
		
		$smarty->assign('assetgroups', $assetgroups);
		
		$smarty->display('admin/asset.tpl');
	});
	
	$app->post('/asset', function () use ($app, $smarty) {
	
		$db = getDbHandler();
	
		$sql = "INSERT INTO asset_group (name) VALUES (:name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':name' => $_POST['name']));
	
		setSuccessMessage('Asset Group Added');
	
		$app->redirect(APP_PATH . '/admin/asset');
	});
	
	$app->get("/country", function () use ($app, $smarty) {
	
		$db = getDbHandler();
		$sql = "SELECT c.id, c.name, COUNT(*) AS fedcount FROM country AS c JOIN federation AS f ON f.country_id = c.id GROUP BY f.country_id ORDER BY c.name ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$countries = $sth->fetchAll();
	
		$smarty->assign('countries', $countries);
	
		$smarty->display('admin/country.tpl');
	});
	
	$app->post('/country', function () use ($app, $smarty) {

		$db = getDbHandler();

		$sql = "INSERT INTO country (name) VALUES (:name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':name' => $_POST['name']));

		setSuccessMessage('Country Added');

		$app->redirect(APP_PATH . '/admin/country');
	});
	
	$app->get("/federation", function () use ($app, $smarty) {
	
		$db = getDbHandler();
		
		$sql = "SELECT f.id, f.name, c.name AS country_name, COUNT(pu.id) AS pucount FROM federation AS f JOIN country AS c ON c.id = f.country_id LEFT JOIN primary_union AS pu ON pu.federation_id = f.id GROUP BY f.id ORDER BY f.name ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$federations = $sth->fetchAll();
		
		$sql = "SELECT id, name FROM country ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$countries = $sth->fetchAll();
	
		$smarty->assign('countries', $countries);
		$smarty->assign('federations', $federations);
	
		$smarty->display('admin/federation.tpl');
	});
		
	$app->post('/federation', function () use ($app, $smarty) {

		$db = getDbHandler();

		$sql = "INSERT INTO federation (country_id, name) VALUES (:country_id, :name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':country_id' => $_POST['country_id'], ':name' => $_POST['name']));

		setSuccessMessage('Federation Added');

		$app->redirect(APP_PATH . '/admin/federation');
	});
		

	$app->get("/service", function () use ($app, $smarty) {

		$db = getDbHandler();
		$sql = "SELECT id, name FROM service ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$services = $sth->fetchAll();
		
		$smarty->assign('services', $services);
		
		$smarty->display('admin/service.tpl');
	});
	
	$app->post('/service', function () use ($app, $smarty) {
	
		$db = getDbHandler();
	
		$sql = "INSERT INTO service (name) VALUES (:name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':name' => $_POST['name']));
	
		setSuccessMessage('Service Added');
	
		$app->redirect(APP_PATH . '/admin/service');
	});
	
	$app->get("/balancesheet", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		
		$sql = "SELECT id, name FROM balancesheet_group ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$groups = $sth->fetchAll();
		$smarty->assign('groups', $groups);
		
		$sql = "SELECT id, name FROM balancesheet_sub_group ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$subgroups = $sth->fetchAll();
		$smarty->assign('subgroups', $subgroups);
		
		
		$sql = "SELECT b.name, bg.name AS group_name, bsg.name AS subgroup_name "
		     . "FROM balancesheet AS b "
		     . "JOIN balancesheet_group AS bg ON bg.id = b.group_id "
		     . "JOIN balancesheet_sub_group AS bsg ON bsg.id = b.sub_group_id ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$bslines = $sth->fetchAll();
		$smarty->assign('bslines', $bslines);
		
		$smarty->display('admin/balancesheet.tpl');
	});
	
	$app->post('/balancesheet', function () use ($app, $smarty) {
	
		if (!isset($_POST['group_id']) || $_POST['group_id'] == '') {
			setErrorMessage('Select Group Name');
			$app->redirect(APP_PATH . '/admin/balancesheet');
			return;
		}
		
		if (!isset($_POST['subgroup_id']) || $_POST['subgroup_id'] == '') {
			setErrorMessage('Select Sub Group Name');
			$app->redirect(APP_PATH . '/admin/balancesheet');
			return;
		}
		
		$db = getDbHandler();
	
		$sql = "INSERT INTO balancesheet (group_id, sub_group_id, name) VALUES (:group_id, :sub_group_id, :name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':group_id' => $_POST['group_id'], ':sub_group_id' => $_POST['subgroup_id'], ':name' => $_POST['name']));
	
		setSuccessMessage('Balance Sheet Line Item Added');
	
		$app->redirect(APP_PATH . '/admin/balancesheet');
	});
	
	
	$app->get("/incomestatement", function () use ($app, $smarty) {
	
		$db = getDbHandler();
	
		$sql = "SELECT id, name FROM is_group ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$groups = $sth->fetchAll();
		$smarty->assign('groups', $groups);
	
		$sql = "SELECT id, name FROM is_sub_group ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$subgroups = $sth->fetchAll();
		$smarty->assign('subgroups', $subgroups);
	
	
		$sql = "SELECT i.name, ig.name AS group_name, isg.name AS subgroup_name "
				. "FROM `is` AS i "
				. "JOIN is_group AS ig ON ig.id = i.group_id "
			    . "JOIN is_sub_group AS isg ON isg.id = i.sub_group_id ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$bslines = $sth->fetchAll();
		$smarty->assign('bslines', $bslines);
	
		$smarty->display('admin/incomestatement.tpl');
	});
		
	$app->post('/incomestatement', function () use ($app, $smarty) {

		if (!isset($_POST['group_id']) || $_POST['group_id'] == '') {
			setErrorMessage('Select Group Name');
			$app->redirect(APP_PATH . '/admin/incomestatement');
			return;
		}

		if (!isset($_POST['subgroup_id']) || $_POST['subgroup_id'] == '') {
			setErrorMessage('Select Sub Group Name');
			$app->redirect(APP_PATH . '/admin/incomestatement');
			return;
		}

		$db = getDbHandler();

		$sql = "INSERT INTO `is` (group_id, sub_group_id, name) VALUES (:group_id, :sub_group_id, :name) ";
		$sth = $db->prepare($sql);
		$sth->execute(array(':group_id' => $_POST['group_id'], ':sub_group_id' => $_POST['subgroup_id'], ':name' => $_POST['name']));

		setSuccessMessage('Income Statement Line Item Added');

		$app->redirect(APP_PATH . '/admin/incomestatement');
	});
	
	$app->get("/users", function () use ($app, $smarty) {
		
		$db = getDbHandler();
		$sql = "SELECT u.id, u.email, u.level, u.federation_id, u.primary_union_id, u.country_id, f.name AS fedname, pu.name AS puname, c.name AS country_name  "
				. "FROM user AS u "
				. "JOIN federation AS f ON f.id = u.federation_id "
				. "JOIN primary_union AS pu ON pu.id = u.primary_union_id "
				. "JOIN country AS c ON c.id = u.country_id "
				. " WHERE 1=1 ";
		
		if ($_SESSION['user_level'] == 1) {
			$sql .= " AND u.federation_id = :federation_id ";
		} 
		
		$sth = $db->prepare($sql);
		
		if ($_SESSION['user_level'] == 0) {
			$sth->execute();
		} else {
			$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));
		}
		
		$users = $sth->fetchAll();
		
		$smarty->assign('users', $users);
		
		$sql = "SELECT id, name FROM country ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$countries = $sth->fetchAll();
		
		$smarty->assign('countries', $countries);
		
		$smarty->display('admin/users.tpl');
	});

	$app->get("/user/edit/:id", function ($id) use ($app, $smarty) {

		$db = getDbHandler();
		$sql = "SELECT u.id, u.email, u.level, u.federation_id, u.primary_union_id, u.country_id, f.name AS fedname, pu.name AS puname, c.name AS country_name  "
			. "FROM user AS u "
			. "JOIN federation AS f ON f.id = u.federation_id "
			. "JOIN primary_union AS pu ON pu.id = u.primary_union_id "
			. "JOIN country AS c ON c.id = u.country_id "
			. " WHERE 1=1 AND u.id = :id ";

		if ($_SESSION['user_level'] == 1) {
			$sql .= " AND u.federation_id = :federation_id ";
		}

		$sth = $db->prepare($sql);

		if ($_SESSION['user_level'] == 0) {
			$sth->execute([':id' => $id]);
		} else {
			$sth->execute(array(':federation_id' => $_SESSION['user_federation_id'], ':id' => $id));
		}

		$user = $sth->fetch();

		$smarty->assign('user', $user);

		$sql = "SELECT id, name FROM country ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$countries = $sth->fetchAll();

		$smarty->assign('countries', $countries);

		$sql = "SELECT id,name FROM federation ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$federations = $sth->fetchAll();

		$smarty->assign('federations', $federations);

		if ($_SESSION['user_level'] == 1) {
			$sql = "SELECT id, name FROM primary_union WHERE federation_id = :federation_id ";
			$sth = $db->prepare($sql);
			$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));

			$primarycus = $sth->fetchAll();
			$smarty->assign('primarycus', $primarycus);

		}

		$smarty->display('admin/edituser.tpl');
	});

	$app->post("/user/edit/:id", function ($id) use ($app, $smarty) {

		$pdo = getDbHandler();

		$sql = "UPDATE user SET email = :email, federation_id = :federation_id, primary_union_id = :primary_union_id, country_id = :country_id "
			 . "WHERE id = :id ";

		$sth = $pdo->prepare($sql);
		$sth->execute(array(':email' => $_POST['username'], ':federation_id' => $_POST['federation_id'],
			':primary_union_id' => $_POST['primary_union_id'], ':country_id' => $_POST['country_id'], ':id' => $id));

		setSuccessMessage('User Updated');

		$app->redirect(APP_PATH . "/admin/users");
	});

	$app->get("/user/delete/:id", function ($id) use ($app, $smarty) {

		$pdo = getDbHandler();

		$sql = "DELETE FROM user WHERE id = :id ";

		$sth = $pdo->prepare($sql);
		$sth->execute(array(':id' => $id));

		setSuccessMessage('User Deleted');

		$app->redirect(APP_PATH . "/admin/users");
	});

	$app->get("/user/password/:id", function ($id) use ($app, $smarty) {

		$db = getDbHandler();
		$sql = "SELECT u.id, u.email, u.level, u.federation_id, u.primary_union_id, u.country_id, f.name AS fedname, pu.name AS puname, c.name AS country_name  "
			. "FROM user AS u "
			. "JOIN federation AS f ON f.id = u.federation_id "
			. "JOIN primary_union AS pu ON pu.id = u.primary_union_id "
			. "JOIN country AS c ON c.id = u.country_id "
			. " WHERE 1=1 AND u.id = :id ";

		if ($_SESSION['user_level'] == 1) {
			$sql .= " AND u.federation_id = :federation_id ";
		}

		$sth = $db->prepare($sql);

		if ($_SESSION['user_level'] == 0) {
			$sth->execute([':id' => $id]);
		} else {
			$sth->execute(array(':federation_id' => $_SESSION['user_federation_id'], ':id' => $id));
		}

		$user = $sth->fetch();

		$smarty->assign('user', $user);

		$smarty->display('admin/password.tpl');
	});

	$app->post("/user/password/:id", function ($id) use ($app, $smarty) {

		$pdo = getDbHandler();

		$sql = "UPDATE user SET password = PASSWORD(:password) WHERE id = :id ";

		$sth = $pdo->prepare($sql);
		$sth->execute(array(':password' => $_POST['password'], ':id' => $id));

		setSuccessMessage('Password Changed');

		$app->redirect(APP_PATH . "/admin/users");
	});
	
	$app->post('/users', function () use ($app, $smarty) {
		$db = getDbHandler();
		$sql = "SELECT u.email, u.level, u.federation_id, u.primary_union_id, u.country_id, f.name AS fedname, pu.name AS puname, c.name AS country_name  "
				. "FROM user AS u "
				. "JOIN federation AS f ON f.id = u.federation_id "
				. "JOIN primary_union AS pu ON pu.id = u.primary_union_id "
				. "JOIN country AS c ON c.id = u.country_id "
				. " WHERE 1=1 ";
		
		if ($_SESSION['user_level'] == 1) {
			$sql .= " AND u.federation_id = :federation_id ";
		}
		
		if (isset($_POST['country_id']) && $_POST['country_id'] != -1) {
			$sql .= " AND u.country_id = " . $_POST['country_id'] . " ";
		}
		
		$sql .= " ORDER BY u.email";
		
		$sth = $db->prepare($sql);
		
		if ($_SESSION['user_level'] == 0) {
			$sth->execute();
		} else {
			$sth->execute(array(':federation_id' => $_SESSION['user_federation_id']));
		}
		
		$users = $sth->fetchAll();
		
		$smarty->assign('users', $users);
		
		$sql = "SELECT id, name FROM country ";
		$sth = $db->prepare($sql);
		$sth->execute();
		$countries = $sth->fetchAll();
		
		$smarty->assign('countries', $countries);
		
		$smarty->display('admin/users.tpl');
	});
});


$app->get("/logout", function () use ($app, $smarty) {
	session_destroy();
	$app->redirect(APP_PATH . "/");
});
