[![MIT license](http://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)
[![Packagist](https://img.shields.io/packagist/v/networkteam/fusionform-altcha.svg)](https://packagist.org/packages/networkteam/fusionform-altcha)

# ALTCHA Next-Gen Captcha for Neos.Fusion.Form

Use ALTCHA Next-Gen Captcha with [Fusion Form](https://github.com/neos/fusion-form) in [Neos CMS](https://neos.io).

Inspired by [NeosRulez.Neos.Form.AltchaCaptcha](https://github.com/patriceckhart/NeosRulez.Neos.Form.AltchaCaptcha)

This package provides a Fusion Form field, which renders and the captcha. Your form will be protected when using the 
field in combination with the captcha validator. 

## Installation

Networkteam.FusionForm.Altcha is available via packagist. Run `composer require networkteam/fusionform-altcha` to install.
Internally it requires the [networkteam/flow-altcha](https://github.com/networkteam/Networkteam.Flow.Altcha) package for 
Neos Flow framework, which brings basic functionality such as ALTCHA service and captcha validator.

## Usage with Neos.Fusion.Form 

To make use of the captcha you must extend an existing Neos.Fusion.Form form by adding the captcha field 
`Networkteam.FusionForm.Altcha:Captcha` to form content. Wrap it in `Neos.Fusion.Form:FieldContainer` to make use of 
error message rendering.

Then add the captcha field with validator to schema definition:

```neosfusion
schema {
    captcha = ${Form.Schema.string().validator('Networkteam.Flow.Altcha:Captcha')}
}
```

_Example of simple contact form_

```neosfusion
prototype(Vendor.Site:Content.SingleStepFormExample) < prototype(Neos.Fusion.Form:Runtime.RuntimeForm) {

    namespace = "single_step_form_example"

    process {

        content = afx`
            <Neos.Fusion.Form:FieldContainer field.name="firstName" label="First Name">
                <Neos.Fusion.Form:Input />
            </Neos.Fusion.Form:FieldContainer>
            <Neos.Fusion.Form:FieldContainer field.name="lastName" label="Last Name">
                <Neos.Fusion.Form:Input />
            </Neos.Fusion.Form:FieldContainer>
            <Neos.Fusion.Form:FieldContainer field.name="birthDate" label="BirthDate">
                <Neos.Fusion.Form:Date />
            </Neos.Fusion.Form:FieldContainer>
            <Neos.Fusion.Form:FieldContainer field.name="message" label="Message">
                <Neos.Fusion.Form:Textfield />
            </Neos.Fusion.Form:FieldContainer>
            
            <!-- wrap captcha field by FieldContainer to make use of error message rendering -->
            <Neos.Fusion.Form:FieldContainer field.name="captcha">
                <Networkteam.FusionForm.Altcha:Captcha />
            </Neos.Fusion.Form:FieldContainer>
        `

        schema {
            firstName = ${Form.Schema.string().isRequired()}
            lastName = ${Form.Schema.string().isRequired().validator('StringLength', {minimum: 6, maximum: 12})}
            birthDate =  ${Form.Schema.date().isRequired()}
            message = ${Form.Schema.string().isRequired()}
            
            // add captha field with validator
            captcha = ${Form.Schema.string().validator('Networkteam.Flow.Altcha:Captcha')}
        }
        
        action {
            // ...
        }
    }
}
```

### Add ALTCHA JavaScript widget

The captcha field needs JavaScript for rendering the [ALTCHA widget](https://altcha.org/docs/website-integration). You
can use the fusion prototype `Networkteam.FusionForm.Altcha:Script` inside `head.javascripts` section of `Neos.Neos:Page`
or CDN as described in [ALTCHA documentation](https://altcha.org/docs/website-integration).

_Add JavaScript to head of Neos.Neos:Page_

```neosfusion
prototype(Neos.Neos:Page) {
    head {
        javascripts {
            alcha = Networkteam.FusionForm.Altcha:Script
        }
    }
}
```

Alternatively, install the NPM package [altcha](https://www.npmjs.com/package/altcha) and import it to your build process.

## Usage with Sitegeist.PaperTiger

This package ships with a content element for [Sitegeist.PaperTiger](https://github.com/sitegeist/Sitegeist.PaperTiger): 
`Networkteam.FusionForm.Altcha:PaperTiger.Field.Captcha`.

If you use Sitegeist.PaperTiger in your project, the content element is available within group `form.special` of Neos UI
content dialog.
