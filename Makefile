VERSION       = 0.1.11
CONFIG_TOOL   = php .foundation/repo/bin/project-config.php
GENERATE_TOOL = php .foundation/repo/bin/project-generate.php

.title:
	@echo "Respect/Foundation - $(VERSION)\n"

.check-foundation: .title
	@test -d .foundation || make -f Makefile foundation

# Help is not the default target cause its mainly used as the main
# build command. We're reserving it.
default: .title
	@echo "See 'make help' for instructions."

help: .title
	@echo "             help: Shows this message"
	@echo "       foundation: Installs and updates Foundation"
	@echo "     project-info: Shows project configuration"
	@echo "             test: Run project tests"
	@echo "         coverage: Run project tests and reports coverage status"
	@echo "         cs-fixer: Run php coding standard fixer (PHP CS Fixer)"
	@echo "            clean: Removes code coverage reports"
	@echo "            patch: Increases the patch version of the project (X.X.++)"
	@echo "            minor: Increases the minor version of the project (X.++.0)"
	@echo "            major: Increases the major version of the project (++.0.0)"
	@echo "            alpha: Changes the stability of the current version to alpha"
	@echo "             beta: Changes the stability of the current version to beta"
	@echo "           stable: Changes the stability of the current version to stable"
	@echo "              tag: Makes a git tag of the current project version/stability"
	@echo "      package-ini: Creates the basic package.ini file"
	@echo "      package-xml: Propagates changes from package.ini to package.xml"
	@echo "    composer-json: Propagates changes from package.ini to composer.json"
	@echo "          package: Generates package.ini, package.xml and composer.json files"
	@echo "             pear: Generates a PEAR package"
	@echo "          install: Install this project and its dependencies in the local PEAR"
	@echo "     get-composer: Downlod composer.phar packager."
	@echo "composer-validate: Validate composer.json for syntax and other problems"
	@echo " composer-install: Install this project with composer which will create vendor folder"
	@echo "  composer-update: Update an exiting composer instalation and refresh repositories"
	@echo "        pear-push: Pushes the latest PEAR package. Custom pear_repo='' and \n\
	                   pear_package='' available."
	@echo "          release: Runs tests, coverage reports, tag the build and pushes\n\
	                   to package repositories"
	@echo ""

# Foundation puts its files into .foundation inside your project folder.
# You can delete .foundation anytime and then run make foundation again if you need
foundation: .title
	@echo "Updating Makefile"
	curl -LO git.io/Makefile
	@echo "Creating .foundation folder"
	-rm -Rf .foundation
	-mkdir .foundation
	git clone --depth 1 git://github.com/Respect/Foundation.git .foundation/repo
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > .foundation/onion;chmod +x .foundation/onion
	@echo "Done."

# Target for Respect/Foundation development and internal use only. This target will not appear on the menus.
foundation-develop: .title
	@echo "Updating Makefile"
	curl -LO https://raw.github.com/Respect/Foundation/develop/Makefile
	@echo "Creating .foundation folder"
	-rm -Rf .foundation
	-mkdir .foundation
	git clone --depth 1 git://github.com/Respect/Foundation.git .foundation/repo
	cd .foundation/repo/ && git fetch && git checkout develop && cd -
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > .foundation/onion;chmod +x .foundation/onion
	@echo "Done."

project-info: .check-foundation
	@echo "\nProject Information\n"
	@echo "             php-version:" `$(CONFIG_TOOL) php-version`
	@echo "      project-repository:" `$(CONFIG_TOOL) project-repository`
	@echo "          library-folder:" `$(CONFIG_TOOL) library-folder `
	@echo "             test-folder:" `$(CONFIG_TOOL) test-folder `
	@echo "           config-folder:" `$(CONFIG_TOOL) config-folder `
	@echo "           public-folder:" `$(CONFIG_TOOL) public-folder `
	@echo "      executables-folder:" `$(CONFIG_TOOL) executables-folder `
	@echo "             vendor-name:" `$(CONFIG_TOOL) vendor-name `
	@echo "            package-name:" `$(CONFIG_TOOL) package-name `
	@echo "            project-name:" `$(CONFIG_TOOL) project-name `
	@echo "        one-line-summary:" `$(CONFIG_TOOL) one-line-summary `
	@echo "     package-description:" `$(CONFIG_TOOL) package-description `
	@echo "         package-version:" `$(CONFIG_TOOL) package-version `
	@echo "       package-stability:" `$(CONFIG_TOOL) package-stability `
	@echo "\r         project-authors: "`$(CONFIG_TOOL) package-authors ` \
		| tr ',' '\n' \
		| awk -F' <' '{ printf "                         %-10-s \t<%15-s \n",$$1,$$2 }'
	@echo "\r    project-contributors: "`$(CONFIG_TOOL) package-contributors ` \
		| tr ',' '\n' \
		| awk -F' <' '{ printf "                         %-10-s \t<%15-s \n",$$1,$$2 }'

	@echo "       package-date-time:" `$(CONFIG_TOOL) package-date-time `
	@echo "            pear-channel:" `$(CONFIG_TOOL) pear-channel `
	@echo "         pear-repository:" `$(CONFIG_TOOL) pear-repository `
	@echo "         phar-repository:" `$(CONFIG_TOOL) phar-repository `
	@echo "       pear-dependencies:" `$(CONFIG_TOOL) pear-dependencies `
	@echo "  extension-dependencies:" `$(CONFIG_TOOL) extension-dependencies `
	@echo "             readme-file:" `$(CONFIG_TOOL) readme-file `
	@echo "         project-license:" `$(CONFIG_TOOL) project-license `
	@echo "        project-homepage:" `$(CONFIG_TOOL) project-homepage `
	@echo ""

