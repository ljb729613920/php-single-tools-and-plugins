#!/bin/bash

vendor/bin/phpunit --colors --testdox-html tests.html --bootstrap test/bootstrap.php test/

vendor/bin/phpmetrics --report-html=metrics.html lib/
vendor/bin/phpcbf --standard=PSR2 lib/
vendor/bin/phpcs --standard=PSR2 --report-full=sniffer.txt lib/
vendor/bin/phpmd lib/ html codesize cleancode controversial design naming unusedcode --reportfile phpmd.html

