VERSION       = 0.1.13
FOUNDATION_HOME = $(shell pwd)/.foundation
CONFIG_TOOL   = ${FOUNDATION_HOME}/repo/bin/project-config.php
GENERATE_TOOL = ${FOUNDATION_HOME}/repo/bin/project-generate.php
PACKAGES_PEAR = pear config-get php_dir
SHELL        := $(shell which bash)
.SHELLFLAGS = -c

.SILENT: ;               # no need for @
.ONESHELL: ;             # recipes execute in same shell
.NOTPARALLEL: ;          # wait for this target to finish
.EXPORT_ALL_VARIABLES: ; # send all vars to shell
default: help-default;   # default target
Makefile: ;              # skip prerequisite discovery

.title:
	@echo -e "Respect/Foundation: $(VERSION)\n"

.check-foundation: .title
	@test -d ${FOUNDATION_HOME} || make -f Makefile foundation-develop
	@make -v|grep -qi GNU || echo -e "\nWARNING: Foundation Makefile was developed for use with GNU Make, \
	using other flavoured binaries may have unwanted consequences.\n"
	@make -v|grep -q 'built for .*apple' && echo -e "\nWARNING: The apple built edition of GNU Make have several \
	known quirks and is not recommended. For best results, install make with homebrew and link it in out of \
	"keg only" or create an alias to the non apple distributed version of GNU Make instead.\n" || true

# Help is not the default target cause its mainly used as the main
# build command. We're reserving it.
help-default help: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu"
	@echo "                          ====================================================================="
	@echo "                    help: Shows Respect/Foundation Help Menu: type: make help"
	@echo "              foundation: Installs and updates Foundation"
	@echo "                          ====================================================================="
	@echo "                          Other Targets Menus"
	@echo "                          ====================================================================="
	@echo "            menu-project: Project Scripts Menu"
	@echo "            menu-package: Show Packaging Toolbox Menu"
	@echo "                menu-dev: Show Dev Toolbox Menu"
	@echo "             menu-deploy: Show Deploy & Release"
	@echo ""

menu-project: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 1"
	@echo "                          ====================================================================="
	@echo "                          Project Scripts"
	@echo "                          ====================================================================="
	@echo "                        :   INFO & SCAFFOLDING"
	@echo "            project-info: Shows project configuration"
	@echo "            project-init: Initialize current folder and create boilerplate project structure"
	@echo "                        :   TESTING"
	@echo "                    test: Run project tests"
	@echo "                 testdox: Run project tests - output in testdox format"
	@echo "                coverage: Run project tests and report coverage status"
	@echo "                   clean: Removes code coverage reports"
	@echo "           bootstrap-php: (Re)create all purpose bootstrap.php for phpunit in test folder"
	@echo "       bootstrap-php-opt: Optimized all purpose bootstrap.php with static pear path in test folder"
	@echo "             phpunit-xml: (Re)create phpunit.xml in test folder"
	@echo "              travis-yml: (Re)create .travis.yml in root folder"
	@echo "             travis-lint: Validate your .travis.yml configuration"
	@echo "               gitignore: (Re)create .gitignore file"
	@echo "            test-skelgen: Generate boilerplate PHPUnit skeleton tests per class see help-skelgen"
	@echo "        test-skelgen-all: Generate tests for all classes and it's overwrite safe of course"
	@echo "      phantomjs-snapshot: Take a snapshot of that page with the webkit headless browser"
	@echo "        phantomjs-inject: Inject javascript/jquery into pages for output to stdout."
	@echo "phantomjs-inject-verbose: Verbose output of script injection to help see whats going on."
	@echo "                        :   CLEANUP UTILITIES"
	@echo "        clean-whitespace: All in one does tabs2spaces, unix-line-ends and trailing_spaces"
	@echo "             tabs2spaces: Turns tabs into 4 spaces properly handling mixed tab/spaces"
	@echo "          unix-line-ends: Fixes unix line endings"
	@echo "         trailing_spaces: Removes trailing whitespace"
	@echo "      single-blank-lines: Removes multiple blank lines adds blank line at end of file"
	@echo "      remove-eof-php-tag: Removes php tag at the end of a file if exists"
	@echo "                        :   CODE CONTENT UTILITIES"
	@echo "                cs-fixer: Run PHP Coding Standards Fixer to ensure your cs-style is correct"
	@echo "               codesniff: Run PHP Code Sniffer to generate a report of code analysis"
	@echo "                  phpcpd: Run PHP Copy Paste detector"
	@echo "                  phpdcd: Run PHP Dead Code detector"
	@echo "                  phploc: Run PHP Lines Of Code analyzer for project code statistics"
	@echo "                  phpdoc: Run PhpDocumentor2 to generate the project API documentation"
	@echo "                        :   CONFIGURATION"
	@echo "             package-ini: Creates the basic package.ini file"
	@echo "             package-xml: Propagates changes from package.ini to package.xml"
	@echo "           composer-json: Propagates changes from package.ini to composer.json"
	@echo "                 package: Generates package.ini, package.xml and composer.json files"
	@echo "                    pear: Generates a PEAR package"
	@echo ""



