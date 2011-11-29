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
	@echo "patch\t\t Updates the package.xml and increments the patch revision number (1.1.x)"
	@echo "minor\t\t Updates the package.xml and increments the minor revision number (1.x.0)"
	@echo "major\t\t Updates the package.xml and increments the major revision number (x.0.0)"
	@echo "pear\t\t Creates a PEAR package from the current package.xml"
	@echo "pirum-push\t PKG=FooPackage.tgz REPO=GitHubFooUser/GitHubFooRepo Send all tgz pear packages to Pirum repository (requires git write access)"

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

patch:
	@echo "Generating package.xml patch version"
	php bin/pear-package.php patch ${STABILITY}

minor: 
	@echo "Generating package.xml minor version"
	php bin/pear-package.php minor ${STABILITY}

major:
	@echo "Generating package.xml major version"
	php bin/pear-package.php major ${STABILITY}

pear:
	@echo "Generating package tgz"
	pear package package.xml

pirum-push:
	@echo "Cloning channel from git ${REPO}"
	-rm -Rf pirum
	git clone git@github.com:${REPO}.git pirum
	pirum add pirum ${PKG};pirum build pirum;
	cd pirum;git add .;git commit -m "Added ${PKG}";git push
	@echo "Success! Pushed ${PKG}"

foundation:
	@echo "Cloning Foundation from GitHub"
	-rm -Rf .foundation-tmp
	git clone git://github.com/Respect/Foundation.git .foundation-tmp
	@echo "Renaming .dist files and removing repo metadata"
	rm .foundation-tmp/README.md
	rm .foundation-tmp/LICENSE
	mv .foundation-tmp/README.md.dist .foundation-tmp/README.md
	mv .foundation-tmp/package.xml.dist package.xml
	@echo "Copying files without overwrite"
	cp -an .foundation-tmp/* .
	echo "Removing temp files"
	rm -Rf .foundation-tmp
	@echo "Done!"
