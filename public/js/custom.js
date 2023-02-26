const my = {
    "getDate": function () {
        var d = new Date(Date.now());
        return d.getDate() + '/' + d.getMonth() + '/' + d.getFullYear();
    },
    "inputToRupiah": function () {
        var curval = this.value.replace(/Rp|,/g, "");
        if (/^[\d.]*$/.test(curval) && curval.trim() !== '') { //is it valid float number?
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
            this.value = this.oldValue = 'Rp' + parseFloat(curval)
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
    },
    "formatRupiah": function (angka, prefix) {
        angka = angka.toString();
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp' + rupiah;
    },
    "initFormExtendedDatetimepickers": function () {
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('.timepicker').datetimepicker({
            //          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'

            }
        });

        $(".monthyearpicker").datetimepicker({
            viewMode: 'months',
            format: "MM/YYYY",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'

            }
        });
    },
    "request": {
        get: function (url) {
            return $.ajax({
                url: url,
                type: 'GET',
            });
        },
        post: function (url, data) {
            data["_token"] = window['_token']
            return $.ajax({
                url: url,
                method: 'POST',
                data: data,
            });
        },
        delete: function (url) {
            const data = {
                "_token": window['_token']
            }
            return $.ajax({
                url: url,
                method: 'DELETE',
                data: data,
            });
        },
        put: function (url, data) {
            data["_token"] = window['_token']
            return $.ajax({
                url: url,
                method: 'PUT',
                data: data,
            });
        },
        upload: function (url, formdata) {
            console.log(url)
            // return
            return $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {

                        }
                    });
                    return xhr;
                },
                url: url,
                method: 'POST',
                data: formdata,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
            });
        },
    },
    'getFormData': function ($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            var key = n['name'];
            var is_arr = false;
            if (/(\[\d+\])$/.test(key)) {
                key = key.replace(/(\[\d+\])$/, "");
                is_arr = true;
            } else if (/(\[\])$/.test(key)) {
                key = key.replace(/(\[\])$/, "");
                is_arr = true;
            }

            if (is_arr && !(key in indexed_array)) indexed_array[key] = [];
            if (typeof n['value'] === 'string') n['value'] = n['value'].trim()

            if (is_arr) {
                indexed_array[key].push(n['value']);
            } else {
                if (n['value'].length || !(key in indexed_array)) {
                    indexed_array[key] = n['value'];
                }
            }

        });

        return indexed_array;
    },
    'toggleSpesialisasi': async function(e, $wrapper, idspesialisasi=null){
        let $s = $(e.target).find('option:selected')
        let idprofesi = $s.val()
        let isparent = $s[0].dataset.isparent
        let $select = $wrapper.find('select')
        if(parseInt(isparent)){
            try {
                let url = BASEURL+"/data/getspesialisasi/"+idprofesi;
                let res = await my.request.get(url)
                let options = res.reduce(function(e,a){
                    if(idspesialisasi && a.id == idspesialisasi){
                        e += '<option value="'+a.id+'" selected>'+a.nama+'</option>'
                    }else{
                        e += '<option value="'+a.id+'" >'+a.nama+'</option>'
                    }
                    return e;
                },'<option value="" >Pilih Spesialisasi</option>');
                $select.html(options)
                $select.prop("disabled", false)
                $select.attr("required",true)  
                $select.selectpicker('refresh')
                let val = $select.data( "value" )
                console.log('val',val)
                if(val){
                    $select.val(val).change();
                }
                $wrapper.attr('hidden', false)
            } catch (error) {
                $wrapper.attr('hidden', true) 
                $select.removeAttr("required")  
                $select.prop("disabled", true)  
            }
        }else{
            $wrapper.attr('hidden', true) 
            $select.removeAttr("required")  
            $select.prop("disabled", true)
        }
    },
    "fileToBase64": async function(file){
        return new Promise(function(resolve){
            let fileReader = new FileReader();
            let base64 = "";
            fileReader.onload = function (event) {
            base64 = event.target.result;
                    resolve(base64)
            };
        
            fileReader.readAsDataURL(file);
        });
    },
    "b64toBlob": function(b64Data, contentType, sliceSize) {
            contentType = contentType || '';
            sliceSize = sliceSize || 512;

            var byteCharacters = atob(b64Data);
            var byteArrays = [];

            for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                var slice = byteCharacters.slice(offset, offset + sliceSize);

                var byteNumbers = new Array(slice.length);
                for (var i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }

                var byteArray = new Uint8Array(byteNumbers);

                byteArrays.push(byteArray);
            }

        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    },
    "fileToBase64" : async function(file){
        return new Promise(function(resolve){
            let fileReader = new FileReader();
            let base64 = "";
            fileReader.onload = function (event) {
                base64 = event.target.result;
                    resolve(base64)
            };
        
            fileReader.readAsDataURL(file);
        });
    },      
    "noMoreBigFile": async function(file){
        var name =file.name;
        var head = 'data:image/png;base64,';
        name = name.replace(/[\.]\w+$/,"").trim()+'.jpg';
        ext= name.match(/[\.]\w+$/)[0].substr(1);
        if (file && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
        {
            var converted = await this.fileToBase64(file);
            const canvas = document.createElement("CANVAS");
            const ctx = canvas.getContext('2d');

            ctx.mozImageSmoothingEnabled = true;
            ctx.webkitImageSmoothingEnabled = true;
            ctx.msImageSmoothingEnabled = true;
            ctx.imageSmoothingEnabled = true;
            
            var image = await new Promise(function(resolve,reject){
                var imageRaw = new Image();
                imageRaw.onload = function() {
                    resolve(imageRaw);
                }
                imageRaw.src = converted;
            })

            var imgFileSize=999999;

            var divider=1;
            var bot=15, top=1;
            while( Math.abs(bot-top) > 0.11 ){
                divider = (bot-top)/2+top;

                var nW = image.width/divider;
                var nH = image.height/divider;

                ctx.canvas.width = nW;
                ctx.canvas.height = nH;
                ctx.drawImage(image, 0, 0,nW,nH);
                
                converted = canvas.toDataURL("image/jpeg");
                imgFileSize = Math.round((converted.length - head.length)*3/4);

                if(imgFileSize>100000){
                    top=divider;
                }else{
                    bot=divider;
                }

            }
            let index=converted.indexOf(",");
            converted=converted.substr(index+1);
            return this.b64toBlob(converted, 'image/jpeg');

            // return new Promise(function(resolve){ canvas.toBlob(resolve); }) 
        }
        else
        {
            return false;
        }
    }
}


$(function(){
//   $( document ).ajaxStart(function() {
//     $('#modal-loading').modal('show');
//   });
  
//   $( document ).ajaxComplete(function( event, request, settings ) {
//     $('#modal-loading').modal('hide');
//   });
})