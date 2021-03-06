
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "subdomain"=>$subdomain,
                                "mainTitle"=>$mainTitle,
                                "placeholderMainSearch"=>$placeholderMainSearch) ); 
?>

<style>
    #sectionSearchResults{
        min-height:1000px;
        margin-left:80px;
    }
</style>
<section class="padding-top-15 margin-bottom-50 hidden" id="sectionSearchResults">
        <div class="row">
            <div class="col-md-12" id="searchResults"></div>
        </div>
</section>

<div id="mainCategories"></div>

<?php $this->renderPartial($layoutPath.'footer'); ?>

<script>
jQuery(document).ready(function() {
    initKInterface();
    initWebInterface();
    buildListCategories();
});

function initWebInterface(){
    $("#main-btn-start-search, #menu-btn-start-search").click(function(){
        var search = $("#main-search-bar").val();
        startWebSearch(search);
    });
}

function startWebSearch(search, category){
    $("#second-search-bar").val(search);
    $("#mainCategories").hide();
    $("#searchResults").html("recherche en cours. Merci de patienter quelques instants...");

    var params = {
        search:search,
        category:category
    };

    $.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/k/websearch/",
        data: params,
        //dataType: "json",
        success:
            function(html) {
                $("#searchResults").html(html);
                $("#sectionSearchResults").removeClass("hidden");
                KScrollTo("#titleWebSearch");
            },
        error:function(xhr, status, error){
            $("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    $("#searchResults").html("not found");
            }
        }
    });
}

function buildListCategories(){
    console.log(mainCategories);
    var html = "";
    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";

        html    += '<section id="portfolio" class="'+classe+'">'+
                        '<div class="container">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h2 class="text-'+params.color+'">'+
                                        'Recherche '+name+
                                    '</h2>'+
                                    '<hr class="angle-down">'+
                                '</div>'+
                            '</div>'+
                            '<div class="row text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            console.log(keyC, val);
            html +=             '<div class="col-sm-4 portfolio-item">'+
                                    '<button class="portfolio-link category-search-link" data-category="'+val.name+'">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-3x"></i>'+
                                        '<h3>'+val.name+'</h3>'+
                                    '</button>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#mainCategories").html(html);

    $(".category-search-link").click(function(){
        var cat = $(this).data("category");
        startWebSearch("", cat);
    });
}
</script>