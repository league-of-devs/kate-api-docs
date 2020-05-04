<?php
	$path = isset($_GET['path']) ? $_GET['path'] : "";
	if($path == "")
		$path = "index";

	$path = str_replace("/","_",$path);

	$cnt = file_get_contents("base.html");

	//Load content
	{
		$content = "";
		if(file_exists ("content/" . $path . ".html"))
		{
			$content = file_get_contents("content/" . $path . ".html");
		}
		else
		{
			$content = "<div class='title'>Invalid Path: /" . (isset($_GET['path']) ? $_GET['path'] : "") . "</div>";
		}

		$cnt = str_replace("%content%", $content, $cnt);

	}

	//Load title
	{
		$cnt = str_replace("%title%",'asKate - Api Docs',$cnt);
	}

	//Load side menu
	$sidebar = '<div class="subtitle menu">Páginas<hr/></div>';

	function addLink($text,$link)
	{
		return '<div class="side_menu_item" onclick="window.location.href = \'' . $link . '\'">' . $text . '</div>';
	}

	//Páginas
	$sidebar.= addLink("Página Principal","https://katedocs.leagueofdevs.com.br/");
	$sidebar.= addLink("Segurança","/security");
	$sidebar.= addLink("Tratamento de Erros","/errors");
	$sidebar.= addLink("Suporte","/support");
	
	$sidebar .= '<div class="subtitle menu">Rotas<hr/></div>';

	//Rotas
	$sidebar.= addLink("<div class=\"badge green menu\">GET</div>/kate/platforms","/kate/platforms");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/kate/suggestion/question","/kate/suggestion/question");
	$sidebar.= addLink("<div class=\"badge green menu\">GET</div>/product/full_info","/product/full_info");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/question/answer","/question/answer");
	$sidebar.= addLink("<div class=\"badge green menu\">GET</div>/user/products","/user/products");
	$sidebar.= addLink("<div class=\"badge green menu\">GET</div>/user/info","/user/info");
	$sidebar.= addLink("<div class=\"badge purple menu\">PUT</div>/user/edit_info","/user/edit_info");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/suggestion/attribute","/user/suggestion/attribute");
	$sidebar.= addLink("<div class=\"badge green menu\">GET</div>/user/syncs","/user/syncs");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/suggestions","/user/suggestions");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/sync_with_platform","/user/sync_with_platform");
	$sidebar.= addLink("<div class=\"badge red menu\">DELETE</div>/user/remove_sync","/user/remove_sync");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/login","/user/login");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/register","/user/register");
	$sidebar.= addLink("<div class=\"badge orange menu\">POST</div>/user/reset_api_tokens","/user/reset_api_tokens");

	$cnt = str_replace("%side_menu%",$sidebar,$cnt);

	echo $cnt;
?>