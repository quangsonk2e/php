<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="_code.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="1.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<link rel="stylesheet" href="css.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
	<?php
	
	ini_set('max_execution_time', 0);
	include 'simple_html_dom.php';
		$flag=1;
	$link='https://www.wpf-tutorial.com/vi/75/listview/a-simple-listview-example/';
	
	function replaceimg($http,$strUrl,$str){
		return str_replace($strUrl, $http.$strUrl, $str);
	}
	function getContent($url=''){
		global $flag, $link;

		$html = file_get_html($url);
		$art= $html->find('article',0);
		if(!empty($art)){

			$lang=$html->find('#divArticleAvailableLanguages');
			$localtion=$html->find('.localization-info',0);
			$bottomPage=$html->find('#bottom-navigation',0);
			$linkNext=$html->find('a.article-navigation',1);
			if($linkNext){
				$linkNext='https://www.wpf-tutorial.com'.$linkNext->href;
				$link=$linkNext;
			}
			else $flag=0;
			$html1=str_get_html($art);
			foreach ($html1->find('img') as $itemImg){
					$art=replaceimg('https://www.wpf-tutorial.com/',$itemImg->src,$art);
				}
				
			 $art=str_replace($localtion, '', $art);
			$art=str_replace($lang, '', $art);
			$art=str_replace($bottomPage, '', $art);
		}
		
		return $art;

		// $html = file_get_html($url);
		// 	$art=$html->find('.localizable',0);
		// $html1=str_get_html($art);
		// foreach ($html1->find('img') as $itemImg){
		// 		$art=replaceimg('https://www.wpf-tutorial.com/',$itemImg->src,$art);
		// 	}
		// //localization-info
		// if(!$html->find('.article-navigation',1)){ $flag=0;} 
		// $head=$html->find('.localization-info',0);

	
			
		// $language=$html->find('#divArticleAvailableLanguages');
		// $art=str_replace($head, '', $art);

		// echo 'ddddddddddd '.$flag;
		// return str_replace($language,'',$art);
			
	}


		while($flag)
			echo getContent($link).'</br>';
	
	?>
</body>
</html>