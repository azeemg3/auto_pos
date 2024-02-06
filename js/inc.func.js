var call_page="";
var path="";
var comm_path="";
var page="";
function call_ajax(url, form, callDiv)
{
	path=url;
	call_page="."+callDiv;
	var form="#"+form;
	var page=1;
	$("#loader").show();
	$.ajax({
			url:path+"?page="+page,
			type:"POST",
			data:$(form).serialize(),
			cache:false,
			success: function(data)
			{
				$(call_page).html(data);
				$("#loader").hide();
			}
			
	});
}
$("table").on("click", 'ul li', function(){
	page=$(this).attr("p");
	if(path!=""){
	$("#loader").show();
	}
	$.ajax({
			url:path+"?page="+page,
			type:"POST",
			data:$("#form").serialize(),
			cache:false,
			success: function(data)
			{
				$(call_page).html(data);
				$("#loader").hide();
			}
	});
});

$('li').on('click', 'li', function() {
    $('li').removeClass('active');
});
$(".clickthis").on("click", function()
{
	console.log($(this).parents("li"));
});
// create new lead
$(".createLead").on("click", function(){
	var code=$("#c_code").val();
    var mobile=$("#mobile").val();
    if(mobile=="" || mobile.length<5)
    {
        $(".empty-field").show();
		return false;
    }
   
        $.ajax({
                url:"ajax_call/createLead?mobile="+mobile+"&code="+code,
				cache:false,
                success:function(data)
                {
                   $("#primary").html(data);
				   //$("#primary").parents(".content-wrapper").find("h2").hide();
				   $(".empty-field").hide();
                }
               });
    
});


// supplier term and conditions
function s_term_c(val)
{
	$("#term-condition").modal();
	$.ajax({
		url:"lead-tabs/term-cond-proc?vendor_id="+val,
		success: function(data)
		{
			rec=data.split("~");
			$("#term-cond-head").html(rec[0]);
			$("#term-cond-det").html(rec[1]);
		}
	});
}
// empty fields 
function empty_fields(thisForm)
{
	document.getElementById(thisForm).reset();
}
//add new vendors etc
function add_acc()
{
	$("#transacc").modal({ backdrop: 'static'});
	vendor_name=$("#new-transacc input[name$='acc_name']").val();
	if(vendor_name!=""){
	$.ajax({
		url:"savetransacc",
		type:"POST",
		data:$("#new-transacc").serialize(),
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1)
			{
				alert("Operation Successfull!");
				document.getElementById("new-transacc").reset();
				$("#transacc").modal('hide');
				call_ajax("ajax_call/get_transacc", "", "get_transacc");
			}
			if(rec[0]==2){alert("Something Wrong With You!")}
			if(rec[0]==1062){alert("Account Already Exist...")}
		}
	});
	}
}
// update transaction account
function update_trans_acc(trans_acc_id)
{
	$("#transacc").modal({ backdrop: 'static'});
	$("#transacc input[name$='trans_acc_id']").val(trans_acc_id);
	$.ajax({
		url:"update_transacc?trans_acc_id="+trans_acc_id,
		dataType:"JSON",
		success: function(data)
		{
			$("#transacc select[name$='trans_acc_type']").val(data['trans_acc_type']);
			$("#transacc input[name$='trans_acc_name']").val(data['trans_acc_name']);
			$("#transacc select[name$='dr_cr']").val(data['dr_cr']);
			$("#transacc input[name$='trans_acc_address']").val(data['trans_acc_address']);
			$("#transacc input[name$='amount']").val(data['amount']);
		}
	});
}
// delete recoeds
function del_rec(root,type, id)
{
	 var x=confirm('Do you want to delete it?');
	if(!x)
	{
		return false;
	}
	$("#"+id).load(root+"del_rec?del_rec="+id+"&type="+type);
	$("#"+id).hide();
}
// read images url and display images
function readURL_img(input, id) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#'+id)
				.attr('src', e.target.result)
				.width(50)
				.height(50);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

 // load messages
