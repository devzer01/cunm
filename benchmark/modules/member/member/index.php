<?php
$MEMBER = $_GET['d'];
$smem_id = $_GET['smem_id'];

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
				
$m		=	isset( $_GET['m'])?$_GET['m']:$_POST['m'];
$op		=	isset( $_GET['op'])?$_GET['op']:$_POST['op'];
$url	=	isset( $_GET['url'])?$_GET['url']:$_POST['url'];

$module_name = "member";
$gr = "member";
$index_file = "member.php";

$template->set_filenames(array(
		'body' => $mainframe[0])
	);
//######################

if(empty($op)){$op="";}

switch($op)
{
	    //#####   member #########
		case "savemember":
			Savemember($mem_id,$title,$firstname,$lastname,$email,$email_confirmation,$organization,$addresstype,$street,$street2,$city,$state,$zip,$country,$phone,$fax,$username,$password1,$password2,$player,$player_other,$interests1,$interests2,$interests3,$interests4,$interests5,$interests_other,$newsletter,$member_name,$m_address,$m_country,$m_tel,$m_fax,$m_email,$m_homepage,$m_establish,$m_vision,$m_mission,$m_profile_as,$members_urban,$members_urban_low,$members_rural,$members_rural_low,$market_segmentation,$urban_male,$urban_female,$members_urban_18_19,$members_urban_30_45,$members_urban_45_60,$members_urban_60,$rural_male,$rural_female,$members_rural_18_19,$members_rural_30_45,$members_rural_45_60,$members_rural_60,$assets_total,$Core_Business,$savings_amount,$savings_male,$savings_female,$savings_youth,$savings_nonmember,$share_amount,$share_male,$share_female,$share_youth,$share_nonmember,$loan_total,$loan_male,$loan_female,$loan_youth,$loan_nonmember,$reserve_total,$board_name_1,$board_pos_1,$board_name_2,$board_pos_2,$board_name_3,$board_pos_3,$board_name_4,$board_pos_4,$board_name_5,$board_pos_5,$board_name_6,$board_pos_6,$board_name_7,$board_pos_7,$board_name_8,$board_pos_8,$board_name_9,$board_pos_9,$board_name_10,$board_pos_10,$manage_name_1,$manage_pos_1,$manage_name_2,$manage_pos_2,$manage_name_3,$manage_pos_3,$manage_name_4,$manage_pos_4,$manage_name_5,$manage_pos_5,$Iagree,$member_of,$active,$area_code,$m_area);
			break;
		case "inputmember":
			Inputmember($mem_id);
			break;

		case "detailmember":
			Detailmember($mem_id);
			break;
		//###########################
		case "del":
			Del($tb,$key,$id,$bk,$rt,$page);
			break;
	default :
	Inputmember($mem_id);
		break;

}

function Del($tb,$key,$id,$bk,$rt,$page)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;


		unset($query);
		unset($result);

		$query="DELETE FROM $tb WHERE $key=$id ";
		$db->sql_query($query);
			if(!empty($rt))
			{
			$goto = "$index_file?m=$module_name&op=$rt&gr=$gr";
			}else{
			$goto="$index_file?m=$module_name&op=game&page=$page&gr=$gr#$bk";
			}
	Header("Refresh: 0;url=$goto");

	
}


