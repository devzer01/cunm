<?php
//###############################################################
//### Gen Code  By phpform V 4.012  
//###  Module For db table  member
//###
//###  By Mr. Piya Pimchankam
//###  email : a_piya_p@hotmail.com
//###############################################################
$m		=	isset( $_GET['m'])?$_GET['m']:$_POST['m'];
$op		=	isset( $_GET['op'])?$_GET['op']:$_POST['op'];
$url	=	isset( $_GET['url'])?$_GET['url']:$_POST['url'];
$MEMBER = $_GET['d'];

				//$cookie = cookieAdmindecode($ADMIN);
				$cookie = cookieMemberdecode($MEMBER);
				$mem_id=$cookie[0];
				$username=$cookie[1];
				$password=$cookie[2];
				$member_ofck=$cookie[3];
				$name=$cookie[4];
				$member_name=$cookie[5];

				if( $member_ofck!=MEMBER_USER )
				{
					Header("Refresh: 0;url=$index_file?m=member&op=login");
					exit();
				}

$module_name = "community";
$gr = "member";
$index_file = "member.php";

$template->set_filenames(array(
		'body' => $mainframe[0])
	);
//######################

if(empty($op)){$op="";}

switch($op)
{
		case "pearls":
				Pearls($mem_id,$smem_id,$bench_id,$sbench_id);
			break;
		case "balance":
				Balance($mem_id,$smem_id);
			break;
		case "listmember":
			MemberHomeN();
			break;
	default :
MemberHomeN();
		break;

}


function MemberHomeN()
{
 global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $s_country,$r,$mem_id;

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/listmember.php";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/listmember.php";
	 $template->SetImagePath("modules/$module_name/");
		}

	 $template->set_filenames(array(
		'listform' => $module_file)
		);

		if(empty($page))
		{
		$page=1;
		}
		$page_list=50;
		$table="member";
		//$fieldArr ="mem_id,title,firstname,lastname,email,email_confirmation,organization,addresstype,street,street2,city,state,zip,country,phone,fax,username,password1,password2,player,player_other,interests1,interests2,interests3,interests4,interests5,interests_other,newsletter,member_name,m_address,m_country,m_tel,m_fax,m_email,m_homepage,m_establish,m_vision,m_mission,m_profile_as,members_urban,members_urban_low,members_rural,members_rural_low,market_segmentation,urban_male,urban_female,members_urban_18_19,members_urban_30_45,members_urban_45_60,members_urban_60,rural_male,rural_female,members_rural_18_19,members_rural_30_45,members_rural_45_60,members_rural_60,assets_total,Core_Business,savings_amount,savings_male,savings_female,savings_youth,savings_nonmember,share_amount,share_male,share_female,share_youth,share_nonmember,loan_total,loan_male,loan_female,loan_youth,loan_nonmember,reserve_total,board_name_1,board_pos_1,board_name_2,board_pos_2,board_name_3,board_pos_3,board_name_4,board_pos_4,board_name_5,board_pos_5,board_name_6,board_pos_6,board_name_7,board_pos_7,board_name_8,board_pos_8,board_name_9,board_pos_9,board_name_10,board_pos_10,manage_name_1,manage_pos_1,manage_name_2,manage_pos_2,manage_name_3,manage_pos_3,manage_name_4,manage_pos_4,manage_name_5,manage_pos_5,Iagree,member_of,active, area_code , m_area , register_date";
		$fieldArr=" * ";
		$searchkey="  and  member_of !=".ADMINISTRATOR;
		
		if(!empty($s_country)){
		$searchkey.=" and  m_country = '$s_country' ";
		}

		if(empty($r)){
		$searchkey.=" order by member_name  asc  ";
		}else{
			$searchkey.=" order by  $r  ";
		}