function load_msg()
{
	$(".load-msg").load("ajax_call/load_message");
}
// show pending notification details
function pending_noti()
{
	$("#pending_noti").load("ajax_call/pending_noti");
}
function reminder_view(rem_id)
{
	$("#desk_rem_view").modal();
	$("#rem_det").load("ajax_call/get_reminder?rem_id="+rem_id);
	$("#rem_det").parent().children("h3").children("a").attr("href","create_reminder?id="+rem_id);
}
// create a funciton for editing
function edit_branch(edit_url, call_div, form, id)
{
	$("#"+call_div).modal({ backdrop: 'static' });
	path=edit_url+".php";
	if(id!=""){
	document.getElementById("branch").value="Update";
	}
	var form="#"+form;
	$.ajax({
			url:"ajax_call/"+path+"?page="+page+"&id="+id,
			type:"POST",
			data:$(form).serialize(),
			success: function(data)
			{
				rec=data.split("=");
				$("#id").val(rec[0]);
				$("#branch_name").val(rec[1]);
				$("#branch_location").val(rec[2]);
				document.getElementById("branch_logo").src="branch_logo/"+rec[3];
				$("#address").val(rec[4]);
				document.getElementById("sign_logo").src="branch_logo/"+rec[5];
				$("#branch_email").val(rec[6]);
				$("#phone_line").val(rec[7]);
				$("#mobile").val(rec[8]);
				$("#web").val(rec[9]);
				document.getElementById("email_header").src="branch_logo/"+rec[10];
				$("#msg_mask").val(rec[11]);
							
			}
	});
}
// Add  invoice numbers in sale reports
$("body").delegate( ".inv_no", "click", function() {
	$("#inv_no").modal({ backdrop: 'static' });
  	id=$(this).attr("data-id");
	type=$(this).attr("data-type");
	$("#inv_no input[name$='sale_id']").val(id);
	$("#inv_no input[name$='sale_type']").val(type);
});
function inv_no()
{
	id=$("#invForm input[name$='sale_id']").val();
	type=$("#invForm input[name$='sale_type']").val();
	$.ajax({
		url:"ajax_call/get_inv_no?type="+type+"&id="+id,
		type:"POST",
		data:$("#invForm").serialize(),
		success: function(data)
		{
			$("."+type+id).html(data);
			document.getElementById("invForm").reset();
			$("#inv_no").modal('hide');
		}
	});
}
function country()
{
	$.ajax({
		url:"ajax_call/get_countries",
		data:$("#cntryForm").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("country Added Successfully");
				$(".get_countries").html(data);
				document.getElementById("cntryForm").reset();
			}
		}
	});
}
function city()
{
	$("#city_modal").modal({ backdrop: 'static' });
	$.ajax({
		url:"ajax_call/get_cities",
		data:$("#new-city").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("City Added Successfully");
				$(".get_cities").html(data);
				document.getElementById("new-city").reset();
				$("#city_modal").modal('hide');
			}
		}
	});
}
// area selected
function areas()
{
	$("#area_modal").modal({ backdrop: 'static' });
	$.ajax({
		url:"ajax_call/get_areas",
		data:$("#new-area").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split("~");
			if(rec[0]==1){alert("Already Exist!"); return false;}
			else if(rec[0]==2)
			{
				alert("Area Added Successfully");
				$(".get_areas").html(data);
				document.getElementById("new-area").reset();
				$("#area_modal").modal('hide');
			}
		}
	});
}
// select cities country wise
function select_city(id)
{
	$("#city_id").load('ajax_call/citiesList?country_id='+id);
}
// update message api 
function update_msg_api(id)
{
	$("#myModal").modal();
	$.ajax({
		url:"ajax_call/get_message_api?id="+id,
		success: function(data)
		{
			$("#id").val(id);
			rec=data.split(',');
			$("#msg_mask").val(rec[1]);
			$("#api_id").val(rec[2]);
			$("#api_pswd").val(rec[3]);
			$("#myModal select[name$='branch']").val(rec[4]);
			$("#myModal .btn-change").val('Update');
		}
	});
}
/*==================Convert number in number_format========
function RemoveRougeChar(convertString){
        if(convertString.substring(0,1) == ","){
            return convertString.substring(1, convertString.length)                  
        }
        return convertString; 
    }
    
    $('input.number').on("keyup", function(e){
        var $this = $(this);
        var num = $this.val().replace(/[^0-9]+/g, '').replace(/,/gi, "").split("").reverse().join("");     
        var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
        $this.val(num2);
});*/
///////////////////////End function 
/*===============================Transaction account actions==========*/
function trans_action()
{
	$.ajax({
		url:"get_trans_action",
		data:$("#trans_acc_form").serialize(),
		type:"POST",
		success: function(data)
		{
			if(data==1)
			{
				$(".success-load").show(); $(".error-load").hide();
				document.getElementById("trans_acc_form").reset();
			}
			else if(data==2){$(".error-load").show(); $(".success-load").hide();}
		}
	});
}
// logout redirect to login page
function logout(red)
{
	window.location=red;
}

