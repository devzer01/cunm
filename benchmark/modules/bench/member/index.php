<?php
$m		=	isset( $_GET['m'])?$_GET['m']:$_POST['m'];
$op		=	isset( $_GET['op'])?$_GET['op']:$_POST['op'];
$url	=	isset( $_GET['url'])?$_GET['url']:$_POST['url'];
$bench_id = isset( $_GET['bench_id'])?$_GET['bench_id']:$_POST['bench_id'];
$MEMBER =  isset( $_GET['d'])?$_GET['d']:$_POST['d'];

$balance_sheet = isset( $_GET['balance_sheet'])?$_GET['balance_sheet']:$_POST['balance_sheet'];
$C6  	= isset( $_GET['C6'])?$_GET['C6']:$_POST['C6'];
$C7  	= isset( $_GET['C7'])?$_GET['C7']:$_POST['C7'];
$C11	= isset( $_GET['C11'])?$_GET['C11']:$_POST['C11'];
$C14	= isset( $_GET['C14'])?$_GET['C14']:$_POST['C14'];
$C15	= isset( $_GET['C15'])?$_GET['C15']:$_POST['C15'];
$C19	= isset( $_GET['C19'])?$_GET['C19']:$_POST['C19'];
$C20	= isset( $_GET['C20'])?$_GET['C20']:$_POST['C20'];
$C26	= isset( $_GET['C26'])?$_GET['C26']:$_POST['C26'];
$C27	= isset( $_GET['C27'])?$_GET['C27']:$_POST['C27'];
$C32	= isset( $_GET['C32'])?$_GET['C32']:$_POST['C32'];
$C33	= isset( $_GET['C33'])?$_GET['C33']:$_POST['C33'];
$C35	= isset( $_GET['C35'])?$_GET['C35']:$_POST['C35'];
$C36	= isset( $_GET['C36'])?$_GET['C36']:$_POST['C36'];
$C40	= isset( $_GET['C40'])?$_GET['C40']:$_POST['C40'];
$C41	= isset( $_GET['C41'])?$_GET['C41']:$_POST['C41'];
$C42	= isset( $_GET['C42'])?$_GET['C42']:$_POST['C42'];
$C46	= isset( $_GET['C46'])?$_GET['C46']:$_POST['C46'];
$C47	= isset( $_GET['C47'])?$_GET['C47']:$_POST['C47'];
$C52	= isset( $_GET['C52'])?$_GET['C52']:$_POST['C52'];
$C53	= isset( $_GET['C53'])?$_GET['C53']:$_POST['C53'];
$C54	= isset( $_GET['C54'])?$_GET['C54']:$_POST['C54'];
$income_month	= isset( $_GET['income_month'])?$_GET['income_month']:$_POST['income_month'];
$income_ended	= isset( $_GET['income_ended'])?$_GET['income_ended']:$_POST['income_ended'];
$C63	= isset( $_GET['C63'])?$_GET['C63']:$_POST['C63'];
$C64	= isset( $_GET['C64'])?$_GET['C64']:$_POST['C64'];
$C66	= isset( $_GET['C66'])?$_GET['C66']:$_POST['C66'];
$C67	= isset( $_GET['C67'])?$_GET['C67']:$_POST['C67'];
$C68	= isset( $_GET['C68'])?$_GET['C68']:$_POST['C68'];
$C72	= isset( $_GET['C72'])?$_GET['C72']:$_POST['C72'];
$C73	= isset( $_GET['C73'])?$_GET['C73']:$_POST['C73'];
$C78	= isset( $_GET['C78'])?$_GET['C78']:$_POST['C78'];
$C79	= isset( $_GET['C79'])?$_GET['C79']:$_POST['C79'];
$C80	= isset( $_GET['C80'])?$_GET['C80']:$_POST['C80'];
$C81	= isset( $_GET['C81'])?$_GET['C81']:$_POST['C81'];
$C82	= isset( $_GET['C82'])?$_GET['C82']:$_POST['C82'];
$C84	= isset( $_GET['C84'])?$_GET['C84']:$_POST['C84'];
$C87	= isset( $_GET['C87'])?$_GET['C87']:$_POST['C87'];
$C89	= isset( $_GET['C89'])?$_GET['C89']:$_POST['C89'];
$C90	= isset( $_GET['C90'])?$_GET['C90']:$_POST['C90'];
$C91	= isset( $_GET['C91'])?$_GET['C91']:$_POST['C91'];
$C92	= isset( $_GET['C92'])?$_GET['C92']:$_POST['C92'];
$C93	= isset( $_GET['C93'])?$_GET['C93']:$_POST['C93'];
$C94	= isset( $_GET['C94'])?$_GET['C94']:$_POST['C94'];
$C96	= isset( $_GET['C96'])?$_GET['C96']:$_POST['C96'];
$C97	= isset( $_GET['C97'])?$_GET['C97']:$_POST['C97'];
$C98	= isset( $_GET['C98'])?$_GET['C98']:$_POST['C98'];
$C99	= isset( $_GET['C99'])?$_GET['C99']:$_POST['C99'];
$C100	= isset( $_GET['C100'])?$_GET['C100']:$_POST['C100'];
$C101	= isset( $_GET['C101'])?$_GET['C101']:$_POST['C101'];
$C102	= isset( $_GET['C102'])?$_GET['C102']:$_POST['C102'];
$C103	= isset( $_GET['C103'])?$_GET['C103']:$_POST['C103'];
$C104	= isset( $_GET['C104'])?$_GET['C104']:$_POST['C104'];
$C105	= isset( $_GET['C105'])?$_GET['C105']:$_POST['C105'];
$C106	= isset( $_GET['C106'])?$_GET['C106']:$_POST['C106'];
$C107	= isset( $_GET['C107'])?$_GET['C107']:$_POST['C107'];
$C108	= isset( $_GET['C108'])?$_GET['C108']:$_POST['C108'];
$C109	= isset( $_GET['C109'])?$_GET['C109']:$_POST['C109'];
$C110	= isset( $_GET['C110'])?$_GET['C110']:$_POST['C110'];
$C111	= isset( $_GET['C111'])?$_GET['C111']:$_POST['C111'];
$C112	= isset( $_GET['C112'])?$_GET['C112']:$_POST['C112'];
$C113	= isset( $_GET['C113'])?$_GET['C113']:$_POST['C113'];
$C114	= isset( $_GET['C114'])?$_GET['C114']:$_POST['C114'];
$C115	= isset( $_GET['C115'])?$_GET['C115']:$_POST['C115'];
$C116	= isset( $_GET['C116'])?$_GET['C116']:$_POST['C116'];
$C117	= isset( $_GET['C117'])?$_GET['C117']:$_POST['C117'];


