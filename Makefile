#! /usr/bin/make

.PHONY: default
default: project-info
default:
	@echo 'Please see "make help" for instructions'

.PHONY: help
help: project-info
help:
	@echo "Usage: make <target>"
	@echo "\nAvailable targets"
	@echo "\thelp\t\t This message"
	@echo "\ttest\t\t Run all tests"
	@echo "\tcoverage\t Run all tests and write HTML coverage reports"
	@echo "\tdev\t\t Install the necessary packages to develop this project"
	@echo "\tpear-patch\t Creates a PEAR package incrementing the patch revision number (1.1.x)"
	@echo "\tpear-minor\t Creates a PEAR package incrementing the minor revision number (1.x.0)"
	@echo "\tpear-major\t Creates a PEAR package incrementing the major revision number (x.0.0)"
	@echo "\tpirum\t\t Send all tgz pear packages to Respect Pirum repository (requires git write access)"
	@echo "\tfix-legacy\t\t Remove old respect.github.com/pear channel, adds new respect.li/pear channel"

.PHONY: project-info
project-info: 
	@echo "Respect Project"

.PHONY: test
test: project-info
test: 
	@cd tests;phpunit .

.PHONY: coverage
coverage: project-info
coverage: 
	@cd tests;phpunit --coverage-html=reports/coverage .
	@echo "Done. Reports available on /tests/reports/coverage/index.html"

.PHONY: dev
dev: project-info
dev: 
	@echo "Installing PEAR packages... (please run as administrator if needed)"
	pear config-set auto_discover 1
	pear install pear.phpunit.de/PHPUnit pear.pirum-project.org/Pirum
	pear channel-discover respect.li/pear

.PHONY: pear-patch
pear-patch: project-info
	@echo "Generating package.xml"
	php bin/pear-package.php patch
	pear package package.xml

.PHONY: pear-minor
pear-minor: project-info
	@echo "Generating package.xml"
	php bin/pear-package.php minor
	pear package package.xml

.PHONY: pear-major
pear-major: project-info
	@echo "Generating package.xml"
	php bin/pear-package.php major
	pear package package.xml

.PHONY: pirum
pirum: project-info
	@echo "Cloning channel"
	rm -Rf pirum;git clone git@github.com:Respect/pear.git pirum
	pirum add pirum ${PKG};pirum build pirum;
	cd pirum;git add .;git commit -m "$Added {PKG}";git push
	@echo "Success! Pushed ${PKG} to http://respect.li/pear"
		
.PHONY: fix-legacy
fix-legacy: project-info
	@echo "Making PEAR magic (please run as administrator if needed)"
	pear uninstall respect.github.com/pear/Relational
	pear uninstall respect.github.com/pear/Config
	pear uninstall respect.github.com/pear/Validation
	pear uninstall respect.github.com/pear/Loader
	pear channel-delete respect.github.com/pear