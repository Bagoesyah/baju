/**
* @Author: Awan Tengah
* @Date:   2017-02-03T15:30:38+07:00
 * @Last modified by:   Awan Tengah
 * @Last modified time: 2017-05-03T03:44:37+07:00
*/

var base_url = window.location.host == 'localhost' ? window.location.origin + '/karuizawa' : window.location.origin + '/karuizawa';
var sub_price_custom = 0;
var app_token = 'clabskaruizawa';

$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").delay(1000).fadeOut("slow");

    $('.ready-to-wear').matchHeight();
    $('.ready-to-wear-img').matchHeight();
    $('.ready-to-wear-content').matchHeight();

    $('.new-arrival').matchHeight();
    $('.new-arrival-img').matchHeight();
    $('.new-arrival-content').matchHeight();

    $('.box-information').matchHeight();
});

$(document).ready(function() {
    $('select#sort-by-price').change(function() {
        var get_sort_by = $("select#sort-by-price").val();
        if(get_sort_by != '') {
            var params = { sort_by: get_sort_by };
            var isExistsParam = window.location.search.length;
            var current_url = window.location.href;
            var newUri = '';
            if(isExistsParam != 0) {
                if(window.location.search.match('sort_by')) {
                    newUri = current_url.replace(/(sort_by=)[^\&]+/, '$1' + get_sort_by);
                } else {
                    newUri = current_url + "&" + $.param(params);
                }
            } else {
                newUri = current_url + "?" + $.param(params);
            }
            window.location.href = base_url + '/view/ready-to-wear.html?' + newUri.split("?")[1];
        }
    });

    $('#btnSearch').click(function() {
        alert("oke");
        var key     = $("#key").val();
        if(key != '') {
            var params = { key: key };
            var isExistsParam = window.location.search.length;
            var current_url = window.location.href;
            var newUri = '';
            if(isExistsParam != 0) {
                if(window.location.search.match('key')) {
                    newUri = current_url.replace(/(key=)[^\&]+/, '$1' + key);
                } else {
                    newUri = current_url + "&" + $.param(params);
                }
            } else {
                newUri = current_url + "?" + $.param(params);
            }
            window.location.href = base_url + '/view/ready-to-wear.html?' + newUri.split("?")[1];
        }
    });

    $('a.shirt-for').click(function() {
        var shirt_for = $(this).data('val');
        if(shirt_for != '') {
            var params = { shirt: shirt_for };
            var isExistsParam = window.location.search.length;
            var current_url = window.location.href;
            var newUri = '';
            if(isExistsParam != 0) {
                if(window.location.search.match('shirt')) {
                    newUri = current_url.replace(/(shirt=)[^\&]+/, '$1' + shirt_for);
                } else {
                    newUri = current_url + "&" + $.param(params);
                }
            } else {
                newUri = current_url + "?" + $.param(params);
            }
            window.location.href = base_url + '/view/ready-to-wear.html?' + newUri.split("?")[1];
        }
    });

    $('select#sort-by-color').change(function() {
        var get_sort_by = $("select#sort-by-color").val();
        if(get_sort_by != '') {
            var params = { color: get_sort_by };
            var isExistsParam = window.location.search.length;
            var current_url = window.location.href;
            var newUri = '';
            if(isExistsParam != 0) {
                if(window.location.search.match('color')) {
                    newUri = current_url.replace(/(color=)[^\&]+/, '$1' + get_sort_by);
                } else {
                    newUri = current_url + "&" + $.param(params);
                }
            } else {
                newUri = current_url + "?" + $.param(params);
            }
            window.location.href = base_url + '/view/ready-to-wear.html?' + newUri.split("?")[1];
        }
    });

    $('select#sort-by-size').change(function() {
        var get_sort_by = $("select#sort-by-size").val();
        if(get_sort_by != '') {
            var params = { size: get_sort_by };
            var isExistsParam = window.location.search.length;
            var current_url = window.location.href;
            var newUri = '';
            if(isExistsParam != 0) {
                if(window.location.search.match('size')) {
                    newUri = current_url.replace(/(size=)[^\&]+/, '$1' + get_sort_by);
                } else {
                    newUri = current_url + "&" + $.param(params);
                }
            } else {
                newUri = current_url + "?" + $.param(params);
            }
            window.location.href = base_url + '/view/ready-to-wear.html?' + newUri.split("?")[1];
        }
    });

    /*
    $('#custom_link').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + '/custom/unset_custom_param',
            dataType: 'json',
            type: 'post',
            success: function(d) {
                window.location.href = base_url + '/custom.html';
            }
        });
    });
    */
});