# Two-step generation including a tmp file to avoid streaming problems
package-ini: .check-foundation
	@$(GENERATE_TOOL) package-ini > package.ini.tmp && mv -f package.ini.tmp package.ini

# Generates a package.xml from the package.ini
package-xml: .check-foundation
	@.foundation/onion build

composer-json: .check-foundation
	@$(GENERATE_TOOL) composer-json > composer.json.tmp && mv -f composer.json.tmp composer.json

# Generates all package files
package: .check-foundation package-ini package-xml composer-json

# Phony target so the test folder don't conflict
.PHONY: test
test: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit --testdox .

coverage: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit  --coverage-html=reports/coverage --coverage-text .
	@echo "Done. Reports also available on `$(CONFIG_TOOL) test-folder`/reports/coverage/index.html"

cs-fixer: .check-foundation
	@cd `$(CONFIG_TOOL) library-folder`;php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
	@echo "Library folder done. `$(CONFIG_TOOL) library-folder`"
	@cd `$(CONFIG_TOOL) test-folder`;php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
	@echo "Test folder done. `$(CONFIG_TOOL) test-folder` "
	@echo "Done. You may verify the changes and commit if you are happy."

# Any cleaning mechanism should be here
clean: .check-foundation
	@rm -Rf `$(CONFIG_TOOL) test-folder`/reports

# Targets below use the same rationale. They change the package.ini file, so you'll need a
# package-sync after them
patch: .check-foundation
	@$(GENERATE_TOOL) package-ini patch > package.ini.tmp && mv -f package.ini.tmp package.ini

minor: .check-foundation
	@$(GENERATE_TOOL) package-ini minor > package.ini.tmp && mv -f package.ini.tmp package.ini

major: .check-foundation
	@$(GENERATE_TOOL) package-ini major > package.ini.tmp && mv -f package.ini.tmp package.ini

alpha: .check-foundation
	@$(GENERATE_TOOL) package-ini alpha > package.ini.tmp && mv -f package.ini.tmp package.ini

beta: .check-foundation
	@$(GENERATE_TOOL) package-ini beta > package.ini.tmp && mv -f package.ini.tmp package.ini

stable: .check-foundation
	@$(GENERATE_TOOL) package-ini stable > package.ini.tmp && mv -f package.ini.tmp package.ini

tag: .check-foundation
	-git tag `$(CONFIG_TOOL) package-version ` -m 'Tagging.'

# Runs on the current package.xml file
pear:
	@pear package

# On root PEAR installarions, this need to run as sudo
install: .check-foundation
	@echo "You may need to run this as sudo."
	@echo "Discovering channel"
	-@pear channel-discover `$(CONFIG_TOOL) pear-channel`
	@pear install package.xml

get-composer: .check-foundation
	@echo "Attempting to download composer packager."
	curl -s http://getcomposer.org/installer | php

composer-validate: .check-foundation
	@echo "Running composer validate, be brave."
	php composer.phar validate -v

composer-install: .check-foundation
	@echo "Running composer install, this will create a vendor folder and congigure autoloader."
	php composer.phar install -v

composer-update: .check-foundation
	@echo "Running composer update, which updates your existing installarion."
	php composer.phar update -v

# Install pirum, clones the PEAR Repository, make changes there and push them.
pear-push: .check-foundation
	@echo "Installing Pirum"
	@sudo pear install --soft --force pear.pirum-project.org/Pirum
	@echo "Cloning channel from git" `$(CONFIG_TOOL) pear-repository`
	-rm -Rf .foundation/pirum
	git clone --depth 1 `$(CONFIG_TOOL) pear-repository`.git .foundation/pirum
	pirum add .foundation/pirum `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`.tgz;pirum build .foundation/pirum;
	cd .foundation/pirum;git add .;git commit -m "Added " `$(CONFIG_TOOL) package-version`;git push

packagecommit:
	@git add package.ini package.xml composer.json
	@git commit -m "Updated package files"

# Uses other targets to complete the build
release: test package packagecommit pear pear-push tag
	@echo "Release done. Pushing to GitHub"
	@git push
	@git push --tags
	@echo "Done. " `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`