//echo $MEMBER;
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

$module_name = "bench";
$gr = "member";
$index_file = "member.php";

$template->set_filenames(array(
		'body' => $mainframe[0])
	);
//######################

if(empty($op)){$op="";}

switch($op)
{
		case "savebench":
			Savebench($bench_id,$mem_id,$MEMBER);
			break;

		case "bench":
			MemberHome($MEMBER);
			break;
	case "prebench":
		 PreBench($bench_id,$mem_id,$balance_sheet,$C6,$C7,$C8,$C11,$C14,$C15,$C16,$C19,$C20,$C21,$C22,$C23,$C26,$C27,$C28,$C29,$C32,$C33,$C34,$C35,$C36,$C37,$C40,$C41,$C42,$C43,$C46,$C47,$C48,$C49,$C52,$C53,$C54,$C55,$C56,$income_month,$income_ended,$C63,$C64,$C65,$C66,$C67,$C68,$C69,$C72,$C73,$C74,$C75,$C76,$C78,$C79,$C80,$C81,$C82,$C83,$C84,$C85,$C86,$C87,$C88,$C91,$C92,$C93,$C94,$C95,$C96,$C98,$C99,$C100,$C101,$C102,$C103,$C104,$C105,$C106,$C107,$C108,$C109,$C110,$C111,$C112,$C113,$MEMBER);
		break;
	case "makebench":
MakeBench($bench_id,$mem_id,$balance_sheet,$C6,$C7,$C8,$C11,$C14,$C15,$C16,$C19,$C20,$C21,$C22,$C23,$C26,$C27,$C28,$C29,$C32,$C33,$C34,$C35,$C36,$C37,$C40,$C41,$C42,$C43,$C46,$C47,$C48,$C49,$C52,$C53,$C54,$C55,$C56,$income_month,$income_ended,$C63,$C64,$C65,$C66,$C67,$C68,$C69,$C72,$C73,$C74,$C75,$C76,$C78,$C79,$C80,$C81,$C82,$C83,$C84,$C85,$C86,$C87,$C88,$C91,$C92,$C93,$C94,$C95,$C96,$C98,$C99,$C100,$C101,$C102,$C103,$C104,$C105,$C106,$C107,$C108,$C109,$C110,$C111,$C112,$C113,$MEMBER);
		break;

	default :
MemberHome($MEMBER);
		break;

}