// (function(window){
//
//     // get vars
//     var searchEl = document.querySelector("#search-input-div");
//     var labelEl = document.querySelector("#search-label-div");
//
//     // register clicks and toggle classes
//     labelEl.addEventListener("click",function(){
//         if (classie.has(searchEl,"focus")) {
//             classie.remove(searchEl,"focus");
//             classie.remove(labelEl,"active");
//         } else {
//             classie.add(searchEl,"focus");
//             classie.add(labelEl,"active");
//         }
//     });
//
//     // register clicks outisde search box, and toggle correct classes
//     document.addEventListener("click",function(e){
//         var clickedID = e.target.id;
//         if (clickedID != "search-input" && clickedID != "search-label") {
//             if (classie.has(searchEl,"focus")) {
//                 classie.remove(searchEl,"focus");
//                 classie.remove(labelEl,"active");
//             }
//         }
//     });
// }(window));

$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    e.preventDefault();
    var material = $(this).data('material');
    var category = $(this).data('category');

    var idcategory = $(this).data('idcategory');
    var idsubcategory = $(this).data('idsubcategory');

    var sub = $(this).data('sub');
    var cleric_type = idcategory;

    if(material == 'cleric') {
        var header = $(this).data('header');
        var param = {
            material: material,
            category: category,
            idcategory: idcategory,
            idsubcategory: idsubcategory,
            sub: sub,
            cleric_type: cleric_type
        }
        show_all_material_cleric(param);

        cleric_param = {
            id: idcategory
        }
        get_category_cleric(cleric_param);

        if(header == 'cleric') {
            $.post(base_url + '/api/order/save_to_session', {type: 'cleric_type', value: idcategory}, function(response) {
                for (var i = 1; i <= 3; i++) {
                    //$.post(base_url + '/api/order/unset_session', {type: 'id_cleric_' + i}, function(response) {});
                    //$.post(base_url + '/api/order/unset_session', {type: 'price_id_cleric_' + i}, function(response) {});
                }
            });
        }
    } else if(material == 'other' || material == 'payment') {

    } else {
        var param = {
            material: material,
            category: category,
            idcategory: idcategory,
            idsubcategory: idsubcategory
        }
        show_all_material(param);
    }
});