$cnt=1;
		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

						$smem_id=$v["mem_id"];
				$title=$v["title"];
				$firstname=$v["firstname"];
				$lastname=$v["lastname"];
				$email=$v["email"];
				$email_confirmation=$v["email_confirmation"];
				$organization=$v["organization"];
				$addresstype=$v["addresstype"];
				$street=$v["street"];
				$street2=$v["street2"];
				$city=$v["city"];
				$state=$v["state"];
				$zip=$v["zip"];
				$country=$v["country"];
				$phone=$v["phone"];
				$fax=$v["fax"];
				$username=$v["username"];
				$password1=$v["password1"];
				$password2=$v["password2"];
				$player=$v["player"];
				$player_other=$v["player_other"];
				$interests1=$v["interests1"];
				$interests2=$v["interests2"];
				$interests3=$v["interests3"];
				$interests4=$v["interests4"];
				$interests5=$v["interests5"];
				$interests_other=$v["interests_other"];
				$newsletter=$v["newsletter"];
				$member_name=$v["member_name"];
				$m_address=$v["m_address"];
				$m_country=$v["m_country"];
				$m_tel=$v["m_tel"];
				$m_fax=$v["m_fax"];
				$m_email=$v["m_email"];
				$m_homepage=$v["m_homepage"];
				$m_establish=$v["m_establish"];
				$m_vision=$v["m_vision"];
				$m_mission=$v["m_mission"];
				$m_profile_as=$v["m_profile_as"];
				$members_urban=$v["members_urban"];
				$members_urban_low=$v["members_urban_low"];
				$members_rural=$v["members_rural"];
				$members_rural_low=$v["members_rural_low"];
				$market_segmentation=$v["market_segmentation"];
				$urban_male=$v["urban_male"];
				$urban_female=$v["urban_female"];
				$members_urban_18_19=$v["members_urban_18_19"];
				$members_urban_30_45=$v["members_urban_30_45"];
				$members_urban_45_60=$v["members_urban_45_60"];
				$members_urban_60=$v["members_urban_60"];
				$rural_male=$v["rural_male"];
				$rural_female=$v["rural_female"];
				$members_rural_18_19=$v["members_rural_18_19"];
				$members_rural_30_45=$v["members_rural_30_45"];
				$members_rural_45_60=$v["members_rural_45_60"];
				$members_rural_60=$v["members_rural_60"];
				$assets_total=$v["assets_total"];
				$Core_Business=$v["Core_Business"];
				$savings_amount=$v["savings_amount"];
				$savings_male=$v["savings_male"];
				$savings_female=$v["savings_female"];
				$savings_youth=$v["savings_youth"];
				$savings_nonmember=$v["savings_nonmember"];
				$share_amount=$v["share_amount"];
				$share_male=$v["share_male"];
				$share_female=$v["share_female"];
				$share_youth=$v["share_youth"];
				$share_nonmember=$v["share_nonmember"];
				$loan_total=$v["loan_total"];
				$loan_male=$v["loan_male"];
				$loan_female=$v["loan_female"];
				$loan_youth=$v["loan_youth"];
				$loan_nonmember=$v["loan_nonmember"];
				$reserve_total=$v["reserve_total"];
				$board_name_1=$v["board_name_1"];
				$board_pos_1=$v["board_pos_1"];
				$board_name_2=$v["board_name_2"];
				$board_pos_2=$v["board_pos_2"];
				$board_name_3=$v["board_name_3"];
				$board_pos_3=$v["board_pos_3"];
				$board_name_4=$v["board_name_4"];
				$board_pos_4=$v["board_pos_4"];
				$board_name_5=$v["board_name_5"];
				$board_pos_5=$v["board_pos_5"];
				$board_name_6=$v["board_name_6"];
				$board_pos_6=$v["board_pos_6"];
				$board_name_7=$v["board_name_7"];
				$board_pos_7=$v["board_pos_7"];
				$board_name_8=$v["board_name_8"];
				$board_pos_8=$v["board_pos_8"];
				$board_name_9=$v["board_name_9"];
				$board_pos_9=$v["board_pos_9"];
				$board_name_10=$v["board_name_10"];
				$board_pos_10=$v["board_pos_10"];
				$manage_name_1=$v["manage_name_1"];
				$manage_pos_1=$v["manage_pos_1"];
				$manage_name_2=$v["manage_name_2"];
				$manage_pos_2=$v["manage_pos_2"];
				$manage_name_3=$v["manage_name_3"];
				$manage_pos_3=$v["manage_pos_3"];
				$manage_name_4=$v["manage_name_4"];
				$manage_pos_4=$v["manage_pos_4"];
				$manage_name_5=$v["manage_name_5"];
				$manage_pos_5=$v["manage_pos_5"];
				$Iagree=$v["Iagree"];
				$member_of=$v["member_of"];
				$active=$v["active"];

				$area_code =$v["area_code"];
				$m_area = $v["m_area"];
				$register_date = $v["register_date"];
				


		$view ="$index_file?m=$module_name&op=balance&smem_id=$smem_id";

		$template->assign_block_vars('r', array(
			'CNT'=>$cnt++,
					'AREA_CODE'=>$area_code,
		'M_AREA'=>$m_area,
		'REGISTER_DATE'=>$register_date,
			'U_VIEW'=>$view,
		 'MEM_ID'=>$mem_id,
			    'TITLE'=>$title,
			    'FIRSTNAME'=>$firstname,
			    'LASTNAME'=>$lastname,
			    'EMAIL'=>$email,
			    'EMAIL_CONFIRMATION'=>$email_confirmation,
			    'ORGANIZATION'=>$organization,
			    'ADDRESSTYPE'=>$addresstype,
			    'STREET'=>$street,
			    'STREET2'=>$street2,
			    'CITY'=>$city,
			    'STATE'=>$state,
			    'ZIP'=>$zip,
			    'COUNTRY'=>$country,
			    'PHONE'=>$phone,
			    'FAX'=>$fax,
			    'USERNAME'=>$username,
			    'PASSWORD1'=>$password1,
			    'PASSWORD2'=>$password2,
			    'PLAYER'=>$player,
			    'PLAYER_OTHER'=>$player_other,
			    'INTERESTS1'=>$interests1,
			    'INTERESTS2'=>$interests2,
			    'INTERESTS3'=>$interests3,
			    'INTERESTS4'=>$interests4,
			    'INTERESTS5'=>$interests5,
			    'INTERESTS_OTHER'=>$interests_other,
			    'NEWSLETTER'=>$newsletter,
			    'MEMBER_NAME'=>$member_name,
			    'M_ADDRESS'=>$m_address,
			    'M_COUNTRY'=>$m_country,
			    'M_TEL'=>$m_tel,
			    'M_FAX'=>$m_fax,
			    'M_EMAIL'=>$m_email,
			    'M_HOMEPAGE'=>$m_homepage,
			    'M_ESTABLISH'=>$m_establish,
			    'M_VISION'=>$m_vision,
			    'M_MISSION'=>$m_mission,
			    'M_PROFILE_AS'=>$m_profile_as,
			    'MEMBERS_URBAN'=>$members_urban,
			    'MEMBERS_URBAN_LOW'=>$members_urban_low,
			    'MEMBERS_RURAL'=>$members_rural,
			    'MEMBERS_RURAL_LOW'=>$members_rural_low,
			    'MARKET_SEGMENTATION'=>$market_segmentation,
			    'URBAN_MALE'=>$urban_male,
			    'URBAN_FEMALE'=>$urban_female,
			'MEMBER'=>number_format( $urban_male + $urban_female ),
			    'MEMBERS_URBAN_18_19'=>$members_urban_18_19,
			    'MEMBERS_URBAN_30_45'=>$members_urban_30_45,
			    'MEMBERS_URBAN_45_60'=>$members_urban_45_60,
			    'MEMBERS_URBAN_60'=>$members_urban_60,
			    'RURAL_MALE'=>$rural_male,
			    'RURAL_FEMALE'=>$rural_female,
			    'MEMBERS_RURAL_18_19'=>$members_rural_18_19,
			    'MEMBERS_RURAL_30_45'=>$members_rural_30_45,
			    'MEMBERS_RURAL_45_60'=>$members_rural_45_60,
			    'MEMBERS_RURAL_60'=>$members_rural_60,
			    'ASSETS_TOTAL'=>$assets_total,
			    'CORE_BUSINESS'=>$Core_Business,
			    'SAVINGS_AMOUNT'=>$savings_amount,
			    'SAVINGS_MALE'=>$savings_male,
			    'SAVINGS_FEMALE'=>$savings_female,
			    'SAVINGS_YOUTH'=>$savings_youth,
			    'SAVINGS_NONMEMBER'=>$savings_nonmember,
			    'SHARE_AMOUNT'=>$share_amount,
			    'SHARE_MALE'=>$share_male,
			    'SHARE_FEMALE'=>$share_female,
			    'SHARE_YOUTH'=>$share_youth,
			    'SHARE_NONMEMBER'=>$share_nonmember,
			    'LOAN_TOTAL'=>$loan_total,
			    'LOAN_MALE'=>$loan_male,
			    'LOAN_FEMALE'=>$loan_female,
			    'LOAN_YOUTH'=>$loan_youth,
			    'LOAN_NONMEMBER'=>$loan_nonmember,
			    'RESERVE_TOTAL'=>$reserve_total,
			    'BOARD_NAME_1'=>$board_name_1,
			    'BOARD_POS_1'=>$board_pos_1,
			    'BOARD_NAME_2'=>$board_name_2,
			    'BOARD_POS_2'=>$board_pos_2,
			    'BOARD_NAME_3'=>$board_name_3,
			    'BOARD_POS_3'=>$board_pos_3,
			    'BOARD_NAME_4'=>$board_name_4,
			    'BOARD_POS_4'=>$board_pos_4,
			    'BOARD_NAME_5'=>$board_name_5,
			    'BOARD_POS_5'=>$board_pos_5,
			    'BOARD_NAME_6'=>$board_name_6,
			    'BOARD_POS_6'=>$board_pos_6,
			    'BOARD_NAME_7'=>$board_name_7,
			    'BOARD_POS_7'=>$board_pos_7,
			    'BOARD_NAME_8'=>$board_name_8,
			    'BOARD_POS_8'=>$board_pos_8,
			    'BOARD_NAME_9'=>$board_name_9,
			    'BOARD_POS_9'=>$board_pos_9,
			    'BOARD_NAME_10'=>$board_name_10,
			    'BOARD_POS_10'=>$board_pos_10,
			    'MANAGE_NAME_1'=>$manage_name_1,
			    'MANAGE_POS_1'=>$manage_pos_1,
			    'MANAGE_NAME_2'=>$manage_name_2,
			    'MANAGE_POS_2'=>$manage_pos_2,
			    'MANAGE_NAME_3'=>$manage_name_3,
			    'MANAGE_POS_3'=>$manage_pos_3,
			    'MANAGE_NAME_4'=>$manage_name_4,
			    'MANAGE_POS_4'=>$manage_pos_4,
			    'MANAGE_NAME_5'=>$manage_name_5,
			    'MANAGE_POS_5'=>$manage_pos_5,
			    'IAGREE'=>$Iagree,
			    'MEMBER_OF'=>$member_of,
			    'ACTIVE'=>$active,
			     'U_DETAIL'=>$detail,  
        'U_DEL'=>$del,
		'U_EDIT'=>$edit
		)	);
	} // end while
}else{
 $template->assign_block_vars('norow', array(
	 '#'=>1
	 ));
}// end if

	$link="$index_file?m=$module_name&op=listmember";
	$template->assign_vars(array(
      'PAGE_LIST'=>List_PageStr($page,$totalpage,$link),
		'JAVA_URL'=>"$index_file?m=$module_name&op=del",
		'U_ADD'=>"$index_file?m=$module_name&op=inputmember&gr=$gr",
		'n_s'=>"$index_file?m=$module_name&op=search&s_country=$s_country&r=member_name  asc",
		'c_s'=>"$index_file?m=$module_name&op=search&s_country=$s_country&r=m_country  asc",
		'g_s'=>"$index_file?m=$module_name&op=search&s_country=$s_country&r=assets_total desc ",
		'm_s'=>"$index_file?m=$module_name&op=search&s_country=$s_country&r= "
		)	);

	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		));

	   $menu=GetMenu();

	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
  $template->SetImagePath("");
   $template->pparse('body');


}



