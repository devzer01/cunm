<?php
//###############################################################
//### Gen Code  By phpform V 2.016  
//###  Module For db table  company
//###
//###  By Mr. Piya Pimchankam
//###  email : a_piya_p@hotmail.com
//###############################################################
$m		=	isset( $_GET['m'])?$_GET['m']:$_POST['m'];
$op		=	isset( $_GET['op'])?$_GET['op']:$_POST['op'];
$url	=	isset( $_GET['url'])?$_GET['url']:$_POST['url'];
$MEMBER = $_GET['d'];

				$cookie = cookieMemberdecode($MEMBER);
				$mem_id=$cookie[0];
				$username=$cookie[1];
				$password=$cookie[2];
				$member_of=$cookie[3];
				//$com_id=$cookie[4];
				//$brance_id=$cookie[5];
				
				if( $member_of!=ADMINISTRATOR )
				{
					Header("Refresh: 0;url=$index_file?m=member&op=login");
					exit();
				}


$module_name = "admin";
$gr = "admin";
$index_file = "admin.php";
$template->set_filenames(array(
		'body' => $mainframe[1])
	);
//######################3

if(empty($op)){$op="";}

switch($op)
{
	    //#####   modules #########
		case "savemodules":
			Savemodules($modules_id,$name,$menu_name,$e_index_file,$e_gr,$active,$icon,$mainframe,$security_level,$config_file,$menu_order);
			break;
		case "inputmodules":
			Inputmodules($modules_id);
			break;
		case "listmodules":
			List_Modules();
			break;
		case "installmodules":
			Installmodules($modules);
			break;
		//###########################
		case "del":
			Del($tb,$key,$id,$bk,$rt,$page);
			break;
	default :
			List_Modules();
		break;

}


function Installmodules($modules)
{
global $file_slash,$template;
  global $db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;

$curdir  = getcwd();

  // echo "current dir = $curdir <br>";

	$module_name = basename(dirname(__FILE__));
// Check Modules and install Module
	$web_root_path=$curdir.$file_slash;
 // echo " dir =$web_root_path <br>";

			$installable_modules = array();
			
			 
			if( $dir = @opendir($web_root_path. "modules".$file_slash) )
			{
				// echo "open dir modules OK <br>";
				while( $sub_dir = @readdir($dir) )
				{  
					  //echo "open Sub dir modules OK <br>";
					if( !is_file($web_root_path . 'modules'.$file_slash.$sub_dir) && !is_link($web_root_path . 'modules'.$file_slash.$sub_dir) && $sub_dir != "." && $sub_dir != ".." && $sub_dir != "CVS" )
					{
								//echo "check File OK <br>";
						if( @file_exists(@($web_root_path."modules".$file_slash . $sub_dir.$file_slash."module_info.cfg")) )
						{
							     
							include( $web_root_path. "modules" .$file_slash. $sub_dir.$file_slash . "module_info.cfg");
							//echo "Include File OK <br>";
							
							for($i = 0; $i < count($$sub_dir); $i++)
							{
								$working_data = $$sub_dir;
								
								$modules_name = $working_data[$i]['module_name'];
								$menu_name = $working_data[$i]['menu_name'];
								//echo "$style_name <br>";
								//---- Check Modules
								if($modules	== $menu_name )
								{
									$table="modules";
									$name = $working_data[$i]['module_name'] ;
									$menu_name = $working_data[$i]['menu_name'] ;
									$mindex_file = $working_data[$i]['Index_file'] ;
									$mgr = $working_data[$i]['gr'] ;
									$mainframe = $working_data[$i]['mainframe'] ;
									$security_level = $working_data[$i]['security_level'] ;
									$config_file = $working_data[$i]['config_file'] ;

									$field="modules_id,name,menu_name,index_file,gr,active,icon,mainframe,security_level,config_file,menu_order";
									$data="NULL,'$name','$menu_name','$mindex_file','$mgr','$active','$icon','$mainframe','$security_level','$config_file','$menu_order'";
									SaveDB( $table,$field,$data);
								}

							}
						}
					}
				}
			}


Header("Refresh: 0;url=$index_file?m=$module_name&op=listmodules&gr=$gr");
}


