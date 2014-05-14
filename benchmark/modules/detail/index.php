<?php
$module_name = basename(dirname(__FILE__));
$MEMBER = $_GET['d'];
$m		=	isset( $_GET['m'])?$_GET['m']:$_POST['m'];
$op		=	isset( $_GET['op'])?$_GET['op']:$_POST['op'];
$url	=	isset( $_GET['url'])?$_GET['url']:$_POST['url'];
$mem_id = $_GET['mem_id'];

$template->set_filenames(array(
		'body' => $mainframe[0])
	);
	
		if(empty($op)){$op="";}

		switch($op)
		{

			case "member":
				Detailmember($mem_id);
				break;
			case "pearls":
				Pearls($mem_id);
				break;
			case "balance":
				Balance($mem_id);
				break;
			case "rating":
				Rating($mem_id);
				break;
						case "view":
			View($bid);
			break;
		case "ratingcode":
			RatingCode($code);
			break;
			case "libraly":
				Libraly($mem_id);
				break;

		}

function Libraly($mem_id)
{
	global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
	

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/libraly.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/libraly.htm";
	 $template->SetImagePath("modules/$module_name/");
		}


	 $template->set_filenames(array(
		'libraly' => $module_file)
		);

	 	if(empty($page))
		{
		$page=1;
		}
		$page_list=50;
		$table="library";
		$fieldArr ="lib,mem_id,pdate,name,file,remark";
		$searchkey=" and mem_id=$mem_id  order by pdate desc ";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

						$lib=$v["lib"];
				$mem_id=$v["mem_id"];
				$pdate=$v["pdate"];
				$name=$v["name"];
				$file=$v["file"];
				$remark=$v["remark"];
				

		$edit="$index_file?m=$module_name&op=inputlibrary&lib=$lib&gr=$gr";
		$cap=str_replace("","",$cap);
		 $del="javascript:Del('tb=library&key=lib&id=$lib&op=del&rt=libraly&gr=$gr','$cap')";

		$template->assign_block_vars('listrow', array(
		 'LIB'=>$lib,
			    'MEM_ID'=>$mem_id,
			    'PDATE'=>$pdate,
			    'NAME'=>$name,
			    'FILE'=>$file,
			    'REMARK'=>$remark,
			       'DW'=>"$SaveFilePath/$file",
        'U_DEL'=>$del,
		'U_EDIT'=>$edit
		)	);
	} // end while
}// end if

	$link="$index_file?m=$module_name&op=libraly";
	$template->assign_vars(array(
      'PAGE_LIST'=>List_PageStr($page,$totalpage,$link),
		'JAVA_URL'=>"$index_file?m=$module_name&op=del",
		'U_ADD'=>"$index_file?m=$module_name&op=inputlibrary&gr=$gr"
		)	);


	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		));

	$menu=GetMenu();

	$html_code =  $template->pparse_str('libraly');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
   $template->SetImagePath("");
   $template->pparse('body');

}


function Rating($mem_id)
{
	global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;
	

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/rating.htm";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/rating.htm";
	 $template->SetImagePath("modules/$module_name/");
		}


	 $template->set_filenames(array(
		'rating' => $module_file)
		);
	if(empty($page))
		{
		$page=1;
		}
		$page_list=50;
		$table="formula";
		$fieldArr =" * ";
		$searchkey="  and  ranking > 0 order by ranking";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

				$for_id=$v["for_id"];
				$code=$v["code"];
				$name=$v["name"];
				$goals=$v["goals"];
				$formula=$v["formula"];
				$comment=$v["comment"];
				

		$edit="$index_file?m=$module_name&op=ratingcode&code=$code&gr=$gr&mem_id=$mem_id";
		$cap=str_replace("","",$cap);

		$template->assign_block_vars('listrow', array(
		 'FOR_ID'=>$for_id,
			    'CODE'=>$code,
			    'NAME'=>$name,
			    'GOALS'=>$goals,
			    'FORMULA'=>$formula,
			    'COMMENT'=>$comment,

		'EDIT'=>$edit
		)	);
	} // end while
}// end if

	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
		));

	$menu=GetMenu();

	$html_code =  $template->pparse_str('rating');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
   $template->SetImagePath("");
   $template->pparse('body');

}


