# Neversettle Development Theme
Front-End frameworks: [Bootstrap 4](http://getbootstrap.com/), [Bootstrap 3](https://getbootstrap.com/docs/3.3/) and [ZURB Foundation](http://foundation.zurb.com/). 

## Before start development
Copy folder with child theme `wp-content/themes/ns-base-theme/!rename-child-theme` to the themes folder `wp-content/themes` and rename to the name of project.

Rename all functions, variables, theme folder, etc. to the name of the project. 
Example: project name is "Wanderlust", you have to rename "neversettle" to "wanderlust" in all files of the theme.

Don't forget to add a customer logo to the `wp-content/themes/ns-base-theme/!rename-child-theme/screenshot.png`

## Requirements

This project uses [Gulp task runner](http://gulpjs.com/) that requires [Node.js](http://nodejs.org) v6.x.x  to be installed on your machine. 
If you haven't installed Gulp CLI on your machine yet, run:

```bash
$ npm install --global gulp-cli
```

## Quickstart

### 1. Clone the repository and install with npm

```bash
$ cd my-wordpress-folder/wp-content/themes/
$ cd !rename-child-theme
$ npm install
```
### 1.2 Install necessary plugins using `npm`:
```bash
$ npm install jquery-match-height
```

Then copy needed `.js` file from `\node_modules` to `assets\src\javascript\plugins\`. Gulp will automatically add new js file to compiled `assets\dist\javascript\global.js`
If downloaded module requires css/scss or images - just add that files to `assets\src\` and include them.

### 2. Setup your gulpfile.js:

#### 2.1 Live reload
Add your local server URL, so LiveReload can refresh browser as you are working on your code :

```javascript
var URL = 'localhost/myproject'
```


### 3. Setup framework

To enable one of the pre-installed frameworks, go to theme folder, then open framework-specific folder and simply copy its contents to root theme folder:

![Framework Setup](http://i.imgur.com/dqVv2T9.gif)

Then navigate to main scss file
`assets\src\scss\style.scss`
and uncomment import command for this framework:

![Framework SCSS](http://i.imgur.com/g9saD0q.gif)

### 4. Run Gulp

While working on your project, run "watch" task from the NPM: `npm run watch`
When project is done, run `npm run production` to minify CSS, JS and remove unnecessary sourcemaps

## Overview
### 1. Folder structure

```
neversettle-theme/
├───assets
│   ├───dist
│   │   ├───css
│   │   ├───fonts
│   │   ├───images
│   │   └───javascript
│   └───src
│       ├───images
│       ├───javascript
│       │   └───plugins
│       └───scss
│           ├───components
│           ├───framework
│           ├───layouts
│           └───template-parts
├───languages
├───lib
├───template-parts
├───page-templates
└───vc_templates
```
### 2. Javascript
Write all your project's scripts to `assets\src\javascript\scripts.js`. Separate modules can be placed inside `assets\src\javascript\plugins` folder 

### 3. SCSS
All SCSS files are split into four main subfolders:

```
│       └───scss
│           ├───components
│           ├───layouts
│           └───template-parts
```

The `components` folder conains secondary styles, such as core Wordpress classes styling, forms, comments, etc. Put any small, reusable styles (buttons, etc) to `_parts.scss`.
The `layouts` folder is a place for all your page/template specific styles (header/footer, single, 404, etc). Try to avoid writing styles directly in `styles.scss`, its main purpose is to connect all your files for compilation via `@import`.
The `template-parts` folder should contain styles for reusable Wordpress template parts.

### 4. Images
Before place images to the `assets\dist\images` you should compress them. If image is `*.png` [Compress it here](https://tinypng.com/), 
if is `*.jpg` [Compress it here](https://bulkresizephotos.com/) ![Compression settings](https://i.imgur.com/Je4PBrJ.png)
### 5. PHP and `\lib` folder

The `lib` folder contains php files, connected to `functions.php`:

* `cleanup.php` - contains functions for cleaning up default Wordpress styles, scripts, etc.
* `enqueue-scripts.php` - serves for registering your styles and scripts in Wordpress
* `framework.php` - contains pre-configured menu walker, comment form and pagination with classes, specific to the framework you are using. Each framework has its own `framework.php` file.
* `jetpack.php` - handles compatibility issues if Jetpack plugin is enabled.
* `menu-areas.php` - serves for registering menu areas.
* `template-tags.php` - contains pre-configured custom template tags.
* `theme-support.php` - serves for registering theme support for languages, menus, post-thumbnails, post-formats etc. Most of them are already enabled.
* `vc_shortcodes.php` - serves for registering VisualComposer modules.
* `widget-areas.php` - serves for registering menu areas.

### 5. Workflow features

#### 5.1 Helper Classes

The theme contains javascript library, that detects type of input on site (mouse, keyboard, wheel). 
Also to body adding user browser, OS and displays their names as classes for `<body>` tag. This allows you to easily debug all device or browser-specific ussies.
Also, if sidebar is active, `<body>` will have class `has_sidebar`.

#### 5.2 Working with breakpoints

The theme have default mixin that gives you fast and easy way to interact with responsive breakpoints<br>

```scss
// Breakpoints (Example: @include breakpoint(xs) { YOUR CODE GOES HERE } )
@mixin breakpoint($point) {
  // Extra small devices (0px +)
  @if $point == xs {
    @media only screen and (min-width: 0px) and (max-width: 767px) {
      @content;
    }
  }
    // Small devices (576px - 767px)
  @else if $point == sm {
    @media only screen and (min-width: 576px) and (max-width: 767px) {
      @content;
    }
  }
    // Tablets (768px - 991px)
  @else if $point == tb {
    @media only screen and (min-width: 768px) and (max-width: 991px) {
      @content;
    }
  }
    // Medium Devices, Notebooks (992px +)
  @else if $point == md {
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
      @content;
    }
  }
    // Large Devices, Wide Screens
  @else if $point == desktop {
    @media only screen and (min-width: 1200px) {
      @content;
    }
  }
}
```

You can add breakpoints directly into css block by adding 

```scss
@include breakpoint ( /* breakpoint name */ ) { /* breakpoint-specific styles */ }
```

Example:

![Breakpoint include](http://i.imgur.com/7uIM947.gif)

Compiled result:
```css
.myfancyblock {
  width: 100%;
}
@media only screen and (min-width : 992px){
  .myfancyblock {
    width: 50%;
  }
}
```

If you are PhpStorm user, you can make this process even faster, by adding a [live template](https://www.jetbrains.com/help/phpstorm/10.0/live-templates.html). For this, go to `File > Settings > Editor > Live Templates`, add new template, then enter an abbreviation (for example, word `breakpoint`) and description. In "Template text" field add the following code:

```
@include breakpoint ( $END$ ) {}
```

Then press "Change" at the bottom and select "CSS".

Example:

![Live template](http://i.imgur.com/cgdz3SS.gif)

Now you are able to call breakpoint mixin by simply typing first few letters of its abbreviation and pressing enter:

![Live template example](http://i.imgur.com/HonCC3Y.gif)

## Test your project
* [Dummy content generator wpfill.me](http://www.wpfill.me/)
* [Set of data to test all core Wordress features (post/content formats, multilevel menus, etc)](http://wptest.io/)
* https://codex.wordpress.org/Theme_Development#Theme_Testing_Process
* https://codex.wordpress.org/Theme_Unit_Test