menu-package: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 2"
	@echo "                          ====================================================================="
	@echo "                          Toolbox - Packaging"
	@echo "                          ====================================================================="
	@echo "       composer-validate: Validate composer.json for syntax and other problems"
	@echo "        composer-install: Install this project with composer which will create vendor folder"
	@echo "    composer-install-dev: Install this development project with composer using --dev"
	@echo "         composer-update: Update an exiting composer installation and refresh repositories"
	@echo "                        :    COMPOSER & PACKAGES: use argument ex. package=vendor/package"
	@echo " composer-create-project: Create a project from a package into its default directory"
	@echo "        composer-require: Add required package to composer.json and install it"
	@echo "                 install: Install this project and its dependencies in the local PEAR"
	@echo "                info-php: Show information about your PHP"
	@echo "              config-php: Locate your PHP configuration file aka. php.ini"
	@echo "             include-php: Show the PHP configured (php.ini) include path"
	@echo "               info-pear: Show information about your PEAR"
	@echo "             locate-pear: Locate the PEAR packages installation folder"
	@echo "            install-pear: PEAR installation instructions"
	@echo "            updated-pear: See if there are any updates for PEAR and the installed packages"
	@echo "         update-all-pear: Update all packages if any updates are available"
	@echo "           packages-pear: Show the list of PEAR installed packages and their version numbers"
	@echo "             verify-pear: Verify that we can include System.php in PHP script"
	@echo "         info-check-pear: PEAR installation verification checklist instructions"
	@echo "              info-pyrus: Show information about your PEAR2_Pyrus - PEAR2 Installer"
	@echo "           install-pyrus: Download and install PEAR2_Pyrus"
	@echo "           info-composer: Show information about your composer"
	@echo "        install-composer: Download and install composer"
	@echo ""



menu-dev: .title
	@echo "                          ====================================================================="
	@echo "                          Respect/Foundation Menu 3"
	@echo "                          ====================================================================="
	@echo "                          Toolbox - Development"
	@echo "                          ====================================================================="
	@echo "         info-git-extras: Show information about your installed git extras"
	@echo "      install-git-extras: Install git extras"
	@echo "           info-cs-fixer: Show information about your installed PHP Coding Standards Fixer"
	@echo "        install-cs-fixer: Install PHP Coding Standards Fixer"
	@echo "          info-codesniff: Show information about your installed PHP_CodeSniffer"
	@echo "       install-codesniff: Install PHP_CodeSniffer"
	@echo "       install-psr-sniff: Install Code Sniffer PSR sniffs to allow for PSR 0-3 compliancy checks"
	@echo "            info-phpunit: Show information about your installed PHPUnit"
	@echo "         install-phpunit: Install PHPUnit"
	@echo "             info-phpcpd: Show information about your installed PHP Copy Paste detector"
	@echo "          install-phpcpd: Install PHPcpd"
	@echo "             info-phpdcd: Show information about your installed PHP Dead Code detector"
	@echo "          install-phpdcd: Install PHPdcd"
	@echo "             info-phploc: Show information about your installed PHP LOC analyzer"
	@echo "          install-phploc: Install PHPloc"
	@echo "            info-skelgen: Show information about your installed PHPUnit Skeleton Generator"
	@echo "         install-skelgen: Install PHPUnit Skeleton Generator"
	@echo "       info-test-helpers: Show information about your installed PHPUnit Test Helpers extension"
	@echo "    install-test-helpers: Install PHPUnit Test Helpers extension"
	@echo "             info-phpdoc: Show information about your installed PhpDocumentor2"
	@echo "          install-phpdoc: Install PhpDocumentor2"
	@echo "                info-phd: Show information about your installed PhD"
	@echo "             install-phd: Install PhD is a PHP based Docbook renderer to build the PHP.net documentation"
	@echo "              info-phpsh: Show information about your installed PHP Shell (phpsh)"
	@echo "           install-phpsh: Install PHP Shell (phpsh) - Requires Python"
	@echo "          info-phantomjs: Show information about your installed phantomjs headless webkit browser"
	@echo "       install-phantomjs: Install phantomjs - headless webkit browser"
	@echo "     install-travis-lint: Install travis-lint configuration checker - Requires ruby gems"
	@echo "    install-uri-template: Install uri_template a php extension. Might require sudo."
	@echo ""



menu-deploy: .title
	@echo "                      ====================================================================="
	@echo "                      Respect/Foundation Menu 4"
	@echo "                      ====================================================================="
	@echo "                      Deploy & Release"
	@echo "                      ====================================================================="
	@echo "               patch: Increases the patch version of the project (X.X.++)"
	@echo "               minor: Increases the minor version of the project (X.++.0)"
	@echo "               major: Increases the major version of the project (++.0.0)"
	@echo "               alpha: Changes the stability of the current version to alpha"
	@echo "                beta: Changes the stability of the current version to beta"
	@echo "              stable: Changes the stability of the current version to stable"
	@echo "                 tag: Makes a git tag of the current project version/stability"
	@echo "               pear-push: Pushes the latest PEAR package. Custom pear_repo='' and pear_package='' available."
	@echo "                 release: Runs tests, coverage reports, tag the build and pushes to package repositories"
	@echo ""