function RatingCode($code)
{
 global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name;

	 $module_file = "modules/$module_name/$gr/ratingcode.htm";
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


 $sql = " SELECT bench.bench_id ,member.mem_id,member.member_name ,member.m_country ,bench_result.".$code."_SCORE ";
 $sql .="  FROM bench ,member  ";
  $sql .="left join  bench_result on bench.bench_id=bench_result.bench_id  ";

 $sql .="where  bench.mem_id=member.mem_id  ";
 $sql .=" and bench.last_id=1 ";
 $sql .=" order by bench_result.".$code."_SCORE DESC ";

/*
 $searchkey.=" order by ";
 $searchkey.=" case  "; 
 $searchkey.=" when substring(code,1,4) between '0' and '9' ";  
 $searchkey.=" then substring(code,1,4) ";  
 $searchkey.=" when substring(code,2,4) between '0' and '9' ";  
 $searchkey.=" then substring(code,2,4) "; 
 $searchkey.=" when substring(code,3,4) between '0' and '9' ";  
 $searchkey.=" then substring(code,3,4) "; 
 $searchkey.=" when substring(code,4,4) between '0' and '9' ";  
 $searchkey.=" then substring(code,4,4) ";  
 $searchkey.=" end "; 
 $searchkey.=" DESC  ";  
*/
//--create new array 
$bench_country = array();
$c=1;
  $result = $db->sql_query($sql);
	if($db->sql_numrows())
	{
		while($v= $db->sql_fetchrow($result) )
		{
	$bench_id = $v["bench_id"];
	$smem_id = $v["mem_id"];
	$member_name = $v["member_name"];
	$m_country = $v["m_country"];
	$score = $v[$code."_SCORE"];

     $bench_country[$bench_id]=$m_country;

     $ckcount = array_count_values ($bench_country);
	// print_r ($ckcount);
	// echo "<br>";
   	 if($ckcount [ $m_country ]>1){
	 $bench_country[$bench_id] = $m_country.$ckcount [$m_country] ;
	 }



    $view = "$index_file?m=$module_name&op=view&bid=$bench_id&country=$bench_country[$bench_id]";
	$template->assign_block_vars('listrow', array(
		'BENCH_ID'=>$bench_id,
		'MEM_ID'=>$smem_id,
		'NAME'=>$member_name,
		'M_COUNTRY'=>$bench_country[$bench_id] ,
		'U_VIEW'=>$view,
		'SCORE'=>number_format($score,2,'.',','),
		'CNT'=>$c++,
		));
		}
	}


		$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
			'CODE'=>$code,
			'CODE_NAME'=>SearchSingleDB( " and code='$code'  " ,"formula","name"),
		));


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



function View($bid)
{
	 global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;
  global $mem_id,$username,$password,$member_ofck,$name,$member_name,$country;

	

         $module_file = "modules/$module_name/$gr/view1.htm";


		 $template->set_filenames(array(
		'view' => $module_file)
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
		'COUNTRY'=>$country
		)	);

