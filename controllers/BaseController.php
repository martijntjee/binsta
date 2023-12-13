<?php

use RedBeanPHP\R as R;

class BaseController
{
    public function getBeanById($typeOfBean, $queryStringKey)
    {
        $bean = null;
        if (isset($_GET[$queryStringKey])) {
            $id = $_GET[$queryStringKey];
            $bean = R::load($typeOfBean, $id);
        } else {
            error(404, 'No ' . $queryStringKey . ' specified');
        }

        return $bean;
    }

    public function authorizeUser()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /user/login');
            exit();
        }
    }
}