# Foundation puts its files into .foundation inside your project folder.
# You can delete .foundation anytime and then run make foundation again if you need
foundation: .title
	@echo "Updating Makefile"
	curl -LO git.io/Makefile
	@echo "Creating ${FOUNDATION_HOME} folder"
	-rm -Rf ${FOUNDATION_HOME}
	-mkdir ${FOUNDATION_HOME}
	git clone --depth 1 git://github.com/Respect/Foundation.git ${FOUNDATION_HOME}/repo
	@make -f Makefile .gitignore-foundation
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > ${FOUNDATION_HOME}/onion;chmod +x ${FOUNDATION_HOME}/onion
	@echo "Done."

# Target for Respect/Foundation development and internal use only. This target will not appear on the menus.
foundation-develop:
	@if make .prompt-yesno message="Do you want to update your Makefile?" 2> /dev/null; then \
	  echo "Updating Makefile"; \
	  curl -LO https://raw.github.com/Respect/Foundation/develop/Makefile; \
	fi
	@echo "Creating ${FOUNDATION_HOME} folder"
	-rm -Rf ${FOUNDATION_HOME}
	-mkdir ${FOUNDATION_HOME}
	git clone --depth 1 git://github.com/Respect/Foundation.git ${FOUNDATION_HOME}/repo
	cd ${FOUNDATION_HOME}/repo/ && git fetch && git checkout develop && cd -
	@make -f Makefile .gitignore-foundation
	@echo "Downloading Onion"
	-curl -L https://github.com/c9s/Onion/raw/master/onion > ${FOUNDATION_HOME}/onion;chmod +x ${FOUNDATION_HOME}/onion
	@echo "Done."

.gitignore-foundation:
	@test -f .gitignore || make -f Makefile .gen-gitignore
	@grep -q .foundation .gitignore || echo .foundation >> .gitignore

.gen-gitignore:
	@echo "(Re)create .gitignore"
	@$(GENERATE_TOOL) config-template gitignore > gitignore.tmp && mv -f gitignore.tmp .gitignore

gitignore: .title .gen-gitignore

project-info: .check-foundation
	@echo -e "\nProject Information\n"
	@echo "             php-version:" `$(CONFIG_TOOL) php-version `
	@echo "      project-repository:" `$(CONFIG_TOOL) project-repository `
	@echo "          library-folder:" `$(CONFIG_TOOL) library-folder `
	@echo "             test-folder:" `$(CONFIG_TOOL) test-folder `
	@echo "           config-folder:" `$(CONFIG_TOOL) config-folder `
	@echo "           public-folder:" `$(CONFIG_TOOL) public-folder `
	@echo "           vendor-folder:" `$(CONFIG_TOOL) vendor-folder `
	@echo "          sandbox-folder:" `$(CONFIG_TOOL) sandbox-folder `
	@echo "    documentation-folder:" `$(CONFIG_TOOL) documentation-folder `
	@echo "      executables-folder:" `$(CONFIG_TOOL) executables-folder `
	@echo "             vendor-name:" `$(CONFIG_TOOL) vendor-name `
	@echo "            package-name:" `$(CONFIG_TOOL) package-name `
	@echo "            project-name:" `$(CONFIG_TOOL) project-name `
	@echo "        one-line-summary:" `$(CONFIG_TOOL) one-line-summary `
	@echo "     package-description:" `$(CONFIG_TOOL) package-description `
	@echo "         package-version:" `$(CONFIG_TOOL) package-version `
	@echo "       package-stability:" `$(CONFIG_TOOL) package-stability `
	@echo -e "\r         project-authors: "`$(CONFIG_TOOL) package-authors` \
	|tr ',' "\n"| awk -F' <' '{printf "%25s%-25s <%15s \n","",$$1,$$2}'
	@echo -e "\r    project-contributors: "`$(CONFIG_TOOL) package-contributors ` \
	|tr ',' "\n"| awk -F' <' '{printf "%25s%-25s <%15s \n","",$$1,$$2}'
	@echo "       package-date-time:" `$(CONFIG_TOOL) package-date-time `
	@echo "               pear-path:" `$(CONFIG_TOOL) pear-path `
	@echo "            pear-channel:" `$(CONFIG_TOOL) pear-channel `
	@echo "         pear-repository:" `$(CONFIG_TOOL) pear-repository `
	@echo "         phar-repository:" `$(CONFIG_TOOL) phar-repository `
	@echo "       pear-dependencies:" `$(CONFIG_TOOL) pear-dependencies `
	@echo "  extension-dependencies:" `$(CONFIG_TOOL) extension-dependencies `
	@echo "             readme-file:" `$(CONFIG_TOOL) readme-file `
	@echo "         project-license:" `$(CONFIG_TOOL) project-license `
	@echo "        project-homepage:" `$(CONFIG_TOOL) project-homepage `
	@echo "               user-name:" `$(CONFIG_TOOL) user-name `
	@echo "              user-email:" `$(CONFIG_TOOL) user-email `
	@echo "               user-home:" `$(CONFIG_TOOL) user-home `
	@echo ""



