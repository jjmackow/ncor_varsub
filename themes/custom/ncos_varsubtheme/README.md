<!-- @file Instructions for subtheming using the LESS Vartheme Subtheme. -->
<!-- @defgroup subtheme_less -->
<!-- @ingroup subtheme -->
# LESS ncos_varsubtheme

Below are instructions on how to create a Vartheme Sub theme using a LESS
preprocessor.

- [Prerequisites](#prerequisites)
- [Additional Setup](#setup)
- [Override Styles](#styles)
- [Override Settings](#settings)
- [Override Templates and Theme Functions](#registry)

## Prerequisites
- Read the @link getting_started Getting Started @endlink documentation topic.
- You must understand the basic concept of using the [LESS] CSS pre-processor.
- You must use a **[local LESS compiler](https://www.google.com/search?q=less
  +compiler)**.
- You must use the [Bootstrap Framework Source Files] ending in the `.less`
  extension, not files ending in `.css`.

## Additional Setup {#setup}
Bootstrap library: Download and extract the **latest** 3.x.x version of
[Bootstrap Framework Source Files] into your new sub-theme. After it has been
extracted, the folder should read `./ncos_varsubtheme/bootstrap`.

Bootstrap RTL library: Download and extract the **latest** 3.x.x version of
[Bootstrap Framework Source Files for Right to left] into your new sub-theme.
After it has been extracted, the folder should read
`./ncos_varsubtheme/bootstrap-rtl`.

{.alert.alert-warning} **WARNING:** Do not modify the files inside of
`./ncos_varsubtheme/bootstrap` directly. Doing so may cause issues when 
upgrading the [Bootstrap Framework] in the future.

## Override variables.
The `./ncos_varsubtheme/less/variables.less` file is generally 
where you will the majority of your time overriding the variables provided by
the [Bootstrap Framework].

## Mixins.
The `./ncos_varsubtheme/less/mixins.less` Vartheme custom mixins.

The `./ncos_varsubtheme/less/base/bootstrap.base.less` file is nearly an exact
copy from the [Bootstrap Framework Source Files]. The only difference is that it 
injects the `variable-overrides.less` file directly after it has imported the
[Bootstrap Framework]'s `variables.less` file. This allows you to easily 
override variables without having to constantly keep up with newer or missing
variables during an upgrade.

The `./ncos_varsubtheme/less/base/vartheme.base.less` file contains various
Varbase and Vartheme overrides to properly integrate with the 
[Bootstrap Framework]. It may contain a few enhancements, feel free to edit
this file as you see fit.

The `./ncos_varsubtheme/less/base/ncos_varsubtheme.base.less` file contains
 various Varbase and Vartheme
overrides to properly integrate with the [Bootstrap Framework]. It may contain
a few enhancements, feel free to edit this file as you see fit.

Following the SMACSS-style categorization of its CSS/LESS rules:

## Base — CSS/LESS reset/normalize plus HTML element styling.
* The `./ncos_varsubtheme/less/base/bootstrap.base.less` file contains
  Bootstrap base.
* The `./ncos_varsubtheme/less/base/vartheme.base.less` file contains
  Vartheme base, which Bootstrap overrides
* The `./ncos_varsubtheme/less/base/ncos_varsubtheme.base.less` file contains
  ncos_varsubtheme base overrides over Vartheme and Bootstrap.

##Layout — macro arrangement of a web page, including any grid systems.
* The `./ncos_varsubtheme/less/layout/edge2edge.layout.less` file contains
  Vartheme Edge to Edge layout for content.

## Component — discrete, reusable UI elements.
* The `./ncos_varsubtheme/less/component/bs-callouts.component.less` file
  contains Bootstrap callouts component.
* The `./ncos_varsubtheme/less/component/outside-in.component.less` file
  contains Outside-in component.
* The `./ncos_varsubtheme/less/component/navbar.admin.component.less` file
  contains Vartheme navbar for administration.
* The `./ncos_varsubtheme/less/component/navbar.component.less` file contains
  Vartheme navbar.

## State — styles that deal with client-side changes to components.

## Theme — purely visual styling (“look-and-feel”) for a component.
* The `./ncos_varsubtheme/less/theme/header.theme.less` file contains
  ncos_varsubtheme header styling.
* The `./ncos_varsubtheme/less/theme/footer.theme.less` file contains
  ncos_varsubtheme footer styling.
* The `./ncos_varsubtheme/less/theme/content.theme.less` file contains
  ncos_varsubtheme content styling.


## Override Theme Settings {#settings}
Please refer to the @link subtheme_settings Sub-theme Settings @endlink topic.

## Override Templates and Theme Functions {#registry}
Please refer to the @link registry Theme Registry @endlink topic.

[Bootstrap Framework]: http://getbootstrap.com
[Bootstrap Framework Source Files]: https://github.com/twbs/bootstrap/releases
[LESS]: http://lesscss.org
 Generated by -- create-new-vartheme ncos_varsubtheme ltr /var/www/html-flanagan-rocks/docroot/themes/custom -- on 2019/01/15 - 12:43:06
