# MODX Formalicious
![Formalicious version](https://img.shields.io/badge/version-3.0.0-green.svg) ![MODX Extra by Sterc](https://img.shields.io/badge/checked%20by-Gauke%20and%20Roel-blue.svg) ![MODX version requirements](https://img.shields.io/badge/modx%20version%20requirement-2.4%2B-brightgreen.svg)

Formalicious is a tool for MODX content managers, which enables them to manage complex forms using a GUI, without any programming knowledge. The tool makes use of FormIt to render the forms, therefore the properties available in FormIt are used in Formalicious. For example hooks and preHooks are optional settings in Formalicious.

### Requirements ###
* MODX 2.4.0 or greater
* FormIt 4.2.2 or greater

## Snippets

**Voorbeeld snippet call:**

```
{'!FormaliciousRenderForm' | snippet : [
	'form' 	        => 3,
    'tplForm'		=> '@FILE elements/chunks/formfenom.chunk.tpl'
]}
```

### How do I get set up? ###

* Install FormIt 2.2.2 or greater with MODX installer
* Install the Formalicious package with MODX installer

To create a form:

* Go to Extras > Formalicious
* Head to the Admin panel and create a category
* Click the tab Types to add field types which can be used in the forms
* When creating a type you can provide a name, template, the possibility to add values to the field and give these values a template, FormIt validators (https://docs.modx.com/extras/revo/formit/formit.validators) and you can add an icon which is shown when choosing a field type in the manager.
* Close the categories and go to the Formalicious overview
* The tabs represent the categories and you can now create forms under these categories
* Click 'Create form' and add at least a title in the form settings
* You have to save the form settings before you can add any fields to it
* When adding fields, you can also create steps in your form to create sections in which a user can navigate with 'next' and 'previous' buttons.
* Click 'Add field' and choose a field type
* The options of the fields you add, are managed in the Admin panel > Types
* Under the Advanced tab you can add prehooks, posthooks and custom parameters just like FormIt (https://docs.modx.com/extras/revo/formit)

To show the form on a page:

* When installing the Formalicious package, a TV named 'formalicious' will be created. This TV can be assigned to a template and in the code add this for example to show the form chosen in the TV:
```html
[[!renderForm? &form=`[[!*formalicious]]`]]
```

### Options ###
System settings:

* formalicious.source: the media source id Formalicious will use
