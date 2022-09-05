<?php
session_start();

/**
 * ETML
 * Date: 01.06.2017
 * Shop
 */

$debug = false;

if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

}

include 'controller/Controller.php';
include 'controller/AdminController.php';
include 'controller/HomeController.php';
include 'controller/LoginController.php';
include 'controller/ShopController.php';
include 'controller/BasketController.php';

date_default_timezone_set('Europe/Zurich');

class MainController
{

    /**
     * Constructor for view display
     *
     * @return void
     */
    public function dispatch()
    {

        if (!isset($_GET['controller'])) {
            $_GET['controller'] = 'shop';
            $_GET['action'] = 'list';
        }


        $currentLink = $this->menuSelected($_GET['controller']);
        $this->viewBuild($currentLink);
    }

    /**
     * Selected the page current
     *
     * @param string $page
     * @return AdminController|HomeController|LoginController|ShopController
     */
    protected function menuSelected($page)
    {

        switch ($page) {
            case 'admin':
                $link = new AdminController();
                break;
            case 'login':
                $link = new LoginController();
                break;
            case 'shop':
                $link = new ShopController();
                break;
            case 'basket':
                $link = new BasketController();
                break;
            case 'home':
            default:
                $link = new HomeController();
                break;
        }

        return $link;
    }

    /**
     * Build the view for display pages
     *
     * @param $currentPage
     * @return void
     */
    protected function viewBuild($currentPage)
    {

        $content = $currentPage->display();

        if (get_class($currentPage) == 'DownloadController') {
            echo $content;
        } else {
            include(dirname(__FILE__) . '/view/head.html');
            include(dirname(__FILE__) . '/view/header.html');
            include(dirname(__FILE__) . '/view/menu.php');
            echo $content;
            include(dirname(__FILE__) . '/view/footer.html');
        }
    }
}

/**
 * Display WebSite
 */
$controller = new MainController();
$controller->dispatch();