// remove added accommodation div
$(document).on('click','.remove',function() {
	var sum=0;
 	$(this).parents().closest(".parentRemove").remove();
	$(".total").each(function(){
				sum += +$(this).val();
			});
	$("#sub_total").val(sum);
	net_total=Number(sum)+Number($("#gst").val());
	$("#net_total").val(net_total);
	rec=$("#receive").val();
	$("#balance").val(Number(net_total)-Number(rec));
});
/*$(document).on('change','.qty',function() {
	var sum=0;
	$(".qty").each(function(){
				sum += +$(this).val();
			});
	$("#sub_total").val(sum);
	net_total=Number(sum)+Number($("#gst").val());
	$("#net_total").val(net_total);
	rec=$("#receive").val();
	$("#balance").val(Number(net_total)-Number(rec));
});*/
function st()
{
	var sum=0;
	$(".total").each(function(){
		sum+=Number($(this).val());		
	});
	$("#sub_total").val(sum);
	$("#net_total").val(sum);
}
$(document).on('change','.parentRemove',function() {
	var sum=0;
	g=$(this);
	$(this).each(function(){
		qty=$(this).find(".qty").val();
		rate=g.find(".rate").val();
		total=Number(rate)*Number(qty);
		g.find(".total").val(total);		
	});
	st();
});
//calculate net total with gst
$("#gst").on("keyup", function(){
	sub_total=$("#sub_total").val();
	gst=$(this).val();
	$("#net_total").val(Number(sub_total)+Number(gst));
	$("#balance").val(Number(sub_total)+Number(gst));
});
$("#receive").on("keyup", function(){
	net_total=$("#net_total").val();
	rec=$(this).val();
	$("#balance").val(net_total-rec);
});
$("#discount_per").on("keyup", function(){
	sub_total=$("#sub_total").val();
	discount=Number(sub_total)*Number($(this).val()/100);
	$("#discount").val(discount);
	$("#net_total").val(Number(sub_total)-Number(discount));
});
$("#discount").on("keyup", function(){
	sub_total=$("#sub_total").val();
	dis_per=Number(sub_total)*Number($(this).val()/100);
	dis_per=Number($(this).val()/Number(sub_total)*100);
	$("#discount_per").val(dis_per.toFixed(2));
	$("#net_total").val(Number(sub_total)-Number($(this).val()));
});
// reset form
function reset_form(formName)
{
	document.getElementById(formName).reset();
}
//open any type of modal
function openModal(modalName)
{
	$("#error").hide();
	$("#loader").hide();
	$("#"+modalName).modal({backdrop: 'static'});

}
// add and update brands etc
function add_new_brands()
{
	$("#error").hide();
	$("#loader").hide();
	$.ajax({
		url:"ajax_call/brand_action",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split('~');
			if(rec[0]==1)
			{
				$("#succ").show();
				$("#error").hide();
				$(".get_brands").html(rec[1]);
				document.getElementById("form").reset();
			}
			if(rec[0]==1062)
			{
				$("#error").show();
				$("#succ").hide();
			}
		}
	});

}
// edit brands 
function edit_brnads(id)
{
	$("#error").hide();
	$("#succ").hide();
	$("#brand").modal({backdrop: 'static'});
	$("#brand").find("button").last().text('Update');
	$.ajax({
		url:"edits/edit_brand?brand_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#brand input[name$='brand_id']").val(data.brand_id);
			$("#brand input[name$='brand_name']").val(data.brand_name);
		}
	});
}
//add update products etc
function add_products(formData)
{
	$.ajax({
		url:"ajax_call/product_action",
		data:$("#"+formData).serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split('~');
			if(rec[0]==1)
			{
				alert("Operation Successfully...");
				$(".get_products").html(rec[1]);
				document.getElementById(formData).reset();
				$("#product").modal('hide');
			}
			if(rec[0]==1062)
			{
				alert("Already Exist");
			}
		}
	});
}
// edit products 
function edit_products(id)
{
	$("#product").modal({backdrop: 'static'});
	$("#product").find("button").last().text('Update');
	$.ajax({
		url:"edits/edit_product?product_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#product input[name$='product_id']").val(data.product_id);
			$("#product input[name$='product_name']").val(data.product_name);
			$("#product select[name$='brand_id']").val(data.brand_id);
			$("#product input[name$='exp_date']").val(data.exp_date);
			$("#product input[name$='purchase_price']").val(data.purchase_price);
			$("#product input[name$='batch']").val(data.batch);
		}
	});
}
//add new accounts
function add_new_acc(formData)
{
	$.ajax({
		url:"../ajax_call/trans_acc_action",
		type:"POST",
		data:$("#"+formData).serialize(),
		success: function(data)
		{
			rec=data.split('~');
			if(rec[0]==1)
			{
				alert('Operation Successfully!');
				$(".get_trans_acc").html(rec[1]);
				document.getElementById(formData).reset();
				$("#transacc").modal('hide');
			}
			if(rec[0]==1062)
			{
				alert('Something Wrong With Your Query!');
				$("#succ").hide();
			}
		}
	});
}
//edit trans account
function edit_trans_acc(id)
{
	$("#transacc").modal({backdrop: 'static'});
	$.ajax({
		url:"../edits/edit_trans_acc?trans_acc_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#transacc input[name$='trans_acc_id']").val(data.trans_acc_id);
			$("#transacc select[name$='trans_acc_type']").val(data.trans_acc_type);
			$("#transacc input[name$='trans_acc_name']").val(data.trans_acc_name);
			$("#transacc select[name$='dr_cr']").val(data.dr_cr);
			$("#transacc input[name$='amount']").val(data.amount);
			$("#transacc input[name$='trans_acc_address']").val(data.trans_acc_address);
			$("#transacc select[name$='city_name']").val(data.city_name);
			$("#transacc select[name$='area_name']").val(data.area_name);
		}
	});
}
//add opening stock
function add_opning_stock(formData)
{
	$.ajax({
		url:"ajax_call/os_action",
		data:$("#"+formData).serialize(),
		type:"POST",
		success: function(data)
		{
			rec=data.split('~');
			if(rec[0]==1)
			{
				alert('Operation Successfully');
				$(".get_stock_det").html(rec[1]);
				document.getElementById(formData).reset();
				$("#opening_stock").modal('hide');
			}
			if(rec[0]==1062)
			{
				alert("Something Wrong With Your Query");
			}
		}
	});
}
//edit opening stock
function edit_opeining_stock(id)
{
	$("#opening_stock").modal({backdrop: 'static'});
	$("#opening_stock").find(".select2").css("width","100%");
	$.ajax({
		url:"edits/edit_os?stock_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#opening_stock input[name$='stock_id']").val(data.stock_id);
			$("#opening_stock input[name$='rate']").val(data.rate);
			$("#opening_stock input[name$='qty']").val(data.qty);
	//console.log($("#opening_stock select[name$='product_id']").val(data.product_id).prop("selected",true));
	//$('#opening_stock .select2 option:eq(1)').prop('selected', true)
	$('.select2 option:eq('+data.product_id+')').attr('selected', 'selected');
	$("#opening_stock").find(".select2-selection__rendered").text($('.select2 option:eq('+data.product_id+')').text())
		}
	});
}
//check previous sotkc record
// Remaining Items
$(document).on("change", ".thisProduct", function(){
	product_id=$(this).val();
	g=$(this);
	$.ajax({
		url:"ajax_call/rem_product?product_id="+product_id,
		success: function(data)
		{
			g.find(".remPro").val(data);
		}
	});
});
// create purchase invoice
function purchase_invoice()
{
	$("#loader").show();
		$.ajax({
			url:"ajax_call/p_action",
			type:"POST",
			data:$("#form").serializeArray(),
			success: function(data)
			{
				if(data==1)
				{
					$("#success-loader").modal({backdrop: 'static'});
				}
				else
				{
					$("#error-loader").modal();
				}
				$("#loader").hide();
			}
		});
}
function sale_invoice()
{
	$("#loader").show();
		$.ajax({
			url:"ajax_call/s_action",
			type:"POST",
			data:$("#form").serializeArray(),
			success: function(data)
			{
				rec=data.split('~');
				if(rec[0]==1)
				{
					$("#success-loader").modal({backdrop: 'static'});
					$("#printInv").attr("href","print_inv?invId="+rec[1]);
				}
				else
				{
					$("#error-loader").find("p").text(rec[0]);
					$("#error-loader").modal();
				}
				$("#loader").hide();
			}
		});
}
// sale invoice views
function sale_invoice_view(id)
{
	var show_data="";
	var tq=0;
	var st=0;
	$("#sale_invoice_view").modal();
	$.ajax({
		url:"json_views/get_sale_invoice?s_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#client_name").text(data[0]['all_data']['client_name']);
			for(i=0; i<data.length; i++)
			{
				show_data+="<tr>";
				 show_data+="<td>"+data[i]['all_data']['product_name']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['rate']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['qty']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['total']+"</td>";
				show_data+="</tr>";
				tq+=Number(data[i]['all_data']['qty']);
				st+=Number(data[i]['all_data']['total']);
			}
			show_data+="<tr>";
				 show_data+="<td colspan='2' align='right'><strong>Total</strong></td>";
				 show_data+="<td align='left'><strong>"+tq+"</strong></td>";
				 show_data+="<td><strong>"+st+"</strong></td>";
			show_data+="</tr>";
			show_data+="<tr>";
				 show_data+="<td colspan='3' align='right'>Discount</td>";
				 show_data+="<td align='left'><strong>"+data[0]['discount']+"</strong></td>";
			show_data+="</tr>";
			show_data+="<tr>";
				 show_data+="<td colspan='3' align='right'>Net Total</td>";
				 show_data+="<td align='left'><strong>"+data[0]['net_total']+"</strong></td>";
			show_data+="</tr>";
			show_data+="<tr>";
				 show_data+="<td colspan='3' align='right'>Receive</td>";
				 show_data+="<td align='left'><strong>"+data[0]['receive']+"</strong></td>";
			show_data+="</tr>";
			show_data+="<tr>";
				 show_data+="<td colspan='3' align='right'>Balance</td>";
				 show_data+="<td align='left'><strong>"+data[0]['balance']+"</strong></td>";
			show_data+="</tr>";
			$(".sale_inv_view").html(show_data);
		}
	});
}
//update sale invoice
function update_sale_invoice(sId)
{
		$.ajax({
			url:"ajax_call/update_sale?sId="+sId,
			type:"POST",
			data:$("#form").serializeArray(),
			success: function(data)
			{
				var rec=data.split('~');
				if(rec[0]==1)
				{
					$("#success-loader").modal({backdrop: 'static'});
					$("#printInv").attr("href","print_inv?invId="+rec[1]);
				}
				else
				{
					$("#error-loader").find("p").text(data);
					$("#error-loader").modal();
				}
			}
		});
}

