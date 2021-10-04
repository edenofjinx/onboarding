define([
        "jquery"
    ], function($){
        "use strict";
        return function(config) {
            $('document').ready(function(){
                console.log(config.message)
            });
        }
    }
)