function List_Modules()
{
global $file_slash,$template;
  global $db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;

	$curdir  = getcwd();

  // echo "current dir = $curdir <br>";

	$module_name = basename(dirname(__FILE__));
// Check Modules and install Module
	$web_root_path=$curdir.$file_slash;
 // echo " dir =$web_root_path <br>";

			$installable_modules = array();
			
			 
			if( $dir = @opendir($web_root_path. "modules".$file_slash) )
			{
				// echo "open dir modules OK <br>";
				while( $sub_dir = @readdir($dir) )
				{  
					  //echo "open Sub dir modules OK <br>";
					if( !is_file($web_root_path . 'modules'.$file_slash.$sub_dir) && !is_link($web_root_path . 'modules'.$file_slash.$sub_dir) && $sub_dir != "." && $sub_dir != ".." && $sub_dir != "CVS" )
					{
								//echo "check File OK <br>";
						if( @file_exists(@($web_root_path."modules".$file_slash . $sub_dir.$file_slash."module_info.cfg")) )
						{
							     
							include( $web_root_path. "modules" .$file_slash. $sub_dir.$file_slash . "module_info.cfg");
							//echo "Include File OK <br>";
							
							for($i = 0; $i < count($$sub_dir); $i++)
							{
								$working_data = $$sub_dir;
								
								$modules_name = $working_data[$i]['module_name'];
								$menu_name = $working_data[$i]['menu_name'];
								//echo "$style_name <br>";
								//---- Check Modules
											$table="modules";
											$fieldArr ="modules_id";
											$searchkey=" and menu_name='$menu_name' ";
											$result=SearchDB( $searchkey,$table,$fieldArr);
											if(!$db->sql_numrows())
											{
												$installable_modules = $working_data[$i];
												$template->assign_block_vars('morow', array(
												'name'=>$menu_name,
												 'install'=>"$index_file?m=$module_name&op=installmodules&modules=".urlencode($menu_name)."&gr=$gr"
												));
											}

							}
						}
					}
				}
			}


//----------------------List Install Modules------------------------------------
AListmodules();
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

function Savemodules($modules_id,$name,$menu_name,$e_index_file,$e_gr,$active,$icon,$mainframe,$security_level,$config_file,$menu_order)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath,$gr;



		$table="modules";
		if(empty($modules_id))
		{
		$field="modules_id,name,menu_name,index_file,gr,active,icon,mainframe,security_level,config_file,menu_order";
		$data="NULL,'$name','$menu_name','$e_index_file','$e_gr','$active','$icon','$mainframe','$security_level','$config_file','$menu_order'";
		SaveDB( $table,$field,$data);
		}else{
		$dataset="name='$name' ,menu_name='$menu_name' ,index_file='$e_index_file' ,gr='$e_gr' ,active='$active' ,icon='$icon' ,mainframe='$mainframe' ,security_level='$security_level' ,config_file='$config_file' ,menu_order='$menu_order' ";
		$condition=" modules_id='$modules_id' ";
		SaveEditDB( $table,$dataset,$condition);
		}
		Header("Refresh: 0;url=$index_file?m=$module_name&op=listmodules&gr=$gr");
	
}