test-skelgen:	.check-foundation
	@test -f $(shell $(CONFIG_TOOL) test-folder)/bootstrap.php || make bootstrap-php > /dev/null
	@$(eval source-folder=$(shell $(CONFIG_TOOL) library-folder))
	-@if test "$(class)"; then \
		cd $(shell $(CONFIG_TOOL) test-folder) && ${FOUNDATION_HOME}/repo/bin/phpunit-skelgen-classname "${class}" $(source-folder); \
	else \
		echo "Usage:"; \
		echo "     make test-skelgen class=\"My\\Awesome\\Class\""; \
		echo; \
	fi; \

test-skelgen-all:
	@$(eval source-folder=$(shell $(CONFIG_TOOL) library-folder))
	@find $(source-folder) -type f -name "*.php" \
	  | sed -E 's%$(source-folder)/(.*).php%class=\\"\1\\"%' \
	  | sed 's%/%\\\\\\\\%g' \
	  | xargs -L 1 make test-skelgen;

# Re-usable target for yes no prompt. Usage: make .prompt-yesno message="Is it yes or no?"
# Will exit with error if not yes
.prompt-yesno:
	@exec 9<&0 0</dev/tty
	echo "$(message) [Y]:"
	[[ -z $$FOUNDATION_NO_WAIT ]] && read -rs -t5 -n 1 yn;
	exec 0<&9 9<&-
	[[ -z $$yn ]] || [[ $$yn == [yY] ]] && echo Y >&2 || (echo N >&2 && exit 1)

info-phantomjs: .check-foundation
	@echo "This is what I know about your phantomjs."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} phantomjs -v  2> /dev/null || (echo "No phantomjs installed." && false)

install-phantomjs: .check-foundation
	@echo -e "Phantomjs Installation,\ndue to frequent releases (based on webkit) we are not able to install this package for you at this time."
	@echo "Detailed installation instructions are available at http://phantomjs.org/download.html."
	make .prompt-yesno message="Would you like to have the url opened?" && open http://phantomjs.org/download.html

.check-phantomjs:
	@make -f Makefile info-phantomjs &> /dev/null \
	|| make -f Makefile install-phantomjs 2> /dev/null \
	|| (echo "Unable to install phantomjs. Aborting..." && false)

phantomjs-inject phantomjs-inject-verbose: .check-foundation .check-phantomjs
	$(eval VERBOSE := $(patsubst phantomjs-inject%,%,$(@)))
	[[ -z "$(url)" ]] && echo -e "Usage: make phantomjs-snapshot url=<site-url> [code=jQuery Script] or use stdin\n\n \
	      Example:\n \
	      As command line argument:\n \
	                make phantomjs-inject url=respect.li code='alert(\$$\$$(\"title\").text());'\n \
	          note: requires dollar escaped as double dollar \$$\$$\n \
	      From stdin:\n \
	                echo 'console.log(\$$(\"title\").text());' | make phantomjs-inject url=respect.li \n \
	          note: stdin allows for raw input so \$$ doesn't get processed\n \
	      Tips: \n \
	                Use single quotes to avoid shell interpretation.\n \
	                Both alert and/or console.log will echo to stdout.\n \
	                Use target phantom-inject-verbose for detailed output while debugging.\n" \
	      && exit || true
	if [ -z '$(code)' ]; then
	  while read -r; do \
	    lines="$${lines} $${REPLY}"; \
	  done <&0;
	  phantomjs ${FOUNDATION_HOME}/repo/bin/jquery-console-phantom.js "$(url)" "$${lines}" "${VERBOSE}"
	else
	  phantomjs ${FOUNDATION_HOME}/repo/bin/jquery-console-phantom.js "$(url)" '$(code)' "${VERBOSE}"
	fi

phantomjs-snapshot: .check-foundation .check-phantomjs
	[[ -z "$(url)" ]] && echo -e "Usage: make phantomjs-snapshot url=<site-url>\n" && exit 11 || true
	mkdir -p `$(CONFIG_TOOL) sandbox-folder `/snapshots
	image=`phantomjs ${FOUNDATION_HOME}/repo/bin/snapshot.phantom.js "$(url)"`
	echo $$image
	mv -f "$${image}" `$(CONFIG_TOOL) sandbox-folder `/snapshots/.
	open `$(CONFIG_TOOL) sandbox-folder `/snapshots/"$${image}"

project-init: .check-foundation
	@if test -d .git; then \
	  echo; \
	  echo "It appears you already have a git repository configured."; \
	  echo "This target, will run git init and auto add + commit."; \
	  if ! make .prompt-yesno message="Do you want to continue?" 2> /dev/null; then \
	    echo "Aborted on request."; \
	    exit; \
	  fi; \
	fi; \
	make -f Makefile .project-init

.project-init: git-init project-folders phpunit-xml bootstrap-php package git-add-all
	sleep 1
	git add -A
	git commit -a -m"Project initialized."