//echo $page;


		$page_list=1;
		$table="bench";
		/*$fieldArr ="bench_id,mem_id,balance_sheet,C6,C7,C8,C11,C14,C15,C16,C19,C20,C21,C22,C23,C26,C27,C28,C29,C32,C33,C34,C35,C36,C37,C40,C41,C42,C43,C46,C47,C48,C49,C52,C53,C54,C55,C56,income_month,income_ended,C63,C64,C65,C66,C67,C68,C69,C72,C73,C74,C75,C76,C78,C79,C80,C81,C82,C83,C84,C85,C86,C87,C88,C91,C92,C93,C94,C95,C96,C98,C99,C100,C101,C102,C103,C104,C105,C106,C107,C108,C109,C110,C111,C112,C113,ANS6,ANS7,ANS8,ANS16,ANS21,ANS22,ANS23,ANS26,ANS27,ANS29,ANS32,ANS33,ANS35,ANS36,ANS37,ANS40,ANS41,ANS43,ANS46,ANS48,ANS52,ANS53,ANS54,ANS65,ANS66,ANS67,ANS68,ANS72,ANS73,ANS75,ANS83,ANS84,ANS87,ANS88,ANS92,ANS98,ANS99,ANS100,ANS101,ANS102,ANS103,ANS104,ANS105,ANS106,ANS107,ANS108,ANS109,ANS110,ANS111,ANS112,ANS113,remark6,remark7,remark8,remark16,remark21,remark22,remark23,remark26,remark27,remark29,remark32,remark33,remark35,remark36,remark37,remark40,remark41,remark43,remark46,remark48,remark52,remark53,remark54,remark65,remark66,remark67,remark68,remark72,remark73,remark75,remark83,remark84,remark87,remark88,remark92,remark98,remark99,remark100,remark101,remark102,remark103,remark104,remark105,remark106,remark107,remark108,remark109,remark110,remark111,remark112,remark113";
		*/
		/*
		$fieldArr=" * ";
		$searchkey=" and bench_id='$bid'    ";

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

*/
$table="bench_result";
			$fieldArr =" * ";
			$searchkey="   and   bench_id =$bid ";
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

			}

		$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
			'CODE'=>$code,
			'CODE_NAME'=>SearchSingleDB( " and code='$code'  " ,"formula","name"),
		));

	 $menu=GetMenu();
	$template->SetImagePath("");
	$html_code =  $template->pparse_str('view');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'COUNT'=>Counter()
		)	);
  $template->SetImagePath("");
   $template->pparse('body');

}



