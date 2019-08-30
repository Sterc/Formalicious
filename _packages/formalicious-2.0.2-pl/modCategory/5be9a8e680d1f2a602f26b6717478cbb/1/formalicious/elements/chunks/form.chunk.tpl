[[!FormIt?
    [[!+FormItParameters]]
]]

<hr>
<form action="[[!+currentUrl]]" id="form-[[!+id]]" method="POST" enctype="multipart/form-data" novalidate>
    [[!+formalicious.navigation]]
    [[!+formalicious.form]]

    <div class="form-pagination">
        [[!+step:neq=`1`:then=`<a href="[[!+prevUrl]]" class="btn btn--prev" title="[[%formalicious.prev? &namespace=`formalicious` &topic=`default`]]">
            [[%formalicious.prev? &namespace=`formalicious` &topic=`default`]]
        </a>`:else=``]]
        <button type="submit" class="btn btn--next" name="[[!+submitVar]]" value="[[!+submitVar]]" title="[[!+submitTitle]]">
            [[!+submitTitle]]
        </button>
    </div>
</form>