# BadgeOS Test Suite [![Build Status](https://secure.travis-ci.org/opencredit/badgeos.png?branch=master)](http://travis-ci.org/opencredit/badgeos) [![Coverage Status](https://coveralls.io/repos/opencredit/badgeos/badge.png)](https://coveralls.io/r/opencredit/badgeos) #

Version: 1.1

-------------------------

The BadgeOS Test Suite uses PHPUnit to help us maintain the best possible code quality.

Travis-CI Automated Testing
-----------

The master branch of BadgeOS is automatically tested on [travis-ci.org](http://travis-ci.org). The image above will show you the latest test's output. Travis-CI will also automatically test all new Pull Requests to make sure they will not break our build.

Quick Start (For Manual Runs)
-----------------------------

	# Clone this repository
    git clone git://github.com/opencredit/badgeos.git
    cd BadgeOS

    # Download the core WordPress Testing Suite
	svn co --ignore-externals http://unit-tests.svn.wordpress.org/trunk/ tests/vendor/wordpress-tests

    # Copy and edit the WordPress Unit Tests Configuration
    cp tests/phpunit/includes/unittests-config.travis.php tests/vendor/wordpress-tests/unittests-config.php

Now edit `unittests-config.php` in a code editor. Make sure to have an empty database ready (all data will die) and double-check that your path to WordPress is correct.

BadgeOS does not necessarily need to be in the `wp-content/plugins` directory. For example in Travis-CI's `.travis.yml` we copy WordPress into `vendor/wordpress`

    <?php

    /* Path to the WordPress codebase you'd like to test. Add a backslash in the end. */
    define( 'ABSPATH', 'path-to-WP/' );
    define( 'DB_NAME', 'badgeos_test' );
    define( 'DB_USER', 'user' );
    define( 'DB_PASSWORD', 'password' );

    # .. more you probably don't need to edit

Load up the Terminal and cd into the directory where BadgeOS is stored and run this command:

    phpunit

Please note: MySQL will need to be running otherwise the unit tests will fail and you'll receive WordPress's standard 'Error Establishing a Database Connection.'

-------------------------

# External Testing URLs #
* Travis-CI (automated unit testing): https://travis-ci.org/opencredit/badgeos/
* Coveralls.io (automated code coverage): https://coveralls.io/r/opencredit/badgeos/

Other Supported (manually run):
* PHPCI: http://www.phptesting.org/
* PHPUnit: http://phpunit.de/manual/current/en/index.html