function Pearls($mem_id,$smem_id,$bench_id,$sbench_id)
{
	global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
	

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/pearls.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/pearls.htm";
	 $template->SetImagePath("modules/$module_name/");
		}


	 $template->set_filenames(array(
		'pearls' => $module_file)
		);
	 
				



	 $table="bench_result";
			$fieldArr =" * ";
			$searchkey=" and bench_id = $bench_id ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			$col=1;

				while($row = $db->sql_fetchrow($result))
				{

				$resu=$row["resu"];
				$bench_id=$row["bench_id"];
				$mem_id=$row["mem_id"];
				$date = SearchSingleDB( " and bench_id='$bench_id'  " ,"bench","balance_sheet");

				$P1=$row["P1"];
				$P2=$row["P2"];
				$P3=$row["P3"];
				$P4=$row["P4"];
				$P5=$row["P5"];
				$P6=$row["P6"];
				$E1=$row["E1"];
				$E2=$row["E2"];
				$E3=$row["E3"];
				$E4=$row["E4"];
				$E5=$row["E5"];
				$E6=$row["E6"];
				$E7=$row["E7"];
				$E8=$row["E8"];
				$E9=$row["E9"];
				$A1=$row["A1"];
				$A2=$row["A2"];
				$A3=$row["A3"];
				$R1=$row["R1"];
				$R2=$row["R2"];
				$R3=$row["R3"];
				$R4=$row["R4"];
				$R5=$row["R5"];
				$R6=$row["R6"];
				$R7=$row["R7"];
				$R8=$row["R8"];
				$R9=$row["R9"];
				$R10=$row["R10"];
				$R11=$row["R11"];
				$R12=$row["R12"];
				$L1=$row["L1"];
				$L2=$row["L2"];
				$L3=$row["L3"];
				$S1=$row["S1"];
				$S2=$row["S2"];
				$S3=$row["S3"];
				$S4=$row["S4"];
				$S5=$row["S5"];
				$S6=$row["S6"];
				$S7=$row["S7"];
				$S8=$row["S8"];
				$S9=$row["S9"];
				$S10=$row["S10"];
				$S11=$row["S11"];
				$P1_SCORE=$row["P1_SCORE"];
				$P2_SCORE=$row["P2_SCORE"];
				$P5_SCORE=$row["P5_SCORE"];
				$P6_SCORE=$row["P6_SCORE"];
				$E1_SCORE=$row["E1_SCORE"];
				$E2_SCORE=$row["E2_SCORE"];
				$E3_SCORE=$row["E3_SCORE"];
				$E4_SCORE=$row["E4_SCORE"];
				$E5_SCORE=$row["E5_SCORE"];
				$E6_SCORE=$row["E6_SCORE"];
				$E7_SCORE=$row["E7_SCORE"];
				$E8_SCORE=$row["E8_SCORE"];
				$E9_SCORE=$row["E9_SCORE"];
				$A1_SCORE=$row["A1_SCORE"];
				$A2_SCORE=$row["A2_SCORE"];
				$A3_SCORE=$row["A3_SCORE"];
				$R9_SCORE=$row["R9_SCORE"];
				$L1_SCORE=$row["L1_SCORE"];
				$L2_SCORE=$row["L2_SCORE"];
				$L3_SCORE=$row["L3_SCORE"];

			$template->assign_vars(array(
				'DATE'.$col=>$date
			));

				//==== P =========
				for($p=1;$p<=6;$p++)
				{
					$pvar ="P".$p."_".$col;
					@eval( '$Pans = number_format($P'.$p.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$pvar=>$Pans,
						));
				}
				//==== E =========
				for($e=1;$e<=9;$e++)
				{
					$evar ="E".$e."_".$col;
					@eval( '$Eans = number_format($E'.$e.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$evar=>$Eans,
						));
				}
				//==== A =========
				for($a=1;$a<=9;$a++)
				{
					$avar ="A".$a."_".$col;
					@eval( '$Aans = number_format($A'.$a.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$avar=>$Aans,
						));
				}
				//==== R =========
				for($r=1;$r<=12;$r++)
				{
					$rvar ="R".$r."_".$col;
					@eval( '$Rans = number_format($R'.$r.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$rvar=>$Rans,
						));
				}
				//==== L =========
				for($l=1;$l<=3;$l++)
				{
					$lvar ="L".$l."_".$col;
					@eval( '$Lans = number_format($L'.$l.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$lvar=>$Lans,
						));
				}
				//==== S =========
				for($s=1;$s<=11;$s++)
				{
					$svar ="S".$s."_".$col;
					@eval( '$Sans = number_format($S'.$s.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$svar=>$Sans,
						));
				}


			}

  
	 $table="bench_result";
			$fieldArr =" * ";
			$searchkey=" and bench_id = $sbench_id ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			$col=2;

				while($row = $db->sql_fetchrow($result))
				{

				$resu=$row["resu"];
				$bench_id=$row["bench_id"];
				$mem_id=$row["mem_id"];
				$date = SearchSingleDB( " and bench_id='$bench_id'  " ,"bench","balance_sheet");

				$P1=$row["P1"];
				$P2=$row["P2"];
				$P3=$row["P3"];
				$P4=$row["P4"];
				$P5=$row["P5"];
				$P6=$row["P6"];
				$E1=$row["E1"];
				$E2=$row["E2"];
				$E3=$row["E3"];
				$E4=$row["E4"];
				$E5=$row["E5"];
				$E6=$row["E6"];
				$E7=$row["E7"];
				$E8=$row["E8"];
				$E9=$row["E9"];
				$A1=$row["A1"];
				$A2=$row["A2"];
				$A3=$row["A3"];
				$R1=$row["R1"];
				$R2=$row["R2"];
				$R3=$row["R3"];
				$R4=$row["R4"];
				$R5=$row["R5"];
				$R6=$row["R6"];
				$R7=$row["R7"];
				$R8=$row["R8"];
				$R9=$row["R9"];
				$R10=$row["R10"];
				$R11=$row["R11"];
				$R12=$row["R12"];
				$L1=$row["L1"];
				$L2=$row["L2"];
				$L3=$row["L3"];
				$S1=$row["S1"];
				$S2=$row["S2"];
				$S3=$row["S3"];
				$S4=$row["S4"];
				$S5=$row["S5"];
				$S6=$row["S6"];
				$S7=$row["S7"];
				$S8=$row["S8"];
				$S9=$row["S9"];
				$S10=$row["S10"];
				$S11=$row["S11"];
				$P1_SCORE=$row["P1_SCORE"];
				$P2_SCORE=$row["P2_SCORE"];
				$P5_SCORE=$row["P5_SCORE"];
				$P6_SCORE=$row["P6_SCORE"];
				$E1_SCORE=$row["E1_SCORE"];
				$E2_SCORE=$row["E2_SCORE"];
				$E3_SCORE=$row["E3_SCORE"];
				$E4_SCORE=$row["E4_SCORE"];
				$E5_SCORE=$row["E5_SCORE"];
				$E6_SCORE=$row["E6_SCORE"];
				$E7_SCORE=$row["E7_SCORE"];
				$E8_SCORE=$row["E8_SCORE"];
				$E9_SCORE=$row["E9_SCORE"];
				$A1_SCORE=$row["A1_SCORE"];
				$A2_SCORE=$row["A2_SCORE"];
				$A3_SCORE=$row["A3_SCORE"];
				$R9_SCORE=$row["R9_SCORE"];
				$L1_SCORE=$row["L1_SCORE"];
				$L2_SCORE=$row["L2_SCORE"];
				$L3_SCORE=$row["L3_SCORE"];

			$template->assign_vars(array(
				'DATE'.$col=>$date
			));

				//==== P =========
				for($p=1;$p<=6;$p++)
				{
					$pvar ="P".$p."_".$col;
					@eval( '$Pans = number_format($P'.$p.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$pvar=>$Pans,
						));
				}
				//==== E =========
				for($e=1;$e<=9;$e++)
				{
					$evar ="E".$e."_".$col;
					@eval( '$Eans = number_format($E'.$e.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$evar=>$Eans,
						));
				}
				//==== A =========
				for($a=1;$a<=9;$a++)
				{
					$avar ="A".$a."_".$col;
					@eval( '$Aans = number_format($A'.$a.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$avar=>$Aans,
						));
				}
				//==== R =========
				for($r=1;$r<=12;$r++)
				{
					$rvar ="R".$r."_".$col;
					@eval( '$Rans = number_format($R'.$r.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$rvar=>$Rans,
						));
				}
				//==== L =========
				for($l=1;$l<=3;$l++)
				{
					$lvar ="L".$l."_".$col;
					@eval( '$Lans = number_format($L'.$l.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$lvar=>$Lans,
						));
				}
				//==== S =========
				for($s=1;$s<=11;$s++)
				{
					$svar ="S".$s."_".$col;
					@eval( '$Sans = number_format($S'.$s.',2,\'.\',\',\' );');
						$template->assign_vars(array(
						$svar=>$Sans,
						));
				}


			}





	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		'BENCH'=>"$index_files?m=bench",
		'LINK1'=>"$index_files?m=$module_name&op=balance&smem_id=$smem_id",
		'LINK2'=>"$index_files?m=$module_name&op=pearls&smem_id=$smem_id&bench_id=$bench_id&sbench_id=$sbench_id",
		'OTHER'=>SearchSingleDB( " and mem_id=$smem_id" ,"member","member_name"),
		));

	$menu=GetMenu();

	$html_code =  $template->pparse_str('pearls');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
   $template->SetImagePath("");
   $template->pparse('body');

}



