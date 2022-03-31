/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    
    var dir="http://domninpa.myjino.ru/aydoom2/gallery/over9000/";
    var MainWidth = 2; // Кол-во экранов 
    show = false; // открытое второе окно
    /* Пагинатор */
    NumPages = new Array(); // Номер текущей страницы
    query = ""; // Аякс запрос 
    search = false; // Поисковая фраза
    shadow = new Array(); // координаты облака
    searchAct = 0; // Поисковая фраза
    
    var speed = 500; // скорость анимации
    
    var TopMenuAct = "c2"; // Класс активной ссылки в топ меню
    var TopMenuPass = "c0"; // Класс пассивной ссылки в топ меню

// Порядок ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // Строим страницу
    vDisplay();

// События ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    // Работа с экраном
    $(window).resize(function(){vDisplay();});
    
    // Разделы отурытие/закрытие
    $("#link_sect").click(function(){  $("#sections").toggle();  });
    $("#main,#menu_out").click(function(){  $("#sections").hide();  });
    
    // Скроллбар
    $(".scroll").slimScroll({ height: body_h +'px', wheelStep: 10 });
    
    // Движение между страницами
    // На главную
    $(".link_in_title").click(function(){cGoHome();});
    // На страницу с обзорами
    $(".nav").click(function(){
		console.log("nav - click");
        ancor = $(this).attr("ancor");
        mPostArticles(ancor);
    });
    // На страницу с обзорами из разделов
    $(".topM").click(function(){
        ancor = $(this).attr("ancor");
        cClearTopMenu("up_menu");
        $(this).removeClass(TopMenuPass).addClass(TopMenuAct);
        $("#sections").slideUp(300);
        mPostArticles(ancor);
    });
    // На страницу с обзорами из доменов
    $(".topS").click(function(){
        if(query === "") {an = new Array();an[0] = "all"; }
        else {an = query.split("/");}
        ancor = an[0] + "/" + $(this).attr("ancor");
        cClearTopMenu("suits");
        $(this).removeClass(TopMenuPass).addClass(TopMenuAct);
        $("#sections").slideUp(300);
        mPostArticles(ancor);
    });
    // Пагинатор
    $(".page").click(function(){
        ancor = $(this).attr("ancor");
        if(searchAct != 0){ mPostSearch(searchAct, ancor);}
        else{ mPostArticles(ancor);}
        
    });
    // Поиск
    $(".searchS").click(function(event){
        event.preventDefault();
        var string = $("#searchText").val();
            //alert(string);
        searchAct = string;
        mPostSearch(string,0);
    })
// Логика ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Viewer
    
    // Параметры документа
    function vDisplay(){
        // Параметры экрана
        win_w = $(document).width();
        win_h = $(document).height();
            cDelLinks();
        vBuildBody();
    }
    // Назначаем параметры тела
    function vBuildBody(){
        head_h = $("#header").height() + $("#top_article").height();
        body_h = (win_h - head_h)*0.90;
        // Тело
        var win = win_w * MainWidth;
        $("#main2").css({width: win + "px"});
        $("#main2>div").css({width: win_w + "px"});
        $("#main2>div").css({width: win_w + "px"});
        $(".slimScrollDiv")
            .css({height: body_h + "px"})
            .find("section")
            .css({height: body_h + "px"});
        
    }