// purchase invoice veiw
function purchase_invoice_view(id)
{
	var show_data="";
	var tq=0;
	var st=0;
	$("#purchase_invoice_view").modal();
	$.ajax({
		url:"json_views/get_purchase_view?p_id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#vendor_id").text(data[0]['all_data']['client_name']);
			for(i=0; i<data.length; i++)
			{
				show_data+="<tr>";
				 show_data+="<td>"+data[i]['all_data']['product_name']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['rate']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['qty']+"</td>";
				 show_data+="<td>"+data[i]['all_data']['total']+"</td>";
				show_data+="</tr>";
				tq+=Number(data[i]['all_data']['qty']);
				st+=Number(data[i]['all_data']['total']);
			}
			show_data+="<tr>";
				 show_data+="<td colspan='2' align='right'><strong>Total</strong></td>";
				 show_data+="<td align='left'><strong>"+tq+"</strong></td>";
				 show_data+="<td><strong>"+st+"</strong></td>";
			show_data+="</tr>";
			$(".sale_inv_view").html(show_data);
		}
	});
}
//update purchase invoice
function update_purchase_invoice(pId)
{
		$.ajax({
			url:"ajax_call/update_purchase?pId="+pId,
			type:"POST",
			data:$("#form").serializeArray(),
			success: function(data)
			{
				if(data==1)
				{
					$("#success-loader").modal({backdrop: 'static'});
				}
				else
				{
					$("#error-loader").find("p").text(data);
					$("#error-loader").modal();
				}
			}
		});
}
// new transactions
function addNew_trans()
{
	$("#transaction").modal({backdrop: 'static'});
}
// Retreive tha dta accont ledger
function get_acc_ledger()
{
	var tcr=0;
	var tdr=0;
	var tbal=0;
	$("#loader").show();
	$("#get_acc_ledger_ob").html("");
	$("#get_acc_ledger").html("");
	$.ajax({
		url:"ajax_call/get_acc_ledger",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			ob="";
			for(i=0; i<data.ob.length; i++)
			{
				ob+='<tr>';
				ob+='<td colspan="3" align="right">'+data.ob[i]['trans_acc_name']+'</td>';
				ob+='<td>'+data.ob[i]['description']+'</td>';
				ob+='<td>'+data.ob[i]['debit']+'</td>';
				ob+='<td>'+data.ob[i]['credit']+'</td>';
				ob+='<td>'+data.ob[i]['balance']+'</td>';
				ob+='</tr>';
			}
			$("#get_acc_ledger_ob").html(ob);
			acc_ledger="";
			if(data.allData!="")
			{
			for(j=0; j<data.allData.length; j++)
			{
				acc_ledger+='<tr>';
				acc_ledger+='<td>'+data.allData[j]['trans_date']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['voucher']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['trans_acc_name']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['narration']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['debit']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['credit']+'</td>';
				acc_ledger+='<td>'+data.allData[j]['balance']+'</td>';
				acc_ledger+='</tr>';
				tdr+=Number(data.allData[j]['debit']);
				tcr+=Number(data.allData[j]['credit']);
			}
			acc_ledger+='<tr>';
				acc_ledger+='<td colspan="4" align="right"><strong>Total</strong></td>';
				acc_ledger+='<td><strong>'+(data.total_balance.t_dr)+'</strong></td>';
				acc_ledger+='<td><strong>'+(data.total_balance.t_cr)+'</strong></td>';
				acc_ledger+='<td><strong>'+(data.total_balance.tbal)+'</strong></td>';
				acc_ledger+='</tr>';
			$("#get_acc_ledger").html(acc_ledger);
			}
			$("#loader").hide();
		}
	});
}
// fetch the transaction account accordingly accoun type
$(".fetch_trans_acc").on("change", function(){
	$.ajax({
		url:"../ajax_call/search_transacc?acc_type="+$(this).val(),
		dataType:"JSON",
		success: function(data)
		{
			var sel_acc="";
			for(i=0; i<data.length; i++)
			{
				sel_acc+='<option value="'+data[i]['trans_acc_id']+'">'+data[i]['trans_acc_name']+'</option>';
			}
			$(".selected_trans_acc").html('<option value="">Select Ledger A/C</option>'+sel_acc);
		}
	});
});
$(".trans_from").on("change", function()
{
	$.ajax({
		url:"ajax_call/get_transacc_to?trans_id="+$(this).val(),
		success:function(data)
		{
			$(".trans_to").html('<option value="">Select A/C</option>'+data);
		}
	});
});
//delere record
function del_rec(recId, type, path)
{
	x=confirm("Are You Sure?");
	if(!x){return false;}
	$.ajax({
		url:""+path+"del_rec?id="+recId+"&type="+type,
		success: function(data)
		{
			document.getElementById(recId).style.display='none';
			alert("Deleted Successfully");
		}
	});	
}
// edit transaction
function edit_transaction(trans_code)
{
	$("#transaction").modal({backdrop: 'static'});
	$.ajax({
		url:"../edits/edit_transaction?trans_code="+trans_code,
		dataType:"JSON",
		success: function(data)
		{
			$("#trans_acc_form input[name$='trans_date']").val(data.trans_date);
			$("#trans_acc_form select[name$='vt']").val(data.vt);
			//$('.trans_from option:eq('+data.from+')').attr('selected', 'selected');
			$("#trans_acc_form select[name$='trans_from']").attr('selected', 'selected');
	//$("#trans_acc_form").find(".select2-selection__rendered").text($('.trans_from option:eq('+data.from+')').text())
		}
	});
}
// calculte net income etc
function net_income()
{
	$("#loader").show();
	$.ajax({
		url:"ajax_call/get_netincome",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			var rec=data.split("~");
			$("#gp").text(rec[0]);
			$("#texp").text(rec[1]);
			$("#netincome").text(rec[2]);
			$("#loader").hide();
		}
	});
}
function main_menu()
{
	$.ajax({
		url:"ajax_call/get_main_menu",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			var rec=data.split('~');
			if(rec[0]==1){alert("Already Exist");}
			else if(rec[0]==2)
			{
				alert('Record Added Successfully');
				$(".get_menu").html(rec[1]);
				document.getElementById("form").reset();
			}
		}
	});
}
function menu_cat()
{
	$.ajax({
		url:"ajax_call/get_catgories",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			var rec=data.split('~');
			if(rec[0]==1){alert("Already Exist");}
			else if(rec[0]==2)
			{
				alert('Record Added Successfully');
				$(".get_catgories").html(rec[1]);
				document.getElementById("form").reset();
			}
		}
	});
}
$('#upload_img').submit(function(e){
    $.ajax( {
      url:"ajax_call/get_sub_catgories",
      type: 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
	  success: function(data)
	  {
		  var rec=data.split('~');
			if(rec[0]==1){alert("Already Exist");}
			else if(rec[0]==2)
			{
				alert('Record Added Successfully');
				$(".get_sub_catgories").html(rec[1]);
				document.getElementById("form").reset();
			}
	  }
    });
    e.preventDefault();
  } );
  function product_det(product_id)
{
	$("#product-detail").modal();
	$.ajax({
		url:"ajax_call/get_product_det?product_id="+product_id,
		dataType:"JSON",
		success: function(data)
		{
			$(".product_name").text(data['product_name']);
			$(".sale_price").text(data['sale_price']);
			$(".discount_price").text(data['discount_price']);
			$(".sale_from").text(data['sale_from']);
			$(".sale_to").text(data['sale_to']);
			$(".product_size").text(data['product_size']);
			$(".product_color").text(data['product_color']);
			$(".product_quantity").text(data['product_quantity']);
			$(".product_quantity").text(data['product_quantity']);
			$(".thumb_img").html('<img src="product_images/'+data['thumb_image']+'" width="200" height="200">');
		}
	});
}
function zoom_img(imgzm)
{
	$("#slider-modal").modal();
	$(".show-img").html('<img src="sliders/'+imgzm+'" width="100%" height="500px;">');
}
function pro_size_qty()
{
	$(".product_size_qty").append('<div class="rem_size_qty"><div class="col-md-3">'+
              	'<div class="form-group">'+
                	'<input type="text" name="product_size[]" class="form-control input-sm " placeholder="Size e.g 28">'+
                '</div>'+
              '</div>'+
			  '<div class="col-md-3">'+
			  	'<div class="form-group">'+
					'<input type="text" name="product_qty[]" class="form-control input-sm" placeholder="Product Quantity">'+
				'</div>'+
			  '</div>'+
              '<div class="col-md-2">'+
                	'<div class="form-group">'+
                	'<button type="button" class="btn btn-sm btn-warning rem_size_qty">Remove</button>'+
                    '</div>'+
                '</div>'+
                '<div class="clearfix"></div>');
}
function view_order_det(id)
{
	var txt="";
	$(".order_det").modal();
	$.ajax({
		url:"ajax_call/get_order_det?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$(".order_date").text(data['billing_det']['order_date']);
			$(".bill_name").text(data['billing_det']['first_name']+' '+ data['billing_det']['last_name']);
			$(".order_status").text(data['billing_det']['status']);
			$(".order_email").text(data['billing_det']['email']);
			$(".shipping_add").text(data['billing_det']['address']);
			myobj=data['order_det']['arrayInArray'];
			for(i in myobj)
			{
				txt+='<tr>';
				txt+='<td>'+myobj[i]['product_name']+' ('+myobj[i]['product_size']+')</td>';
				txt+='<td>'+myobj[i]['product_qty']+'</td>';
				txt+='<td>'+myobj[i]['price']+'</td>';
				txt+='</tr>';
			}
			txt+='<tr><td colspan="3" align="right"><strong>Total</strong>: '+data['billing_det']['total_amount']+'</td></tr>';
			$(".get_order_det").html(txt);
			$(".order_action_id").val(data['billing_det']['billing_id']);
			var myCheckbox = document.getElementsByName("order_status");
			  Array.prototype.forEach.call(myCheckbox,function(el){
				el.checked = false;
			  });
			$("."+data['billing_det']['status']).prop("checked", true);
		}
	});
}
// chnage the status of the given order
function order_action(status)
{
  x=confirm('Are you Sure');
  if(!x)
  {
  	return false;
  }
  var myCheckbox = document.getElementsByName("order_status");
  Array.prototype.forEach.call(myCheckbox,function(el){
  	el.checked = false;
  });
  status.checked = true;
  billing_id=$(".order_action_id").val();
  $.ajax({
  		url:"ajax_call/get_order_action?billing_id="+billing_id+"&status="+$(status).val(),
  		success:function(data)
  		{
  		 $("#"+billing_id).find(".orStatus").text($(status).val());
		 $(".order_det").modal('hide');
  		}
  });
  
}

function rem_balance(thisVal)
{
	$.ajax({
		url:"ajax_call/rem_balance?cId="+thisVal,
		success:function(data)
		{
			$("#rem_bal").val(data);
		}
	});
}