function Balance($mem_id,$smem_id)
{
	global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
	

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/balance.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/balance.htm";
	 $template->SetImagePath("modules/$module_name/");
		}


	 $template->set_filenames(array(
		'balance' => $module_file)
		);




		if($mem_id >$smem_id ){
			$order = "DESC";
		}else{
			$order = "ASC";
		}



		$BenchArr = array();
		$query="select bench_id from bench where mem_id=$mem_id ";
		$query.="order by bench_id desc limit 0,1";

		$res1 = $db->sql_query($query);
		while($v= $db->sql_fetchrow($res1) )
		{
			$lastbench = $v["bench_id"];
			$BenchArr[$mem_id]=$lastbench;
		}
			
		$query="select bench_id from bench where mem_id=$smem_id ";
		$query.="order by bench_id desc limit 0,1";

		$res1 = $db->sql_query($query);
		while($v= $db->sql_fetchrow($res1) )
		{
			$lastbench = $v["bench_id"];
			$BenchArr[$smem_id]=$lastbench;
		}
			//print_r($BenchArr);


        $query=" select * from bench where bench_id=".$BenchArr[$mem_id]."   ";

		$result = $db->sql_query($query);
		$col=1;
	
		while($v= $db->sql_fetchrow($result) )
		{

				$bench_id=$v["bench_id"];
				$mem_id=$v["mem_id"];
				$balance_sheet=$v["balance_sheet"];
		
				$C6=$v["C6"];
				$C7=$v["C7"];
				$C8=$v["C8"];
				$C11=$v["C11"];
				$C14=$v["C14"];
				$C15=$v["C15"];
				$C16=$v["C16"];
				$C19=$v["C19"];
				$C20=$v["C20"];
				$C21=$v["C21"];
				$C22=$v["C22"];
				$C23=$v["C23"];
				$C26=$v["C26"];
				$C27=$v["C27"];
				$C28=$v["C28"];
				$C29=$v["C29"];
				$C32=$v["C32"];
				$C33=$v["C33"];
				$C34=$v["C34"];
				$C35=$v["C35"];
				$C36=$v["C36"];
				$C37=$v["C37"];
				$C40=$v["C40"];
				$C41=$v["C41"];
				$C42=$v["C42"];
				$C43=$v["C43"];
				$C46=$v["C46"];
				$C47=$v["C47"];
				$C48=$v["C48"];
				$C49=$v["C49"];
				$C52=$v["C52"];
				$C53=$v["C53"];
				$C54=$v["C54"];
				$C55=$v["C55"];
				$C56=$v["C56"];
				$income_month=$v["income_month"];
				$income_ended=$v["income_ended"];
				$C63=$v["C63"];
				$C64=$v["C64"];
				$C65=$v["C65"];
				$C66=$v["C66"];
				$C67=$v["C67"];
				$C68=$v["C68"];
				$C69=$v["C69"];
				$C72=$v["C72"];
				$C73=$v["C73"];
				$C74=$v["C74"];
				$C75=$v["C75"];
				$C76=$v["C76"];
				$C78=$v["C78"];
				$C79=$v["C79"];
				$C80=$v["C80"];
				$C81=$v["C81"];
				$C82=$v["C82"];
				$C83=$v["C83"];
				$C84=$v["C84"];
				$C85=$v["C85"];
				$C86=$v["C86"];
				$C87=$v["C87"];
				$C88=$v["C88"];
				$C91=$v["C91"];
				$C92=$v["C92"];
				$C93=$v["C93"];
				$C94=$v["C94"];
				$C95=$v["C95"];
				$C96=$v["C96"];
				$C98=$v["C98"];
				$C99=$v["C99"];
				$C100=$v["C100"];
				$C101=$v["C101"];
				$C102=$v["C102"];
				$C103=$v["C103"];
				$C104=$v["C104"];
				$C105=$v["C105"];
				$C106=$v["C106"];
				$C107=$v["C107"];
				$C108=$v["C108"];
				$C109=$v["C109"];
				$C110=$v["C110"];
				$C111=$v["C111"];
				$C112=$v["C112"];
				$C113=$v["C113"];

			$template->assign_vars(array(
			"DATE".$col=>$balance_sheet
			));
						//==== C =========
				for($c=6;$c<=113;$c++)
				{
					$cvar ="C".$c."_".$col;

					@eval( 'if($C'.$c.'){ $Cans = number_format($C'.$c.',2,\'.\',\',\' ); }else{ $Cans =""; } ');
					//@eval( ' $Cans = number_format($C'.$c.',2,\'.\',\',\' );  ');
						$template->assign_vars(array(
						$cvar=>$Cans,
						));
						
				}

	} // end while


 $query=" select * from bench where bench_id=".$BenchArr[$smem_id]."   ";

		$result = $db->sql_query($query);
		$col=2;
	
		while($v= $db->sql_fetchrow($result) )
		{

				$sbench_id=$v["bench_id"];
				$smem_id=$v["mem_id"];
				$balance_sheet=$v["balance_sheet"];
		
				$C6=$v["C6"];
				$C7=$v["C7"];
				$C8=$v["C8"];
				$C11=$v["C11"];
				$C14=$v["C14"];
				$C15=$v["C15"];
				$C16=$v["C16"];
				$C19=$v["C19"];
				$C20=$v["C20"];
				$C21=$v["C21"];
				$C22=$v["C22"];
				$C23=$v["C23"];
				$C26=$v["C26"];
				$C27=$v["C27"];
				$C28=$v["C28"];
				$C29=$v["C29"];
				$C32=$v["C32"];
				$C33=$v["C33"];
				$C34=$v["C34"];
				$C35=$v["C35"];
				$C36=$v["C36"];
				$C37=$v["C37"];
				$C40=$v["C40"];
				$C41=$v["C41"];
				$C42=$v["C42"];
				$C43=$v["C43"];
				$C46=$v["C46"];
				$C47=$v["C47"];
				$C48=$v["C48"];
				$C49=$v["C49"];
				$C52=$v["C52"];
				$C53=$v["C53"];
				$C54=$v["C54"];
				$C55=$v["C55"];
				$C56=$v["C56"];
				$income_month=$v["income_month"];
				$income_ended=$v["income_ended"];
				$C63=$v["C63"];
				$C64=$v["C64"];
				$C65=$v["C65"];
				$C66=$v["C66"];
				$C67=$v["C67"];
				$C68=$v["C68"];
				$C69=$v["C69"];
				$C72=$v["C72"];
				$C73=$v["C73"];
				$C74=$v["C74"];
				$C75=$v["C75"];
				$C76=$v["C76"];
				$C78=$v["C78"];
				$C79=$v["C79"];
				$C80=$v["C80"];
				$C81=$v["C81"];
				$C82=$v["C82"];
				$C83=$v["C83"];
				$C84=$v["C84"];
				$C85=$v["C85"];
				$C86=$v["C86"];
				$C87=$v["C87"];
				$C88=$v["C88"];
				$C91=$v["C91"];
				$C92=$v["C92"];
				$C93=$v["C93"];
				$C94=$v["C94"];
				$C95=$v["C95"];
				$C96=$v["C96"];
				$C98=$v["C98"];
				$C99=$v["C99"];
				$C100=$v["C100"];
				$C101=$v["C101"];
				$C102=$v["C102"];
				$C103=$v["C103"];
				$C104=$v["C104"];
				$C105=$v["C105"];
				$C106=$v["C106"];
				$C107=$v["C107"];
				$C108=$v["C108"];
				$C109=$v["C109"];
				$C110=$v["C110"];
				$C111=$v["C111"];
				$C112=$v["C112"];
				$C113=$v["C113"];

			$template->assign_vars(array(
			"DATE".$col=>$balance_sheet
			));
						//==== C =========
				for($c=6;$c<=113;$c++)
				{
					$cvar ="C".$c."_".$col;

					@eval( 'if($C'.$c.'){ $Cans = number_format($C'.$c.',2,\'.\',\',\' ); }else{ $Cans =""; } ');
					//@eval( ' $Cans = number_format($C'.$c.',2,\'.\',\',\' );  ');
						$template->assign_vars(array(
						$cvar=>$Cans,
						));
						
				}

	} // end while




	

	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		'BENCH'=>"$index_files?m=bench",
		'LINK1'=>"$index_files?m=$module_name&op=balance&smem_id=$smem_id",
		'LINK2'=>"$index_files?m=$module_name&op=pearls&smem_id=$smem_id&bench_id=$bench_id&sbench_id=$sbench_id",
		'OTHER'=>SearchSingleDB( " and mem_id=$smem_id" ,"member","member_name"),
		));

	$menu=GetMenu();

	$html_code =  $template->pparse_str('balance');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
   $template->SetImagePath("");
   $template->pparse('body');

}




