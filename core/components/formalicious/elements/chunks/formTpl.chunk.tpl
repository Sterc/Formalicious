
[[!FormIt?
    &preHooks=`[[+preHooks]]`
    &hooks=`[[+hooks]]`
    &emailTo=`[[+emailto]]`
    &emailSubject=`[[+subject]]`
    &emailTpl=`@CODE:[[+description:nl2br]]<br /><br />[[+fieldsemailoutput]]`
    &redirectTo=`[[+redirectTo]]`
    &redirectParams=`[[+redirectParams]]`
    &formid=`[[+id]]`
    &validate=`[[+validation]]`
    &fieldNames=`[[+fieldNames]]`
    &formFields=`[[+formFields]]`
    &formName=`[[+formName]]`
    &fsFormTopic=`[[+fsFormTopic]]`
    &fiarToField=`field_[[+fiaremailto]]`
    &fiarTpl=`@CODE:[[+fiarcontent:nl2br]]<br /><br />[[+fieldsemailoutput]]`
    &fiarSubject=`[[+fiarsubject]]`
    &fiarFrom=`[[+fiaremailfrom]]`
    &fiarFiles=`[[+fiarattachment]]`
]]

<hr>
<form action="[[~[[*id]]? &step=`[[+currentStep]]`]]" method="POST" enctype="multipart/form-data">
    [[+form]]

    [[+currentStep:neq=`1`:then=`<a href="[[~[[*id]]]]?step=[[+currentStep:decr=`1`]]">« [[%prev]]</a>`:else=``]]
    <input type="submit" value="[[+submitTitle]]">
</form>