function show_all_material_cleric(param) {
    var material = param.material;
    var category = param.category;
    var idcategory = param.idcategory;
    var idsubcategory = param.idsubcategory;
    var sub = param.sub;
    var cleric_type = param.cleric_type;

    cleric_param = {
        id: idcategory
    }

    $.post(base_url + '/api/order/save_to_session', {type: 'cleric_type', value: cleric_type}, function(response) {});

    get_category_cleric(cleric_param);

    var id_session_text = 'id_'+material;
    var session = get_session(id_session_text);

    var get_url = base_url + '/api/material/get_material_cleric';

    var id_list_img_fabric = "#"+category+"_"+idcategory;

    $.ajax({
        url: get_url,
        type: "POST",
        beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
        data: {},
        success: function(response) {
            $('#cleric-' + idcategory + '-fabric').html('');
            if(response.STATUS == 'SUCCESS') {
                var checkImage = '';

                if (idcategory == 1) {
                    $catJs = 'collar_cuff';
                } else if (idcategory == 2) {
                    $catJs = 'collar_cuff_front_placket';
                } else if (idcategory == 3) {
                    $catJs = 'inner_collar_cuff';
                } else {
                    $catJs = 'inner_collar_cuff_lower_placket';
                }

                var $sessName = false;
                if (idcategory == 1) {
                    $sessName = get_session('skin_id_collar_cuff');
                } else if (idcategory == 2) {
                    $sessName = get_session('skin_id_collar_cuff_front_placket');
                } else if (idcategory == 3) {
                    $sessName = get_session('skin_id_inner_collar_cuff');
                } else if (idcategory == 4) {
                    $sessName = get_session('skin_id_inner_collar_cuff_lower_placket');
                }
                
                $('#cleric-' + idcategory + '-fabric').append(
                    '<a data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>None</strong><br/>" href="#" data-cid="'+idcategory+'" data-material="cleric" class="a-material-cleric-none fabric-mtl fb-tooltip">' +
                    '<img class="fabric-mtl" src="'+base_url+'/assets/img/upload/none.jpg" width="100" onclick="">' +
                    '</a>'
                );

                $.each(response.DATA, function(key, value) {
                    checkImage = value.IMAGE;
                    $('#cleric-' + idcategory + '-fabric').append(
                        '<a data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>'+value.TITLE+'</strong>" href="#" data-sub="'+idcategory+'" data-category="'+$catJs+'" class="a-material-cleric-img '+$catJs+'-'+value.ID+' fabric-mtl fb-tooltip" data-id="'+value.ID+'" data-type="id_cleric">' +
                        '<img class="fabric-mtl" src="'+base_url+'/'+value.PATH+checkImage+'" width="100" onclick="getClericSrc(this.src, \''+$catJs+'\', false)">' +
                        '</a>'
                    );
                    if(session == value.ID && $sessName) {
                        $(".a-material-cleric-img img.material-checked-img").remove();
                        $(".a-material-cleric-img."+$catJs+"-"+value.ID+"").append(
                            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                        );
                    }
                });

                if(!$sessName) {
                    $(".a-material-cleric-img img.material-checked-img").remove();
                    $(".a-material-cleric-none").append(
                        '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                    );
                }

            } else {
                $('#cleric-' + idcategory + '-fabric').html('<div class="panel panel-default"><div class="panel-body">'+response.MESSAGE+'</div></div>');
            }
            $('.fb-tooltip').tooltip();
        }
    });

    $('#cleric-' + idcategory + '-fabric').on('click', '.a-material-cleric-img', function(e) {
        e.preventDefault();

        // Check if Cuff has been set
        if (!get_session('id_cuff')) {
            $('#cr_verify').empty();
            $('#cr_verify').append('<div class="alert alert-danger"><p>You must choose a cuff selection before pick a cleric fabric.</p></div>');
            return false;
        }

        var type = $(this).data('type');
        var id_material = $(this).data('id');
        var typeCategory = $(this).data('category');
        $.post(base_url + '/api/order/save_to_session', {type: type, value: id_material}, function(response) {
            var changeMaterial = material;
            var get_url = base_url + '/api/material/get_material_cleric';
            $.ajax({
                url: get_url,
                type: "POST",
                beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
                data: {ID_CLERIC: id_material},
                success: function(rgbyid) {
                    var $texture = rgbyid.DATA.IMAGE;
                    if (rgbyid.DATA.TEXTURE) {
                        $texture = rgbyid.DATA.TEXTURE;
                    }
                    $.post(base_url + '/api/order/save_to_session', {type: 'price_' + type, value: rgbyid.DATA.PRICE, skin: 'skin_id_' + typeCategory, src: $texture}, function(response2) {
                        get_price_material_custom();
                    });
                }
            });
        });
        $(".material-checked-img").remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
    });
    get_price_material_custom();
}

function show_all_material(param) {

    var material = param.material;
    var category = param.category;

    var id_session_text = '';
    if(material == 'body_type' || material == 'embroidery' || material == 'option') {
        id_session_text = 'id_'+material+'_'+category+'';
    } else if(material == 'buttons') {
        id_session_text = 'id_'+category+'';
    } else {
        id_session_text = 'id_'+material+'';
    }
    var session = get_session(id_session_text);

    if(category == '') {
        category = material;
    }

    var changeMaterial = material;

    var get_url = base_url + '/api/material/get_material_' + changeMaterial + '?category=' + category;

    $.ajax({
        url: get_url,
        type: "GET",
        beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
        success: function(response) {
            $("#" + category).html('');
            var checkImage = '';
            if (material == 'buttons' && (category == 'button_hole' || category == 'button_thread')) {
                var addBtnState = '';
                if (session == null) {
                    var addBtnState = 'add_btn_active';
                }                
                $("#" + category).append(
                    '<div style="display:block;padding:0 0 7px 7px;margin-bottom:5px;margin-left:-7px;margin-right:-6px;border-bottom:1px solid #ccc;"><a style="display:inline-block;" href="" id="'+category+'_match_fabric" class="additional-btn '+addBtnState+'">Match Fabric Color</a></div>'
                );
            }

            if (material == 'embroidery') {
                $("#" + category).append(
                    '<a href="#" style="display:inline-block;position:relative;" class="a-material-none" data-type="id_'+material+'_'+category+'">' +
                    '<img src="'+base_url+'/assets/img/upload/none_2.jpg" alt="None" width="100" onclick="">' +
                    '</a>'
                );
                if (!get_session('id_'+material+'_'+category)) {
                    $(".a-material-img img.material-checked-img").remove();
                    $(".a-material-none").append(
                        '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                    );
                }
            }

            if (material == 'option' && (category == 'amf_stitch' || category == 'tape')) {
                $("#" + category).append(
                    '<a href="#" style="display:inline-block;position:relative;" class="a-material-none" data-type="id_'+material+'_'+category+'">' +
                    '<img src="'+base_url+'/assets/img/upload/none_2.jpg" alt="None" width="100" onclick="">' +
                    '</a>'
                );
                if (!get_session('id_'+material+'_'+category)) {
                    $(".a-material-img img.material-checked-img").remove();
                    $(".a-material-none").append(
                        '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                    );
                }
            }

            if (material == 'option' && (category == 'interlining' || category == 'sewing')) {
                $("#" + category).append(
                    '<a href="#" style="display:inline-block;position:relative;" class="a-material-none" data-type="id_'+material+'_'+category+'">' +
                    '<img src="'+base_url+'/assets/img/upload/standard_2.jpg" alt="None" width="100" onclick="">' +
                    '</a>'
                );
                if (!get_session('id_'+material+'_'+category)) {
                    $(".a-material-img img.material-checked-img").remove();
                    $(".a-material-none").append(
                        '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                    );
                }
            }

            $.each(response.DATA, function(key, value) {
                if(value.THUMB == null) {
                    checkImage = value.IMAGE;
                } else {
                    checkImage = value.THUMB;
                }
                if(material == 'body_type' || material == 'cleric' || material == 'embroidery' || material == 'option') {
                    $("#" + category).append(
                        '<a href="#" class="a-material-img '+category+'-'+value.ID+'" data-id="'+value.ID+'" data-type="id_'+material+'_'+category+'">' +
                        '<img src="'+base_url+'/assets/img/upload/material_'+changeMaterial+'/'+checkImage+'" alt="'+value.TITLE+'" width="100">' +
                        '</a>'
                    );
                } else if(material == 'buttons') {
                    var imgTexture = base_url+'/assets/img/upload/material_'+material+'/'+checkImage;
                    if (value.TEXTURE != null) imgTexture = base_url+'/assets/img/upload/material_'+material+'/'+value.TEXTURE;
                    $("#" + category).append(
                        '<a href="#" class="a-material-img '+category+'-'+value.ID+'" data-id="'+value.ID+'" data-type="id_'+category+'">' +
                        '<img data-texture="'+base_url+'/assets/img/upload/material_'+material+'/'+value.TEXTURE+'" src="'+base_url+'/assets/img/upload/material_'+material+'/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(\''+imgTexture+'\', \''+category+'\', false)">' +
                        '</a>'
                    );
                } else {
                    if (material == 'cuff' || material == 'collar' || material == 'pocket') {
                        $("#" + category).append(
                            '<a href="#" class="a-material-img '+category+'-'+value.ID+'" data-id="'+value.ID+'" data-type="id_'+material+'" data-obj="'+value.OBJECT+'">' +
                            '<img src="'+base_url+'/assets/img/upload/material_'+material+'/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(this.src, \''+material+'\', \''+value.OBJECT+'\')">' +
                            '</a>'
                        );
                    } else if(material == 'sleeve') {
                        $("#" + category).append(
                            '<a href="#" class="a-material-img '+category+'-'+value.ID+'" data-id="'+value.ID+'" data-type="id_'+material+'" data-obj="'+value.OBJECT+'">' +
                            '<img src="'+base_url+'/assets/img/upload/material_cuff/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(this.src, \'sleeve\', \''+value.OBJECT+'\')">' +
                            '</a>'
                        );
                    } else {
                        if (material == 'fabric') {
                            $("#" + category).append(
                                '<a data-toggle="tooltip" data-placement="top" data-html="true" title="<strong>'+value.TITLE+'</strong><br/>'+value.PRICE_FORMAT+'" href="#" class="fb-tooltip a-material-img '+category+'-'+value.ID+' fabric-mtl" data-id="'+value.ID+'" data-type="id_'+material+'">' +
                                '<img class="fabric-mtl" src="'+base_url+'/assets/img/upload/material_'+material+'/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(this.src, \''+material+'\', false)">' +
                                '</a>'
                            );
                        } else {
                            $("#" + category).append(
                                '<a href="#" class="a-material-img '+category+'-'+value.ID+' '+ fabricClass +'" data-id="'+value.ID+'" data-type="id_'+material+'">' +
                                '<img class="'+fabricClass+'" src="'+base_url+'/assets/img/upload/material_'+material+'/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(this.src, \''+material+'\', false)">' +
                                '</a>'
                            );
                        }
                    }
                }
                if(session == value.ID) {
                    $("div#" + category + " .a-material-img img.material-checked-img").remove();
                    $("div#" + category + " .a-material-img."+category+"-"+value.ID+"").append(
                        '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
                    );
                }
                $('.fb-tooltip').tooltip();
            });
        }
    });

    $("#" + category).on('click','.a-material-none', function(e) {
        e.preventDefault();
        $(".material-checked-img").remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
        var materialType = $(this).data('type');
        if (materialType == 'id_embroidery_position') {
            $.get(base_url + '/api/material/reset_material_selection/embroidery_position', {}, function(response) {});
        } else if (materialType == 'id_embroidery_color') {
            $.get(base_url + '/api/material/reset_material_selection/embroidery_color', {}, function(response) {});
        } else if (materialType == 'id_embroidery_font') {
            $.get(base_url + '/api/material/reset_material_selection/embroidery_font', {}, function(response) {});
        } else if (materialType == 'id_option_amf_stitch') {
            $.get(base_url + '/api/material/reset_material_selection/option_amf_stitch', {}, function(response) {});
        } else if (materialType == 'id_option_tape') {
            $.get(base_url + '/api/material/reset_material_selection/option_tape', {}, function(response) {});
        } else if (materialType == 'id_option_interlining') {
            $.get(base_url + '/api/material/reset_material_selection/option_interlining', {}, function(response) {});
        } else if (materialType == 'id_option_sewing') {
            $.get(base_url + '/api/material/reset_material_selection/option_sewing', {}, function(response) {});
        }
        setTimeout(function () {
            get_price_material_custom();
        },100);
    });

    $("#" + category).on('click', '.a-material-img', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var id_material = $(this).data('id');
        var id_obj = $(this).data('obj');
        $.post(base_url + '/api/order/save_to_session', {type: type, value: id_material, id_object: id_obj}, function(response) {
            get_detail_material(base_url, material, id_material);
            var changeMaterial = material;
            var get_url_material_by_id = base_url + '/api/material/get_material_' + changeMaterial + '/' + id_material;
            $.ajax({
                url: get_url_material_by_id,
                type: "GET",
                beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
                success: function(rgbyid) {
                    var $texture = rgbyid.DATA.IMAGE;
                    if (rgbyid.DATA.TEXTURE != null) {
                        $texture = rgbyid.DATA.TEXTURE;
                    }
                    $.post(base_url + '/api/order/save_to_session', {type: 'price_' + type, value: rgbyid.DATA.PRICE, skin: 'skin_' + type, src: $texture}, function(response2) {
                        get_price_material_custom();
                    });
                }
            });
        });
        $(".material-checked-img").remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
    });
    get_price_material_custom();
}

$(document).ready(function() {
    $(".a-material-img").click(function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var id_material = $(this).data('id');
        $.post(base_url + '/api/order/save_to_session', {type: type, value: id_material}, function(response) {
            get_detail_material(base_url, 'fabric', id_material);
        });
        $(".material-checked-img").remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
    });
    $(".a-material-cleric-img").click(function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var id_material = $(this).data('id');
        $.post(base_url + '/api/order/save_to_session', {type: type, value: id_material}, function(response) {});
        $(".material-checked-img").remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
    });
});

function get_detail_material(base_url, material, id_material) {
    // $.ajax({
    //     url: base_url + '/api/material/get_material_'+material+'/' + id_material,
    //     type: "GET",
    //     beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
    //     success: function(response) {
    //         $("#fcd-" + material).html('');
    //         $("#fcd-" + material).append(
    //             '<ul class="list-unstyled">' +
    //             '<li><strong>Colors and patterns:</strong> '+response.DATA.COLOR_PATTERN+'</li>' +
    //             '<li><strong>Mixing ratio:</strong> '+response.DATA.MIXING_RATIO+'</li>' +
    //             '<li><strong>Origin:</strong> '+response.DATA.ORIGIN+'</li>' +
    //             '<ul>'
    //         );
    //     }
    // });
}

var session_value = null;
var price_value = 0;

function get_session(name) {
    $.ajax({
        url: base_url + '/api/order/get_session/' + name,
        type: 'get',
        async: false,
        success: function(data) {
            session_value = data;
        }
    });
    return session_value;
}

function get_price_material_custom() {
    $("#sub_price_fabric").html('');
    $.ajax({
        url: base_url + '/api/order/get_sum_price_material_custom',
        type: 'get',
        async: false,
        success: function(data) {
            $("#sub_price_fabric").append(
                data
            );
        }
    });
}

function view_detail_order_custom_history(id_custom_product, template, getclass) {
    $.ajax({
        url: base_url + '/api/order/get_detail_order_custom_history',
        type: 'post',
        beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
        data: {ID_CUSTOM_PRODUCT: id_custom_product, TEMPLATE: template},
        success: function(data) {
            $('.view_custom_collapse').html('');
            $('.' + getclass).html(data.DATA);
        }
    });
}

function already_received_product(order_number) {
    $.ajax({
        url: base_url + '/dashboard/order_status/already_received_product',
        type: 'post',
        data: {ORDER_NUMBER: order_number},
        success: function(data) {
            if(data != false) {
                $('.side-order-detail').html('');
                $('.side-order-detail').html(data);
            }
        }
    });
}

function get_combobox_value(api_funct, session_name, val) {
    $.post(base_url + '/api/order/save_to_session', {type: session_name, value: val}, function(response) {
        $.ajax({
            url: base_url + '/api/material/' + api_funct + '/' + val,
            type: "GET",
            beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
            success: function(rgbyid) {
                $.post(base_url + '/api/order/save_to_session', {type: 'price_' + session_name, value: rgbyid.DATA.PRICE}, function(response2) {
                    get_price_material_custom();
                });
            }
        });
    });
}

function get_value_by_name(session_name, val) {
    $.post(base_url + '/api/order/save_to_session', {type: session_name, value: val}, function(response) {});
}

function get_category_cleric(param) {
    var id = param.id;
    $.ajax({
        url: base_url + '/api/material/get_material_cleric_category',
        type: 'POST',
        beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
        data: {ID_CATEGORY: id},
        success: function(response) {
            if(response.STATUS == 'SUCCESS') {
                $('.category-cleric-img').html('');
                $('.category-cleric-img').html(
                    '<img src="'+base_url+'/'+response.DATA.PATH + response.DATA.IMAGE+'" class="img-responsive col-centered">'
                );
            } else {
                $('.category-cleric-img').html('');
            }
        }
    });
}

function get_element_by_name(name) {
    return document.getElementsByName(name)[0].value;
}

$(document).ready(function() {
    $("#list-view-chart").html('LOADING..');
    $('#size-cart-modal').on('shown.bs.modal', function (e) {
        /*
        $.ajax({
            url: base_url + '/api/product/get_master_size',
            type: "POST",
            beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
            data: {TEMPLATE_SIZE_CHART: true},
            success: function(response) {
                $("#list-view-chart").html('');
                if(response.STATUS == 'SUCCESS') {
                    $("#list-view-chart").append(
                        response.DATA
                    );
                } else {
                    $("#list-view-chart").html('<tr><td colspan="3">'+response.MESSAGE+'</td></tr>');
                }
            }
        });
        */
        $("#list-view-chart").html('');
        $.ajax({
            url: base_url + '/api/product/get_size_chart',
            type: "POST",
            beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
            data: {
                around_neck: $('#around_neck').val()
            },
            success: function(response) {
                if(response.STATUS == 'SUCCESS') {
                    $("#list-view-chart").append(
                        response.DATA
                    );
                } else {
                    $("#list-view-chart").html('<tr><td colspan="3">'+response.MESSAGE+'</td></tr>');
                }
            }
        });
    });

    $('#size-cart-modal').on('hidden.bs.modal', function() {
        $("#list-view-chart").html('LOADING..');
    });

    $('#collapseDetailSizeAdjustment').on('shown.bs.collapse', function () {
        $('a.link-collapse-size-adjustment span').html('<i class="ion-android-arrow-dropup-circle"></i> Hide detailed size adjustment');
    });
    $('#collapseDetailSizeAdjustment').on('hidden.bs.collapse', function () {
        $('a.link-collapse-size-adjustment span').html('<i class="ion-android-arrow-dropdown-circle"></i> Show detailed size adjustment');
    });

    $('#goto_verify').click(function (e) {
        e.preventDefault();
        var that = $(this);
        $.ajax({
            url: base_url + '/custom/check_verify',
            data: {},
            type: 'post',
            dataType: 'json',
            success: function (d) {
                if (d.status == 200) {
                    console.log(that.src);
                    window.location.href = base_url + '/custom/verify';
                } else {
                    $('#cr_verify').empty();
                    $('.alert-flash').remove();
                    $('#cr_verify').append('<div class="alert alert-danger"><p>Cannot proceed to Verify, you must complete the order.</p></div>');
                }
            }
        });
    });
});

function size_calculation() {
    $("#btnSizeCalculation").html("<i class='ion-load-c'></i> loading");
    setTimeout(function (){

        var id_size = !isNaN(get_element_by_name('id_size')) && get_element_by_name('id_size') != '' ? get_element_by_name('id_size') : 0;

        // MAIN SIZE
        var around_neck = $('#around_neck').val() || 0;
        var body_type = $('#select_body_type').val() || 0;
        var sleeve_type = $('#select_sleeve_type').val() || 0;
        var sleeve_length_right = $('#select_sleeve_length_right').val() || 0;
        var sleeve_length_left = $('#select_sleeve_length_left').val() || 0;

        //Dimensions
        var neck_dimensions = !isNaN(get_element_by_name('neck_dimensions')) && get_element_by_name('neck_dimensions') != '' ? get_element_by_name('neck_dimensions') : 0;
        var shoulder_dimensions = !isNaN(get_element_by_name('shoulder_dimensions')) && get_element_by_name('shoulder_dimensions') != '' ? get_element_by_name('shoulder_dimensions') : 0;
        var chest_dimensions = !isNaN(get_element_by_name('chest_dimensions')) && get_element_by_name('chest_dimensions') != '' ? get_element_by_name('chest_dimensions') : 0;
        var waist_dimensions = !isNaN(get_element_by_name('waist_dimensions')) && get_element_by_name('waist_dimensions') != '' ? get_element_by_name('waist_dimensions') : 0;
        var hip_dimensions = !isNaN(get_element_by_name('hip_dimensions')) && get_element_by_name('hip_dimensions') != '' ? get_element_by_name('hip_dimensions') : 0;
        var arm_hole_dimensions = !isNaN(get_element_by_name('arm_hole_dimensions')) && get_element_by_name('arm_hole_dimensions') != '' ? get_element_by_name('arm_hole_dimensions') : 0;
        var back_length_88_dimensions = !isNaN(get_element_by_name('back_length_88_dimensions')) && get_element_by_name('back_length_88_dimensions') != '' ? get_element_by_name('back_length_88_dimensions') : 0;
        var back_length_89_dimensions = !isNaN(get_element_by_name('back_length_89_dimensions')) && get_element_by_name('back_length_89_dimensions') != '' ? get_element_by_name('back_length_89_dimensions') : 0;
        
        if (parseInt(sleeve_length_right) < 89) {
            back_length_89_dimensions = 0;
        }

        var aloha_88_dimensions = !isNaN(get_element_by_name('aloha_88_dimensions')) && get_element_by_name('aloha_88_dimensions') != '' ? get_element_by_name('aloha_88_dimensions') : 0;
        var aloha_89_dimensions = !isNaN(get_element_by_name('aloha_89_dimensions')) && get_element_by_name('aloha_89_dimensions') != '' ? get_element_by_name('aloha_89_dimensions') : 0;
        
        if (parseInt(sleeve_length_right) < 89) {
            aloha_89_dimensions = 0;
        }

        var cuffs_circle_dimensions = !isNaN(get_element_by_name('cuffs_circle_dimensions')) && get_element_by_name('cuffs_circle_dimensions') != '' ? get_element_by_name('cuffs_circle_dimensions') : 0;
        var short_sleeve_dimensions = !isNaN(get_element_by_name('short_sleeve_dimensions')) && get_element_by_name('short_sleeve_dimensions') != '' ? get_element_by_name('short_sleeve_dimensions') : 0;
        var sleeve_circle_dimensions = !isNaN(get_element_by_name('sleeve_circle_dimensions')) && get_element_by_name('sleeve_circle_dimensions') != '' ? get_element_by_name('sleeve_circle_dimensions') : 0;

        //Correction
        var neck_correction = !isNaN(get_element_by_name('neck_correction')) && get_element_by_name('neck_correction') != '' ? get_element_by_name('neck_correction') : 0;
        var shoulder_correction = !isNaN(get_element_by_name('shoulder_correction')) && get_element_by_name('shoulder_correction') != '' ? get_element_by_name('shoulder_correction') : 0;
        var chest_correction = !isNaN(get_element_by_name('chest_correction')) && get_element_by_name('chest_correction') != '' ? get_element_by_name('chest_correction') : 0;
        var waist_correction = !isNaN(get_element_by_name('waist_correction')) && get_element_by_name('waist_correction') != '' ? get_element_by_name('waist_correction') : 0;
        var hip_correction = !isNaN(get_element_by_name('hip_correction')) && get_element_by_name('hip_correction') != '' ? get_element_by_name('hip_correction') : 0;
        var arm_hole_correction = !isNaN(get_element_by_name('arm_hole_correction')) && get_element_by_name('arm_hole_correction') != '' ? get_element_by_name('arm_hole_correction') : 0;
        var back_length_88_correction = !isNaN(get_element_by_name('back_length_88_correction')) && get_element_by_name('back_length_88_correction') != '' ? get_element_by_name('back_length_88_correction') : 0;
        var back_length_89_correction = !isNaN(get_element_by_name('back_length_89_correction')) && get_element_by_name('back_length_89_correction') != '' ? get_element_by_name('back_length_89_correction') : 0;
        var aloha_88_correction = !isNaN(get_element_by_name('aloha_88_correction')) && get_element_by_name('aloha_88_correction') != '' ? get_element_by_name('aloha_88_correction') : 0;
        var aloha_89_correction = !isNaN(get_element_by_name('aloha_89_correction')) && get_element_by_name('aloha_89_correction') != '' ? get_element_by_name('aloha_89_correction') : 0;
        var cuffs_circle_correction = !isNaN(get_element_by_name('cuffs_circle_correction')) && get_element_by_name('cuffs_circle_correction') != '' ? get_element_by_name('cuffs_circle_correction') : 0;
        var short_sleeve_correction = !isNaN(get_element_by_name('short_sleeve_correction')) && get_element_by_name('short_sleeve_correction') != '' ? get_element_by_name('short_sleeve_correction') : 0;
        var sleeve_circle_correction = !isNaN(get_element_by_name('sleeve_circle_correction')) && get_element_by_name('sleeve_circle_correction') != '' ? get_element_by_name('sleeve_circle_correction') : 0;

        //sum size
        var sum_neck = parseInt(neck_dimensions) + parseInt(neck_correction);
        var sum_shoulder = parseInt(shoulder_dimensions) + parseInt(shoulder_correction);
        var sum_chest = parseInt(chest_dimensions) + parseInt(chest_correction);
        var sum_waist = parseInt(waist_dimensions) + parseInt(waist_correction);
        var sum_hip = parseInt(hip_dimensions) + parseInt(hip_correction);
        var sum_arm_hole = parseInt(arm_hole_dimensions) + parseInt(arm_hole_correction);
        var sum_back_length_88 = parseInt(back_length_88_dimensions) + parseInt(back_length_88_correction);
        var sum_back_length_89 = parseInt(back_length_89_dimensions) + parseInt(back_length_89_correction);
        var sum_aloha_88 = parseInt(aloha_88_dimensions) + parseInt(aloha_88_correction);
        var sum_aloha_89 = parseInt(aloha_89_dimensions) + parseInt(aloha_89_correction);
        var sum_cuffs_circle = parseInt(cuffs_circle_dimensions) + parseInt(cuffs_circle_correction);
        var sum_short_sleeve = parseInt(short_sleeve_dimensions) + parseInt(short_sleeve_correction);
        var sum_sleeve_circle = parseInt(sleeve_circle_dimensions) + parseInt(sleeve_circle_correction);

        //Product upsize
        $('input[name="neck_product_upsize"]').val(sum_neck);
        $('input[name="shoulder_product_upsize"]').val(sum_shoulder);
        $('input[name="chest_product_upsize"]').val(sum_chest);
        $('input[name="waist_product_upsize"]').val(sum_waist);
        $('input[name="hip_product_upsize"]').val(sum_hip);
        $('input[name="arm_hole_product_upsize"]').val(sum_arm_hole);
        $('input[name="back_length_88_product_upsize"]').val(sum_back_length_88);
        $('input[name="back_length_89_product_upsize"]').val(sum_back_length_89);
        $('input[name="aloha_88_product_upsize"]').val(sum_aloha_88);
        $('input[name="aloha_89_product_upsize"]').val(sum_aloha_89);
        $('input[name="cuffs_circle_product_upsize"]').val(sum_cuffs_circle);
        $('input[name="short_sleeve_product_upsize"]').val(sum_short_sleeve);
        $('input[name="sleeve_circle_product_upsize"]').val(sum_sleeve_circle);

        var set_session = [
            // MAIN SIZE
            ['around_neck_selection', around_neck],
            ['body_type_selection', body_type],
            ['sleeve_type_selection', sleeve_type],
            ['sleeve_length_right_selection', sleeve_length_right],
            ['sleeve_length_left_selection', sleeve_length_left],

            // Upsize
            ['id_size', id_size],
            ['neck_product_upsize', sum_neck],
            ['shoulder_product_upsize', sum_shoulder],
            ['chest_product_upsize', sum_chest],
            ['waist_product_upsize', sum_waist],
            ['hip_product_upsize', sum_hip],
            ['arm_hole_product_upsize', sum_arm_hole],
            ['back_length_88_product_upsize', sum_back_length_88],
            ['back_length_89_product_upsize', sum_back_length_89],
            ['aloha_88_product_upsize', sum_aloha_88],
            ['aloha_89_product_upsize', sum_aloha_89],
            ['cuffs_circle_product_upsize', sum_cuffs_circle],
            ['short_sleeve_product_upsize', sum_short_sleeve],
            ['sleeve_circle_product_upsize', sum_sleeve_circle],

            // Correction
            ['neck_correction', neck_correction],
            ['shoulder_correction', shoulder_correction],
            ['chest_correction', chest_correction],
            ['waist_correction', waist_correction],
            ['hip_correction', hip_correction],
            ['arm_hole_correction', arm_hole_correction],
            ['back_length_88_correction', back_length_88_correction],
            ['back_length_89_correction', back_length_89_correction],
            ['aloha_88_correction', aloha_88_correction],
            ['cuffs_circle_correction', cuffs_circle_correction],
            ['short_sleeve_correction', short_sleeve_correction],
            ['sleeve_circle_correction', sleeve_circle_correction],
        ];

        for (var i = 0; i < set_session.length; i++) {
            $.post(base_url + '/api/order/save_to_session', {type: set_session[i][0], value: set_session[i][1]}, function(response) {});
        }
        $("#btnSizeCalculation").html("Size calculation");
    }, 1000);
}