function Balance($mem_id)
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



				$C6=array();
				$C7=array();
				$C8=array();
				$C11=array();
				$C14=array();
				$C15=array();
				$C16=array();
				$C19=array();
				$C20=array();
				$C21=array();
				$C22=array();
				$C23=array();
				$C26=array();
				$C27=array();
				$C28=array();
				$C29=array();
				$C32=array();
				$C33=array();
				$C34=array();
				$C35=array();
				$C36=array();
				$C37=array();
				$C40=array();
				$C41=array();
				$C42=array();
				$C43=array();
				$C46=array();
				$C47=array();
				$C48=array();
				$C49=array();
				$C52=array();
				$C53=array();
				$C54=array();
				$C55=array();
				$C56=array();
				$C63=array();
				$C64=array();
				$C65=array();
				$C66=array();
				$C67=array();
				$C68=array();
				$C69=array();
				$C72=array();
				$C73=array();
				$C74=array();
				$C75=array();
				$C76=array();
				$C78=array();
				$C79=array();
				$C80=array();
				$C81=array();
				$C82=array();
				$C83=array();
				$C84=array();
				$C85=array();
				$C86=array();
				$C87=array();
				$C88=array();
				$C91=array();
				$C92=array();
				$C93=array();
				$C94=array();
				$C95=array();
				$C96=array();
				$C98=array();
				$C99=array();
				$C100=array();
				$C101=array();
				$C102=array();
				$C103=array();
				$C104=array();
				$C105=array();
				$C106=array();
				$C107=array();
				$C108=array();
				$C109=array();
				$C110=array();
				$C111=array();
				$C112=array();
				$C113=array();
				$DateArr = array();

        $query=" select * from bench where mem_id='$mem_id' order by bench_id DESC limit 0,5  ";

		$result = $db->sql_query($query);
		$cnt_row = $db->sql_numrows();
		//echo $cnt_row;

		while($v= $db->sql_fetchrow($result) )
		{

				$bench_id=$v["bench_id"];
				$mem_id=$v["mem_id"];
				$balance_sheet=$v["balance_sheet"];
				$DateArr [] = $balance_sheet;

				$C6[]=$v["C6"];
				$C7[]=$v["C7"];
				$C8[]=$v["C8"];
				$C11[]=$v["C11"];
				$C14[]=$v["C14"];
				$C15[]=$v["C15"];
				$C16[]=$v["C16"];
				$C19[]=$v["C19"];
				$C20[]=$v["C20"];
				$C21[]=$v["C21"];
				$C22[]=$v["C22"];
				$C23[]=$v["C23"];
				$C26[]=$v["C26"];
				$C27[]=$v["C27"];
				$C28[]=$v["C28"];
				$C29[]=$v["C29"];
				$C32[]=$v["C32"];
				$C33[]=$v["C33"];
				$C34[]=$v["C34"];
				$C35[]=$v["C35"];
				$C36[]=$v["C36"];
				$C37[]=$v["C37"];
				$C40[]=$v["C40"];
				$C41[]=$v["C41"];
				$C42[]=$v["C42"];
				$C43[]=$v["C43"];
				$C46[]=$v["C46"];
				$C47[]=$v["C47"];
				$C48[]=$v["C48"];
				$C49[]=$v["C49"];
				$C52[]=$v["C52"];
				$C53[]=$v["C53"];
				$C54[]=$v["C54"];
				$C55[]=$v["C55"];
				$C56[]=$v["C56"];
				$income_month=$v["income_month"];
				$income_ended=$v["income_ended"];
				$C63[]=$v["C63"];
				$C64[]=$v["C64"];
				$C65[]=$v["C65"];
				$C66[]=$v["C66"];
				$C67[]=$v["C67"];
				$C68[]=$v["C68"];
				$C69[]=$v["C69"];
				$C72[]=$v["C72"];
				$C73[]=$v["C73"];
				$C74[]=$v["C74"];
				$C75[]=$v["C75"];
				$C76[]=$v["C76"];
				$C78[]=$v["C78"];
				$C79[]=$v["C79"];
				$C80[]=$v["C80"];
				$C81[]=$v["C81"];
				$C82[]=$v["C82"];
				$C83[]=$v["C83"];
				$C84[]=$v["C84"];
				$C85[]=$v["C85"];
				$C86[]=$v["C86"];
				$C87[]=$v["C87"];
				$C88[]=$v["C88"];
				$C91[]=$v["C91"];
				$C92[]=$v["C92"];
				$C93[]=$v["C93"];
				$C94[]=$v["C94"];
				$C95[]=$v["C95"];
				$C96[]=$v["C96"];
				$C98[]=$v["C98"];
				$C99[]=$v["C99"];
				$C100[]=$v["C100"];
				$C101[]=$v["C101"];
				$C102[]=$v["C102"];
				$C103[]=$v["C103"];
				$C104[]=$v["C104"];
				$C105[]=$v["C105"];
				$C106[]=$v["C106"];
				$C107[]=$v["C107"];
				$C108[]=$v["C108"];
				$C109[]=$v["C109"];
				$C110[]=$v["C110"];
				$C111[]=$v["C111"];
				$C112[]=$v["C112"];
				$C113[]=$v["C113"];
	
		

	} // end while




