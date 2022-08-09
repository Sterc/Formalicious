(function ($, ContentBlocks) {
    ContentBlocks.fieldTypes.formalicious = function(dom, data) {
        var input = {
            fieldId: data.field,
            select: null,
            options: {}
        };

        // Do something when the input is being loaded
        input.init = function() {
            dom.addClass('contentblocks-field-loading');
            this.select = dom.find('.contentblocks-field-formalicious-select select');

            var url = MODx.config['formalicious.assets_url'] || MODx.config['assets_url'] + 'components/formalicious/';
            url += 'connector.php';
            $.ajax({
                dataType: 'json',
                url: url,
                data: {
                    action: '\\Sterc\\Formalicious\\Processors\\Mgr\\Forms\\GetList',
                    limit: 0
                },
                context: this,
                beforeSend:function(xhr, settings){
                    if(!settings.crossDomain) {
                        xhr.setRequestHeader('modAuth',MODx.siteId);
                    }
                },
                success: function(result) {
                    if (result.results) {
                        input.setOptions(result.results);
                    }
                    dom.removeClass('contentblocks-field-loading');
                }
            });
        };

        input.setOptions = function(options) {
            input.options = options;
            input.select.empty();
            $.each(input.options, function(idx, form) {
                var opt = $('<option></option>');
                opt.attr('value', form.id);
                opt.text(form.name);
                // @todo maybe add an indication if a form is not published?
                input.select.append(opt);
            });

            if (data.value) {
                input.select.val(data.value);
            }
        };

        // Get the data from this input, it has to be a simple object.
        input.getData = function() {
            return {
                value: this.select.val()
            }
        };

        // Always return the input variable.
        return input;
    }
})(vcJquery, ContentBlocks);