function MemberHome($MEMBER)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;


	 $module_file = "modules/$module_name/$gr/memberhome.htm";
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
     'ACTION'=>$index_file."?m=bench&mem_id=$mem_id&d=$MEMBER",
	 'M'=>$module_name,
	'OP'=>"prebench",
	'INF'=>$MEMBER,
	'GR'=>$gr,
'BCAP'=>" Start Benchmarking Services Now !",
				'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		)	);


	   $menu=GetMenu();
	$template->SetImagePath("");
	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'MENU'=>$menu
		)	);
  $template->SetImagePath("");
   $template->pparse('body');


}

function PreBench($bench_id,$mem_id,$balance_sheet,$C6,$C7,$C8,$C11,$C14,$C15,$C16,$C19,$C20,$C21,$C22,$C23,$C26,$C27,$C28,$C29,$C32,$C33,$C34,$C35,$C36,$C37,$C40,$C41,$C42,$C43,$C46,$C47,$C48,$C49,$C52,$C53,$C54,$C55,$C56,$income_month,$income_ended,$C63,$C64,$C65,$C66,$C67,$C68,$C69,$C72,$C73,$C74,$C75,$C76,$C78,$C79,$C80,$C81,$C82,$C83,$C84,$C85,$C86,$C87,$C88,$C91,$C92,$C93,$C94,$C95,$C96,$C98,$C99,$C100,$C101,$C102,$C103,$C104,$C105,$C106,$C107,$C108,$C109,$C110,$C111,$C112,$C113,$MEMBER)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;
	

	 $module_file = "modules/$module_name/$gr/prebench.htm";
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
		'INFO'=>$MEMBER,
				'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),

		)	);


//***** Cal CVAL =====
		$page=1;
		$page_list=500;
		$table="balancesheet";
		$fieldArr ="bal_id,NO,ASSETS,CVAL,P_FORMULA,PEARLS";
		$searchkey=" order by NO";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
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

				if(!empty($CVAL))
			   {
				 @eval($CVAL);
			   }
	} // end while
}// end if
//***** Cal P =====
		$page=1;
		$page_list=500;
		$table="balancesheet";
		$fieldArr ="bal_id,NO,ASSETS,CVAL,P_FORMULA,PEARLS";
		$searchkey=" order by NO";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
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



for($i=6;$i<=113;$i++)
	{
	 $cval="C$i";
	 $pval ="P$i";
		 if($$pval!=0){ 
			 $P = number_format($$pval,2,'.',','); 
		 }else{
		$P="";
		 }
		$template->assign_vars(array(
			"$cval"=>$$cval,
			"$pval"=>$P
					));
	}

$template->assign_vars(array(
       'BENCH_ID'=>$bench_id,
			    'MEM_ID'=>$mem_id,
			    'BALANCE_SHEET'=>$balance_sheet,
				    'INCOME_MONTH'=>$income_month,
			    'INCOME_ENDED'=>$income_ended,
			     'ACTION'=>$index_file."?m=bench&mem_id=$mem_id&d=$MEMBER",
				 'INF'=>$MEMBER,
	 'M'=>$module_name,
	'OP'=>"makebench",
	'INFO'=>$_GET['d'],
	'GR'=>$gr
	)	);




	   $menu=GetMenu();
	$template->SetImagePath("");
	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'MENU'=>$menu
		)	);
  $template->SetImagePath("");
   $template->pparse('body');

}