function Savemember($mem_id,$title,$firstname,$lastname,$email,$email_confirmation,$organization,$addresstype,$street,$street2,$city,$state,$zip,$country,$phone,$fax,$username,$password1,$password2,$player,$player_other,$interests1,$interests2,$interests3,$interests4,$interests5,$interests_other,$newsletter,$member_name,$m_address,$m_country,$m_tel,$m_fax,$m_email,$m_homepage,$m_establish,$m_vision,$m_mission,$m_profile_as,$members_urban,$members_urban_low,$members_rural,$members_rural_low,$market_segmentation,$urban_male,$urban_female,$members_urban_18_19,$members_urban_30_45,$members_urban_45_60,$members_urban_60,$rural_male,$rural_female,$members_rural_18_19,$members_rural_30_45,$members_rural_45_60,$members_rural_60,$assets_total,$Core_Business,$savings_amount,$savings_male,$savings_female,$savings_youth,$savings_nonmember,$share_amount,$share_male,$share_female,$share_youth,$share_nonmember,$loan_total,$loan_male,$loan_female,$loan_youth,$loan_nonmember,$reserve_total,$board_name_1,$board_pos_1,$board_name_2,$board_pos_2,$board_name_3,$board_pos_3,$board_name_4,$board_pos_4,$board_name_5,$board_pos_5,$board_name_6,$board_pos_6,$board_name_7,$board_pos_7,$board_name_8,$board_pos_8,$board_name_9,$board_pos_9,$board_name_10,$board_pos_10,$manage_name_1,$manage_pos_1,$manage_name_2,$manage_pos_2,$manage_name_3,$manage_pos_3,$manage_name_4,$manage_pos_4,$manage_name_5,$manage_pos_5,$Iagree,$member_of,$active,$area_code,$m_area)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath,$gr;

		$table="member";
		if(empty($mem_id))
		{
		$field="mem_id,title,firstname,lastname,email,email_confirmation,organization,addresstype,street,street2,city,state,zip,country,phone,fax,username,password1,password2,player,player_other,interests1,interests2,interests3,interests4,interests5,interests_other,newsletter,member_name,m_address,m_country,m_tel,m_fax,m_email,m_homepage,m_establish,m_vision,m_mission,m_profile_as,members_urban,members_urban_low,members_rural,members_rural_low,market_segmentation,urban_male,urban_female,members_urban_18_19,members_urban_30_45,members_urban_45_60,members_urban_60,rural_male,rural_female,members_rural_18_19,members_rural_30_45,members_rural_45_60,members_rural_60,assets_total,Core_Business,savings_amount,savings_male,savings_female,savings_youth,savings_nonmember,share_amount,share_male,share_female,share_youth,share_nonmember,loan_total,loan_male,loan_female,loan_youth,loan_nonmember,reserve_total,board_name_1,board_pos_1,board_name_2,board_pos_2,board_name_3,board_pos_3,board_name_4,board_pos_4,board_name_5,board_pos_5,board_name_6,board_pos_6,board_name_7,board_pos_7,board_name_8,board_pos_8,board_name_9,board_pos_9,board_name_10,board_pos_10,manage_name_1,manage_pos_1,manage_name_2,manage_pos_2,manage_name_3,manage_pos_3,manage_name_4,manage_pos_4,manage_name_5,manage_pos_5,Iagree,member_of,active";
		$data="NULL,'$title','$firstname','$lastname','$email','$email_confirmation','$organization','$addresstype','$street','$street2','$city','$state','$zip','$country','$phone','$fax','$username','$password1','$password2','$player','$player_other','$interests1','$interests2','$interests3','$interests4','$interests5','$interests_other','$newsletter','$member_name','$m_address','$m_country','$m_tel','$m_fax','$m_email','$m_homepage','$m_establish','$m_vision','$m_mission','$m_profile_as','$members_urban','$members_urban_low','$members_rural','$members_rural_low','$market_segmentation','$urban_male','$urban_female','$members_urban_18_19','$members_urban_30_45','$members_urban_45_60','$members_urban_60','$rural_male','$rural_female','$members_rural_18_19','$members_rural_30_45','$members_rural_45_60','$members_rural_60','$assets_total','$Core_Business','$savings_amount','$savings_male','$savings_female','$savings_youth','$savings_nonmember','$share_amount','$share_male','$share_female','$share_youth','$share_nonmember','$loan_total','$loan_male','$loan_female','$loan_youth','$loan_nonmember','$reserve_total','$board_name_1','$board_pos_1','$board_name_2','$board_pos_2','$board_name_3','$board_pos_3','$board_name_4','$board_pos_4','$board_name_5','$board_pos_5','$board_name_6','$board_pos_6','$board_name_7','$board_pos_7','$board_name_8','$board_pos_8','$board_name_9','$board_pos_9','$board_name_10','$board_pos_10','$manage_name_1','$manage_pos_1','$manage_name_2','$manage_pos_2','$manage_name_3','$manage_pos_3','$manage_name_4','$manage_pos_4','$manage_name_5','$manage_pos_5','$Iagree' ";
		SaveDB( $table,$field,$data);
		}else{
		$dataset="title='$title' ,firstname='$firstname' ,lastname='$lastname' ,email='$email' ,email_confirmation='$email_confirmation' ,organization='$organization' ,addresstype='$addresstype' ,street='$street' ,street2='$street2' ,city='$city' ,state='$state' ,zip='$zip' ,country='$country' ,phone='$phone' ,fax='$fax' ,username='$username' ,password1='$password1' ,password2='$password2' ,player='$player' ,player_other='$player_other' ,interests1='$interests1' ,interests2='$interests2' ,interests3='$interests3' ,interests4='$interests4' ,interests5='$interests5' ,interests_other='$interests_other' ,newsletter='$newsletter' ,member_name='$member_name' ,m_address='$m_address' ,m_country='$m_country' ,m_tel='$m_tel' ,m_fax='$m_fax' ,m_email='$m_email' ,m_homepage='$m_homepage' ,m_establish='$m_establish' ,m_vision='$m_vision' ,m_mission='$m_mission' ,m_profile_as='$m_profile_as' ,members_urban='$members_urban' ,members_urban_low='$members_urban_low' ,members_rural='$members_rural' ,members_rural_low='$members_rural_low' ,market_segmentation='$market_segmentation' ,urban_male='$urban_male' ,urban_female='$urban_female' ,members_urban_18_19='$members_urban_18_19' ,members_urban_30_45='$members_urban_30_45' ,members_urban_45_60='$members_urban_45_60' ,members_urban_60='$members_urban_60' ,rural_male='$rural_male' ,rural_female='$rural_female' ,members_rural_18_19='$members_rural_18_19' ,members_rural_30_45='$members_rural_30_45' ,members_rural_45_60='$members_rural_45_60' ,members_rural_60='$members_rural_60' ,assets_total='$assets_total' ,Core_Business='$Core_Business' ,savings_amount='$savings_amount' ,savings_male='$savings_male' ,savings_female='$savings_female' ,savings_youth='$savings_youth' ,savings_nonmember='$savings_nonmember' ,share_amount='$share_amount' ,share_male='$share_male' ,share_female='$share_female' ,share_youth='$share_youth' ,share_nonmember='$share_nonmember' ,loan_total='$loan_total' ,loan_male='$loan_male' ,loan_female='$loan_female' ,loan_youth='$loan_youth' ,loan_nonmember='$loan_nonmember' ,reserve_total='$reserve_total' ,board_name_1='$board_name_1' ,board_pos_1='$board_pos_1' ,board_name_2='$board_name_2' ,board_pos_2='$board_pos_2' ,board_name_3='$board_name_3' ,board_pos_3='$board_pos_3' ,board_name_4='$board_name_4' ,board_pos_4='$board_pos_4' ,board_name_5='$board_name_5' ,board_pos_5='$board_pos_5' ,board_name_6='$board_name_6' ,board_pos_6='$board_pos_6' ,board_name_7='$board_name_7' ,board_pos_7='$board_pos_7' ,board_name_8='$board_name_8' ,board_pos_8='$board_pos_8' ,board_name_9='$board_name_9' ,board_pos_9='$board_pos_9' ,board_name_10='$board_name_10' ,board_pos_10='$board_pos_10' ,manage_name_1='$manage_name_1' ,manage_pos_1='$manage_pos_1' ,manage_name_2='$manage_name_2' ,manage_pos_2='$manage_pos_2' ,manage_name_3='$manage_name_3' ,manage_pos_3='$manage_pos_3' ,manage_name_4='$manage_name_4' ,manage_pos_4='$manage_pos_4' ,manage_name_5='$manage_name_5' ,manage_pos_5='$manage_pos_5' ,Iagree='$Iagree' , area_code='$area_code' , m_area='$m_area' ";
		$condition=" mem_id='$mem_id' ";
		SaveEditDB( $table,$dataset,$condition);
		}
		//Header("Refresh: 0;url=$index_file?m=$module_name&op=listmember&gr=$gr");