function MemberHome()
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr,$op;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name,$b_country,$b_id,$next,$country;

	 if(empty($next))
	{	
		 $module_file = "modules/$module_name/$gr/memberhome.htm";
	}else{
         $module_file = "modules/$module_name/$gr/memberhome1.htm";
	}

$module_file = "modules/$module_name/$gr/memberhome1.htm";
		 $template->set_filenames(array(
		'listform' => $module_file)
		); 
	$template->assign_vars(array(
      'NAME'=> $name ,
	  'MEMBER_NAME'=>$member_name,
		'LOGOUT'=>"index.php?m=member&op=logout",
		'EDIT_PROFILE'=>"member.php?m=member&op=inputmember",
		'HISTORY'=>"member.php?m=history",
		'COMMUNITY'=>"member.php?m=community",
		'PEARSL'=>"member.php?m=fearsl",
		'BENCH'=>"member.php?m=bench",
		)	);


	$template->assign_vars(array(
		'COUNTRY'=>$country
		)	);

$query=" select bench.bench_id ,bench.mem_id ";
$query.=" ,member.mem_id, member.member_name,member.m_country ";
$query.=" from bench ,member ";
$query.=" where bench.mem_id=member.mem_id  " ;
//$query.=" and bench.mem_id!=$mem_id";
$query.="  group by member.m_country ";
$query.=" order by bench.bench_id";


