# WP-Browser Wakeup Error Repo
This is a demo repository with the minimum to reproduce the following error.

## Problem

When I wan't to run codeception with WPLoader (wp-browser v4) to test some code with WooCommerce, I get the following error:

```
[PHPUnit\Framework\Error\Notice] Function __wakeup was called <strong>incorrectly</strong>. Unserializing instances of this class is forbidden. Backtrace: include('/var/www/vendor/codeception/codeception/codecept'), require('/var/www/vendor/codeception/codeception/app.php'), {closure}, Codeception\Application->run, Symfony\Component\Console\Application->run, Symfony\Component\Console\Application->doRun, Symfony\Component\Console\Application->doRunCommand, Symfony\Component\Console\Command\Command->run, lucatume\WPBrowser\Command\RunAll->execute, Codeception\Command\Run->execute, Codeception\Command\Run->runSuites, Codeception\Codecept->run, Codeception\Codecept->runSuite, Codeception\SuiteManager->run, Codeception\Suite->run, Codeception\Test\Test->realRun, Codeception\Test\TestCaseWrapper->test, PHPUnit\Framework\TestCase->runBare, PHPUnit\Framework\TestCase->snapshotGlobalState, PHPUnit\Framework\TestCase->createGlobalStateSnapshot, SebastianBergmann\GlobalState\Snapshot->__construct, SebastianBergmann\GlobalState\Snapshot->snapshotGlobals, unserialize, WooCommerce->__wakeup, wc_doing_it_wrong Please see <a href="https://wordpress.org/documentation/article/debugging-in-wordpress/">Debugging in WordPress</a> for more information. (This message was added in version 2.1.)

#1  Codeception\Subscriber\ErrorHandler->errorHandler
#2  /var/www/html/wp/wp-includes/functions.php:5905
#3  /var/www/html/wp-content/plugins/woocommerce/includes/wc-deprecated-functions.php:118
#4  /var/www/html/wp-content/plugins/woocommerce/includes/class-woocommerce.php:164
#5  WooCommerce->__wakeup
#6  /var/www/vendor/sebastian/global-state/src/Snapshot.php:281
#7  /var/www/vendor/sebastian/global-state/src/Snapshot.php:126
#8  /var/www/vendor/symfony/console/Command/Command.php:326
#9  /var/www/vendor/bin/codecept:119
```

## How to

1. Build docker image `docker compose build`
2. Run containers `docker compose up -d`
3. Run codeception unit test `docker compose exec wordpress composer test`
4. Error should be shown

## Notes
* The WordPress environment of the Dockerfile is not used in this demo.
* I need to run the codeception within the docker environment. 
* The unit test does not have any assertions. The error seems to occur while bootstrapping.