Header("Refresh: 0;url=$index_file?m=detail&op=member");
}



function Inputmember($mem_id)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
  global $TitleArr,$AddressTypeArr,$PlayerArr,$CountryArr ;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;






						$title="";
				$firstname="";
				$lastname="";
				$email="";
				$email_confirmation="";
				$organization="";
				$addresstype="";
				$street="";
				$street2="";
				$city="";
				$state="";
				$zip="";
				$country="";
				$phone="";
				$fax="";
				$username="";
				$password1="";
				$password2="";
				$player="";
				$player_other="";
				$interests1="";
				$interests2="";
				$interests3="";
				$interests4="";
				$interests5="";
				$interests_other="";
				$newsletter="";
				$member_name="";
				$m_address="";
				$m_country="";
				$m_tel="";
				$m_fax="";
				$m_email="";
				$m_homepage="";
				$m_establish="";
				$m_vision="";
				$m_mission="";
				$m_profile_as="";
				$members_urban="";
				$members_urban_low="";
				$members_rural="";
				$members_rural_low="";
				$market_segmentation="";
				$urban_male="";
				$urban_female="";
				$members_urban_18_19="";
				$members_urban_30_45="";
				$members_urban_45_60="";
				$members_urban_60="";
				$rural_male="";
				$rural_female="";
				$members_rural_18_19="";
				$members_rural_30_45="";
				$members_rural_45_60="";
				$members_rural_60="";
				$assets_total="";
				$Core_Business="";
				$savings_amount="";
				$savings_male="";
				$savings_female="";
				$savings_youth="";
				$savings_nonmember="";
				$share_amount="";
				$share_male="";
				$share_female="";
				$share_youth="";
				$share_nonmember="";
				$loan_total="";
				$loan_male="";
				$loan_female="";
				$loan_youth="";
				$loan_nonmember="";
				$reserve_total="";
				$board_name_1="";
				$board_pos_1="";
				$board_name_2="";
				$board_pos_2="";
				$board_name_3="";
				$board_pos_3="";
				$board_name_4="";
				$board_pos_4="";
				$board_name_5="";
				$board_pos_5="";
				$board_name_6="";
				$board_pos_6="";
				$board_name_7="";
				$board_pos_7="";
				$board_name_8="";
				$board_pos_8="";
				$board_name_9="";
				$board_pos_9="";
				$board_name_10="";
				$board_pos_10="";
				$manage_name_1="";
				$manage_pos_1="";
				$manage_name_2="";
				$manage_pos_2="";
				$manage_name_3="";
				$manage_pos_3="";
				$manage_name_4="";
				$manage_pos_4="";
				$manage_name_5="";
				$manage_pos_5="";
				$Iagree="";
				$member_of="";
				$active="";
				
		if( 1 and  !empty($mem_id))
		{
			$table="member";
			$fieldArr ="mem_id,title,firstname,lastname,email,email_confirmation,organization,addresstype,street,street2,city,state,zip,country,phone,fax,username,password1,password2,player,player_other,interests1,interests2,interests3,interests4,interests5,interests_other,newsletter,member_name,m_address,m_country,m_tel,m_fax,m_email,m_homepage,m_establish,m_vision,m_mission,m_profile_as,members_urban,members_urban_low,members_rural,members_rural_low,market_segmentation,urban_male,urban_female,members_urban_18_19,members_urban_30_45,members_urban_45_60,members_urban_60,rural_male,rural_female,members_rural_18_19,members_rural_30_45,members_rural_45_60,members_rural_60,assets_total,Core_Business,savings_amount,savings_male,savings_female,savings_youth,savings_nonmember,share_amount,share_male,share_female,share_youth,share_nonmember,loan_total,loan_male,loan_female,loan_youth,loan_nonmember,reserve_total,board_name_1,board_pos_1,board_name_2,board_pos_2,board_name_3,board_pos_3,board_name_4,board_pos_4,board_name_5,board_pos_5,board_name_6,board_pos_6,board_name_7,board_pos_7,board_name_8,board_pos_8,board_name_9,board_pos_9,board_name_10,board_pos_10,manage_name_1,manage_pos_1,manage_name_2,manage_pos_2,manage_name_3,manage_pos_3,manage_name_4,manage_pos_4,manage_name_5,manage_pos_5,Iagree,member_of,active, area_code , m_area , register_date";
			$searchkey=" and mem_id='$mem_id' ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			if($db->sql_numrows())
			{
				$row = $db->sql_fetchrow($result);
								$mem_id=$row["mem_id"];
				$title=$row["title"];
				$firstname=$row["firstname"];
				$lastname=$row["lastname"];
				$email=$row["email"];
				$email_confirmation=$row["email_confirmation"];
				$organization=$row["organization"];
				$addresstype=$row["addresstype"];
				$street=$row["street"];
				$street2=$row["street2"];
				$city=$row["city"];
				$state=$row["state"];
				$zip=$row["zip"];
				$country=$row["country"];
				$phone=$row["phone"];
				$fax=$row["fax"];
				$username=$row["username"];
				$password1=$row["password1"];
				$password2=$row["password2"];
				$player=$row["player"];
				$player_other=$row["player_other"];
				$interests1=$row["interests1"];
				$interests2=$row["interests2"];
				$interests3=$row["interests3"];
				$interests4=$row["interests4"];
				$interests5=$row["interests5"];
				$interests_other=$row["interests_other"];
				$newsletter=$row["newsletter"];
				$member_name=$row["member_name"];
				$m_address=$row["m_address"];
				$m_country=$row["m_country"];
				$m_tel=$row["m_tel"];
				$m_fax=$row["m_fax"];
				$m_email=$row["m_email"];
				$m_homepage=$row["m_homepage"];
				$m_establish=$row["m_establish"];
				$m_vision=$row["m_vision"];
				$m_mission=$row["m_mission"];
				$m_profile_as=$row["m_profile_as"];
				$members_urban=$row["members_urban"];
				$members_urban_low=$row["members_urban_low"];
				$members_rural=$row["members_rural"];
				$members_rural_low=$row["members_rural_low"];
				$market_segmentation=$row["market_segmentation"];
				$urban_male=$row["urban_male"];
				$urban_female=$row["urban_female"];
				$members_urban_18_19=$row["members_urban_18_19"];
				$members_urban_30_45=$row["members_urban_30_45"];
				$members_urban_45_60=$row["members_urban_45_60"];
				$members_urban_60=$row["members_urban_60"];
				$rural_male=$row["rural_male"];
				$rural_female=$row["rural_female"];
				$members_rural_18_19=$row["members_rural_18_19"];
				$members_rural_30_45=$row["members_rural_30_45"];
				$members_rural_45_60=$row["members_rural_45_60"];
				$members_rural_60=$row["members_rural_60"];
				$assets_total=$row["assets_total"];
				$Core_Business=$row["Core_Business"];
				$savings_amount=$row["savings_amount"];
				$savings_male=$row["savings_male"];
				$savings_female=$row["savings_female"];
				$savings_youth=$row["savings_youth"];
				$savings_nonmember=$row["savings_nonmember"];
				$share_amount=$row["share_amount"];
				$share_male=$row["share_male"];
				$share_female=$row["share_female"];
				$share_youth=$row["share_youth"];
				$share_nonmember=$row["share_nonmember"];
				$loan_total=$row["loan_total"];
				$loan_male=$row["loan_male"];
				$loan_female=$row["loan_female"];
				$loan_youth=$row["loan_youth"];
				$loan_nonmember=$row["loan_nonmember"];
				$reserve_total=$row["reserve_total"];
				$board_name_1=$row["board_name_1"];
				$board_pos_1=$row["board_pos_1"];
				$board_name_2=$row["board_name_2"];
				$board_pos_2=$row["board_pos_2"];
				$board_name_3=$row["board_name_3"];
				$board_pos_3=$row["board_pos_3"];
				$board_name_4=$row["board_name_4"];
				$board_pos_4=$row["board_pos_4"];
				$board_name_5=$row["board_name_5"];
				$board_pos_5=$row["board_pos_5"];
				$board_name_6=$row["board_name_6"];
				$board_pos_6=$row["board_pos_6"];
				$board_name_7=$row["board_name_7"];
				$board_pos_7=$row["board_pos_7"];
				$board_name_8=$row["board_name_8"];
				$board_pos_8=$row["board_pos_8"];
				$board_name_9=$row["board_name_9"];
				$board_pos_9=$row["board_pos_9"];
				$board_name_10=$row["board_name_10"];
				$board_pos_10=$row["board_pos_10"];
				$manage_name_1=$row["manage_name_1"];
				$manage_pos_1=$row["manage_pos_1"];
				$manage_name_2=$row["manage_name_2"];
				$manage_pos_2=$row["manage_pos_2"];
				$manage_name_3=$row["manage_name_3"];
				$manage_pos_3=$row["manage_pos_3"];
				$manage_name_4=$row["manage_name_4"];
				$manage_pos_4=$row["manage_pos_4"];
				$manage_name_5=$row["manage_name_5"];
				$manage_pos_5=$row["manage_pos_5"];
				$Iagree=$row["Iagree"];
				$member_of=$row["member_of"];
				$active=$row["active"];

				$area_code=$row["area_code"];
				$m_area=$row["m_area"];
				$register_date=$row["register_date"];
				
			}

		}else{
		     $mem_id="";
	
	
		}//end if

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/register.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/register.htm";
	 $template->SetImagePath("modules/$module_name/");
		}

	 $template->set_filenames(array(
		'inputform' => $module_file)
		);

	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenuMM(),
		'AREA_CODE'=>$area_code,
		'M_AREA'=>$m_area,
		'REGISTER_DATE'=>$register_date,
       'MEM_ID'=>$mem_id,
			    'TITLE'=>OptionV(0,count($TitleArr)-1,$title,$TitleArr,"-- Select --"),
			    'FIRSTNAME'=>$firstname,
			    'LASTNAME'=>$lastname,
			    'EMAIL'=>$email,
			    'EMAIL_CONFIRMATION'=>$email_confirmation,
			    'ORGANIZATION'=>$organization,
			    'ADDRESSTYPE'=>OptionV(0,count($AddressTypeArr)-1,$addresstype,$AddressTypeArr,"-- Select --"),
			    'STREET'=>$street,
			    'STREET2'=>$street2,
			    'CITY'=>$city,
			    'STATE'=>$state,
			    'ZIP'=>$zip,
			    'COUNTRY'=>OptionV(0,count($CountryArr)-1,$country,$CountryArr,"-- Select --"),
			    'PHONE'=>$phone,
			    'FAX'=>$fax,
			    'USERNAME'=>$username,
			    'PASSWORD1'=>$password1,
			    'PASSWORD2'=>$password2,
			    'PLAYER'=>OptionV(0,count($PlayerArr)-1,$player,$PlayerArr,"-- Select --"),
			    'PLAYER_OTHER'=>$player_other,
			  	'INTERESTS1'=>CheckBox("interests1",$interests1),
			    'INTERESTS2'=>CheckBox("interests2",$interests2),
			    'INTERESTS3'=>CheckBox("interests3",$interests3),
			    'INTERESTS4'=>CheckBox("interests4",$interests4),
			    'INTERESTS5'=>CheckBox("interests5",$interests5),
			    'INTERESTS_OTHER'=>$interests_other,
			    'NEWSLETTER'=>CheckBox("newsletter",$newsletter),
			    'MEMBER_NAME'=>$member_name,
			    'M_ADDRESS'=>$m_address,
			    'M_COUNTRY'=>OptionV(0,count($CountryArr)-1,$m_country,$CountryArr,"-- Select --"),
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
			    
	 'M'=>$module_name,
	'OP'=>"savemember",
	'GR'=>$gr
	)	);

	   $menu=GetMenu();
	 $template->SetImagePath("");
	$html_code =  $template->pparse_str('inputform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
		'COUNT'=>Counter()
		)	);
	 $template->SetImagePath("");
   $template->pparse('body');
	
}

