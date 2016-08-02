# Makefile as a Deployment Tool
#
# Docs and examples:
#	http://www.gnu.org/software/make/manual/make.html
#	https://cbednarski.com/articles/makefiles-for-everyone/
#	https://github.com/njh/easyrdf/blob/master/Makefile
#

.DEFAULT: help
all: help

# TARGET:install       Install dependencies
.PHONY: install
install: install-dir install-dependencies

install-dir:
	mkdir -p assets/css
	mkdir -p assets/fonts
	mkdir -p assets/js

install-dependencies:
	@if [ -f package.json ]; then \
		npm install; \
	fi;
	@if [ -f composer.json ]; then \
		composer install; \
	fi;

# TARGET:update        Update dependencies
.PHONY: update
update: install-dir update-dependencies

update-dependencies:
	@if [ -f package.json ]; then \
		npm update; \
	fi;
	@if [ -f composer.json ]; then \
		composer update; \
	fi;

# TARGET:build         Build assets and translations
.PHONY: build
build: install-dir test build-js build-css

.PHONY: build-js
build-js:
	node_modules/.bin/uglifyjs \
		node_modules/jquery/dist/jquery.js \
		--compress --mangle --screw-ie8 --output assets/js/jquery.min.js
	node_modules/.bin/uglifyjs \
		node_modules/tether/dist/js/tether.js \
		node_modules/bootstrap/dist/js/bootstrap.js \
		src/js/*.js \
		--compress --mangle --screw-ie8 --output assets/js/bundle.min.js

.PHONY: build-css
build-css:
	node_modules/.bin/node-sass \
		src/scss/stylesheet.scss assets/css/stylesheet.css
	node_modules/.bin/postcss \
		--use autoprefixer --autoprefixer.browsers "last 2 versions" \
		--use postcss-flexbugs-fixes \
		--output assets/css/stylesheet.prefixed.css assets/css/stylesheet.css
	node_modules/.bin/uglifycss \
		assets/css/stylesheet.prefixed.css > assets/css/stylesheet.min.css

# TARGET:test          Run tests
.PHONY: test
test:
	node_modules/.bin/stylelint "src/scss/**/*.scss" --syntax scss

# TARGET:help          You're looking at it!
.PHONY: help
help:
	#
	# Usage:
	#   make <target> [OPTION=value]
	#
	# Targets:
	@egrep "^# TARGET:" [Mm]akefile | sed 's/^# TARGET:/#   /'
	#
