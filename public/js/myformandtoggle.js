(function( $ ) {
 
    $.fn.myFormAndToggle = function(options) {

        if(this['0'] instanceof HTMLElement && this['0'].dataset.myformindex){
            let _mft =  window.mft[this['0'].dataset.myformindex]
            return _mft
        }

        if(!window.mft){
            window.mft = []
        }

        this.each(function(){
            const form = $(this)
            let index = window.mft.length
 
            var settings = $.extend({
                // These are the defaults.
                actionSection: form.find(".myform-actions"),
                inputs: form.find('input[data-editable=true], select[data-editable=true], textarea[data-editable=true], [data-editable=true][data-delimitter]'),
                texts: form.find('[data-text=true]'),
            }, options );
    
            form.mft = {
                state: 0,
                settings: settings,
                toggle: function(state){
                    state = (state==null) ? this.state : !state
                    if(state==0)
                    {
                        //SHOW INPUT
                        settings.inputs.each(function(i){
                            
                            if($(this).attr('data-delimitter')){
                                let delimitter= $(this).attr('data-delimitter')
                                let values = this.dataset.previousvalue.split(delimitter)
                                $(this).find('input').each(function(i,e){
                                    $(e).val(values[i]).change();
                                })
                            }else{                                
                                $(this).val(this.dataset.previousvalue).change();
                            }
                            $(settings.texts[i]).text('')
                            $(this).parent().show()
                        })
    
                        settings.actionSection.find('[data-state=0]').addClass('hidden')
                        settings.actionSection.find('[data-state=1]').removeClass('hidden')
                        this.state=1
                    }
                    else{
                        //HIDE INPUT
                        settings.inputs.each(function(i){
                            $(settings.texts[i]).text(this.dataset.text)
                            $(this).parent().hide()
                        })
                        
                        settings.actionSection.find('[data-state=0]').removeClass('hidden')
                        settings.actionSection.find('[data-state=1]').addClass('hidden')
                        this.state=0
                    }
                },
                initInput: function(){
                    settings.inputs.each(function(){
                        let $elem = $(this)
                        let val=$elem.val()
                        let text
                        if($elem.is('input')){
                            val=val.replaceAll(/\s\s|\s+$/gi, '');
                            text=val
                        }else if($elem.is('select')){
                            text=$elem.find('option:selected').text()
                        }else if($elem.attr('data-delimitter')){
                            let delimitter= $elem.attr('data-delimitter')
                            val=''
                            $elem.find('input').each(function(i,e){
                                if(i==0) val+=e.value
                                else val+=(delimitter + e.value)
                            })
                            text=val
                        }
                        $elem.attr('data-previousvalue',val);
                        $elem.attr('data-text',text);
                    })
                }
            }
    
            settings.actionSection.find('button').each(function(){
                $(this).attr('data-myformindex', index);
            })
    
            form.mft.initInput()
    
            form.mft.toggle(0)
    
            window.mft.push(form.mft)
        })
 
        return this;
 
    };
 
}( jQuery ));