// Controller
    // Изменение адреса
    function cCookie(ancor,text,page){
        key = ancor[0] + "+" + ancor[1];
        //alert(key);
        // Меняем адрес url
        if(ancor[0] === "home") history.pushState({ foo: "bar" }, "New page title", dir + "/");
        if(cat[key]!==undefined) history.pushState({ foo: "bar" }, "New page title", dir + "/section/type/" + cat[key] + "/" + ancor[2]);
        // Пишем кукки
        /*$.cookie("cat",ancor[0]);
        $.cookie("domen",ancor[1]);
        $.cookie("text",text);*/
    }
    // Удаляем ссылки
    function cDelLinks(){
            $("a").attr("href","#");
    }
    // Переход на главную страницу
    function cGoHome(){
        $("#main2").animate({
            marginLeft:"0%"},speed*2,
            function(){
                $("#articles").hide();
            }
        );
        // Заменяем адрес
        ancor = new Array("home","","");
        cCookie(ancor);
            
        cClearTopMenu();
        show = false; // Ставим якорь что окно с обзорами закрыли
    }

    // Функция окрытия страницы с обзорами
    function cArticle(data,seach){
        if(seach == "clear"){
            $("#searchText").val("");
            searchAct = 0;
        }
        
        // Анимация
        if(show){
            $(".scroll").animate({ opacity:"0"},speed,function(){
                $(".scroll").html(data);
                $(".scroll").scrollTop("0");
                $(".slimScrollBar").css({top: 0});
                // Пагинатор
                cPaginator();
                $(".scroll").animate({ opacity:"1"},speed);
            });
        }
        else{
            $(".scroll").html(data);
            $("#articles").show();
            // Пагинатор
            cPaginator();
            // Слайд
            $("#main2").animate({ marginLeft:"-100%"},speed*2);
            show = true;
        }
    }
    // Функция выведения paginator
    function cPaginator(){
        var u = 1;
        an = query.split("/");
        var key = an[0] + "/" + an[1];
        if(!NumPages[key]) NumPages[key]=1;
        if(NumPages[key]>5) u = NumPages[key]-4;
        $("ul.pages").find("a").each(function(){
            $(this).html(u);
            if(u == NumPages[key]){
                var xy = $(this).offset();
                var shad = $("#top_article").offset();
                //alert("XY = " + xy.left + ":" + xy.top + "\n" + "SHA= " + shad.left + ":" + shad.top);
                xy.left = xy.left - shad.left;
                xy.top = xy.top - shad.top;
                shadow.fix = xy;
                shadow.start = shad;
                $(".shadow").css({ left: xy.left,top: xy.top });
            } 
            $(this).attr("ancor",an[0] + "/" + an[1] + "/" + u);
            u++;
        });
    }
    // Функция очистки раздела
    function cClearTopMenu(c){
        $("ul." + c).find("a").removeClass(TopMenuAct).addClass(TopMenuPass);
        if(c==="up_menu"){
            $("ul.suits").find("a").removeClass(TopMenuAct).addClass(TopMenuPass);
            $("a.Sall").addClass(TopMenuAct);
        }
    }
// Model
    // Функция запроса для получения страниц
    function mPostArticles(ancor){
        search = false;
        an = new Array(0,0,1);
        an = ancor.split("/");// категория / домен
        // Запрос
        if(an[0]!==undefined && an[1]!==undefined){
            //alert(ancor);
            var key = an[0]+"/"+an[1];
            if(an[2] === undefined){
                if(NumPages[key] === undefined) an[2] = 1;
                else an[2] = NumPages[key];
            }
            $.post(dir + "ajax/",{cat:an[0],domen:an[1],page:an[2]},function(data){
                if(data != 0 && data!==undefined){
                    //alert(data);
                    // Запишем номер страницы
                    NumPages[key] = an[2];
                    // Сохраняем запрос
                    query = ancor;
                    // Удаляем поисковую фразу
                    search = false;
                    // Заменяем адрес
                    cCookie(an);
                    // Запускаем анимацию
                    cArticle(data,"clear");
                }
            });
        }
    }
    // Функция поискового запроса
    function mPostSearch(string,page){
        search = string;
        key = "search";
        if(search !== undefined){
            if(page === undefined){ page = 0;}
            $.post(dir + "ajax/search/",{text:search,page:page},function(data){
                if(data != 0 && data!==undefined){
                    //alert(data);
                    // Запишем номер страницы
                    NumPages[key] = page;
                    // Сохраняем запрос
                    query = "";
                    // Заменяем адрес
                    ancor[0] = "seach";
                    cCookie(ancor,string);
                    // Запускаем анимацию
                    cArticle(data);
                }
                else{
                    cArticle(" ");
                }
            });
       }
    }
});