function Detailmember($mem_id)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
						$title="";
				$firstname="";
				$lastname="";
				$email="";
				$email_confirmation="";
				$organization="";
				$addresstype="";
				$street="";
				$street2="";
				$city="";
				$state="";
				$zip="";
				$country="";
				$phone="";
				$fax="";
				$username="";
				$password1="";
				$password2="";
				$player="";
				$player_other="";
				$interests1="";
				$interests2="";
				$interests3="";
				$interests4="";
				$interests5="";
				$interests_other="";
				$newsletter="";
				$member_name="";
				$m_address="";
				$m_country="";
				$m_tel="";
				$m_fax="";
				$m_email="";
				$m_homepage="";
				$m_establish="";
				$m_vision="";
				$m_mission="";
				$m_profile_as="";
				$members_urban="";
				$members_urban_low="";
				$members_rural="";
				$members_rural_low="";
				$market_segmentation="";
				$urban_male="";
				$urban_female="";
				$members_urban_18_19="";
				$members_urban_30_45="";
				$members_urban_45_60="";
				$members_urban_60="";
				$rural_male="";
				$rural_female="";
				$members_rural_18_19="";
				$members_rural_30_45="";
				$members_rural_45_60="";
				$members_rural_60="";
				$assets_total="";
				$Core_Business="";
				$savings_amount="";
				$savings_male="";
				$savings_female="";
				$savings_youth="";
				$savings_nonmember="";
				$share_amount="";
				$share_male="";
				$share_female="";
				$share_youth="";
				$share_nonmember="";
				$loan_total="";
				$loan_male="";
				$loan_female="";
				$loan_youth="";
				$loan_nonmember="";
				$reserve_total="";
				$board_name_1="";
				$board_pos_1="";
				$board_name_2="";
				$board_pos_2="";
				$board_name_3="";
				$board_pos_3="";
				$board_name_4="";
				$board_pos_4="";
				$board_name_5="";
				$board_pos_5="";
				$board_name_6="";
				$board_pos_6="";
				$board_name_7="";
				$board_pos_7="";
				$board_name_8="";
				$board_pos_8="";
				$board_name_9="";
				$board_pos_9="";
				$board_name_10="";
				$board_pos_10="";
				$manage_name_1="";
				$manage_pos_1="";
				$manage_name_2="";
				$manage_pos_2="";
				$manage_name_3="";
				$manage_pos_3="";
				$manage_name_4="";
				$manage_pos_4="";
				$manage_name_5="";
				$manage_pos_5="";
				$Iagree="";
				$member_of="";
				$active="";
				
		if( 1 and  !empty($mem_id))
		{
			$table="member";
			$fieldArr ="mem_id,title,firstname,lastname,email,email_confirmation,organization,addresstype,street,street2,city,state,zip,country,phone,fax,username,password1,password2,player,player_other,interests1,interests2,interests3,interests4,interests5,interests_other,newsletter,member_name,m_address,m_country,m_tel,m_fax,m_email,m_homepage,m_establish,m_vision,m_mission,m_profile_as,members_urban,members_urban_low,members_rural,members_rural_low,market_segmentation,urban_male,urban_female,members_urban_18_19,members_urban_30_45,members_urban_45_60,members_urban_60,rural_male,rural_female,members_rural_18_19,members_rural_30_45,members_rural_45_60,members_rural_60,assets_total,Core_Business,savings_amount,savings_male,savings_female,savings_youth,savings_nonmember,share_amount,share_male,share_female,share_youth,share_nonmember,loan_total,loan_male,loan_female,loan_youth,loan_nonmember,reserve_total,board_name_1,board_pos_1,board_name_2,board_pos_2,board_name_3,board_pos_3,board_name_4,board_pos_4,board_name_5,board_pos_5,board_name_6,board_pos_6,board_name_7,board_pos_7,board_name_8,board_pos_8,board_name_9,board_pos_9,board_name_10,board_pos_10,manage_name_1,manage_pos_1,manage_name_2,manage_pos_2,manage_name_3,manage_pos_3,manage_name_4,manage_pos_4,manage_name_5,manage_pos_5,Iagree,member_of,active";

			$searchkey=" and mem_id='$mem_id' ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			if($db->sql_numrows())
			{
				$row = $db->sql_fetchrow($result);
								$mem_id=$row["mem_id"];
				$title=$row["title"];
				$firstname=$row["firstname"];
				$lastname=$row["lastname"];
				$email=$row["email"];
				$email_confirmation=$row["email_confirmation"];
				$organization=$row["organization"];
				$addresstype=$row["addresstype"];
				$street=$row["street"];
				$street2=$row["street2"];
				$city=$row["city"];
				$state=$row["state"];
				$zip=$row["zip"];
				$country=$row["country"];
				$phone=$row["phone"];
				$fax=$row["fax"];
				$username=$row["username"];
				$password1=$row["password1"];
				$password2=$row["password2"];
				$player=$row["player"];
				$player_other=$row["player_other"];
				$interests1=$row["interests1"];
				$interests2=$row["interests2"];
				$interests3=$row["interests3"];
				$interests4=$row["interests4"];
				$interests5=$row["interests5"];
				$interests_other=$row["interests_other"];
				$newsletter=$row["newsletter"];
				$member_name=$row["member_name"];
				$m_address=$row["m_address"];
				$m_country=$row["m_country"];
				$m_tel=$row["m_tel"];
				$m_fax=$row["m_fax"];
				$m_email=$row["m_email"];
				$m_homepage=$row["m_homepage"];
				$m_establish=$row["m_establish"];
				$m_vision=$row["m_vision"];
				$m_mission=$row["m_mission"];
				$m_profile_as=$row["m_profile_as"];
				$members_urban=$row["members_urban"];
				$members_urban_low=$row["members_urban_low"];
				$members_rural=$row["members_rural"];
				$members_rural_low=$row["members_rural_low"];
				$market_segmentation=$row["market_segmentation"];
				$urban_male=$row["urban_male"];
				$urban_female=$row["urban_female"];
				$members_urban_18_19=$row["members_urban_18_19"];
				$members_urban_30_45=$row["members_urban_30_45"];
				$members_urban_45_60=$row["members_urban_45_60"];
				$members_urban_60=$row["members_urban_60"];
				$rural_male=$row["rural_male"];
				$rural_female=$row["rural_female"];
				$members_rural_18_19=$row["members_rural_18_19"];
				$members_rural_30_45=$row["members_rural_30_45"];
				$members_rural_45_60=$row["members_rural_45_60"];
				$members_rural_60=$row["members_rural_60"];
				$assets_total=$row["assets_total"];
				$Core_Business=$row["Core_Business"];
				$savings_amount=$row["savings_amount"];
				$savings_male=$row["savings_male"];
				$savings_female=$row["savings_female"];
				$savings_youth=$row["savings_youth"];
				$savings_nonmember=$row["savings_nonmember"];
				$share_amount=$row["share_amount"];
				$share_male=$row["share_male"];
				$share_female=$row["share_female"];
				$share_youth=$row["share_youth"];
				$share_nonmember=$row["share_nonmember"];
				$loan_total=$row["loan_total"];
				$loan_male=$row["loan_male"];
				$loan_female=$row["loan_female"];
				$loan_youth=$row["loan_youth"];
				$loan_nonmember=$row["loan_nonmember"];
				$reserve_total=$row["reserve_total"];
				$board_name_1=$row["board_name_1"];
				$board_pos_1=$row["board_pos_1"];
				$board_name_2=$row["board_name_2"];
				$board_pos_2=$row["board_pos_2"];
				$board_name_3=$row["board_name_3"];
				$board_pos_3=$row["board_pos_3"];
				$board_name_4=$row["board_name_4"];
				$board_pos_4=$row["board_pos_4"];
				$board_name_5=$row["board_name_5"];
				$board_pos_5=$row["board_pos_5"];
				$board_name_6=$row["board_name_6"];
				$board_pos_6=$row["board_pos_6"];
				$board_name_7=$row["board_name_7"];
				$board_pos_7=$row["board_pos_7"];
				$board_name_8=$row["board_name_8"];
				$board_pos_8=$row["board_pos_8"];
				$board_name_9=$row["board_name_9"];
				$board_pos_9=$row["board_pos_9"];
				$board_name_10=$row["board_name_10"];
				$board_pos_10=$row["board_pos_10"];
				$manage_name_1=$row["manage_name_1"];
				$manage_pos_1=$row["manage_pos_1"];
				$manage_name_2=$row["manage_name_2"];
				$manage_pos_2=$row["manage_pos_2"];
				$manage_name_3=$row["manage_name_3"];
				$manage_pos_3=$row["manage_pos_3"];
				$manage_name_4=$row["manage_name_4"];
				$manage_pos_4=$row["manage_pos_4"];
				$manage_name_5=$row["manage_name_5"];
				$manage_pos_5=$row["manage_pos_5"];
				$Iagree=$row["Iagree"];
				$member_of=$row["member_of"];
				$active=$row["active"];
				
			}

		}else{
		     $mem_id="";
	
		}//end if
		
	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/memdetail.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/memdetail.htm";
	 $template->SetImagePath("modules/$module_name/");
		}


	 $template->set_filenames(array(
		'detailform' => $module_file)
		);

	$template->assign_vars(array(

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
			  	'INTERESTS1'=>CheckBox("interests1",$interests1),
			    'INTERESTS2'=>CheckBox("interests2",$interests2),
			    'INTERESTS3'=>CheckBox("interests3",$interests3),
			    'INTERESTS4'=>CheckBox("interests4",$interests4),
			    'INTERESTS5'=>CheckBox("interests5",$interests5),
			    'INTERESTS_OTHER'=>$interests_other,
			    'NEWSLETTER'=>CheckBox("newsletter",$newsletter),
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
			       
		)	);

	$menu=GetMenu();

	$html_code =  $template->pparse_str('detailform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
	  'MENU'=>$menu
		)	);
   $template->SetImagePath("");
   $template->pparse('body');
	
}


?>