$MCountryArr = array();

$result = $db->sql_query($query);
	if($db->sql_numrows())
	{
		while($v= $db->sql_fetchrow($result) )
		{

			$m_country = $v["m_country"];
			$MCountryArr[] = $m_country;

		}

	}



if(!empty($b_country)){

	$template->assign_vars(array('LIST_COUNTRY'=>"List Country"));

	$_tmp = array();
	$_tmp2= array();
$query=" select bench.bench_id ,bench.mem_id ";
$query.=" ,member.mem_id, member.member_name,member.m_country ";
$query.=" from bench ,member ";
$query.=" where bench.mem_id=member.mem_id  " ;
//$query.=" and bench.mem_id!=$mem_id";
$query.="  and member.m_country='$b_country' ";
$query.=" order by bench.bench_id";
$result = $db->sql_query($query);
	if($db->sql_numrows())
	{
		while($v= $db->sql_fetchrow($result) )
		{
			$bench_id = $v["bench_id"];
			$mem_id = $v["mem_id"];
			$member_name = $v["member_name"];
			$m_country = $v["m_country"];
			$_tmp2[$mem_id] = $bench_id;

			$_tmp[$bench_id] = $m_country;

			
		}
	}

//--create new array 
$bench_country = array();
   while(list($k,$v)= each($_tmp2))
	{
	   $country =  $_tmp[$v];
		$bench_country[$v] =$country;

        $ckcount = array_count_values ($bench_country);

	 if($ckcount [ $country ]>1){
	 $bench_country[$v] = $_tmp[$v].$ckcount [$country] ;
	 }

	$u_bench="$index_file?m=$module_name&op=$op&gr=$gr&b_id=$v&country=$country";
	$template->assign_block_vars('norow', array( 
		'COUNTRY'=>$bench_country[$v],
		'U_BENCH'=>$u_bench
		));

	}



}// end if !empty($b_country)



//OptionInArray($b_country,$bench_country,"-- Select --"),

$template->assign_vars(array(
'B_COUNTRY'=>OptionV(0,count($MCountryArr)-1,$b_country,$MCountryArr,"-- Select --"),
	'ACTION'=>$index_file,
		 'M'=>$module_name,
	'OP'=>$op,
	'GR'=>$gr
));


  //print_r($bench_country);
//GetBench($b_id);


$table="bench_result";
			$fieldArr =" * ";
			$searchkey="  and   bench_id =$b_id ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			if($db->sql_numrows())
			{
				$row = $db->sql_fetchrow($result);
								$resu=$row["resu"];
				$bench_id=$row["bench_id"];
				$mem_id=$row["mem_id"];
				$P1=$row["P1"];
				$P2=$row["P2"];
				$P3=$row["P3"];
				$P4=$row["P4"];
				$P5=$row["P5"];
				$P6=$row["P6"];
				$E1=$row["E1"];
				$E2=$row["E2"];
				$E3=$row["E3"];
				$E4=$row["E4"];
				$E5=$row["E5"];
				$E6=$row["E6"];
				$E7=$row["E7"];
				$E8=$row["E8"];
				$E9=$row["E9"];
				$A1=$row["A1"];
				$A2=$row["A2"];
				$A3=$row["A3"];
				$R1=$row["R1"];
				$R2=$row["R2"];
				$R3=$row["R3"];
				$R4=$row["R4"];
				$R5=$row["R5"];
				$R6=$row["R6"];
				$R7=$row["R7"];
				$R8=$row["R8"];
				$R9=$row["R9"];
				$R10=$row["R10"];
				$R11=$row["R11"];
				$R12=$row["R12"];
				$L1=$row["L1"];
				$L2=$row["L2"];
				$L3=$row["L3"];
				$S1=$row["S1"];
				$S2=$row["S2"];
				$S3=$row["S3"];
				$S4=$row["S4"];
				$S5=$row["S5"];
				$S6=$row["S6"];
				$S7=$row["S7"];
				$S8=$row["S8"];
				$S9=$row["S9"];
				$S10=$row["S10"];
				$S11=$row["S11"];
				$P1_SCORE=$row["P1_SCORE"];
				$P2_SCORE=$row["P2_SCORE"];
				$P5_SCORE=$row["P5_SCORE"];
				$P6_SCORE=$row["P6_SCORE"];
				$E1_SCORE=$row["E1_SCORE"];
				$E2_SCORE=$row["E2_SCORE"];
				$E3_SCORE=$row["E3_SCORE"];
				$E4_SCORE=$row["E4_SCORE"];
				$E5_SCORE=$row["E5_SCORE"];
				$E6_SCORE=$row["E6_SCORE"];
				$E7_SCORE=$row["E7_SCORE"];
				$E8_SCORE=$row["E8_SCORE"];
				$E9_SCORE=$row["E9_SCORE"];
				$A1_SCORE=$row["A1_SCORE"];
				$A2_SCORE=$row["A2_SCORE"];
				$A3_SCORE=$row["A3_SCORE"];
				$R9_SCORE=$row["R9_SCORE"];
				$L1_SCORE=$row["L1_SCORE"];
				$L2_SCORE=$row["L2_SCORE"];
				$L3_SCORE=$row["L3_SCORE"];
				
				$template->assign_vars(array(
			    'P1'=>number_format($P1,2,'.',','),
			    'P2'=>number_format($P2,2,'.',','),
			    'P3'=>number_format($P3,2,'.',','),
			    'P4'=>number_format($P4,2,'.',','),
			    'P5'=>number_format($P5,2,'.',','),
			    'P6'=>number_format($P6,2,'.',','),
			    'E1'=>number_format($E1,2,'.',','),
			    'E2'=>number_format($E2,2,'.',','),
			    'E3'=>number_format($E3,2,'.',','),
			    'E4'=>number_format($E4,2,'.',','),
			    'E5'=>number_format($E5,2,'.',','),
			    'E6'=>number_format($E6,2,'.',','),
			    'E7'=>number_format($E7,2,'.',','),
			    'E8'=>number_format($E8,2,'.',','),
			    'E9'=>number_format($E9,2,'.',','),
			    'A1'=>number_format($A1,2,'.',','),
			    'A2'=>number_format($A2,2,'.',','),
			    'A3'=>number_format($A3,2,'.',','),
			    'R1'=>number_format($R1,2,'.',','),
			    'R2'=>number_format($R2,2,'.',','),
			    'R3'=>number_format($R3,2,'.',','),
			    'R4'=>number_format($R4,2,'.',','),
			    'R5'=>number_format($R5,2,'.',','),
			    'R6'=>number_format($R6,2,'.',','),
			    'R7'=>number_format($R7,2,'.',','),
			    'R8'=>number_format($R8,2,'.',','),
			    'R9'=>number_format($R9,2,'.',','),
			    'R10'=>number_format($R10,2,'.',','),
			    'R11'=>number_format($R11,2,'.',','),
			    'R12'=>number_format($R12,2,'.',','),
			    'L1'=>number_format($L1,2,'.',','),
			    'L2'=>number_format($L2,2,'.',','),
			    'L3'=>number_format($L3,2,'.',','),
			    'S1'=>number_format($S1,2,'.',','),
			    'S2'=>number_format($S2,2,'.',','),
			    'S3'=>number_format($S3,2,'.',','),
			    'S4'=>number_format($S4,2,'.',','),
			    'S5'=>number_format($S5,2,'.',','),
			    'S6'=>number_format($S6,2,'.',','),
			    'S7'=>number_format($S7,2,'.',','),
			    'S8'=>number_format($S8,2,'.',','),
			    'S9'=>number_format($S9,2,'.',','),
			    'S10'=>number_format($S10,2,'.',','),
			    'S11'=>number_format($S11,2,'.',','),
			    'P1_SCORE'=>number_format($P1_SCORE,2,'.',','),
			    'P2_SCORE'=>number_format($P2_SCORE,2,'.',','),
			    'P5_SCORE'=>number_format($P5_SCORE,2,'.',','),
			    'P6_SCORE'=>number_format($P6_SCORE,2,'.',','),
			    'E1_SCORE'=>number_format($E1_SCORE,2,'.',','),
			    'E2_SCORE'=>number_format($E2_SCORE,2,'.',','),
			    'E3_SCORE'=>number_format($E3_SCORE,2,'.',','),
			    'E4_SCORE'=>number_format($E4_SCORE,2,'.',','),
			    'E5_SCORE'=>number_format($E5_SCORE,2,'.',','),
			    'E6_SCORE'=>number_format($E6_SCORE,2,'.',','),
			    'E7_SCORE'=>number_format($E7_SCORE,2,'.',','),
			    'E8_SCORE'=>number_format($E8_SCORE,2,'.',','),
			    'E9_SCORE'=>number_format($E9_SCORE,2,'.',','),
			    'A1_SCORE'=>number_format($A1_SCORE,2,'.',','),
			    'A2_SCORE'=>number_format($A2_SCORE,2,'.',','),
			    'A3_SCORE'=>number_format($A3_SCORE,2,'.',','),
			    'R9_SCORE'=>number_format($R9_SCORE,2,'.',','),
			    'L1_SCORE'=>number_format($L1_SCORE,2,'.',','),
			    'L2_SCORE'=>number_format($L2_SCORE,2,'.',','),
			    'L3_SCORE'=>number_format($L3_SCORE,2,'.',',')
			    

	)	);
			$template->assign_block_vars('listrow', array(
		 'BENCH_ID'=>$bench_id,
			    'MEM_ID'=>$mem_id,
				));
			}



	$menu=GetMenu();
	$template->SetImagePath("");
	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'COUNT'=>Counter()
		)	);
  $template->SetImagePath("");
   $template->pparse('body');


}