project-folders: .check-foundation
	@$(GENERATE_TOOL) project-folders createFolders

info-git-extras:
	@echo "This is what I know about your git extras:"
	git extras --version

install-git-extras: .check-foundation
	@make -f Makefile info-git-extras > /dev/null || (cd ${FOUNDATION_HOME} && curl https://raw.github.com/visionmedia/git-extras/master/bin/git-extras | INSTALL=y sh)

git-init: .check-foundation git-init-only git-add-all
	@git commit -a -m"Initial commit."

git-init-only: .check-foundation
	@git init --shared=all

git-add-all: .check-foundation
	@git add -A

codesniff: .check-foundation
	@echo "Running PHP Codesniffer to assess PSR compliancy"
	phpcs -p --report-full=`$(CONFIG_TOOL) documentation-folder `/full2.out `$(CONFIG_TOOL) library-folder `

phpunit-codesniff: .check-foundation
	@echo "Running PHP Codesniffer to assess PHPUnit compliancy"
	phpcs -p --extensions=PHPUnit --report-full=`$(CONFIG_TOOL) documentation-folder `/full2.out `$(CONFIG_TOOL) library-folder `

phpcpd: .check-foundation
	@echo Running PHP Copy paste detection on library folder
	phpcpd --verbose `$(CONFIG_TOOL) library-folder `

phpdcd: .check-foundation
	@echo Running PHP Dead Code detection on library folder
	phpdcd --verbose `$(CONFIG_TOOL) library-folder `

phploc: .check-foundation
	@echo Running PHP Lines of code statistics on library folder
	phploc --verbose `$(CONFIG_TOOL) library-folder `

phpdoc: .check-foundation
	@echo generating documentation with PhpDocumentor2.
	phpdoc -d `$(CONFIG_TOOL) library-folder ` -t `$(CONFIG_TOOL) documentation-folder ` -p

phpunit-xml: .check-foundation
	@$(GENERATE_TOOL) config-template phpunit.xml > phpunit.xml.tmp && mkdir -p $(shell $(CONFIG_TOOL) test-folder) && mv -f phpunit.xml.tmp $(shell $(CONFIG_TOOL) test-folder)/phpunit.xml

bootstrap-php: .check-foundation
	@$(GENERATE_TOOL) config-template bootstrap.php > bootstrap.php.tmp && mkdir -p $(shell $(CONFIG_TOOL) test-folder) && mv -f bootstrap.php.tmp $(shell $(CONFIG_TOOL) test-folder)/bootstrap.php

bootstrap-php-opt: .check-foundation
	@$(GENERATE_TOOL) config-template bootstrap.php.opt > bootstrap.php.tmp && mkdir -p $(shell $(CONFIG_TOOL) test-folder) && mv -f bootstrap.php.tmp $(shell $(CONFIG_TOOL) test-folder)/bootstrap.php

package-ini: .check-foundation
	@$(GENERATE_TOOL) package-ini > package.ini.tmp && mv -f package.ini.tmp package.ini

travis-yml: .check-foundation
	@$(GENERATE_TOOL) config-template travis.yml > travis.yml.tmp && mv -f travis.yml.tmp .travis.yml

# Generates a package.xml from the package.ini
package-xml: .check-foundation
	@${FOUNDATION_HOME}/onion build; echo
	@if test -f package.xml; then \
	  echo Respect/Foundation:; \
	  echo; echo "    $$ make pear"; echo; \
	fi;


composer-json: .check-foundation
	@$(GENERATE_TOOL) composer-json > composer.json.tmp && mv -f composer.json.tmp composer.json

# Generates all package files
package: .check-foundation package-ini package-xml composer-json

# Phony target so the test folder don't conflict
.PHONY: test
test: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit $$([[ -n "$(filter)" ]] && echo "-v --debug --filter $(filter)") .

testdox: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit --testdox .

coverage: .check-foundation
	@cd `$(CONFIG_TOOL) test-folder`;phpunit --testdox --coverage-html=reports/coverage --coverage-text .
	@echo "Done. Reports also available on `$(CONFIG_TOOL) test-folder`/reports/coverage/index.html"
	which open &> /dev/null && open reports/coverage/index.html

cs-fixer: .check-foundation
	@cd `$(CONFIG_TOOL) library-folder`;${FOUNDATION_HOME}/php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
	@echo "Library folder done. `$(CONFIG_TOOL) library-folder`"
	@cd `$(CONFIG_TOOL) test-folder`;${FOUNDATION_HOME}/php-cs-fixer -v fix --level=all --fixers=indentation,linefeed,trailing_spaces,unused_use,return,php_closing_tag,short_tag,visibility,braces,extra_empty_lines,phpdoc_params,eof_ending,include,controls_spaces,elseif .
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
pear: .check-foundation
	@$(eval count=$(shell grep -c dir package.xml)) \
	if test $(count) -gt 1; then \
	  pear package; \
	else \
	  echo "There are no <contents> defined in package.xml"; \
	  echo "Nothing to build"; \
	fi;

info:
	@pear info $(shell $(CONFIG_TOOL) package-name)|egrep 'Version|Name|Summary|Description|-'

# On root PEAR installarions, this need to run as sudo
install: .check-foundation
	@if ! test -f package.xml; then \
	  echo "No package.xml found."; \
	  echo "Nothing to install"; \
	elif ! make info 2> /dev/null; then \
	  echo "You may need to run this as sudo."; \
	  echo "Discovering channel"; \
	  pear channel-info $(shell $(CONFIG_TOOL) pear-channel) || pear channel-discover $(shell $(CONFIG_TOOL) pear-channel); \
	  pear install package.xml; \
	fi;

info-php: .check-foundation
	@echo "This is what I know about your PHP."
	php --version

config-php: .check-foundation
	@echo "The location of your PHP configuration file."
	php --ini

include-php: .check-foundation
	@echo "The PHP configured include path where external packages can be found, like PEAR packages for example."
	php  -r 'echo get_include_path()."\n";'

info-pear: .check-foundation
	@echo "This is what I know about your PEAR."
	pear -V

updated-pear: .check-foundation
	@echo "Fetching possible upgrade information from all channels."
	pear list-upgrades

update-all-pear: .check-foundation
	@echo "Updating all PEAR packages if any updates are available."
	pear upgrade-all

packages-pear: .check-foundation
	@echo "The following PEAR packages are currently installed."
	pear list

locate-pear: .check-foundation
	@echo "The PEAR installed package can be found at:"
	pear config-get php_dir

verify-pear: .check-foundation
	@echo "If the following PHP script:"
	@echo "<?php"
	@echo "  require_once 'System.php';"
	@echo "  echo 'Can we include PEAR System.php? : ';"
	@echo "  var_export(class_exists('System', false));"
	@echo "?>"
	@echo ""
	@echo "Executes without any error and answers true to our question then you may safely assume that the PEAR installation is sound."
	@php -r "require_once 'System.php'; echo PHP_EOL, 'Can we include PEAR System.php? : ', var_export(class_exists('System', false), true), PHP_EOL;"

install-pear: .check-foundation
	@echo "Because we rely so extensively on a proper PEAR installation it is pertinent that PEAR is installed properly."
	@echo "Unfortunately I am not confident that I am capable, at this point, to successfully install PEAR on every system,"
	@echo "yours in particular, without making a complete mess of things."
	@echo ""
	@echo "Don't worry this is not difficult and I am sure you will succeed by following the detailed instructions at the"
	@echo "following URL: http://pear.php.net/manual/en/installation.getting.php"
	@echo ""
	@echo "Once you're done you are welcome to return so I may assist you with the installation verification process."
	@echo "You can start the verification with $ make verify"
	@echo "Good luck!"

info-check-pear: .check-foundation
	@echo "At the address: http://pear.php.net/manual/en/guide.users.commandline.packageinfo.php PEAR lists a comprehensive"
	@echo "list of instructions to execute and verify that the installation is sound."
	@echo ""

info-cs-fixer: .check-foundation
	@echo "This is what I know about your PHP Coding Standards Fixer."
	${FOUNDATION_HOME}/php-cs-fixer -V

install-cs-fixer: .check-foundation
	@echo "Attempting to download PHP Coding Standards Fixer."
	curl http://cs.sensiolabs.org/get/php-cs-fixer.phar -o ${FOUNDATION_HOME}/php-cs-fixer && chmod a+x ${FOUNDATION_HOME}/php-cs-fixer

install-travis-lint: .check-foundation
	@echo "Attempting to install travis-lint. Requires ruby gem..."
	@gem install travis-lint

travis-lint: .check-foundation
	@echo "Checking your .travis.yml"
	@travis-lint ./.travis.yml

info-composer: .check-foundation
	@echo "This is what I know about your composer."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer about 2> /dev/null || (echo "No composer installed." && false)

install-composer: .check-foundation
	@echo "Attempting to download and install composer packager."
	@curl -s http://getcomposer.org/installer | php -d detect_unicode=0
	@mv composer.phar ${FOUNDATION_HOME}/composer && chmod a+x ${FOUNDATION_HOME}/composer && exit 0

.check-composer:
	@make -f Makefile info-composer &> /dev/null || make -f Makefile install-composer &> /dev/null || (echo "Unable to install composer. Aborting..." && false)

composer-validate: .check-foundation .check-composer
	@echo "Running composer validate, be brave."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer validate -v

composer-install: .check-foundation .check-composer
	@echo "Running composer install, this will create a vendor folder and configure autoloader."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer install -v

composer-install-dev: .check-foundation .check-composer
	@echo "Running composer install --dev, this will create a vendor folder and configure autoloader."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer install -v --dev

composer-update: .check-foundation .check-composer
	@echo "Running composer update, which updates your existing installation."
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer update -v

composer-create-project: .check-foundation .check-composer
	@[[ -z "$(package)" ]] && echo -e "Usage: make composer-require package=vendor/package\n" && exit 11 || true
	@echo "Running composer create project for package: $(package)"
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer -v create-project "$(package)"

composer-require: .check-foundation .check-composer
	@[[ -z "$(package)" ]] && echo -e "Usage: make composer-require package=vendor/package\n" && exit 1 || true
	@echo "Running composer require, adding and installing as required package: $(package)"
	@/usr/bin/env PATH=$$PATH:${FOUNDATION_HOME} composer -v require "$(package)"

info-pyrus: .check-foundation
	@echo "This is what I know about your PEAR2_Pyrus."
	${FOUNDATION_HOME}/pyrus --version

install-pyrus: .check-foundation
	@echo "Attempting to download and install PEAR2_Pyrus."
	curl http://pear2.php.net/pyrus.phar -o ${FOUNDATION_HOME}/pyrus && chmod a+x ${FOUNDATION_HOME}/pyrus
	${FOUNDATION_HOME}/pyrus mypear `$(CONFIG_TOOL) vendor-folder`
	${FOUNDATION_HOME}/pyrus install PEAR2_Pyrus_Developer-alpha
	${FOUNDATION_HOME}/pyrus install PEAR2_Autoload-alpha
	${FOUNDATION_HOME}/pyrus install PEAR2_Templates_Savant-alpha

info-codesniff: .check-foundation
	@echo "This is what I know about your PHP_CodeSniffer."
	phpcs --version
	@echo "The following PHP_CodeSniffer coding standard sniffs are installed."
	phpcs -i

install-codesniff: .check-foundation
	@echo "Attempting to download and install PHP_CodeSniffer. This will likely require sudo."
	pear install --alldeps PHP_CodeSniffer
	https://github.com/elblinkin/PHPUnit-CodeSniffer.git

install-psr-sniff: .check-foundation
	@echo "Attempting to download and install PHP_CodeSniffer sniffs for PSR's. This will likely require sudo."
	@cd `$(PACKAGES_PEAR)`/PHP/CodeSniffer/Standards && git clone https://github.com/klaussilveira/phpcs-psr PSR
	@phpcs --config-set default_standard PSR

install-phpunit-sniff: .check-foundation
	@echo "Attempting to download and install PHPUnit_CodeSniffer sniffs for PHPUnit standards. This will likely require sudo."
	@cd `$(PACKAGES_PEAR)`/PHPUnit/ && git clone https://github.com/elblinkin/PHPUnit-CodeSniffer.git && cp -R PHPUnit-CodeSniffer/PHPUnitStandard ../PHP/CodeSniffer/Standards/PHPUnit

info-phpunit: .check-foundation
	@echo "This is what I know about your PHPUnit."
	@phpunit --version

install-phpunit: .check-foundation
	@echo "Attempting to download and install PHPUnit. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear channel-info pear.symfony.com > /dev/null || pear channel-discover pear.symfony.com
	@pear install --alldeps pear.phpunit.de/PHPUnit

info-phpcpd: .check-foundation
	@echo "This is what I know about your PHPcpd."
	@phpcpd --version

install-phpcpd: .check-foundation
	@echo "Attempting to download and install PHPcpd. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear install --alldeps pear.phpunit.de/phpcpd

info-phpdcd: .check-foundation
	@echo "This is what I know about your PHPdcd."
	@phpdcd --version

install-phpdcd: .check-foundation
	@echo "Attempting to download and install PHPdcd. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear install --alldeps pear.phpunit.de/phpdcd-beta

info-phploc: .check-foundation
	@echo "This is what I know about your PHPloc."
	@phploc --version

install-phploc: .check-foundation
	@echo "Attempting to download and install PHPloc. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear install --alldeps pear.phpunit.de/phploc

install-phpcov: .check-foundation
	@echo "Attempting to download and install PHPcov. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear install --alldeps pear.phpunit.de/phpcov

info-skelgen:
	@echo "This is what I know about your PHPUnit_SkeletonGenerator.\n"
	@phpunit-skelgen --version

install-skelgen: .check-foundation
	@echo "Attempting to download and install PHPUnit Skeleton Generator. This will likely require sudo."
	@pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de
	@pear channel-info components.ez.no > /dev/null || pear channel-discover components.ez.no
	@pear install --alldeps pear.phpunit.de/PHPUnit_SkeletonGenerator

info-test-helpers: .check-foundation
	@pecl info phpunit/test_helpers|egrep 'Version|Name|Summary|Description|-'

install-test-helpers:
	@if make info-test-helpers 2> /dev/null; then \
	  exit; \
	fi; \
	echo "Attempting to download and install PHPUnit Test Helpers. This will likely require sudo." \
	pear channel-info pear.phpunit.de > /dev/null || pear channel-discover pear.phpunit.de; \
	pecl install  --alldeps phpunit/test_helpers

info-phpdoc: .check-foundation
	@echo "This is what I know about your PhpDocumentor."
	@echo "The command is piped through more, press spacebar to page or q to abort."
	@pear info phpdoc/phpDocumentor-alpha

install-phpdoc: .check-foundation
	@echo "Attempting to download and install PhpDocumentor2. This will likely require sudo."
	@pear channel-info pear.phpdoc.org > /dev/null || pear channel-discover pear.phpdoc.org
	@pear install --alldeps phpdoc/phpDocumentor-alpha

info-phd: .check-foundation
	@echo "This is what I know about your PhD."
	@pear info doc.php.net/phd

install-phd: .check-foundation
	@echo "Attempting to download and install PhD. This will likely require sudo."
	@pear channel-info doc.php.net > /dev/null || pear channel-discover doc.php.net
	@pear install --alldeps doc.php.net/phd-beta

info-phpsh: .check-foundation
	@echo "This is what I know about your phpsh."
	@phpsh --version

install-phpsh: .check-foundation
	@echo "Attempting to download and install phpsh."
	git clone --progress -v https://github.com/facebook/phpsh.git ${FOUNDATION_HOME}/phpshsrc
	sudo easy_install readline
	cd ${FOUNDATION_HOME}/phpshsrc && python setup.py build && sudo python setup.py install

install-uri-template: .check-foundation
	@git clone --progress -v git://github.com/ioseb/uri-template.git ${FOUNDATION_HOME}/uri-template
	@cd ${FOUNDATION_HOME}/uri-template && phpize && ./configure && make && make test && make install
	@echo
	@echo If all went well and you saw no errors or FAILs then congratulations!
	@echo all that is left is to ensure that extension=uri_template.so is in your php.ini
	@echo

# Clean up utils

tabs2spaces:
	@printf "."
	@if test "$(file)"; then \
	  expand -t 4 "$(file)" > "$(file).tmp" && cp -f "$(file).tmp" "$(file)"; rm -f "$(file).tmp"; \
	else \
		find . -type f -name "*.php" -exec make tabs2spaces file="{}" \;; \
		echo; echo "Done converting tabs to spaces."; \
	fi;

trailing-spaces:
	@printf "."
	@if test "$(file)"; then \
	  awk '{sub(/[ \t]+$$/, "")};1' "$(file)" > "$(file).tmp" && cp -f "$(file).tmp" "$(file)"; rm -f "$(file).tmp"; \
	else \
		find . -type f -name "*.php" -exec make trailing-spaces file="{}" \;; \
		echo; echo "Done removing trailing spaces."; \
	fi;

unix-line-ends:
	@printf "."
	@if test "$(file)"; then \
	  awk '{sub(/\r$$/,"")};1' "$(file)" > "$(file).tmp" && cp -f "$(file).tmp" "$(file)"; rm -f "$(file).tmp"; \
	else \
		find . -type f -name "*.php" -exec make unix-line-ends file="{}" \;; \
		echo; echo "Done converting line endings."; \
	fi;

single-blank-lines:
	@printf "."
	@if test "$(file)"; then \
	  awk '!NF{x="\n"};NF{print x $$0;x=""};END{print EOF}' "$(file)" > "$(file).tmp" && cp -f "$(file).tmp" "$(file)"; rm -f "$(file).tmp"; \
	else \
		find . -type f -name "*.php" -exec make single-blank-lines file="{}" \;; \
		echo; echo "Done converting to single blank lines."; \
	fi;

clean-whitespace: .check-foundation
	@if test "$(file)"; then \
		make tabs2spaces file="$(file)"; \
		make unix-line-ends file="$(file)"; \
		make trailing-spaces file="$(file)"; \
		make single-blank-lines file="$(file)"; \
	else \
		make tabs2spaces; make unix-line-ends; make trailing-spaces; make single-blank-lines; \
	fi;

remove-eof-php-tag:
	@printf "."
	@if test "$(file)"; then \
	  awk '{c=c $$0 "\n"};END{sub(/\n$$/,"",c); sub(/[[:space:]]*\n\?\>[[:space:]]*$$/,"\n",c); print c}' "$(file)" > "$(file).tmp" && cp -f "$(file).tmp" "$(file)"; rm -f "$(file).tmp"; \
	else \
	        find . -type f -name "*.php" -exec make remove-eof-php-tag file="{}" \;; \
	        echo; echo "Done removing php closing tags ?> at end of file."; \
	fi;


# Install pirum, clones the PEAR Repository, make changes there and push them.
pear-push: .check-foundation
	@echo "Installing Pirum"
	@sudo pear install --soft --force pear.pirum-project.org/Pirum
	@echo "Cloning channel from git" `$(CONFIG_TOOL) pear-repository`
	-rm -Rf ${FOUNDATION_HOME}/pirum
	git clone --depth 1 `$(CONFIG_TOOL) pear-repository`.git ${FOUNDATION_HOME}/pirum
	pirum add ${FOUNDATION_HOME}/pirum `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`.tgz;pirum build ${FOUNDATION_HOME}/pirum;
	cd ${FOUNDATION_HOME}/pirum;git add .;git commit -m "Added " `$(CONFIG_TOOL) package-version`;git push

packagecommit:
	@git add package.ini package.xml composer.json
	@git commit -m "Updated package files"

# Uses other targets to complete the build
release: test package packagecommit pear pear-push tag
	@echo "Release done. Pushing to GitHub"
	@git push
	@git push --tags
	@echo "Done. " `$(CONFIG_TOOL) package-name`-`$(CONFIG_TOOL) package-version`
