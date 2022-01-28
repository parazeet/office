<?php
/**
 * Custom router which handles default middlewares, default exceptions and things
 * that should be happen before and after the router is initialised.
 */
namespace App;

use Exception;
use Pecee\Http\Middleware\Exceptions\TokenMismatchException;
use Pecee\SimpleRouter\Exceptions\HttpException;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    /**
     * @throws Exception
     * @throws TokenMismatchException
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public static function start(): void
	{
		// Load our helpers
		require_once 'helpers.php';

		// Load our custom routes
		require_once __DIR__ . "/../../routes/web.php";

		// Do initial stuff
		parent::start();
	}

}