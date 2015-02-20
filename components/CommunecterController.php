<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
  public $title = "Communectez";
  public $subTitle = "se connecter à sa commune";
  public $pageTitle = "Communecter, se connecter à sa commune";
  public static $moduleKey = "communecter";
  public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
  public $description = "Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
  public $projectName = "";
  public $projectImage = "/images/CTK.png";
  public $projectImageL = "/images/logo.png";
  public $footerImages = array(
      array("img"=>"/images/logoORD.PNG","url"=>"http://openrd.io"),
      array("img"=>"/images/logo_region_reunion.png","url"=>"http://www.regionreunion.com"),
      array("img"=>"/images/technopole.jpg","url"=>"http://technopole-reunion.com"),
      array("img"=>"/images/Logo_Licence_Ouverte_noir_avec_texte.gif","url"=>"https://data.gouv.fr"),
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/pixelhumain/pixelhumain"),
      array("img"=>'/images/opensource.gif',"url"=>"http://opensource.org/"));

  const theme = "ph-dori";
  public $themeStyle = "theme-style11";//3,4,5,7,9

	public $sidebar1 = array();

  public $toolbarMenuAdd = array(
     array('label' => "My Network", "key"=>"myNetwork",
            "children"=> array(
              //"myaccount" => array( "label"=>"My Account","key"=>"newContributor", "class"=>"new-contributor", "href"=>"#newContributor", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-pencil fa-stack-1x stack-right-bottom text-danger")),
              "showContributors" => array( "label"=>"Find People","class"=>"show-contributor","key"=>"showContributors", "href"=>"#showContributors", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
              "invitePerson" => array( "label"=>"Invite Someone","key"=>"invitePerson", "class"=>"ajaxSV", "href"=>"#ajaxSV", "onclick"=>"openSubView('Invite someone', '/communecter/person/invite',null)", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "Organisation", "key"=>"organization",
            "children"=> array(
              "addOrganization" => array( "label"=>"Add an Organisation","key"=>"addOrganization", "class"=>"ajaxSV", "onclick"=>"openSubView('Add an Organisation', '/communecter/organization/form',null)", "iconStack"=>array("fa fa-group fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "Note", "key"=>"note",
                "children"=> array(
                  "createNews" 	=> array( "label"=>"Create news",	"key"=>"newNote", 	 "class"=>"ajaxSV", "onclick"=>"openSubView('Create news', '/communecter/news/formCreateNews', null)", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "newsStream" 	=> array( "label"=>"News stream",	"key"=>"newsstream", "class"=>"ajaxSV", "onclick"=>"openSubView('News stream', '/communecter/news/newsstream', null)", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
                  //"newNote"		=> array( "label"=>"Add new note",	"class"=>"new-note",	  "key"=>"newNote",  "href"=>"#newNote",  "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                 // "readNote" 	=> array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href"=>"#readNote", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Calendar", "key"=>"calendar",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent", "class"=>"new-event", "href"=>"#newEvent", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href"=>"#showCalendar", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          )
  );
  
  public $toolbarMenuMaps = array(
      array('label' => "Your Network", 		'desc' => "People, Organisation, Events, Projects ", 		"key"=>"yourNetwork", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Your Network', 	 	'/communecter/sig/network', null)", 	'extra' => "around You",  "iconClass"=>"fa-sitemap text-dark-green"),
      array('label' => "Local Companies", 	'desc' => "Discover Companies around you", 					"key"=>"localCompanies", "class"=>"ajaxSV", "onclick"=>"openSubView('Local Companies', 	'/communecter/sig/companies', null)", 	'extra' => "around You",  "iconClass"=>"fa-building text-dark-danger"),
      array('label' => "Local State", 		'desc' => "All the city hall public services",				"key"=>"localStates", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Local States', 	 	'/communecter/sig/state', null)", 		'extra' => "around You",  "iconClass"=>"fa-university text-orange"),
      array('label' => "Local Events", 		'desc' => "Discover All sorts of local events around you", 	"key"=>"localEvents", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Local Events', 	 	'/communecter/sig/events', null)",  	'extra' => "around You",  "iconClass"=>"fa-calendar text-purple"),
  );

  public $pages = array(
    "default"=> array(
      "index"=>array("href"=>"/ph/communecter"),
      "about"=>array("href"=>"/ph/communecter/default/about"),
      "help"=>array("href"=>"/ph/communecter/default/help"),
      "contact"=>array("href"=>"/ph/communecter/default/contact"),
    ),
    "person"=> array(
      "index"=>array("href"=>"/ph/communecter/person",'title' => "Person"),
    ),
    "organization"=> array(
      "index"=>array("href"=>"/ph/communecter",'title' => "Organization"),
    ),
  );

  function initPage(){
    $this->sidebar1 = array_merge(Menu::menuItems(),$this->sidebar1);
    
    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $this->title = (isset($page["title"])) ? $page["title"] : $this->title;
    $this->subTitle = (isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle;
    $this->pageTitle = (isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle;
  }
}
