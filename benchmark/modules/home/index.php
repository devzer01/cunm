<?php
$module_name = basename(dirname(__FILE__));

 $template->set_filenames(array(
		'body' => $mainframe[0])
	);
	
	
$CNT=1;

	 $module_file = "modules/$module_name/home.htm";
	 $template->SetImagePath("modules/$module_name/");

	 $template->set_filenames(array(
		'home' => $module_file)
		);

$query = "select m_country from member group by m_country ";
$result = $db->sql_query($query);
$SCountry = array();
				while($row = $db->sql_fetchrow($result))
			{
				$m_country = $row["m_country"];
				$SCountry[] =  $m_country;
			}


$template->assign_vars(array(
'COUNTRY'=>OptionV(0,count($SCountry)-1,$country,$SCountry,"--  All Country  --"),
	'ACTION'=>"index.php",
	 'M'=>"member",
	'OP'=>"search",
	'GR'=>$gr
));


    $menu=GetMenu();

	$html_code =  $template->pparse_str('home');
	$template->assign_vars(array(
      'HTML_CODE'=> $html_code,
		'COUNT'=>Counter()
		)	);
	 $template->SetImagePath("");
   $template->pparse('body');



?>