function GetBench($bench_id)
{
	global $template,$db;

//echo $page;
		$page_list=1;
		$table="bench";
		/*$fieldArr ="bench_id,mem_id,balance_sheet,C6,C7,C8,C11,C14,C15,C16,C19,C20,C21,C22,C23,C26,C27,C28,C29,C32,C33,C34,C35,C36,C37,C40,C41,C42,C43,C46,C47,C48,C49,C52,C53,C54,C55,C56,income_month,income_ended,C63,C64,C65,C66,C67,C68,C69,C72,C73,C74,C75,C76,C78,C79,C80,C81,C82,C83,C84,C85,C86,C87,C88,C91,C92,C93,C94,C95,C96,C98,C99,C100,C101,C102,C103,C104,C105,C106,C107,C108,C109,C110,C111,C112,C113,ANS6,ANS7,ANS8,ANS16,ANS21,ANS22,ANS23,ANS26,ANS27,ANS29,ANS32,ANS33,ANS35,ANS36,ANS37,ANS40,ANS41,ANS43,ANS46,ANS48,ANS52,ANS53,ANS54,ANS65,ANS66,ANS67,ANS68,ANS72,ANS73,ANS75,ANS83,ANS84,ANS87,ANS88,ANS92,ANS98,ANS99,ANS100,ANS101,ANS102,ANS103,ANS104,ANS105,ANS106,ANS107,ANS108,ANS109,ANS110,ANS111,ANS112,ANS113,remark6,remark7,remark8,remark16,remark21,remark22,remark23,remark26,remark27,remark29,remark32,remark33,remark35,remark36,remark37,remark40,remark41,remark43,remark46,remark48,remark52,remark53,remark54,remark65,remark66,remark67,remark68,remark72,remark73,remark75,remark83,remark84,remark87,remark88,remark92,remark98,remark99,remark100,remark101,remark102,remark103,remark104,remark105,remark106,remark107,remark108,remark109,remark110,remark111,remark112,remark113";
		*/
		$fieldArr=" * ";
		$searchkey=" and bench_id='$bench_id'    ";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);

		$link="$index_file?m=$module_name&op=listbench";
			$template->assign_vars(array(
				'PAGE_LIST'=>List_PageStr($page,$totalpage,$link)
				));

		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

						$bench_id=$v["bench_id"];
				$mem_id=$v["mem_id"];
				$balance_sheet=$v["balance_sheet"];
				$C6=$v["C6"];
				$C7=$v["C7"];
				$C8=$v["C8"];
				$C11=$v["C11"];
				$C14=$v["C14"];
				$C15=$v["C15"];
				$C16=$v["C16"];
				$C19=$v["C19"];
				$C20=$v["C20"];
				$C21=$v["C21"];
				$C22=$v["C22"];
				$C23=$v["C23"];
				$C26=$v["C26"];
				$C27=$v["C27"];
				$C28=$v["C28"];
				$C29=$v["C29"];
				$C32=$v["C32"];
				$C33=$v["C33"];
				$C34=$v["C34"];
				$C35=$v["C35"];
				$C36=$v["C36"];
				$C37=$v["C37"];
				$C40=$v["C40"];
				$C41=$v["C41"];
				$C42=$v["C42"];
				$C43=$v["C43"];
				$C46=$v["C46"];
				$C47=$v["C47"];
				$C48=$v["C48"];
				$C49=$v["C49"];
				$C52=$v["C52"];
				$C53=$v["C53"];
				$C54=$v["C54"];
				$C55=$v["C55"];
				$C56=$v["C56"];
				$income_month=$v["income_month"];
				$income_ended=$v["income_ended"];
				$C63=$v["C63"];
				$C64=$v["C64"];
				$C65=$v["C65"];
				$C66=$v["C66"];
				$C67=$v["C67"];
				$C68=$v["C68"];
				$C69=$v["C69"];
				$C72=$v["C72"];
				$C73=$v["C73"];
				$C74=$v["C74"];
				$C75=$v["C75"];
				$C76=$v["C76"];
				$C78=$v["C78"];
				$C79=$v["C79"];
				$C80=$v["C80"];
				$C81=$v["C81"];
				$C82=$v["C82"];
				$C83=$v["C83"];
				$C84=$v["C84"];
				$C85=$v["C85"];
				$C86=$v["C86"];
				$C87=$v["C87"];
				$C88=$v["C88"];
				$C91=$v["C91"];
				$C92=$v["C92"];
				$C93=$v["C93"];
				$C94=$v["C94"];
				$C95=$v["C95"];
				$C96=$v["C96"];
				$C98=$v["C98"];
				$C99=$v["C99"];
				$C100=$v["C100"];
				$C101=$v["C101"];
				$C102=$v["C102"];
				$C103=$v["C103"];
				$C104=$v["C104"];
				$C105=$v["C105"];
				$C106=$v["C106"];
				$C107=$v["C107"];
				$C108=$v["C108"];
				$C109=$v["C109"];
				$C110=$v["C110"];
				$C111=$v["C111"];
				$C112=$v["C112"];
				$C113=$v["C113"];
				$ANS6=$v["ANS6"];
				$ANS7=$v["ANS7"];
				$ANS8=$v["ANS8"];
				$ANS16=$v["ANS16"];
				$ANS21=$v["ANS21"];
				$ANS22=$v["ANS22"];
				$ANS23=$v["ANS23"];
				$ANS26=$v["ANS26"];
				$ANS27=$v["ANS27"];
				$ANS29=$v["ANS29"];
				$ANS32=$v["ANS32"];
				$ANS33=$v["ANS33"];
				$ANS35=$v["ANS35"];
				$ANS36=$v["ANS36"];
				$ANS37=$v["ANS37"];
				$ANS40=$v["ANS40"];
				$ANS41=$v["ANS41"];
				$ANS43=$v["ANS43"];
				$ANS46=$v["ANS46"];
				$ANS48=$v["ANS48"];
				$ANS52=$v["ANS52"];
				$ANS53=$v["ANS53"];
				$ANS54=$v["ANS54"];
				$ANS65=$v["ANS65"];
				$ANS66=$v["ANS66"];
				$ANS67=$v["ANS67"];
				$ANS68=$v["ANS68"];
				$ANS72=$v["ANS72"];
				$ANS73=$v["ANS73"];
				$ANS75=$v["ANS75"];
				$ANS83=$v["ANS83"];
				$ANS84=$v["ANS84"];
				$ANS87=$v["ANS87"];
				$ANS88=$v["ANS88"];
				$ANS92=$v["ANS92"];
				$ANS98=$v["ANS98"];
				$ANS99=$v["ANS99"];
				$ANS100=$v["ANS100"];
				$ANS101=$v["ANS101"];
				$ANS102=$v["ANS102"];
				$ANS103=$v["ANS103"];
				$ANS104=$v["ANS104"];
				$ANS105=$v["ANS105"];
				$ANS106=$v["ANS106"];
				$ANS107=$v["ANS107"];
				$ANS108=$v["ANS108"];
				$ANS109=$v["ANS109"];
				$ANS110=$v["ANS110"];
				$ANS111=$v["ANS111"];
				$ANS112=$v["ANS112"];
				$ANS113=$v["ANS113"];
				$remark6=$v["remark6"];
				$remark7=$v["remark7"];
				$remark8=$v["remark8"];
				$remark16=$v["remark16"];
				$remark21=$v["remark21"];
				$remark22=$v["remark22"];
				$remark23=$v["remark23"];
				$remark26=$v["remark26"];
				$remark27=$v["remark27"];
				$remark29=$v["remark29"];
				$remark32=$v["remark32"];
				$remark33=$v["remark33"];
				$remark35=$v["remark35"];
				$remark36=$v["remark36"];
				$remark37=$v["remark37"];
				$remark40=$v["remark40"];
				$remark41=$v["remark41"];
				$remark43=$v["remark43"];
				$remark46=$v["remark46"];
				$remark48=$v["remark48"];
				$remark52=$v["remark52"];
				$remark53=$v["remark53"];
				$remark54=$v["remark54"];
				$remark65=$v["remark65"];
				$remark66=$v["remark66"];
				$remark67=$v["remark67"];
				$remark68=$v["remark68"];
				$remark72=$v["remark72"];
				$remark73=$v["remark73"];
				$remark75=$v["remark75"];
				$remark83=$v["remark83"];
				$remark84=$v["remark84"];
				$remark87=$v["remark87"];
				$remark88=$v["remark88"];
				$remark92=$v["remark92"];
				$remark98=$v["remark98"];
				$remark99=$v["remark99"];
				$remark100=$v["remark100"];
				$remark101=$v["remark101"];
				$remark102=$v["remark102"];
				$remark103=$v["remark103"];
				$remark104=$v["remark104"];
				$remark105=$v["remark105"];
				$remark106=$v["remark106"];
				$remark107=$v["remark107"];
				$remark108=$v["remark108"];
				$remark109=$v["remark109"];
				$remark110=$v["remark110"];
				$remark111=$v["remark111"];
				$remark112=$v["remark112"];
				$remark113=$v["remark113"];
			$template->assign_block_vars('listrow', array(
		 'BENCH_ID'=>$bench_id,
			    'MEM_ID'=>$mem_id,
			    'BALANCE_SHEET'=>$balance_sheet,
		    'INCOME_MONTH'=>$income_month,
			    'INCOME_ENDED'=>$income_ended,

				));


	} // end while