//***** Cal P =====
//echo "Hey P";
/*
		$result = $db->sql_query("Select * from balancesheet Order by NO");
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
*/
//echo "Hey Assign";
	//----- Assign Value ---------
	for($i=0;$i< $cnt_row;$i++)
	{
		 $var = "DATE".(5-$cnt_row+$i+1);

		$template->assign_vars(array(
			$var=>$DateArr[$i],
			));
			//echo "$var  = ".$DateArr[$i]."<br>";
				//==== C =========
				for($c=6;$c<=113;$c++)
				{
					$cvar ="C".$c."_".(5-$cnt_row+$i+1);
					@eval( 'if($C'.$c.'['.$i.']){ $Cans = number_format($C'.$c.'['.$i.'],2,\'.\',\',\' ); }else{ $Cans =""; } ');
					//@eval( ' $Cans = number_format($C'.$c.'['.$i.'],2,\'.\',\',\' );  ');
						$template->assign_vars(array(
						$cvar=>$Cans,
						));
				}

	}



	

	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
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


function Pearls($mem_id)
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
	 
				$P1=array();
				$P2=array();
				$P3=array();
				$P4=array();
				$P5=array();
				$P6=array();
				$E1=array();
				$E2=array();
				$E3=array();
				$E4=array();
				$E5=array();
				$E6=array();
				$E7=array();
				$E8=array();
				$E9=array();
				$A1=array();
				$A2=array();
				$A3=array();
				$R1=array();
				$R2=array();
				$R3=array();
				$R4=array();
				$R5=array();
				$R6=array();
				$R7=array();
				$R8=array();
				$R9=array();
				$R10=array();
				$R11=array();
				$R12=array();
				$L1=array();
				$L2=array();
				$L3=array();
				$S1=array();
				$S2=array();
				$S3=array();
				$S4=array();
				$S5=array();
				$S6=array();
				$S7=array();
				$S8=array();
				$S9=array();
				$S10=array();
				$S11=array();
				$DateArr = array();

	 $table="bench_result";
			$fieldArr =" * ";
			$searchkey=" and mem_id='$mem_id'  order by resu desc  limit 0,5 ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			$cnt_row = $db->sql_numrows();

				while($row = $db->sql_fetchrow($result))
				{

				$resu=$row["resu"];
				$bench_id=$row["bench_id"];
				$mem_id=$row["mem_id"];
				$date = SearchSingleDB( " and bench_id='$bench_id'  " ,"bench","balance_sheet");

				$DateArr[] = $date ;
				$P1[]=$row["P1"];
				$P2[]=$row["P2"];
				$P3[]=$row["P3"];
				$P4[]=$row["P4"];
				$P5[]=$row["P5"];
				$P6[]=$row["P6"];
				$E1[]=$row["E1"];
				$E2[]=$row["E2"];
				$E3[]=$row["E3"];
				$E4[]=$row["E4"];
				$E5[]=$row["E5"];
				$E6[]=$row["E6"];
				$E7[]=$row["E7"];
				$E8[]=$row["E8"];
				$E9[]=$row["E9"];
				$A1[]=$row["A1"];
				$A2[]=$row["A2"];
				$A3[]=$row["A3"];
				$R1[]=$row["R1"];
				$R2[]=$row["R2"];
				$R3[]=$row["R3"];
				$R4[]=$row["R4"];
				$R5[]=$row["R5"];
				$R6[]=$row["R6"];
				$R7[]=$row["R7"];
				$R8[]=$row["R8"];
				$R9[]=$row["R9"];
				$R10[]=$row["R10"];
				$R11[]=$row["R11"];
				$R12[]=$row["R12"];
				$L1[]=$row["L1"];
				$L2[]=$row["L2"];
				$L3[]=$row["L3"];
				$S1[]=$row["S1"];
				$S2[]=$row["S2"];
				$S3[]=$row["S3"];
				$S4[]=$row["S4"];
				$S5[]=$row["S5"];
				$S6[]=$row["S6"];
				$S7[]=$row["S7"];
				$S8[]=$row["S8"];
				$S9[]=$row["S9"];
				$S10[]=$row["S10"];
				$S11[]=$row["S11"];
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
				/*
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
			    

	)	);*/

			}

  
	for($i=0;$i< $cnt_row;$i++)
	{
		 $var = "DATE".(5-$cnt_row+$i+1);

		$template->assign_vars(array(
			$var=>$DateArr[$i],
			));
				
				//==== P =========
				for($p=1;$p<=6;$p++)
				{
					$pvar ="P".$p."_".(5-$cnt_row+$i+1);
					@eval( '$Pans = number_format($P'.$p.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$pvar=>$Pans,
						));
				}
				//==== E =========
				for($e=1;$e<=9;$e++)
				{
					$evar ="E".$e."_".(5-$cnt_row+$i+1);
					@eval( '$Eans = number_format($E'.$e.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$evar=>$Eans,
						));
				}
				//==== A =========
				for($a=1;$a<=9;$a++)
				{
					$avar ="A".$a."_".(5-$cnt_row+$i+1);
					@eval( '$Aans = number_format($A'.$a.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$avar=>$Aans,
						));
				}
				//==== R =========
				for($r=1;$r<=12;$r++)
				{
					$rvar ="R".$r."_".(5-$cnt_row+$i+1);
					@eval( '$Rans = number_format($R'.$r.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$rvar=>$Rans,
						));
				}
				//==== L =========
				for($l=1;$l<=3;$l++)
				{
					$lvar ="L".$l."_".(5-$cnt_row+$i+1);
					@eval( '$Lans = number_format($L'.$l.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$lvar=>$Lans,
						));
				}
				//==== S =========
				for($s=1;$s<=11;$s++)
				{
					$svar ="S".$s."_".(5-$cnt_row+$i+1);
					@eval( '$Sans = number_format($S'.$s.'['.$i.'],2,\'.\',\',\' );');
						$template->assign_vars(array(
						$svar=>$Sans,
						));
				}

	}



	$template->assign_vars(array(
		'TOPMENU'=>GetTopMenu(),
		'MEMBER_NAME'=>SearchSingleDB( " and mem_id=$mem_id" ,"member","member_name"),
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
			$fieldArr ="mem_id,title,firstname,lastname,email,email_confirmation,organization,addresstype,street,street2,city,state,zip,country,phone,fax,username,password1,password2,player,player_other,interests1,interests2,interests3,interests4,interests5,interests_other,newsletter,member_name,m_address,m_country,m_tel,m_fax,m_email,m_homepage,m_establish,m_vision,m_mission,m_profile_as,members_urban,members_urban_low,members_rural,members_rural_low,market_segmentation,urban_male,urban_female,members_urban_18_19,members_urban_30_45,members_urban_45_60,members_urban_60,rural_male,rural_female,members_rural_18_19,members_rural_30_45,members_rural_45_60,members_rural_60,assets_total,Core_Business,savings_amount,savings_male,savings_female,savings_youth,savings_nonmember,share_amount,share_male,share_female,share_youth,share_nonmember,loan_total,loan_male,loan_female,loan_youth,loan_nonmember,reserve_total,board_name_1,board_pos_1,board_name_2,board_pos_2,board_name_3,board_pos_3,board_name_4,board_pos_4,board_name_5,board_pos_5,board_name_6,board_pos_6,board_name_7,board_pos_7,board_name_8,board_pos_8,board_name_9,board_pos_9,board_name_10,board_pos_10,manage_name_1,manage_pos_1,manage_name_2,manage_pos_2,manage_name_3,manage_pos_3,manage_name_4,manage_pos_4,manage_name_5,manage_pos_5,Iagree,member_of,active  , area_code , m_area , register_date";
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

								$area_code =$row["area_code"];
				$m_area = $row["m_area"];
				$register_date = $row["register_date"];
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
		'TOPMENU'=>GetTopMenu(),
							'AREA_CODE'=>$area_code,
		'M_AREA'=>$m_area,
		'REGISTER_DATE'=>$register_date,
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
	  'MENU'=>$menu,
		'COUNT'=>Counter()
		)	);
   $template->SetImagePath("");
   $template->pparse('body');
	
}

?>