function MakeBench($bench_id,$mem_id,$balance_sheet,$C6,$C7,$C8,$C11,$C14,$C15,$C16,$C19,$C20,$C21,$C22,$C23,$C26,$C27,$C28,$C29,$C32,$C33,$C34,$C35,$C36,$C37,$C40,$C41,$C42,$C43,$C46,$C47,$C48,$C49,$C52,$C53,$C54,$C55,$C56,$income_month,$income_ended,$C63,$C64,$C65,$C66,$C67,$C68,$C69,$C72,$C73,$C74,$C75,$C76,$C78,$C79,$C80,$C81,$C82,$C83,$C84,$C85,$C86,$C87,$C88,$C91,$C92,$C93,$C94,$C95,$C96,$C98,$C99,$C100,$C101,$C102,$C103,$C104,$C105,$C106,$C107,$C108,$C109,$C110,$C111,$C112,$C113,$MEMBER)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;


	 $module_file = "modules/$module_name/$gr/accu.htm";
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
		'INFO'=>$MEMBER,
		'BCAP'=>" Save to DB !",
		'TOPMENU'=>GetTopMenuMM(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		)	);



//***** Cal CVAL =====
		$page=1;
		$page_list=500;
		$table="balancesheet";
		$fieldArr ="bal_id,NO,ASSETS,CVAL,P_FORMULA,PEARLS";
		$searchkey=" order by NO";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
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

				if(!empty($CVAL))
			   {
				 @eval($CVAL); // $C8=$C6+$C7;
			   }
	} // end while
}// end if


//***** Cal P =====
		$page=1;
		$page_list=500;
		$table="balancesheet";
		$fieldArr ="bal_id,NO,ASSETS,CVAL,P_FORMULA,PEARLS";
		$searchkey=" order by NO";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
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
				 @eval($P_FORMULA);   $P8=($C8/$C37*100);
			   }
	} // end while
}// end if

//*** CAL REARLS  FOR $ANS==
$query="SELECT t1.NO, t1.PEARLS,t2.formula ";
$query.="from balancesheet as t1,formula as t2 ";
$query.="where t1.PEARLS=t2.code ";
$query.="order by t1.NO ";

$C1=1;
$C2=2;

list($totalpage,$result)=QueryListPage( $query,$page,$page_list);
		while($v= $db->sql_fetchrow($result) )
		{
			$NO = $v["NO"];
			$PEARLS = $v["PEARLS"];
			$formula = $v["formula"];
				if(!empty($formula))
				{
					@eval($formula );
						$val ="ANS$NO";
						@eval("$$val = $ANS;");
							//	$template->assign_vars(array("REMARK$NO"=>$PEARLS));

				}

		}

/*
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
*/
/*
for($i=6;$i<=113;$i++)
	{
	 $cval="C$i";
	 $val ="ANS$i";
	echo "<br>";
	echo "$cval=>".$$cval ;
    echo ":: $val=>".$$val ;
	}
*/

//----- Assign Value
for($i=6;$i<=113;$i++)
	{
	 $cval="C$i";
	 $pval ="P$i";
		$val ="ANS$i";

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


		$template->assign_vars(array(
			"$cval"=>$$cval,
			"$pval"=>$P,
			"$val"=>$PEAR,
					));
	}

