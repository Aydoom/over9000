$(document).ready(function(){
// Адрес сайта
	var Home = "http://www.over9000.su/cake/";
// Поле поиска
	var Inputext = "Введите текст для поиска";
	$(".pole").focus(function(){
		var str = $(this).val();
		if(str==Inputext){
			$(this).val("");}
	});
	$(".pole").blur(function(){
		var str = $(this).val();
		str = jQuery.trim(str);
		if(str==""){
			$(this).val(Inputext);}
		else{
			$(this).val(str);}
	});
	$(".exp").click(function(){
		var str = $(this).html();
		$(".pole").val(str);
	});
// Топовое меню
	$(".menu1").click(function(){
		// Находим div.menu1->p->a#active
		var $pa = $(".menu1").children("p").has("#active");
		// Для каждого из найденного
		$pa.each(function(){
			// 
			text = $(this).children("#active").text();
			$(this).children("#active").remove();
			$(this).html(text);
		});
		$(".menu1").each(function(){
			$(this).removeClass("bg0").children().removeClass("c0").addClass("c5");
		});
		text = $(this).children("p").text();
		id = $(this).children("p").attr('id');
			el = id.split("_");
			index = el[1];
		$(this).children("p").html('<a href="'+link[index]+'" id="active" target="_self">' + text + '</a>');
		$(this).addClass("bg0").children().removeClass("c5").addClass("c0");
		if($(this).children().is("p")){
			$("#field").slideDown("slow");
			var Bid = $(this).children().attr('id');
			Aid = Bid.split("_");
			id = "menu_"  + Aid[1];
			$(".menu_p").each(function(){
				$(this).hide();
			});
			$("#" +id).show();
		}
	});
	$(".up_menu").click(function(){
		$("#field").slideUp("slow");
		var $pa = $(".menu1").children("p").has("#active");
		$pa.each(function(){
			text = $(this).children("#active").text();
			$(this).children("#active").remove();
			$(this).html(text);
		});
	});
// Работа с обзорами
	$("p.go").click(function(){
		id = $(this).attr("id");
		$(".loader").removeClass("none");
		$(".loader_f").removeClass("none");
		$.post(Home + "Ajax/",{id: id},function(data) {
			$(".loader").addClass("none");
			$(".loader_f").addClass("none");
			if(data!="default"){
				$(".block_rewiews").animate({marginLeft: "-960px"}, 1500 );
				big = data.split("%~");
				$("#r_title").html(big[1]);
				$("#r_cat").html(big[3]);
				$("#r_title").attr('href', big[4]);
					if(big[7]==""){big[7] = "Информация по данному обзору [скрыта].";}
					else{big[7]=big[7] + "...";}
				$("#r_text").html(big[7]);
				$("#r_link").html("Читать с " + big[6]);
				$("#r_link").attr('href', big[4]);
				/*$("#r_title").find("p").append(big[1]);*/
			}
		});
	});
	$("p.back").click(function(){
		$(".block_rewiews").animate({marginLeft: "0px"}, 1500 );
	});
// Описание страницы
	var hText = $(".x3211").height();
	var hBlock = $(".x321").height();
	var ht = 0;
	var hpage = 1;
	var hDesc = Math.round(hText/hBlock);
	text_pages(1);
	$("#i_next").click(function(){
		if(hpage<hDesc){
			ht -= 75;
			hpage += 1;
			$(".x3211").css("margin-top",ht + "px");}
			text_pages(hpage);
	});
	$("#i_prev").click(function(){
		if(hpage>1){
			ht += 75;
			hpage -= 1;
			$(".x3211").css("margin-top",ht + "px");}
			text_pages(hpage);
	});
	function text_pages(page){
		$(".paginateinfo").html("стр. " + page + "/" + hDesc);
	}
});