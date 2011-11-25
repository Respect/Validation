default:
	@echo "Respect Foundation"
	@echo 'Please see "make help" for instructions'

help:
	@echo "Respect Foundation\n"
	@echo "Available targets:"
	@echo "help\t\t This message"
	@echo "test\t\t Run all tests"
	@echo "coverage\t Run all tests and write HTML coverage reports"
	@echo "dev\t\t Install the necessary packages to develop this project"
	@echo "pear-patch\t Creates a PEAR package incrementing the patch revision number (1.1.x)"
	@echo "pear-minor\t Creates a PEAR package incrementing the minor revision number (1.x.0)"
	@echo "pear-major\t Creates a PEAR package incrementing the major revision number (x.0.0)"
	@echo "pirum\t\t PKG=FooPackage.tgz REPO=GitHubFooUser/GitHubFooRepo Send all tgz pear packages to Pirum repository (requires git write access)"

test: 
	@cd tests;phpunit .

coverage: 
	@cd tests;phpunit --coverage-html=reports/coverage .
	@echo "Done. Reports available on tests/reports/coverage/index.html"

dev: 
	@echo "Installing PEAR packages... (please run as root if needed)"
	pear upgrade
	pear config-set auto_discover 1
	-pear channel-discover respect.li/pear
	pear install --soft --force pear.phpunit.de/PHPUnit 
	pear install --soft --force pear.pirum-project.org/Pirum
	pear install --soft --force --alldeps -o package.xml 

pear-patch: 
	@echo "Generating package.xml"
	php bin/pear-package.php patch ${STABILITY}
	pear package package.xml

pear-minor: 
	@echo "Generating package.xml"
	php bin/pear-package.php minor ${STABILITY}
	pear package package.xml

pear-major: 
	@echo "Generating package.xml"
	php bin/pear-package.php major ${STABILITY}
	pear package package.xml

pirum: 
	@echo "Cloning channel from git ${REPO}"
	rm -Rf pirum;git clone git@github.com:${REPO}.git pirum
	pirum add pirum ${PKG};pirum build pirum;
	cd pirum;git add .;git commit -m "Added ${PKG}";git push
	@echo "Success! Pushed ${PKG}"