//************************************* SAVE **********************************************
		$table="bench";


			//$sql ="UPDATE $table SET last_id= 0 where mem_id=$mem_id ";
			//$db->sql_query($sql);
		$field="bench_id,mem_id,balance_sheet,C6,C7,C8,C11,C14,C15,C16,C19,C20,C21,C22,C23,C26,C27,C28,C29,C32,C33,C34,C35,C36,C37,C40,C41,C42,C43,C46,C47,C48,C49,C52,C53,C54,C55,C56,income_month,income_ended,C63,C64,C65,C66,C67,C68,C69,C72,C73,C74,C75,C76,C78,C79,C80,C81,C82,C83,C84,C85,C86,C87,C88,C91,C92,C93,C94,C95,C96,C98,C99,C100,C101,C102,C103,C104,C105,C106,C107,C108,C109,C110,C111,C112,C113,ANS6,ANS7,ANS8,ANS16,ANS21,ANS22,ANS23,ANS26,ANS27,ANS29,ANS32,ANS33,ANS35,ANS36,ANS37,ANS40,ANS41,ANS43,ANS46,ANS48,ANS52,ANS53,ANS54,ANS65,ANS66,ANS67,ANS68,ANS72,ANS73,ANS75,ANS83,ANS84,ANS87,ANS88,ANS92,ANS98,ANS99,ANS100,ANS101,ANS102,ANS103,ANS104,ANS105,ANS106,ANS107,ANS108,ANS109,ANS110,ANS111,ANS112,ANS113,remark6,remark7,remark8,remark16,remark21,remark22,remark23,remark26,remark27,remark29,remark32,remark33,remark35,remark36,remark37,remark40,remark41,remark43,remark46,remark48,remark52,remark53,remark54,remark65,remark66,remark67,remark68,remark72,remark73,remark75,remark83,remark84,remark87,remark88,remark92,remark98,remark99,remark100,remark101,remark102,remark103,remark104,remark105,remark106,remark107,remark108,remark109,remark110,remark111,remark112,remark113";
		$data="NULL,'$mem_id','$balance_sheet','$C6','$C7','$C8','$C11','$C14','$C15','$C16','$C19','$C20','$C21','$C22','$C23','$C26','$C27','$C28','$C29','$C32','$C33','$C34','$C35','$C36','$C37','$C40','$C41','$C42','$C43','$C46','$C47','$C48','$C49','$C52','$C53','$C54','$C55','$C56','$income_month','$income_ended','$C63','$C64','$C65','$C66','$C67','$C68','$C69','$C72','$C73','$C74','$C75','$C76','$C78','$C79','$C80','$C81','$C82','$C83','$C84','$C85','$C86','$C87','$C88','$C91','$C92','$C93','$C94','$C95','$C96','$C98','$C99','$C100','$C101','$C102','$C103','$C104','$C105','$C106','$C107','$C108','$C109','$C110','$C111','$C112','$C113','$ANS6','$ANS7','$ANS8','$ANS16','$ANS21','$ANS22','$ANS23','$ANS26','$ANS27','$ANS29','$ANS32','$ANS33','$ANS35','$ANS36','$ANS37','$ANS40','$ANS41','$ANS43','$ANS46','$ANS48','$ANS52','$ANS53','$ANS54','$ANS65','$ANS66','$ANS67','$ANS68','$ANS72','$ANS73','$ANS75','$ANS83','$ANS84','$ANS87','$ANS88','$ANS92','$ANS98','$ANS99','$ANS100','$ANS101','$ANS102','$ANS103','$ANS104','$ANS105','$ANS106','$ANS107','$ANS108','$ANS109','$ANS110','$ANS111','$ANS112','$ANS113','$remark6','$remark7','$remark8','$remark16','$remark21','$remark22','$remark23','$remark26','$remark27','$remark29','$remark32','$remark33','$remark35','$remark36','$remark37','$remark40','$remark41','$remark43','$remark46','$remark48','$remark52','$remark53','$remark54','$remark65','$remark66','$remark67','$remark68','$remark72','$remark73','$remark75','$remark83','$remark84','$remark87','$remark88','$remark92','$remark98','$remark99','$remark100','$remark101','$remark102','$remark103','$remark104','$remark105','$remark106','$remark107','$remark108','$remark109','$remark110','$remark111','$remark112','$remark113'";
		SaveDB( $table,$field,$data);
		$bench_id = $db->sql_nextid();

//******************************************************************************************

//*** CAL REARLS ==
//$query="SELECT t1.NO, t1.PEARLS,t2.formula ";
//$query.="from balancesheet as t1,formula as t2 ";
//$query.="where t1.PEARLS=t2.code ";
//$query.="order by t1.NO ";

$query="SELECT * FROM  formula ";


$C1=1;
$C2=2;

list($totalpage,$result)=QueryListPage( $query,$page,$page_list);
		while($v= $db->sql_fetchrow($result) )
		{
			$CODE = $v["code"];
			$formula = $v["formula"];
			$sql_rank = $v["sql_rank"];
			//echo "<br>";
			//echo " $CODE =  $formula ";

				if(!empty($formula))
				{
					@eval($formula ); //$ANS=$C27/$C16  * 100;
					//$val ="ANS$NO";
						@eval("$$CODE = $ANS;");
						$template->assign_vars(array("$CODE"=>number_format($ANS,2,'.',',')));
				}

 //echo "<br>ANS= $ANS ";

				$SCORE=0;

				if(!empty($sql_rank))
				{
					@eval($sql_rank); // $SCORE = ????
					 // echo "<br>".$sql_rank;
			    }
				 $getpoint= "$".$CODE."_SCORE = $SCORE ; ";
				// echo "<br> $getpoint ";
					@eval( $getpoint );
					
 // echo "<br>";
		}