function Inputmodules($modules_id)
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$gr;


				
		if( 1 and  !empty($modules_id))
		{
			$table="modules";
			$fieldArr ="modules_id,name,menu_name,index_file,gr,active,icon,mainframe,security_level,config_file,menu_order";
			$searchkey=" and modules_id='$modules_id' ";
			$result=SearchDB( $searchkey,$table,$fieldArr);
			if($db->sql_numrows())
			{
				$row = $db->sql_fetchrow($result);
								$dmodules_id=$row["modules_id"];
				$dname=$row["name"];
				$dmenu_name=$row["menu_name"];
				$dindex_file=$row["index_file"];
				$dgr=$row["gr"];
				$dactive=$row["active"];
				$dicon=$row["icon"];
				$dmainframe=$row["mainframe"];
				$dsecurity_level=$row["security_level"];
				$dconfig_file=$row["config_file"];
				$dmenu_order=$row["menu_order"];
				
			}

		}else{
		     $modules_id="";
	
	
		}//end if

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/inputmodules.php";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/inputmodules.php";
	 $template->SetImagePath("modules/$module_name/");
		}

	 $template->set_filenames(array(
		'inputform' => $module_file)
		);

	$template->assign_vars(array(
       'MODULES_ID'=>$dmodules_id,
			    'NAME'=>$dname,
			    'MENU_NAME'=>$dmenu_name,
			    'INDEX_FILE'=>$dindex_file,
			    'GR'=>$dgr,
			    'ACTIVE'=>$dactive,
			    'ICON'=>$dicon,
			    'MAINFRAME'=>$dmainframe,
			    'SECURITY_LEVEL'=>$dsecurity_level,
			    'CONFIG_FILE'=>$dconfig_file,
			    'MENU_ORDER'=>$dmenu_order,
			    
	 'M'=>$module_name,
	'OP'=>"savemodules",
	'GR'=>$gr
	)	);

	   $menu=GetMenu();

	$html_code =  $template->pparse_str('inputform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
		'MENU'=>$menu
		)	);
	 $template->SetImagePath("");
   $template->pparse('body');

}

function AListmodules()
{
  global $admin,$db,$index_file,$module_name,$SaveSMPath,$SaveBGPath,$SaveFilePath, $template,$mainframe,$adminframe,$page,$gr;

	if(!empty($gr))
		{
	 $module_file = "modules/$module_name/$gr/listmodules.php";
	 $template->SetImagePath("modules/$module_name/$gr/");
		}else{
	 $module_file = "modules/$module_name/listmodules.php";
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
		$table="modules";
		$fieldArr ="modules_id,name,menu_name,index_file,gr,active,icon,mainframe,security_level,config_file,menu_order";
		$searchkey=" order by menu_order";

		list($totalpage,$result)=SearchDBListPage( $searchkey,$table,$fieldArr,$page,$page_list);
		 if($db->sql_numrows())
		{
		while($v= $db->sql_fetchrow($result) )
		{

						$dmodules_id=$v["modules_id"];
				$dname=$v["name"];
				$dmenu_name=$v["menu_name"];
				$dindex_file=$v["index_file"];
				$dgr=$v["gr"];
				$dactive=$v["active"];
				$dicon=$v["icon"];
				$dmainframe=$v["mainframe"];
				$dsecurity_level=$v["security_level"];
				$dconfig_file=$v["config_file"];
				$dmenu_order=$v["menu_order"];
				

		$edit="$index_file?m=$module_name&op=inputmodules&modules_id=$dmodules_id&gr=$gr";
		$cap=str_replace("","",$cap);
		 $del="javascript:Del('tb=modules&key=modules_id&id=$dmodules_id&op=del&rt=listmodules&gr=$gr','$cap')";

		$template->assign_block_vars('listrow', array(
		 'MODULES_ID'=>$dmodules_id,
			    'NAME'=>$dname,
			    'MENU_NAME'=>$dmenu_name,
			    'INDEX_FILE'=>$dindex_file,
			    'GR'=>$dgr,
			    'ACTIVE'=>$dactive,
			    'ICON'=>$dicon,
			    'MAINFRAME'=>$dmainframe,
			    'SECURITY_LEVEL'=>$dsecurity_level,
			    'CONFIG_FILE'=>$dconfig_file,
			    'MENU_ORDER'=>$dmenu_order,
			       
        'U_DEL'=>$del,
		'U_EDIT'=>$edit
		)	);
	} // end while
}// end if

	$link="$index_file?m=$module_name&op=listmodules";
	$template->assign_vars(array(
      'PAGE_LIST'=>List_PageStr($page,$totalpage,$link),
		'JAVA_URL'=>"$index_file?m=$module_name&op=del",
		'U_ADD'=>"$index_file?m=$module_name&op=inputmodules&gr=$gr"
		)	);

	   $menu=GetMenu();

	$html_code =  $template->pparse_str('listform');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code ,
	  'MENU'=>$menu
		)	);
  $template->SetImagePath("");
   $template->pparse('body');


	
}


?>