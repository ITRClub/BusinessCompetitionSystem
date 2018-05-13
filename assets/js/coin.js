function refreshCoin(allCoinName){
	coinCount=allCoinName.length;
	for(i=0;i<coinCount;i++){
		setCoinInfo(allCoinName[i]);
	}
}


function setCoinInfo(coinName){
	url=APP_URL+"api/transaction/getCoinInfo/"+coinName;

	$.ajax({
		url:url,
		async:false,
		type:"get",
		dataType:"json",
		error:function(e){
			console.log("e"+JSON.stringify(e));
		},
		success:function(ret){
			if(ret.code==200){
				data=ret.data;
				
				// 币种数据
				last=data.last;
				open=data.open;
				high=data.high;
				low=data.low;
				extent=(last-open)/open*100;
				extent=extent.toString();
				extent=extent.substr(0,5)+"%";
				
				$("#"+coinName+"_last").html("$"+last);
				$("#"+coinName+"_extent").html(extent);
				$("#"+coinName+"_open").html(open);
				$("#"+coinName+"_high").html(high);
				$("#"+coinName+"_low").html(low);
				
				// 波幅颜色
				if(extent.substr(0,1)=="-"){
					$("#"+coinName+"_extent").attr("class","text-red");
				}else{
					$("#"+coinName+"_extent").attr("class","text-green");
				}
				
			}
		}
	});
}