//----- Save 

		$table="bench_result";
 $field="resu,bench_id,mem_id,P1,P2,P3,P4,P5,P6,E1,E2,E3,E4,E5,E6,E7,E8,E9,A1,A2,A3,R1,R2,R3,R4,R5,R6,R7,R8,R9,R10,R11,R12,L1,L2,L3,S1,S2,S3,S4,S5,S6,S7,S8,S9,S10,S11,P1_SCORE,P2_SCORE,P3_SCORE,P4_SCORE,P5_SCORE,P6_SCORE,E1_SCORE,E2_SCORE,E3_SCORE,E4_SCORE,E5_SCORE,E6_SCORE,E7_SCORE,E8_SCORE,E9_SCORE,A1_SCORE,A2_SCORE,A3_SCORE,R1_SCORE,R2_SCORE,R3_SCORE,R4_SCORE,R5_SCORE,R6_SCORE,R7_SCORE,R8_SCORE,R9_SCORE,R10_SCORE,R11_SCORE,R12_SCORE,L1_SCORE,L2_SCORE,L3_SCORE,S1_SCORE,S2_SCORE,S3_SCORE,S4_SCORE,S5_SCORE,S6_SCORE,S7_SCORE,S8_SCORE,S9_SCORE,S10_SCORE,S11_SCORE";
		$data="NULL,'$bench_id','$mem_id','$P1','$P2','$P3','$P4','$P5','$P6','$E1','$E2','$E3','$E4','$E5','$E6','$E7','$E8','$E9','$A1','$A2','$A3','$R1','$R2','$R3','$R4','$R5','$R6','$R7','$R8','$R9','$R10','$R11','$R12','$L1','$L2','$L3','$S1','$S2','$S3','$S4','$S5','$S6','$S7','$S8','$S9','$S10','$S11','$P1_SCORE','$P2_SCORE','$P3_SCORE','$P4_SCORE','$P5_SCORE','$P6_SCORE','$E1_SCORE','$E2_SCORE','$E3_SCORE','$E4_SCORE','$E5_SCORE','$E6_SCORE','$E7_SCORE','$E8_SCORE','$E9_SCORE','$A1_SCORE','$A2_SCORE','$A3_SCORE','$R1_SCORE','$R2_SCORE','$R3_SCORE','$R4_SCORE','$R5_SCORE','$R6_SCORE','$R7_SCORE','$R8_SCORE','$R9_SCORE','$R10_SCORE','$R11_SCORE','$R12_SCORE','$L1_SCORE','$L2_SCORE','$L3_SCORE','$S1_SCORE','$S2_SCORE','$S3_SCORE','$S4_SCORE','$S5_SCORE','$S6_SCORE','$S7_SCORE','$S8_SCORE','$S9_SCORE','$S10_SCORE','$S11_SCORE'";
		SaveDB( $table,$field,$data);

$template->assign_vars(array(
       'BENCH_ID'=>$bench_id,
			    'MEM_ID'=>$mem_id,
			    'BALANCE_SHEET'=>$balance_sheet,
					    'INCOME_MONTH'=>$income_month,
			    'INCOME_ENDED'=>$income_ended,
			     'ACTION'=>$index_file,
				 'INF'=>$MEMBER,
	 'M'=>$module_name,
	'OP'=>"savebench",
	'INFO'=>$_GET['d'],
	'GR'=>$gr
	)	);


	   $menu=GetMenu();
	$template->SetImagePath("");
	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'MENU'=>$menu
		)	);
  $template->SetImagePath("");
   $template->pparse('body');
}

function Savebench($bench_id,$mem_id,$MEMBER)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;



		$table="bench";
			$sql ="UPDATE $table SET last_id= 0  where mem_id=$mem_id ";
			$db->sql_query($sql);
			$sql ="UPDATE $table SET saved= 1 ,last_id= 1   where bench_id=$bench_id  ";
			$db->sql_query($sql);


		Header("Refresh: 0;url=$index_file?m=detail&op=pearls&mem_id=$mem_id&d=$MEMBER");


}

?>