//------ Comment ------
		$table="formula";
		$fieldArr ="for_id,code,name,goals,formula,comment";
		$searchkey=" ";
	$result=SearchDB( $searchkey,$table,$fieldArr);
		while($v= $db->sql_fetchrow($result) )
		{

				//$for_id=$v["for_id"];
				$code=$v["code"];
				//$name=$v["name"];
				//$goals=$v["goals"];
				//$formula=$v["formula"];
				$comment=$v["comment"];

				if( substr($code,0,1)=="P")
				{
				
					$v_name="CP";
				}else{
						$v_name=$code;
					}
				@eval($v_name);

				$template->assign_vars(array("$v_name"=>nl2br($comment )  ));
		}


//***** Cal P =====
		$page=1;
		$page_list=500;
		$table="balancesheet";
		$fieldArr ="bal_id,NO,ASSETS,CVAL,P_FORMULA,PEARLS";
		$searchkey=" order by NO";

		list($totalpage1,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

				$bal_id=$v["bal_id"];
				$NO=$v["NO"];
				$ASSETS=$v["ASSETS"];
				$CVAL=$v["CVAL"];
				$P_FORMULA=$v["P_FORMULA"];
				$PEARLS=$v["PEARLS"];

				if(!empty($P_FORMULA))
			   {
				 @eval($P_FORMULA);

			   }
	} // end while
}// end if

//----- Assign Value

for($i=6;$i<=113;$i++)
	{
	 $cval="C$i";
	 $pval ="P$i";
		$val ="ANS$i";

		 if($$cval!=0){ 
			 $C = number_format($$cval,2,'.',','); 
		 }else{
		$C="";
		 }


		 if($$pval!=0){ 
			 $P = number_format($$pval,2,'.',','); 
		 }else{
		$P="";
		 }
				if($$val!=0){
							$PEAR= number_format($$val,2,'.',','); 
				}else{
							$PEAR="";
				}

   $rem="remark$i";
		$template->assign_vars(array(
			"$cval"=>$C,
			"$pval"=>$P,
			"$val"=>$PEAR,
			"REMARK$i"=>$$rem
					));
	}



}// end if






}

?>