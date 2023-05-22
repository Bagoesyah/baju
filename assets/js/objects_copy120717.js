function show_all_materials(param) {
    var material = param.material;
    var category = param.category;
    var key      = param.key;

    var id_session_text = '';
    if(material == 'body_type' || material == 'cleric' || material == 'embroidery' || material == 'option') {
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

    var changeMaterial = material == 'cleric' ? 'fabric' : material;

    var get_url = base_url + '/api/material/get_material_' + changeMaterial + '?category=' + category +'&key='+ key;

    $.ajax({
        url: get_url,
        type: "GET",
        beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
        success: function(response) {
            $("#" + category).html('');
            var checkImage = '';
            $.each(response.DATA, function(key, value) {
                if(value.THUMB == null) {
                    checkImage = value.IMAGE;
                } else {
                    checkImage = value.THUMB;
                }
                if(material == 'body_type' || material == 'cleric' || material == 'embroidery' || material == 'option') {
                    $("#" + category).append(
                        '<a href="#" class="a-material-img '+category+'-'+value.ID+'" data-id="'+value.ID+'" data-type="id_'+material+'_'+category+'">' +
                        '<img src="'+base_url+'/assets/img/upload/material_'+changeMaterial+'/'+checkImage+'" alt="'+value.TITLE+'" width="100" onclick="getsrc(this.src, \''+material+'\', false)">' +
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

    $("#" + category).on('click', '.a-material-img', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var id_material = $(this).data('id');
        var id_obj = $(this).data('obj');
        $.post(base_url + '/api/order/save_to_session', {type: type, value: id_material, id_object: id_obj}, function(response) {
            get_detail_material(base_url, material, id_material);
            var changeMaterial = material == 'cleric' ? 'fabric' : material;
            var get_url_material_by_id = base_url + '/api/material/get_material_' + changeMaterial + '/' + id_material;
            $.ajax({
                url: get_url_material_by_id,
                type: "GET",
                beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
                success: function(rgbyid) {
                    var $texture = rgbyid.DATA.IMAGE;
                    if (rgbyid.DATA.TEXTURE) {
                        $texture = rgbyid.DATA.TEXTURE;
                    }
                    $.post(base_url + '/api/order/save_to_session', {type: 'price_' + type, value: rgbyid.DATA.PRICE, skin: 'skin_' + type, src: $texture}, function(response2) {
                        get_price_material_custom();
                    });
                }
            });
        });
        // Update for sleeve purposes
        $('#' + category).find('.material-checked-img').remove();
        $(this).prepend(
            '<img src="'+base_url+'/assets/img/checked.png" class="material-checked-img">'
        );
        if (category == 'sleeve') {
            // Check if not long sleeve
            $('#cuff').find('.material-checked-img').remove();
        } else if (category == 'cuff') {
            $('#sleeve').find('.material-checked-img').remove();
        }
    });
    get_price_material_custom();
}

function getsrc(src, material, obj_name){
    $('#change_'+material).data('src', src);
    $('#change_'+material).data('material', material);
    if (obj_name) {
        $('#change_'+material).data('objname', obj_name);
    }
    $('#change_'+material).click();
}

function getClericSrc(src, material, obj_name)
{
    $("#change_cleric_" + material).data('material', material);
    $("#change_cleric_" + material).data('src', src);
    if (obj_name) {
        $("#change_cleric_" + material).data('objname', obj_name);
    }
    $("#change_cleric_" + material).click();
}

function render_objects(src_body, src_collar, src_cuff, src_button, src_button_hole, src_button_thread, src_pocket, src_front_placket, src_lower_placket, src_inner_collar, src_inner_cuff, obj_pocket, obj_collar, obj_cuff, obj_sleeve){
    var base_url = window.location.host == 'localhost' ? window.location.origin + '/karuizawa' : window.location.origin + '/karuizawa';
    var container;
    var camera, scene, renderer, controls;
    var mouseX = 0, mouseY = 0;
    var windowHalfX = document.getElementById("objcontainer").offsetWidth / 2;
    var windowHalfY = window.innerHeight / 2;

    if(src_body === undefined){
        src_body = base_url+"/assets/img/upload/default.png";
    }
    if(src_collar === undefined){
        src_collar = src_body
    }
    if(src_cuff === undefined){
        src_cuff = src_body;
    }
    if(src_button === undefined) {
        src_button = base_url+"/assets/img/upload/default.png";
    }
    if(src_button_hole === undefined){
        src_button_hole = base_url+"/assets/img/upload/default.png";
    }
    if(src_button_thread === undefined){
        src_button_thread = base_url+"/assets/img/upload/default.png";
    }
    if(src_pocket === undefined){
        src_pocket = src_body;
    }

    // Added
    if (src_front_placket === undefined) {
        src_front_placket = src_body;
    }
    if (src_lower_placket === undefined) {
        src_lower_placket = src_body;
    }
    if(src_inner_collar === undefined) {
        src_inner_collar = src_body;
    }
    if(src_inner_cuff === undefined) {
        src_inner_cuff = src_body;
    }

    init();
    animate();

    function init() {
        container = document.getElementById('objcontainer');

        // CAMERA
        //camera = new THREE.PerspectiveCamera(55, document.getElementById("objcontainer").offsetWidth / (window.innerHeight / 2), 1, 2000);
        camera = new THREE.PerspectiveCamera(48, document.getElementById("objcontainer").offsetWidth / (window.innerHeight / 1.2), 1, 2000);
        camera.position.z = 1000;

        // SCENE
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0xffffff);

        // LIGHTING
        var ambient = new THREE.AmbientLight(0x999999);
        scene.add(ambient);

        var directionalLight = new THREE.DirectionalLight(0xaaaaaa);
        directionalLight.position.set(0, 4, 4);
        scene.add(directionalLight);

        var onProgress = function (xhr) {
            if (xhr.lengthComputable) {
                var percentComplete = xhr.loaded / xhr.total * 100;
                document.getElementById('progressbar').innerHTML = Math.round(percentComplete, 2) + "%";
                //if(Math.round(percentComplete, 2) === 100){
                    //$('#progressbar').empty();
                //}
            }
        };
        var onError = function (xhr) { };

        // TEXTURES
        body = new THREE.TextureLoader().load(src_body, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });
        collar = new THREE.TextureLoader().load(src_collar, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 2, 2 );
        });
        outer_cuff = new THREE.TextureLoader().load(src_cuff, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 1, 1 );
        });

        front_placket = new THREE.TextureLoader().load(src_front_placket, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });

        lower_placket = new THREE.TextureLoader().load(src_lower_placket, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });

        inner_collar = new THREE.TextureLoader().load(src_inner_collar, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 4, 4 );
        });

        inner_cuff = new THREE.TextureLoader().load(src_inner_cuff, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 1, 1 );
        });

        // pin = new THREE.TextureLoader().load(src_button, function (texture) {
        //     texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
        //     texture.offset.set( 0, 0 );
        //     texture.repeat.set( 20, 20 );
        // });
        // sew = new THREE.TextureLoader().load(base_url+'/assets/img/upload/default.png', function (texture) {
        //     texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
        //     texture.offset.set( 0, 0 );
        //     texture.repeat.set( 20, 20 );
        // });
        pocket = new THREE.TextureLoader().load(src_pocket, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 4, 4 );
        });
        button = new THREE.TextureLoader().load(src_button, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });
        button_hole = new THREE.TextureLoader().load(src_button_hole, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });
        button_thread = new THREE.TextureLoader().load(src_button_thread, function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
            texture.offset.set( 0, 0 );
            texture.repeat.set( 20, 20 );
        });

        // MESH LAMBERT MATERIAL
        bodylambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: body});
        collarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: collar});
        // pinlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: pin});
        // sewlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: sew});
        outercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: outer_cuff});
        pocketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: pocket});
        buttonlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button});
        button_holelambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button_hole});
        button_threadlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button_thread});

        // Added
        frontplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: front_placket});
        lowerplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: lower_placket});
        innercollarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_collar});
        innercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_cuff});

        objLoader = new THREE.OBJLoader();


        // ========================================================
        // DEFAULT OBJECTS
        // ========================================================

        // BODY OBJECT LOADER
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_body.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "fabric";
            scene.add(object);

            $('#change_fabric').click(function(){
                //var init = scene.getObjectByName("fabric");
                //scene.remove(init);
            });
        }, onProgress, onError);

        // FRONT PLACKET OBJECT
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_front_placket.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = frontplacketlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "front_placket";
            scene.add(object);

            $('#change_front_placket').click(function(){
                var init = scene.getObjectByName("front_placket");
                scene.remove(init);
            });
        }, onProgress, onError);

        // LOWER PLACKET OBJECT 
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_lower_placket.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = lowerplacketlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "lower_placket";
            scene.add(object);

            $('#change_lower_placket').click(function(){
                var init = scene.getObjectByName("lower_placket");
                scene.remove(init);
            });
        }, onProgress, onError);

        // SLEEVE OBJECT LOADER
        var _defSleevePath = base_url+'/assets/plugin/threejs/files/fix/';
        var _defSleeveObj = 'fix_long_sleeve.obj';
        if (obj_sleeve !== undefined) {
            _defSleevePath = base_url+'/assets/img/upload/material_cuff/object/';
            _defSleeveObj = obj_sleeve;
        }
        objLoader.setPath(_defSleevePath);
        objLoader.load(_defSleeveObj, function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "sleeve";
            scene.add(object);

            $('#change_sleeve').click(function(){
                var init = scene.getObjectByName("sleeve");
                scene.remove(init);
            });
        }, onProgress, onError);

        // COLLAR OBJECT LOADER
        var _defCollarPath = base_url+'/assets/plugin/threejs/files/fix/';
        var _defCollarObj = 'fix_regular_collar.obj';
        if (obj_collar !== undefined) {
            _defCollarPath = base_url+'/assets/img/upload/material_collar/object/';
            _defCollarObj = obj_collar;
        }
        objLoader.setPath(_defCollarPath);
        objLoader.load(_defCollarObj, function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = collarlambert;
                    //child.material = bodylambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "collar";
            scene.add(object);
        
            $('#change_collar').click(function(){
                var init = scene.getObjectByName("collar");
                scene.remove(init);
            });
        });

        // INNER COLLAR OBJECT LOADER
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_inner_collar.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = innercollarlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "inner_collar";
            scene.add(object);

            $('#change_cleric_inner_collar').click(function(){
                //var init = scene.getObjectByName("button");
                //scene.remove(init);
            });
        });

        // OUTER CUFF OBJECT LOADER
        if (obj_sleeve === undefined) {
            var _defCuffPath = base_url+'/assets/plugin/threejs/files/fix/';
            var _defCuffObj = 'fix_outer_cuff.obj';
            objLoader.setPath(_defCuffPath);
            objLoader.load(_defCuffObj, function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = outercufflambert;
                    }
                });
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                object.name = "outer_cuff";
                scene.add(object);

                $('#change_cuff').click(function(){
                    //var init = scene.getObjectByName("cuff");
                    //scene.remove(init);
                });
            });
        }

        // INNER CUFF OBJECT LOADER
        if (obj_sleeve === undefined) {
            var _defInnerCuffPath = base_url+'/assets/plugin/threejs/files/fix/';
            var _defInnerCuffObj = 'fix_inner_cuff.obj';
            objLoader.setPath(_defInnerCuffPath);
            objLoader.load(_defInnerCuffObj, function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = innercufflambert;
                    }
                });
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                object.name = "inner_cuff";
                scene.add(object);

                $('#change_cleric_inner_cuff').click(function(){
                    //var init = scene.getObjectByName("cuff");
                    //scene.remove(init);
                });
            });
        }

        // PIN OBJECT LOADER
        // objLoader.setPath(base_url+'/assets/plugin/threejs/files/');
        // objLoader.load('pin2.obj', function (object) {
        //     object.traverse(function(child) {
        //         if (child instanceof THREE.Mesh){
        //             child.material = pinlambert;
        //         }
        //     });
        //     object.position.y = 25;
        //     object.name = "buttons";
        //     scene.add(object);

        //     $('#change_buttons').click(function(){
        //         var init = scene.getObjectByName("buttons");
        //         scene.remove(init);
        //     });
        // });

        // SEW OBJECT LOADER
        // objLoader.setPath(base_url+'/assets/plugin/threejs/files/');
        // objLoader.load('sew.obj', function (object) {
        //     object.traverse(function(child) {
        //         if (child instanceof THREE.Mesh){
        //             child.material = sewlambert;
        //         }
        //     });
        //     object.position.y = 25;
        //     scene.add(object);
        // });

        // POCKET OBJECT LOADER
        var _defPocketPath = base_url+'/assets/plugin/threejs/files/fix/';
        var _defPocketObj = 'fix_pocket.obj';
        if (obj_pocket !== undefined) {
            _defPocketPath = base_url+'/assets/img/upload/material_pocket/object/';
            _defPocketObj = obj_pocket;
        }

        objLoader.setPath(_defPocketPath);
        objLoader.load(_defPocketObj, function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = pocketlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "pocket";
            scene.add(object);

            $('#change_pocket').click(function(){
                var init = scene.getObjectByName("pocket");
                scene.remove(init);
            });
        });

        // BUTTON OBJECT LOADER
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_button.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = buttonlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "button";
            scene.add(object);

            $('#change_button').click(function(){
                //var init = scene.getObjectByName("button");
                //scene.remove(init);
            });
        });

        // BUTTON HOLE OBJECT LOADER
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_button_hole.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = button_holelambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "button_hole";
            scene.add(object);

            $('#change_button_hole').click(function(){
                //var init = scene.getObjectByName("button_hole");
                //scene.remove(init);
            });
        });

        // BUTTON THREAD OBJECT LOADER
        objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
        objLoader.load('fix_button_thread.obj', function (object) {
            object.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = button_threadlambert;
                }
            });
            object.scale.set(7, 7, 7);
            object.position.y = -850;
            object.position.x = -200;
            object.rotation.x = 67.5;
            object.name = "button_thread";
            scene.add(object);

            $('#change_button_thread').click(function(){
                //var init = scene.getObjectByName("button_thread");
                //scene.remove(init);
            });
        });


        // ========================================================
        // CHANGE OBJECTS TO SELECTED MATERIALS
        // ========================================================
        
        $('#change_fabric').click(function(){
            var imgTextureFabric = $(this).data('src');
            body = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            bodylambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: body});

            // FAbric Change
            var fabricChange = scene.getObjectByName("fabric");
            fabricChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });

            // Collar Change
            var collarChange = scene.getObjectByName("collar");
            collarChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    colar = new THREE.TextureLoader().load(imgTextureFabric, function (texture) {
                        texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                        texture.offset.set( 0, 0 );
                        texture.repeat.set( 2, 2 );
                    });
                    colarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: colar});
                    child.material = colarlambert;
                }
            });

            // Inner Collar Change
            var innerCollarChange = scene.getObjectByName("inner_collar");
            innerCollarChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    inner_colar = new THREE.TextureLoader().load(imgTextureFabric, function (texture) {
                        texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                        texture.offset.set( 0, 0 );
                        texture.repeat.set( 4, 4 );
                    });
                    innercolarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_colar});
                    child.material = innercolarlambert;
                }
            });

            // Pocket Change
            var pocketChange = scene.getObjectByName("pocket");
            pocketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    pocket = new THREE.TextureLoader().load(imgTextureFabric, function (texture) {
                        texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                        texture.offset.set( 0, 0 );
                        texture.repeat.set( 4, 4 );
                    });
                    pocketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: pocket});
                    child.material = pocketlambert;
                }
            });

            // Sleeve Change
            var sleeveChange = scene.getObjectByName("sleeve");
            sleeveChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });

            // Front Placket
            var frontPlacketChange = scene.getObjectByName("front_placket");
            frontPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });

            // Lower Placket
            var lowerPlacketChange = scene.getObjectByName("lower_placket");
            lowerPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = bodylambert;
                }
            });

            // Outer Cuff Change
            var outerCuffChange = scene.getObjectByName("outer_cuff");
            outerCuffChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    outer_cuff = new THREE.TextureLoader().load(imgTextureFabric, function (texture) {
                        texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                        texture.offset.set( 0, 0 );
                        texture.repeat.set( 1, 1 );
                    });
                    outercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: outer_cuff});
                    child.material = outercufflambert;
                }
            });

            // Inner Cuff Change
            var innerCuffChange = scene.getObjectByName("inner_cuff");
            innerCuffChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    inner_cuff = new THREE.TextureLoader().load(imgTextureFabric, function (texture) {
                        texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                        texture.offset.set( 0, 0 );
                        texture.repeat.set( 1, 1 );
                    });
                    innercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_cuff});
                    child.material = innercufflambert;
                }
            });

            // Set Image Session
            setSceneImageSession();
        });

        $('#change_sleeve').click(function() {

            /*
            objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
            objLoader.load('fix_seven_sleeve.obj', function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        //child.material = collarlambert;
                        child.material = bodylambert;
                    }
                });
                object.name = "sleeve";
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
            */

            // REMOVE CUFFS
            var innerCuffObj = scene.getObjectByName("inner_cuff");
            var outerCuffObj = scene.getObjectByName("outer_cuff");
            scene.remove(innerCuffObj);
            scene.remove(outerCuffObj);

            objLoader.setPath(base_url+'/assets/img/upload/material_cuff/object/');
            objLoader.load($(this).data('objname'), function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        //child.material = collarlambert;
                        child.material = bodylambert;
                    }
                });
                object.name = "sleeve";
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
        });

        $('#change_collar').click(function(){
            collar = new THREE.TextureLoader().load(src_collar, function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 2, 2 );
            });
            collarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: collar});
            objLoader.setPath(base_url+'/assets/img/upload/material_collar/object/');
            objLoader.load($(this).data('objname'), function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = collarlambert;
                    }
                });
                object.name = "collar";
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
        });

        $('#change_cuff').click(function(){
            /*
            cuff = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            cufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: cuff});
            */

            var sleeveObj = scene.getObjectByName("sleeve");
            scene.remove(sleeveObj);

            objLoader.setPath(base_url+'/assets/plugin/threejs/files/fix/');
            objLoader.load('fix_long_sleeve.obj', function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = bodylambert;
                    }
                });
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                object.name = "sleeve";
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);

            // OUTER CUFF OBJECT LOADER
            var _defCuffPath = base_url+'/assets/plugin/threejs/files/fix/';
            var _defCuffObj = 'fix_outer_cuff.obj';
            objLoader.setPath(_defCuffPath);
            objLoader.load(_defCuffObj, function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = outercufflambert;
                    }
                });
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                object.name = "outer_cuff";
                scene.add(object);

                // Set Image Session
                setSceneImageSession();
            });

            // INNER CUFF OBJECT LOADER
            var _defInnerCuffPath = base_url+'/assets/plugin/threejs/files/fix/';
            var _defInnerCuffObj = 'fix_inner_cuff.obj';
            objLoader.setPath(_defInnerCuffPath);
            objLoader.load(_defInnerCuffObj, function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = innercufflambert;
                    }
                });
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                object.name = "inner_cuff";
                scene.add(object);

                // Set Image Session
                setSceneImageSession();
            });
        });

        $('#change_button').click(function(){
            button = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            buttonlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button});

            // Button Change
            var buttonChange = scene.getObjectByName("button");
            buttonChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = buttonlambert;
                }
            });

            /*
            objLoader.setPath(base_url+'/assets/plugin/threejs/files/');
            objLoader.load('button.obj', function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = buttonlambert;
                    }
                });
                object.name = "button";
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
            */

            // Set Image Session
            setSceneImageSession();
        });

        $('#change_button_hole').click(function(){
            button_hole = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            button_holelambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button_hole});

            // Button Hole Change
            var buttonHoleChange = scene.getObjectByName("button_hole");
            buttonHoleChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = button_holelambert;
                }
            });

            /*
            objLoader.setPath(base_url+'/assets/plugin/threejs/files/');
            objLoader.load('button_hole.obj', function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = button_holelambert;
                    }
                });
                object.name = "button_hole";
                object.position.y = 25;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
            */
            // Set Image Session
            setSceneImageSession();
        });

        $('#change_button_thread').click(function(){
            button_thread = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            button_threadlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: button_thread});

            // Button Thread Change
            var buttonThreadChange = scene.getObjectByName("button_thread");
            buttonThreadChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = button_threadlambert;
                }
            });

            /*
            objLoader.setPath(base_url+'/assets/plugin/threejs/files/');
            objLoader.load('button_thread.obj', function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = button_threadlambert;
                    }
                });
                object.name = "button_thread";
                object.position.y = 25;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
            */
            // Set Image Session
            setSceneImageSession();
        });

        $('#change_pocket').click(function(){
            pocket = new THREE.TextureLoader().load(src_pocket, function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 4, 4 );
            });
            pocketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: pocket});
            
            objLoader.setPath(base_url+'/assets/img/upload/material_pocket/object/');
            objLoader.load($(this).data('objname'), function (object) {
                object.traverse(function(child) {
                    if (child instanceof THREE.Mesh){
                        child.material = pocketlambert;
                    }
                });
                object.name = "pocket";
                object.scale.set(7, 7, 7);
                object.position.y = -850;
                object.position.x = -200;
                object.rotation.x = 67.5;
                scene.add(object);

                // Set Image Session
                setSceneImageSession();

            }, onProgress, onError);
        });

        // CLERIC BEGIN
        $('#change_cleric_front_placket').click(function (e) {
            front_placket = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            frontplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: front_placket});

            // Front Placket Change
            var clericFrontPlacketChange = scene.getObjectByName("front_placket");
            clericFrontPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = frontplacketlambert;
                }
            });

            // Reset Lower Placket
            lower_placket = new THREE.TextureLoader().load(src_body, function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            lowerplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: lower_placket});
            $.post(base_url + '/api/order/unset_session', {type: 'skin_id_lower_placket'}, function(response) {});

            // Lower Placket Change
            var clericLowerPlacketChange = scene.getObjectByName("lower_placket");
            clericLowerPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = lowerplacketlambert;
                }
            });

            // Set Image Session
            setSceneImageSession();
        });

        $('#change_cleric_lower_placket').click(function (e) {
            lower_placket = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            lowerplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: lower_placket});

            // Lower Placket Change
            var clericLowerPlacketChange = scene.getObjectByName("lower_placket");
            clericLowerPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = lowerplacketlambert;
                }
            });

            // Reset Front Placket to current Fabric
            front_placket = new THREE.TextureLoader().load(src_body, function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 20, 20 );
            });
            frontplacketlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: front_placket});
            $.post(base_url + '/api/order/unset_session', {type: 'skin_id_front_placket'}, function(response) {});

            // Front Placket Change
            var clericFrontPlacketChange = scene.getObjectByName("front_placket");
            clericFrontPlacketChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = frontplacketlambert;
                }
            });
            // Set Image Session
            setSceneImageSession();
        });

        $('#change_cleric_collar').click(function (e) {
            collar = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 2, 2 );
            });
            collarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: collar});

            // Collar Change
            var clericCollarChange = scene.getObjectByName("collar");
            clericCollarChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = collarlambert;
                }
            });
            // Set Image Session
            setSceneImageSession();
        });

        $('#change_cleric_inner_collar').click(function() {
            inner_collar = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 4, 4 );
            });
            innercollarlambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_collar});
            // Inner Collar Change
            var clericInnerCollarChange = scene.getObjectByName("inner_collar");
            clericInnerCollarChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = innercollarlambert;
                }
            });
            // Set Image Session
            setSceneImageSession();
        });

        $('#change_cleric_cuffs').click(function (e) {
            // Outer Cuff Change
            outer_cuff = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 1, 1 );
            });
            outercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: outer_cuff});
            var outerCuffChange = scene.getObjectByName("outer_cuff");
            outerCuffChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = outercufflambert;
                }
            });

            // Set Image Session
            setSceneImageSession();
        });

        $('#change_cleric_inner_cuffs').click(function (e) {
            // Inner Cuff Change
            inner_cuff = new THREE.TextureLoader().load($(this).data('src'), function (texture) {
                texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
                texture.offset.set( 0, 0 );
                texture.repeat.set( 1, 1 );
            });
            innercufflambert = new THREE.MeshLambertMaterial({color: 0xffffff, map: inner_cuff});
            var innerCuffChange = scene.getObjectByName("inner_cuff");
            innerCuffChange.traverse(function(child) {
                if (child instanceof THREE.Mesh){
                    child.material = innercufflambert;
                }
            });

            // Set Image Session
            setSceneImageSession();
        });

        // RENDER
        renderer = new THREE.WebGLRenderer({
            antialias: true,
            preserveDrawingBuffer: true,
            canvas: document.getElementById("objcontainer")
        });
        renderer.setPixelRatio(window.devicePixelRatio);
        //renderer.setSize(document.getElementById("objcontainer").offsetWidth, window.innerHeight / 2);
        renderer.setSize(document.getElementById("objcontainer").offsetWidth, window.innerHeight / 2 + 250);
        renderer.setClearColor(0xffffff, 0);
        // container.appendChild(renderer.domElement);

        // CONTROLS
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.maxPolarAngle = Math.PI * 0.5;
        controls.minDistance = 450;
        controls.maxDistance = 950;

        window.addEventListener('resize', onWindowResize, false);
    }

    function onWindowResize() {
        windowHalfX = document.getElementById("objcontainer").offsetWidth / 2;
        windowHalfY = window.innerHeight / 2;

        camera.aspect = document.getElementById("objcontainer").offsetWidth / (window.innerHeight / 2 + 200);
        camera.updateProjectionMatrix();

        renderer.setSize(document.getElementById("objcontainer").offsetWidth, window.innerHeight / 2 + 250);
    }

    function animate() {
        requestAnimationFrame(animate);
        render();
    }

    function render() {
        camera.lookAt(scene.position);
        renderer.render(scene, camera);
    }

    function remove(name) {
        scene.remove(scene.getObjectByName(name));
    }

    function setSceneImageSession() {
        var img = '';
        setTimeout(function() {
            img = renderer.domElement.toDataURL();
            $.ajax({
                url: base_url + '/api/order/set_session_image',
                data: {
                    image: img
                },
                dataType: 'json',
                type: 'post',
                success: function (d) {}
            });
        },500);
        
    }
}